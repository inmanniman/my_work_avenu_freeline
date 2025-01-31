/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/icons sync recursive \\.svg$":
/*!***********************************!*\
  !*** ./assets/icons/ sync \.svg$ ***!
  \***********************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var map = {
	"./logo.svg": "./assets/icons/logo.svg"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./assets/icons sync recursive \\.svg$";

/***/ }),

/***/ "./assets/js/downloadTables.js":
/*!*************************************!*\
  !*** ./assets/js/downloadTables.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var file_saver__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! file-saver */ "./node_modules/file-saver/dist/FileSaver.min.js");
/* harmony import */ var file_saver__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(file_saver__WEBPACK_IMPORTED_MODULE_0__);
// Добавьте этот код в ваш файл скрипта

document.addEventListener('DOMContentLoaded', function () {
  var downloadBtn = document.querySelector('.filter__download-btn');
  downloadBtn.addEventListener('click', function () {
    exportTableToExcel('tables', 'exported_data');
  });
  function exportTableToExcel(tableId, filename) {
    var table = document.getElementById(tableId);
    var ws = XLSX.utils.table_to_sheet(table);
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
    var wbout = XLSX.write(wb, {
      bookType: 'xlsx',
      bookSST: true,
      type: 'binary'
    });
    function s2ab(s) {
      var buf = new ArrayBuffer(s.length);
      var view = new Uint8Array(buf);
      for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xff;
      return buf;
    }
    (0,file_saver__WEBPACK_IMPORTED_MODULE_0__.saveAs)(new Blob([s2ab(wbout)], {
      type: 'application/octet-stream'
    }), filename + '.xlsx');
  }
});

/***/ }),

/***/ "./assets/js/filter.js":
/*!*****************************!*\
  !*** ./assets/js/filter.js ***!
  \*****************************/
/***/ (function() {

document.addEventListener('DOMContentLoaded', () => {
  // Получаем элементы DOM
  const filterBtn = document.querySelector('.filter__btn');
  const inRadio = document.getElementById('in');
  const outsideRadio = document.getElementById('outside');
  const nameInput = document.getElementById('name');
  const departmentInput = document.getElementById('departament');
  const dateInput = document.getElementById('datePeriod');
  const tenCheckbox = document.getElementById('ten');
  const tableRows = document.querySelectorAll('.tables tbody tr');

  // Назначаем обработчик события на кнопку фильтра
  filterBtn.addEventListener('click', () => {
    // Получаем значения из полей ввода
    const nameFilterValue = nameInput.value.toLowerCase();
    const departmentFilterValue = departmentInput.value.toLowerCase();
    const dateFilterValue = dateInput.value;

    // Проходим по каждой строке таблицы
    tableRows.forEach(row => {
      const distance = row.dataset.distance;
      const timeString = row.children[2].textContent;
      const time = new Date(timeString);

      // Получаем значения из ячеек строки
      const fullName = row.children[0].textContent.toLowerCase();
      const department = row.children[1].textContent.toLowerCase();

      // Фильтрация по ФИО и Отделению
      const nameMatch = fullName.includes(nameFilterValue);
      const departmentMatch = department.includes(departmentFilterValue);

      // Сравнение дат с использованием объектов Date
      const dateMatch = dateFilterValue === '' || isDateInRange(time, dateFilterValue);

      // Фильтрация по радио-переключателю и времени
      const zoneMatch = inRadio.checked && distance <= 60 || outsideRadio.checked && distance > 60 || !inRadio.checked && !outsideRadio.checked;

      // Фильтрация записей по времени
      const isBeforeTen = tenCheckbox.checked;
      const timeMatch = isBeforeTen ? time.getHours() >= 10 : true;

      // Применяем все фильтры и выводим данные в ячейке адреса
      if (nameMatch && departmentMatch && dateMatch && zoneMatch && timeMatch) {
        row.style.display = ''; // Показываем строку
      } else {
        row.style.display = 'none'; // Скрываем строку
      }
    });
  });

  // Инициализация Date Range Picker
  $('#datePeriod').daterangepicker({
    autoUpdateInput: false,
    locale: {
      cancelLabel: 'Очистить',
      applyLabel: 'Вставить'
    }
  });

  // Обновление поля ввода при выборе диапазона дат
  $('#datePeriod').on('apply.daterangepicker', (ev, picker) => {
    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
  });

  // Очистка поля ввода при нажатии кнопки 'Очистить'
  $('#datePeriod').on('cancel.daterangepicker', function () {
    $(this).val('');
  });

  // Вспомогательная функция для проверки диапазона дат
  function isDateInRange(dateTime, dateFilter) {
    const dateFromPicker = moment(dateFilter.split(' - ')[0], 'YYYY-MM-DD');
    const dateEndPicker = moment(dateFilter.split(' - ')[1], 'YYYY-MM-DD');
    const dateToCheck = moment(dateTime);
    return dateToCheck.isSameOrAfter(dateFromPicker) && dateToCheck.isSameOrBefore(dateEndPicker.endOf('day'));
  }
  const resetBtn = document.querySelector('.filter__btn-reset');
  resetBtn.addEventListener('click', () => {
    // Сбрасываем значения фильтров
    nameInput.value = '';
    departmentInput.value = '';
    dateInput.value = '';
    inRadio.checked = false;
    outsideRadio.checked = false;
    tenCheckbox.checked = false;

    // Переинициализируем Date Range Picker
    $('#datePeriod').data('daterangepicker').setStartDate(moment());
    $('#datePeriod').data('daterangepicker').setEndDate(moment());

    // Перебираем все строки таблицы и отображаем их
    tableRows.forEach(function (row) {
      row.style.display = '';
    });
  });
});

// фильтр для страницы редактора и добавления пользователей

document.addEventListener('DOMContentLoaded', () => {
  // Получаем элементы DOM
  const filterBtn = document.querySelector('.filter-add__btn');
  const telegramIdInput = document.getElementById('telegram-add');
  const nameInput = document.getElementById('name-add');
  const departmentInput = document.getElementById('departament-add');
  const parkInput = document.getElementById('park-add');
  const tableRows = document.querySelectorAll('.tables tbody tr');
  const noResultsMessage = document.getElementById('no-results-message');
  noResultsMessage.style.display = 'none';

  // Назначаем обработчик события на кнопку фильтра
  filterBtn.addEventListener('click', () => {
    // Получаем значения из инпутов
    const telegramIdFilterValue = telegramIdInput.value.toLowerCase();
    const nameFilterValue = nameInput.value.toLowerCase();
    const departmentFilterValue = departmentInput.value.toLowerCase();
    const parkFilterValue = parkInput.value.toLowerCase();

    // Переменная для отслеживания наличия результатов
    let hasResults = false;

    // Проходим по каждой строке таблицы
    tableRows.forEach(row => {
      // Получаем значения из ячеек строки
      const telegramId = row.children[0].textContent.toLowerCase();
      const fullName = row.children[1].textContent.toLowerCase();
      const department = row.children[2].textContent.toLowerCase();
      const park = row.children[3].textContent.toLowerCase();

      // Фильтрация по значениям из инпутов
      const telegramIdMatch = telegramId.includes(telegramIdFilterValue);
      const nameMatch = fullName.includes(nameFilterValue);
      const departmentMatch = department.includes(departmentFilterValue);
      const parkMatch = park.includes(parkFilterValue);

      // Показываем или скрываем строку в зависимости от соответствия фильтрам
      if (telegramIdMatch && nameMatch && departmentMatch && parkMatch) {
        row.style.display = ''; // Показываем строку
        hasResults = true;
      } else {
        row.style.display = 'none'; // Скрываем строку
      }
    });

    // Показываем или скрываем сообщение о результате поиска
    if (hasResults) {
      noResultsMessage.style.display = 'none'; // Скрываем сообщение
    } else {
      noResultsMessage.style.display = 'block'; // Показываем сообщение
    }
  });
});

/***/ }),

