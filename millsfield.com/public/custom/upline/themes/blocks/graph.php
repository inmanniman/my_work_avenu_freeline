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
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<section class="graph container">
    <div class="graph__title">
        <insert value="График доходности МИЛЛСФИЛД КЭПИТАЛ"/>
    </div>
    <div class="graph__wrapper-graph">
        <canvas id="graph" height="390" data-graph='<insert value="graph">'></canvas>
        <span class="graph__text">
            <insert value="Детализация доступна по запросу"/>
        </span>
    </div>
</section>

<script>
    var data = {
        labels: [],
        datasets: [{
            data: [],
            lineTension: 0,
            borderWidth: 4,
            fill: false,
            pointRadius: 8,
            pointBorderWidth: 4,
            borderColor: '#395B89',
            backgroundColor: '#395B89',
            pointBorderColor: '#C0C7CF',
            pointHoverRadius: 12,
            pointHoverBorderWidth: 4
        }]
    };

    const getOrCreateTooltip = (chart) => {
  let tooltipEl = chart.canvas.parentNode.querySelector('div');
  if (!tooltipEl) {
    tooltipEl = document.createElement('div');
    tooltipEl.style.borderRadius = '4px';
    tooltipEl.style.color = '#395B89';
    tooltipEl.style.opacity = 1;
    tooltipEl.style.fontSize = '12px';
    tooltipEl.style.fontWeight = 400;
    tooltipEl.style.minWidth = '90px';
    tooltipEl.style.pointerEvents = 'none';
    tooltipEl.style.position = 'absolute';
    tooltipEl.style.transform = 'translate(-50%, 0)';
    tooltipEl.style.transition = 'all .1s ease';

    const table = document.createElement('table');
    table.style.margin = '0px';
    table.style.padding = '0px';
    table.style.borderRadius = '4px';
    table.style.background = '#C0C7CF';
    tooltipEl.appendChild(table);
    chart.canvas.parentNode.appendChild(tooltipEl);
  };
  return tooltipEl;
};

