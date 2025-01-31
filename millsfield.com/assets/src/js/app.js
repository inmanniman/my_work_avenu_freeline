function initRating() {
    $('.js-rating-article').raty({
        score: $('.js-rating-article').data("rating"),
        starOn: '/img/m/star-on.png',
        starOff: '/img/m/star-off.png',
        starHalf: '/img/m/star-half.png',
        click: function(score, evt) {
            $.ajax({
                data: {
                    module : "rating",
                    element_id: $('.js-rating-article').data("element_id"),
                    module_name: $('.js-rating-article').data("module_name"),
                    element_type: $('.js-rating-article').data("element_type"),
                    action: 'add',
                    rating: score
                },
                type : 'POST'
            }).done(function(data) {
                let objData = JSON.parse(data);
                if (objData.errors) {
                    alert(objData.errors[0]);
                }
            });
        }
    });
}
const forms = document.querySelectorAll('form');
for(const form of forms){
  const tel = form.querySelector('.phone')
  const email = form.querySelector('.email')
  tel.addEventListener('keydown', (e) => {
    email.required = !e.target.value
  });
  email.addEventListener('input', (e) => {
    tel.required = !e.target.value
  });

}
function generateArticleContentLinks() {
    const pageContainer = $('.js-article-with-links');
    pageContainer.append("<ul class='article-inner-links'></ul>");

    const articleLinksContainer = $('.article-inner-links');

    let articleLinks = $('.js-article-with-links-container').find('h2').not('.js-not-include-in-links');

    $('.article-inner-links').hide();
    articleLinks.each(function (index, value) {
        articleLinksContainer.append("<li><a href='#title-" + index +"'>"+ value.innerText +"</a></li>");
        $(this).attr('id', 'title-' + index);
    })

    $('.js-article-with-links__loader').hide();
    $('.article-inner-links').show();
    $('.article-inner-links a').click(function(e) {
        e.preventDefault();
        var hrefto = $(this).attr('href');
        if (hrefto) {
            $.scrollTo(hrefto, 800,{'offset':-120});
        }
    });
}

$(function() {
    generateArticleContentLinks();
    initRating();
});
