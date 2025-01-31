<?php
/**
 * Файл-блок шаблона
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2020 OOO «Диафан» (http://www.diafan.ru/)
 */

?>


<!-- шаблонный тег show_js подключает JS-файлы. Описан в файле themes/functions/show_js.php. -->
<insert name="show_js"></insert>

<script src='/assets/js/app.js'></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/raty-js@3.1.0/lib/jquery.raty.js" type="text/javascript"></script>

<script src='/<insert name="custom" path="assets/js/graph.min.js"></insert>?v=7'></script>
<script src='/<insert name="custom" path="assets/js/nav.min.js"></insert>?v=7'></script>
<script src='/<insert name="custom" path="assets/js/theme.min.js"></insert>?v=13'></script>

<script>
    if (document.querySelector(".graphSVG")) {
        let data = [0, 4.7, 3.7, 5.3, 6.6, 5.8, 8.1, 12.1, 12.1, 15.5, 13.8, 14.4, 13.2, 21.2, 23.5, 21.6, 22.2, 21.4, 21.6, 23, 23.9, 26.1, 26.7, 24, 25.8, 24.8, 26.3, 26.3, 25.1, 27.2, 24.7, 23.6, 23.6, 26.0, 25.1, 27, 26.3, 27, 26, 28, 32.8];
        let graphData = [];
        let graph = '';

        const graphSVGBlock = document.querySelector(".graphSVG-block");
        const graphId = document.querySelector(".graphSVG .graph");
        const graphGradient = document.querySelector(".graphSVG .graphGradient");
        const svg = document.querySelector(".graphSVG");
        const pointGraph = document.querySelector(".graphSVG .pointGraph");
        const verticalLine = document.querySelector(".graphSVG .vertical-line");
        const horizontalLine = document.querySelector(".graphSVG .horizontal-line");
        const bubble = document.querySelector(".graphSVG .bubble");
        const text = document.querySelector(".graphSVG .text");
        const ratio = graphSVGBlock.offsetWidth / 585;
        const stepY = 8;
        const zeroX = 51;
        const zeroY = 265;
        const sizeScaleX = 584;
        const stepX = ((sizeScaleX - zeroX) / (data.length - 1));

        graph += 'M' + zeroX + ' ' + zeroY + ' ';

        graphData = data.map((item, i, data) => {
            let x = zeroX + i * stepX;
            let y = zeroY - item * stepY;
            return {x, y};
        });

        graph += graphData.map((item, i, data) => {
            return `L ${item.x} ${item.y}`;
        }).join(' ');

        graphId.setAttribute('d', graph);

        graph += 'L' + sizeScaleX + ' ' + zeroY + ' L' + zeroX + ' ' + zeroY;

        graphGradient.setAttribute('d', graph);

        svg.addEventListener('mousemove', (e) => {
            const eX = e.offsetX/ratio;
            let pointIndex = graphData.findIndex((item) => eX < item.x);
            if (pointIndex === -1) {
                return;
            }
            if (pointIndex > 0) {
                const currentdX = Math.abs(eX - graphData[pointIndex].x);
                const prewdX = Math.abs(eX - graphData[pointIndex - 1].x);
                if (currentdX > prewdX) {
                    pointIndex -= 1;
                }
            }
            const point = graphData[pointIndex];
            pointGraph.setAttribute('cx', point.x);
            pointGraph.setAttribute('cy', point.y);
            if (pointIndex < 2) {
                bubble.setAttribute('x', point.x + 10);
                bubble.setAttribute('y', point.y - 40);
                text.setAttribute('x', point.x + 20);
                text.setAttribute('y', point.y - 20);
            } else {
                if (graphData[pointIndex].y > 28) {
                    bubble.setAttribute('x', point.x - 73);
                    bubble.setAttribute('y', point.y - 40);
                    text.setAttribute('x', point.x - 62);
                    text.setAttribute('y', point.y - 20);
                } else {
                    bubble.setAttribute('x', point.x - 73);
                    bubble.setAttribute('y', point.y + 10);
                    text.setAttribute('x', point.x - 62);
                    text.setAttribute('y', point.y + 30);
                }
            }
            text.innerHTML = '+' + data[pointIndex] + '%';
            verticalLine.setAttribute('d', 'M' + point.x + ' 283L' + point.x + ' 24');
            horizontalLine.setAttribute('d', 'M51 ' + point.y + 'L585 ' + point.y);
            // e.offsetX
        });
    }
    if (document.querySelector(".graphSVG-2")) {
        let data = [0,3,5.3,5.7,2.5,5.1,6.4,7.7,7.6,7.5,10.4,15.8,15.3,14.7,11.8,14.4,16.2,19.1,19.9,22.4,22.4,22.4,22.4,22.4,26.3,27.1,25.9,24.8,25.6,24.4,25.3,25.7,26.1,26.6,25.1,27.6,28.8,30.1,31.8,32.7,31.3];
        let graphData = [];
        let graph = '';

        const graphSVGBlock = document.querySelector(".graphSVG-block-2");
        const graphId = document.querySelector(".graphSVG-2 .graph");
        const graphGradient = document.querySelector(".graphSVG-2 .graphGradient");
        const svg = document.querySelector(".graphSVG-2");
        const pointGraph = document.querySelector(".graphSVG-2 .pointGraph");
        const verticalLine = document.querySelector(".graphSVG-2 .vertical-line");
        const horizontalLine = document.querySelector(".graphSVG-2 .horizontal-line");
        const bubble = document.querySelector(".graphSVG-2 .bubble");
        const text = document.querySelector(".graphSVG-2 .text");
        const ratio = graphSVGBlock.offsetWidth / 585;
        const stepY = 8;
        const zeroX = 51;
        const zeroY = 265;
        const sizeScaleX = 584;
        const stepX = ((sizeScaleX - zeroX) / (data.length - 1));

        graph += 'M' + zeroX + ' ' + zeroY + ' ';

        graphData = data.map((item, i, data) => {
            let x = zeroX + i * stepX;
            let y = zeroY - item * stepY;
            return {x, y};
        });

        graph += graphData.map((item, i, data) => {
            return `L ${item.x} ${item.y}`;
        }).join(' ');

        graphId.setAttribute('d', graph);

        graph += 'L' + sizeScaleX + ' ' + zeroY + ' L' + zeroX + ' ' + zeroY;

        graphGradient.setAttribute('d', graph);

        svg.addEventListener('mousemove', (e) => {
            const eX = e.offsetX/ratio;
            let pointIndex = graphData.findIndex((item) => eX < item.x);
            if (pointIndex === -1) {
                return;
            }
            if (pointIndex > 0) {
                const currentdX = Math.abs(eX - graphData[pointIndex].x);
                const prewdX = Math.abs(eX - graphData[pointIndex - 1].x);
                if (currentdX > prewdX) {
                    pointIndex -= 1;
                }
            }
            const point = graphData[pointIndex];
            pointGraph.setAttribute('cx', point.x);
            pointGraph.setAttribute('cy', point.y);
            if (pointIndex < 2) {
                bubble.setAttribute('x', point.x + 10);
                bubble.setAttribute('y', point.y - 40);
                text.setAttribute('x', point.x + 20);
                text.setAttribute('y', point.y - 20);
            } else {
                if (graphData[pointIndex].y > 28) {
                    bubble.setAttribute('x', point.x - 73);
                    bubble.setAttribute('y', point.y - 40);
                    text.setAttribute('x', point.x - 62);
                    text.setAttribute('y', point.y - 20);
                } else {
                    bubble.setAttribute('x', point.x - 73);
                    bubble.setAttribute('y', point.y + 10);
                    text.setAttribute('x', point.x - 62);
                    text.setAttribute('y', point.y + 30);
                }
            }
            text.innerHTML = '+' + data[pointIndex] + '%';
            verticalLine.setAttribute('d', 'M' + point.x + ' 283L' + point.x + ' 24');
            horizontalLine.setAttribute('d', 'M51 ' + point.y + 'L585 ' + point.y);
            // e.offsetX
        });
    }

    if (document.querySelector(".graphSVG-2021")) {
        let data = [0,2.95,5.12,3.97,5.29,6.61,11.07,13.88,15.54,15.37,15.21,15.7,16.2,16.69,20.17,19.83,19.67,19.65,19.63,19.61,19.59,19.57,19.55,19.52,19.5,19.67,19.17,18.68,19.5,20.33,21.98,21.90,21.82,21.74,21.86,21.98,21.81,24.46,26.2,25.95,25.70,25.45,25.45,25.45,25.45,25.45,24.79,24.13,23.8,23.47,24.34,25.21,25.12,25.04,24.96,25.12,25.21,25.29,25.45,24.96,25.37,25.79,25.62,25.45,25.45,25.45,25.45,24.96,24.46,23.8,23.31,22.64,26.12,29.09,32.40,31.57,32.07,31.57,27.44,29.75,32.23,34.71,37.19,36.69,37.02,37.5,37.5,37.5,37.5];
        let graphData = [];
        let graph = '';

        const graphSVGBlock = document.querySelector(".graphSVG-block-2021");
        const graphId = document.querySelector(".graphSVG-2021 .graph");
        const graphGradient = document.querySelector(".graphSVG-2021 .graphGradient");
        const svg = document.querySelector(".graphSVG-2021");
        const pointGraph = document.querySelector(".graphSVG-2021 .pointGraph");
        const verticalLine = document.querySelector(".graphSVG-2021 .vertical-line");
        const horizontalLine = document.querySelector(".graphSVG-2021 .horizontal-line");
        const bubble = document.querySelector(".graphSVG-2021 .bubble");
        const text = document.querySelector(".graphSVG-2021 .text");
        const ratio = graphSVGBlock.offsetWidth / 585;
        const stepY = 6;
        const zeroX = 51;
        const zeroY = 265;
        const sizeScaleX = 584;
        const stepX = ((sizeScaleX - zeroX) / (data.length - 1));

        graph += 'M' + zeroX + ' ' + zeroY + ' ';

        graphData = data.map((item, i, data) => {
            let x = zeroX + i * stepX;
            let y = zeroY - item * stepY;
            return {x, y};
        });

        graph += graphData.map((item, i, data) => {
            return `L ${item.x} ${item.y}`;
        }).join(' ');

        graphId.setAttribute('d', graph);

        graph += 'L' + sizeScaleX + ' ' + zeroY + ' L' + zeroX + ' ' + zeroY;

        graphGradient.setAttribute('d', graph);

        svg.addEventListener('mousemove', (e) => {
            const eX = e.offsetX/ratio;
            let pointIndex = graphData.findIndex((item) => eX < item.x);
            if (pointIndex === -1) {
                return;
            }
            if (pointIndex > 0) {
                const currentdX = Math.abs(eX - graphData[pointIndex].x);
                const prewdX = Math.abs(eX - graphData[pointIndex - 1].x);
                if (currentdX > prewdX) {
                    pointIndex -= 1;
                }
            }
            const point = graphData[pointIndex];
            pointGraph.setAttribute('cx', point.x);
            pointGraph.setAttribute('cy', point.y);
            if (pointIndex < 2) {
                bubble.setAttribute('x', point.x + 10);
                bubble.setAttribute('y', point.y - 40);
                text.setAttribute('x', point.x + 20);
                text.setAttribute('y', point.y - 20);
            } else {
                if (graphData[pointIndex].y > 28) {
                    bubble.setAttribute('x', point.x - 73);
                    bubble.setAttribute('y', point.y - 40);
                    text.setAttribute('x', point.x - 62);
                    text.setAttribute('y', point.y - 20);
                } else {
                    bubble.setAttribute('x', point.x - 73);
                    bubble.setAttribute('y', point.y + 10);
                    text.setAttribute('x', point.x - 62);
                    text.setAttribute('y', point.y + 30);
                }
            }
            text.innerHTML = '+' + data[pointIndex] + '%';
            verticalLine.setAttribute('d', 'M' + point.x + ' 283L' + point.x + ' 24');
            horizontalLine.setAttribute('d', 'M51 ' + point.y + 'L585 ' + point.y);
            // e.offsetX
        });
    }
</script>

<!-- шаблонный тег подключает вывод информации о Политике конфиденциальности. Если необходимо вывести свой текст сообщения, то добавле его в атрибут "text". -->
<insert name="show_privacy" hash="false" text=""></insert>

</body>
</html>
