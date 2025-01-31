<?php
namespace Deployer;

$hostname = getenv('HOSTNAME');
$username = getenv('USERNAME');
$deployPath = getenv('DEPLOY_PATH');

require 'recipe/laravel.php';
require 'recipe/rsync.php';


set('http_user', getenv('USERNAME'));
set('writable_use_sudo', false);


set('bin/php', function () {
    return '/usr/bin/php7.4';
});

set('bin/composer', function () {
    if (test('[ -f {{deploy_path}}/.dep/composer.phar ]')) {
        return '{{bin/php}} {{deploy_path}}/.dep/composer.phar';
    }

    if (commandExist('composer')) {
        return '{{bin/php}} ' . locateBinaryPath('composer');
    }

    run("cd {{deploy_path}} && curl -sS https://getcomposer.org/installer | {{bin/php}}");
    run('mv {{deploy_path}}/composer.phar {{deploy_path}}/.dep/composer.phar');
    return '{{bin/php}} {{deploy_path}}/.dep/composer.phar';
});


//require 'recipe/cachetool.php';


//set('cachetool', '/var/run/php/php-fpm.sock');
//set('bin/cachetool', 'cachetool-7.0.0.phar');

// Shared files/dirs between deploys

set('shared_files', ['public/.htaccess', 'public/config.php']);


set('shared_dirs', [
    'public/cache',
    'public/tmp',
    'public/userfls'
]);

set('rsync_src', function () {
    return __DIR__; // If your project isn't in the root, you'll need to change this.
});

// Configuring the rsync exclusions.
// You'll want to exclude anything that you don't want on the production server.
add('rsync', [
    'exclude' => [
        '.git',
        '/assets',
        '/src',
        '/public/cache',
        '/public/config.php',
        '/public/.htaccess',
        '/public/tmp',
        '/public/userfls',
        '/node_modules/',
        '.gitlab-ci.yml',
        'deploy.php',

    ],
]);

set('allow_anonymous_stats', false);

//set('cachetool_args', '--tmp-dir=/tmp --fcgi=/var/run/php/php7.4-fpm.sock');

host('main')
    ->hostname($hostname)
    ->user($username)
    ->port('22')
    ->forwardAgent(true)
    ->multiplexing(false)
    ->set('deploy_path', $deployPath)
    ->addSshOption('StrictHostKeyChecking', 'no');


task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'rsync', // Deploy code & built assets
    'deploy:shared',
    //'deploy:vendors',
    'deploy:writable',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup'
]);
// Recipe modifiers:

// Unlock after failed deploy process
after('deploy:failed', 'deploy:unlock');
