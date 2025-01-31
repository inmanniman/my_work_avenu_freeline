import noUiSlider from 'nouislider';
var connectSlider = document.querySelector('.modal-application__slider');
var priceSum = document.querySelector('.modal-application__price-sum');
var connectSliderInitialPayment = document.querySelector('.modal-application__slider-initial-payment');
var priceSumPercent = document.querySelector('.modal-application__price-percent');


noUiSlider.create(connectSlider, {
  start: 1000000,
  connect: [true, false],
  step: 10,
  range: {
    'min': 0,
    'max': 2000000
  }
});

noUiSlider.create(connectSliderInitialPayment, {
  start: 13,
  connect: [true, false],
  step: 1,
  range: {
    'min': 0,
    'max': 30
  }
});

// Получаем текущее значение слайдера
connectSlider.noUiSlider.on('update', function(values, handle) {
  priceSum.innerHTML = values[handle];
});

connectSliderInitialPayment.noUiSlider.on('update', function(values, handle) {
  priceSumPercent.innerHTML = values[handle];
});