const externalTooltipHandler = (context) => {
  // Tooltip Element
  const {chart, tooltip} = context;
  const tooltipEl = getOrCreateTooltip(chart);

  // Hide if no tooltip
  if (tooltip.opacity === 0) {
    tooltipEl.style.opacity = 0;
    return;
  }

  // Set Text
  if (tooltip.body) {
    const titleLines = tooltip.title || [];
    const bodyLines = tooltip.body.map(b => b.lines);

    const tableHead = document.createElement('thead');

    titleLines.forEach(title => {
      const tr = document.createElement('tr');
      tr.style.borderWidth = 0;
      tr.style.display = 'flex';
      tr.style.justifyContent = 'center';
      tr.style.padding = '4px';
      tr.style.minHeight = '30px';

      const th = document.createElement('th');
      th.style.borderWidth = 0;
      th.style.padding = 0;
      th.style.fontWeight = 400;
      th.style.lineHeight = '21px';
      th.style.letterSpacing = '0.05%';
      const text = document.createTextNode(title);

      th.appendChild(text);
      tr.appendChild(th);
      tableHead.appendChild(tr);
    });

    const tableBody = document.createElement('tbody');
    bodyLines.forEach((body, i) => {
      const colors = tooltip.labelColors[i];

      const tr = document.createElement('tr');
      tr.style.backgroundColor = 'inherit';
      tr.style.display = 'flex';
      tr.style.justifyContent = 'center';
      tr.style.padding = '4px';
      tr.style.borderWidth = 0;
      tr.style.backgroundColor = '#fff';
      tr.style.minHeight = '30px';
      tr.style.borderRadius = '0 0 4px 4px';  
      tr.style.border = '1px solid #C0C7CF';  


      const td = document.createElement('td');
      td.style.borderWidth = 0;
      td.style.padding = 0;
      td.style.textAlign = 'center';
      td.style.fontWeight = 700;
      td.style.lineHeight = '21px';
      td.style.letterSpacing = '0.05%';

      const text = document.createTextNode(body + '%');

      td.appendChild(text);
      tr.appendChild(td);
      tableBody.appendChild(tr);
    });

    const tableRoot = tooltipEl.querySelector('table');

    // Remove old children
    while (tableRoot.firstChild) {
      tableRoot.firstChild.remove();
    }

    // Add new children
    tableRoot.appendChild(tableHead);
    tableRoot.appendChild(tableBody);
  }

  const {offsetLeft: positionX, offsetTop: positionY} = chart.canvas;

  // Display, position, and set styles for font
  tooltipEl.style.opacity = 1;
  tooltipEl.style.left = positionX + tooltip.caretX + 'px';
  tooltipEl.style.top = positionY + tooltip.caretY + 'px';
  tooltipEl.style.font = tooltip.options.bodyFont.string;
  tooltipEl.style.padding = tooltip.options.padding + 'px ' + tooltip.options.padding + 'px';
};

    const dataGraphElement = document.querySelector('[data-graph]');

    function parsMultipleData() {
        const dataGraph = dataGraphElement.getAttribute('data-graph');
        const dataParts = dataGraph.split('&&');
        dataParts.forEach((element, index) => {
            const dataPart = element.split('|');
            const datePart = dataPart[0];
            const percentPart = parseInt(dataPart[1]);
            data.labels[index] = datePart;
            data.datasets[0].data[index] = percentPart;
        });
    };

    if (dataGraphElement) {
        parsMultipleData();
    }

    // Chart.defaults.font.size = 16;
    // Конфигурация графика
    let options = {
        
        scales: {
            x: {
                ticks: {
                    padding: 8,
                    font: {
                        size: 12,
                    },
                    color: '#718192'
                },
                grid: {
                    tickLength: 20,
                    drawOnChartArea: false
                }
            },
            y: {
                type: 'linear',
                position: 'left',
                ticks: {
                    padding: 8,
                    font: {
                        size: 12,
                    },
                    color: '#718192',
                    // Форматирование меток оси Y в проценты
                    callback: function (value) {
                        return value + '%';
                    },
                    stepSize: 10, // Шаг между значениями оси Y
                    min: 0,      // Минимальное значение оси Y
                    max: 100     // Максимальное значение оси Y
                },
                grid: {
                    tickLength: 20,
                    drawOnChartArea: false
                }
            }
        },
        interaction: {
        mode: 'index',
        intersect: false,
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: false,
                position: 'nearest',
                external: externalTooltipHandler
            },
        },
        onHover: function (event, chartElement) {
            document.getElementById('graph').style.cursor = chartElement[0] ? 'pointer' : 'default';
        },
        maintainAspectRatio: false, // добавьте это свойство для игнорирования соотношения сторон
        responsive: false, // добавьте это свойство для отключения автоматической реакции на изменения размера окна
        height: 390 // устанавливаем высоту
    };

    class Custom extends Chart.LineController {
        draw() {
            super.draw(arguments);

            const ctx = this.chart.ctx;
            const _stroke = ctx.stroke;
            ctx.stroke = function() {
                ctx.save();
                ctx.shadowColor = 'rgba(0, 0, 0, 0.05)';
                ctx.shadowBlur = 10;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 30;
                _stroke.apply(this, arguments);
                ctx.restore();
            }
        }
    };


    const hoverLine = {
    id: 'hoverLine',
    afterDatasetsDraw(chart, args, plugins) {
        const { ctx, tooltip, chartArea: { top, bottom, left, right, width, height }, scales: { x, y } } = chart;

        if (tooltip._active.length > 0) {
            const xCoor = x.getPixelForValue(tooltip.dataPoints[0].dataIndex);
            const yCoor = y.getPixelForValue(tooltip.dataPoints[0].parsed.y);

            // Рисуем вертикальную пунктирную линию
            ctx.save();
            ctx.beginPath();
            ctx.lineWidth = 1;
            ctx.strokeStyle = '#C0C7CF';
            ctx.setLineDash([6, 6]);
            ctx.moveTo(xCoor, top);
            ctx.lineTo(xCoor, bottom);
            ctx.stroke();
            ctx.closePath();
            ctx.restore();

            // Рисуем горизонтальную пунктирную линию
            ctx.save();
            ctx.beginPath();
            ctx.lineWidth = 1;
            ctx.strokeStyle = '#C0C7CF';
            ctx.setLineDash([6, 6]);
            ctx.moveTo(left, yCoor);
            ctx.lineTo(right, yCoor);
            ctx.stroke();
            ctx.closePath();
            ctx.restore();

            // Изменяем стиль текста labels оси X
            const labelText = data.labels[tooltip.dataPoints[0].dataIndex];
            ctx.save();
            ctx.fillStyle = '#ff0000'; // Замените на желаемый цвет текста
            ctx.font = 'bold 14px Arial'; // Замените на желаемый шрифт и размер текста
            ctx.textAlign = 'center';

            // Изменяем стиль текста и фона с добавлением border-radius
            const rectX = xCoor - 50;
            const rectY = bottom + 17;
            const rectWidth = 100;
            const rectHeight = 30;
            const borderRadius = 4; // Замените на желаемый радиус скругления углов

            ctx.fillStyle = '#fff'; // Замените на желаемый цвет текста
            ctx.beginPath();
            ctx.moveTo(rectX + borderRadius, rectY);
            ctx.lineTo(rectX + rectWidth - borderRadius, rectY);
            ctx.quadraticCurveTo(rectX + rectWidth, rectY, rectX + rectWidth, rectY + borderRadius);
            ctx.lineTo(rectX + rectWidth, rectY + rectHeight - borderRadius);
            ctx.quadraticCurveTo(rectX + rectWidth, rectY + rectHeight, rectX + rectWidth - borderRadius, rectY + rectHeight);
            ctx.lineTo(rectX + borderRadius, rectY + rectHeight);
            ctx.quadraticCurveTo(rectX, rectY + rectHeight, rectX, rectY + rectHeight - borderRadius);
            ctx.lineTo(rectX, rectY + borderRadius);
            ctx.quadraticCurveTo(rectX, rectY, rectX + borderRadius, rectY);
            ctx.closePath();

            ctx.strokeStyle = '#C0C7CF'; // Замените на желаемый цвет границы
            ctx.lineWidth = 1; // Замените на желаемую толщину границы
            ctx.stroke();
            ctx.fill();

            ctx.fillStyle = '#395B89'; // Замените на желаемый цвет фона
            ctx.fillText(labelText, xCoor, bottom + 37); // Вы можете настроить положение текста
            ctx.restore();
        }
    }
};


    Custom.id = 'shadowLine';
    Custom.defaults = Chart.LineController.defaults;
    Chart.register(Custom);

    // Создание графика
    let ctx = document.getElementById('graph').getContext('2d');
    let myChart = new Chart(ctx, {
        type: 'shadowLine',
        data: data,
        options: options,
        plugins: [hoverLine]
    });


</script>
