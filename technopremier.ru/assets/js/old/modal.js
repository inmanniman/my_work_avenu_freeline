// var currentForm = 1;
//
// for (var i = 1; i <= 3; i++) {
//   document.querySelector('.btn-modal' + i).addEventListener('click', function() {
//     document.querySelector('.form' + currentForm).style.display = 'none';
//     currentForm = currentForm + 1;
//     if (currentForm > 3) {
//       currentForm = 1;
//     }
//     document.querySelector('.form' + currentForm).style.display = 'block';
//   });
// }

// let form1 = document.querySelector('.modal-application__wrapper-content');
// let form2 = document.querySelector('.modal-list');
//
// let btnModal1 = document.querySelector('.btn-modal1');
//
// btnModal1.onclick = function () {
//   form1.style.display = "none";
//   form2.style.display = "block";
// };

let btnNext = document.querySelectorAll(".btn-next");
let btnPrev = document.querySelectorAll(".btn-prev");
let form = document.querySelectorAll(".form1, .form2, .form3, .form4, .form5, .form6");

let formCounter = 0;

form[formCounter].style.display = "block";

for (let i = 0; i < btnNext.length; i++) {
  btnNext[i].addEventListener("click", function(){
    form[formCounter].style.display = "none";
    formCounter++;
    form[formCounter].style.display = "block";
  });
}

for (let i = 0; i < btnPrev.length; i++) {
  btnPrev[i].addEventListener("click", function(){
    form[formCounter].style.display = "none";
    formCounter--;
    form[formCounter].style.display = "block";
  });
}

//счет суммы
const select = document.querySelectorAll('.modal-list__option');
const summTransport = document.querySelectorAll('.modal-list__summ-transport');

select.forEach((item, i) => {
  item.addEventListener('change', () => {
    const value = item.value;
    summTransport[i].innerHTML = value * 5000 + ' сом';
  });
});


//Добавление блока
const addBuyBtn = document.querySelector(".modal-list__add-buy-transport");
const wrapperBuyColumn = document.querySelector(".modal-list__wrapper-buy-column");

addBuyBtn.addEventListener("click", function (e) {
  e.preventDefault();

  const line = document.createElement("div");
  line.classList.add("modal-list__line");

  const wrapperColumnRow = document.createElement("div");
  wrapperColumnRow.classList.add("modal-list__wrapper-column-row");

  const wrapperNameTransport = document.createElement("div");
  wrapperNameTransport.classList.add("modal-list__wrapper-name-transport");

  const img = document.createElement("img");
  img.setAttribute("width", "80");
  img.setAttribute("height", "47");
  img.classList.add("modal-list__img");
  img.setAttribute("src", "/images/front-loaders-buy.png");
  img.setAttribute("alt", "Экскаватор");
  img.setAttribute("loading", "lazy");

  const nameTransport = document.createElement("span");
  nameTransport.classList.add("modal-list__name-transport");
  nameTransport.textContent = "Экскаватор 950E LiuGong";

  const wrapperSummTransport = document.createElement("div");
  wrapperSummTransport.classList.add("modal-list__wrapper-summ-transport");

  const select = document.createElement("select");
  select.classList.add("modal-list__option");
  select.classList.add("option");

  const option1 = document.createElement("option");
  option1.textContent = "1";
  const option2 = document.createElement("option");
  option2.textContent = "2";
  const option3 = document.createElement("option");
  option3.textContent = "3";
  const option4 = document.createElement("option");
  option4.textContent = "4";
  const option5 = document.createElement("option");
  option5.textContent = "5";
  const option6 = document.createElement("option");
  option6.textContent = "6";
  const option7 = document.createElement("option");
  option7.textContent = "7";

  select.appendChild(option1);
  select.appendChild(option2);
  select.appendChild(option3);
  select.appendChild(option4);
  select.appendChild(option5);
  select.appendChild(option6);
  select.appendChild(option7);

  const summTransport = document.createElement("span");
  summTransport.classList.add("modal-list__summ-transport");
  summTransport.classList.add("summ-transport");
  summTransport.classList.add("resultat");
  summTransport.textContent = "5 000 сом";

  const iconBasket = document.createElement("svg");
  iconBasket.classList.add("modal-list__icon-basket");

  const use = document.createElementNS("http://www.w3.org/2000/svg", "use");
  use.setAttributeNS("http://www.w3.org/1999/xlink", "href", "/assets/sprite.svg#basket-list");

  iconBasket.appendChild(use);

  wrapperNameTransport.appendChild(img);
  wrapperNameTransport.appendChild(nameTransport);

  wrapperSummTransport.appendChild(select);
  wrapperSummTransport.appendChild(summTransport);
  wrapperSummTransport.appendChild(iconBasket);

  wrapperColumnRow.appendChild(wrapperNameTransport);
  wrapperColumnRow.appendChild(wrapperSummTransport);

  wrapperBuyColumn.appendChild(wrapperColumnRow);
  wrapperBuyColumn.appendChild(line);
});
