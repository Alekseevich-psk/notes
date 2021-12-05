// Получаем нужный элемент
var element = document.querySelector('#target');

var Visible = function (target) {
  // Все позиции элемента
  var targetPosition = {
      top: window.pageYOffset + target.getBoundingClientRect().top,
      left: window.pageXOffset + target.getBoundingClientRect().left,
      right: window.pageXOffset + target.getBoundingClientRect().right,
      bottom: window.pageYOffset + target.getBoundingClientRect().bottom
    },
    // Получаем позиции окна
    windowPosition = {
      top: window.pageYOffset,
      left: window.pageXOffset,
      right: window.pageXOffset + document.documentElement.clientWidth,
      bottom: window.pageYOffset + document.documentElement.clientHeight
    };

  if (targetPosition.bottom > windowPosition.top && // Если позиция нижней части элемента больше позиции верхней чайти окна, то элемент виден сверху
    targetPosition.top < windowPosition.bottom && // Если позиция верхней части элемента меньше позиции нижней чайти окна, то элемент виден снизу
    targetPosition.right > windowPosition.left && // Если позиция правой стороны элемента больше позиции левой части окна, то элемент виден слева
    targetPosition.left < windowPosition.right) { // Если позиция левой стороны элемента меньше позиции правой чайти окна, то элемент виден справа
    // Если элемент полностью видно, то запускаем следующий код
    console.clear();
    console.log('Вы видите элемент :)');
  } else {
    // Если элемент не видно, то запускаем этот код
    console.clear();
  };
};

// Запускаем функцию при прокрутке страницы
window.addEventListener('scroll', function() {
  Visible (element);
});

// А также запустим функцию сразу. А то вдруг, элемент изначально видно
Visible (element);







// _____________________________________________
const section = document.querySelectorAll('section');
let positionElems = [];

setPositionElems(section, positionElems);
checkActivePositionInWindow(positionElems);

window.addEventListener('scroll', function () {
    checkActivePositionInWindow(positionElems);
});

window.addEventListener('resize', function () {
    setPositionElems(section, positionElems);
    checkActivePositionInWindow(positionElems);
    console.log(positionElems);
});

function setPositionElems(elems, arr) {
    elems.forEach((elem, i) => {
        arr[i] = getPositionHightElem(elem);
    })
}

function getPositionHightElem(elem) {
    let top = window.pageYOffset + elem.getBoundingClientRect().top;
    let bottom = window.pageYOffset + elem.getBoundingClientRect().bottom;
    let centerElem = (bottom - top) / 2 + top;
    return centerElem;
}

function getPositionWindow() {
    let top = window.pageYOffset;
    let bottom = window.pageYOffset + document.documentElement.clientHeight;
    return {top, bottom};
}

function checkActivePositionInWindow (arr) {
    let positionWindow = getPositionWindow();

    arr.forEach((elem, index) => {
        if (elem > positionWindow.top && elem < positionWindow.bottom) {
            console.log(index);
        }
    })
}
