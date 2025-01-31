import * as noUiSlider from 'nouislider';
import * as wNumb from 'wnumb';


let sliders = document.querySelectorAll('.survey-nouislider');
if (sliders.length) {
  sliders.forEach(function (slider, index) {
    const slide = slider.querySelector('.form-view__nouislider');
    const minValue = Number(slider.dataset.min);
    const maxValue = Number(slider.dataset.max);
    const postfix = slider.dataset.postfix;
    const prefix = slider.dataset.prefix;
    const centerValue = Math.floor(maxValue / 2);
    // console.log(centerValue);
    // console.log(slider);
    // console.log(minValue);
    // console.log(maxValue);

    window['testSlide'+index] = noUiSlider.create(slide, {
      range: {
        min: minValue,
        max: maxValue
      },
      connect: [true, false],
      start: [centerValue],
      format: wNumb({
        decimals: 0,
        thousand: ' ',
        prefix: prefix,
        suffix: postfix
      }),
      pips: {
        mode: 'count',
        values: 5,
        format:  wNumb({
          decimals: 0,
          thousand: ' ',
          prefix: prefix,
          suffix: postfix
        }),
        // mode: 'steps',
        // density: 3,
        // filter: filterPips,
        // format: wNumb({
        //   decimals: 0,
        // })
      }
    });
    let pips = slider.querySelectorAll('.noUi-value');

    function clickOnPip() {
      // console.log(Number(this.getAttribute('data-value')));
      let value = Number(this.getAttribute('data-value'));
      slide.noUiSlider.set(value);
    }

    for (let i = 0; i < pips.length; i++) {

      // For this example. Do this in CSS!
      pips[i].style.cursor = 'pointer';
      pips[i].addEventListener('click', clickOnPip);
    }

    const field = slider.querySelector('.form-view__numtext-input');
    const numTextValue = slider.querySelector('.form-view__numtext-value');

    // console.log(numTextValue);

    slide.noUiSlider.on('update', function (values, handle) {
      field.value = values[handle];
      numTextValue.innerHTML = values[handle];
    });

    const allPips = slide.querySelectorAll('.noUi-value');
    // console.log(allPips);
    // console.log(11111);
    // console.log(allPips.length-1);
    allPips[0].classList.add('noUi-value-first');
    allPips[allPips.length-1].classList.add('noUi-value-last');
  });
}