/***/ "./assets/js/loadingOverlay.js":
/*!*************************************!*\
  !*** ./assets/js/loadingOverlay.js ***!
  \*************************************/
/***/ (() => {

const form = document.querySelector('.authorization__form');
const loadingOverlay = document.getElementById('loadingOverlay');
if (form) {
  form.addEventListener('submit', async event => {
    event.preventDefault();
    loadingOverlay.style.display = 'flex';
    await new Promise(resolve => {
      setTimeout(() => {
        loadingOverlay.style.display = 'none';
        form.submit();
        resolve();
      }, 5000);
    });
  });
}

/***/ }),

/***/ "./assets/js/send-location.js":
/*!************************************!*\
  !*** ./assets/js/send-location.js ***!
  \************************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  var form = document.querySelector('#locationForm');
  if (form) {
    form.addEventListener('submit', async event => {
      // ваш код обработки события submit
    });
  }
  var button = document.querySelector('.geo-tg__btn');
  if (button) {
    button.addEventListener('click', sendLocation);
  }
  function sendLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        // Добавьте код для отправки координат на сервер
        var formData = new FormData();
        formData.append('latitude', latitude);
        formData.append('longitude', longitude);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            // Обновляем сообщение на странице с сервера
            document.querySelector('.geo-tg__error-done').innerText = xhr.responseText;
          }
        };
        xhr.send(formData);
      });
    } else {
      alert('Геолокация не поддерживается вашим браузером.');
    }
  }
});

/***/ }),

/***/ "./assets/js/sprite.js":
/*!*****************************!*\
  !*** ./assets/js/sprite.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__("./assets/icons sync recursive \\.svg$");

/***/ }),

/***/ "./assets/js/app.ts":
/*!**************************!*\
  !*** ./assets/js/app.ts ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _sprite__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./sprite */ "./assets/js/sprite.js");
