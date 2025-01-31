import * as wNumb from 'wnumb';
import * as List from 'list.js';
import {listClass} from "list.js";

// console.log(productData);

const moneyFormat = wNumb({
  decimals: 0,
  thousand: ' ',
  suffix: ' $'
});

const calcTextInput = document.querySelector('.leasing-calc-text-data-18');
const survey = document.querySelector('.form-survey');
const app = document.querySelector('.js-leasing-calc');
const addButton = app.querySelector('.leasing-calc__add-button');
const list = app.querySelector('.leasing-calc__list');
const summ = app.querySelector('.leasing-calc__sum');
const trList = app.querySelector('.leasing-calc__tr-list');
const trClose = app.querySelector('.leasing-calc-tr__close');

const viewItems = survey.querySelectorAll('.form-view__items');

if (app) {

  viewItems.forEach(function (item, index) {
    const next = item.querySelector('.calc-nav__btn-next');
    const back = item.querySelector('.calc-nav__btn-back');
    const id = Number(item.dataset.id);
    // console.log(next);
    if (id > 0 && id < 5) {
      if (next) {
        next.addEventListener('click', function (event) {
          item.style.display = 'none';
          viewItems[index + 1].style.display = 'flex';
        });
      }
    }

    if (back) {
      back.addEventListener('click', function (event) {
        item.style.display = 'none';
        viewItems[index - 1].style.display = 'flex';
      });
    }
  });

  listik();
  addButton.addEventListener("click", getList);
}


function listik() {
  let options = {
    valueNames: [
      'name',
      {name: 'img', attr: 'src'},
      {name: 'price', data: ['price']}
    ]
  };
  const hackerList = new List('tr-list', options);
  hackerList.items.forEach(function (el, index) {
    const item = el.elm;
    item.addEventListener("click",function () {
      const id = item.dataset.id;
      // console.log(id);
      const my = list.querySelector(`[data-id='${id}']`);
      // console.log(my);
      if (my) {
        const select = my.querySelector('.leasing-calc-item__count-select');
        if (select.selectedIndex < 9) {
          select.selectedIndex = select.selectedIndex + 1;
        }
        //update
        sumUpdate();
      } else {
        addItem(productData[id],id);
      }

    });
  });
  //console.log(hackerList.items);
}

function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}

// function leasingCalc() {
//   if (productData) {
//     // console.log(productData);
//     addButton.addEventListener('click', getList);
//
//   }
// }

function getList() {
  trList.classList.remove('hide');
  trClose.addEventListener('click',function (event) {
    trList.classList.add('hide');
  });
}

function addItem(item,id) {
  let elem = document.createElement('div');
  elem.className = 'leasing-calc-item';
  elem.append(trTpl.content.cloneNode(true));
  elem.dataset.id = id;
  elem.dataset.price = item.price_no_format;
  elem.querySelector('.leasing-calc-item__img').src = item.photo;
  elem.querySelector('.leasing-calc-item__name').textContent = item.name;
  elem.querySelector('.leasing-calc-item__sum').textContent = moneyFormat.to(Number(item.price_no_format));
  elem.querySelector('.leasing-calc-item__count-select').addEventListener("change", function () {
    //update
    sumUpdate();
  });
  elem.querySelector('.leasing-calc-item__delete-btn').addEventListener("click", function (event) {
    event.stopPropagation();
    elem.remove();
    //update
    sumUpdate();
  });
  list.append(elem);
  //update
  sumUpdate();
}

function sumUpdate() {
  const items = list.querySelectorAll('.leasing-calc-item');
  let textData = '';
  let sum = 0;
  items.forEach(function (item) {
    const price = Number(item.dataset.price);
    const name = item.querySelector('.leasing-calc-item__name').textContent;
    const count = item.querySelector('.leasing-calc-item__count-select').selectedIndex + 1;
    const itemSum = price * count;
    item.querySelector('.leasing-calc-item__sum').textContent = moneyFormat.to(Number(itemSum));
    sum += itemSum;
    textData += `${name} - ${count}шт - ${moneyFormat.to(Number(itemSum))} ||`;
  });
  summ.textContent = moneyFormat.to(Number(sum));
  calcTextInput.value = textData;
}