/* harmony import */ var _sprite__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_sprite__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _loadingOverlay__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./loadingOverlay */ "./assets/js/loadingOverlay.js");
/* harmony import */ var _loadingOverlay__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_loadingOverlay__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _send_location__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./send-location */ "./assets/js/send-location.js");
/* harmony import */ var _send_location__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_send_location__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _filter__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./filter */ "./assets/js/filter.js");
/* harmony import */ var _filter__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_filter__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _downloadTables__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./downloadTables */ "./assets/js/downloadTables.js");






/***/ }),

/***/ "./node_modules/file-saver/dist/FileSaver.min.js":
/*!*******************************************************!*\
  !*** ./node_modules/file-saver/dist/FileSaver.min.js ***!
  \*******************************************************/
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;(function(a,b){if(true)!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_FACTORY__ = (b),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));else {}})(this,function(){"use strict";function b(a,b){return"undefined"==typeof b?b={autoBom:!1}:"object"!=typeof b&&(console.warn("Deprecated: Expected third argument to be a object"),b={autoBom:!b}),b.autoBom&&/^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(a.type)?new Blob(["\uFEFF",a],{type:a.type}):a}function c(a,b,c){var d=new XMLHttpRequest;d.open("GET",a),d.responseType="blob",d.onload=function(){g(d.response,b,c)},d.onerror=function(){console.error("could not download file")},d.send()}function d(a){var b=new XMLHttpRequest;b.open("HEAD",a,!1);try{b.send()}catch(a){}return 200<=b.status&&299>=b.status}function e(a){try{a.dispatchEvent(new MouseEvent("click"))}catch(c){var b=document.createEvent("MouseEvents");b.initMouseEvent("click",!0,!0,window,0,0,0,80,20,!1,!1,!1,!1,0,null),a.dispatchEvent(b)}}var f="object"==typeof window&&window.window===window?window:"object"==typeof self&&self.self===self?self:"object"==typeof __webpack_require__.g&&__webpack_require__.g.global===__webpack_require__.g?__webpack_require__.g:void 0,a=f.navigator&&/Macintosh/.test(navigator.userAgent)&&/AppleWebKit/.test(navigator.userAgent)&&!/Safari/.test(navigator.userAgent),g=f.saveAs||("object"!=typeof window||window!==f?function(){}:"download"in HTMLAnchorElement.prototype&&!a?function(b,g,h){var i=f.URL||f.webkitURL,j=document.createElement("a");g=g||b.name||"download",j.download=g,j.rel="noopener","string"==typeof b?(j.href=b,j.origin===location.origin?e(j):d(j.href)?c(b,g,h):e(j,j.target="_blank")):(j.href=i.createObjectURL(b),setTimeout(function(){i.revokeObjectURL(j.href)},4E4),setTimeout(function(){e(j)},0))}:"msSaveOrOpenBlob"in navigator?function(f,g,h){if(g=g||f.name||"download","string"!=typeof f)navigator.msSaveOrOpenBlob(b(f,h),g);else if(d(f))c(f,g,h);else{var i=document.createElement("a");i.href=f,i.target="_blank",setTimeout(function(){e(i)})}}:function(b,d,e,g){if(g=g||open("","_blank"),g&&(g.document.title=g.document.body.innerText="downloading..."),"string"==typeof b)return c(b,d,e);var h="application/octet-stream"===b.type,i=/constructor/i.test(f.HTMLElement)||f.safari,j=/CriOS\/[\d]+/.test(navigator.userAgent);if((j||h&&i||a)&&"undefined"!=typeof FileReader){var k=new FileReader;k.onloadend=function(){var a=k.result;a=j?a:a.replace(/^data:[^;]*;/,"data:attachment/file;"),g?g.location.href=a:location=a,g=null},k.readAsDataURL(b)}else{var l=f.URL||f.webkitURL,m=l.createObjectURL(b);g?g.location=m:location.href=m,g=null,setTimeout(function(){l.revokeObjectURL(m)},4E4)}});f.saveAs=g.saveAs=g, true&&(module.exports=g)});

//# sourceMappingURL=FileSaver.min.js.map

/***/ }),

/***/ "./assets/scss/app.scss":
/*!******************************!*\
  !*** ./assets/scss/app.scss ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./assets/icons/logo.svg":
/*!*******************************!*\
  !*** ./assets/icons/logo.svg ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
      id: "logo-usage",
      viewBox: "0 0 391.3 474",
      url: __webpack_require__.p + "assets/sprite.svg#logo",
      toString: function () {
        return this.url;
      }
    });

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/publicPath */
/******/ 	(() => {
/******/ 		__webpack_require__.p = "/";
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/assets/js/app": 0,
/******/ 			"assets/css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = globalThis["webpackChunk"] = globalThis["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["assets/css/app"], () => (__webpack_require__("./assets/js/app.ts")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["assets/css/app"], () => (__webpack_require__("./assets/scss/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;