const $sections = document.querySelectorAll('.slide');
const $sectionsWrap = document.querySelectorAll('.slide container');
const $btnToTop = document.querySelector('.footer__top-btn');
const $header = document.querySelector('.header');

let currentSection = 0;
let flag = true;
let screenSize = false;

getScreenSize();
addBackgroundHeder();

window.addEventListener('resize', function (event) {
  window.removeEventListener('wheel', scrollFoo, { passive: false });
  getScreenSize();
  if (screenSize && flag) {
    window.addEventListener('wheel', scrollFoo, { passive: false })
  }
}, true);

window.addEventListener('wheel', addBackgroundHeder, { passive: false });

if (screenSize) {
  window.addEventListener('wheel', scrollFoo, { passive: false });
}

$btnToTop.addEventListener('click', () => {
  if (window.pageYOffset > 0) {
    if (currentSection) {
      currentSection = 0;
      flagForAddBackGroundHeder = false;
      addBackgroundHeder();
    }
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }
})

function getScreenSize() {
  if (window.screen.availWidth > 1280 && window.screen.availHeight > 800 && window.innerWidth > 1280 && window.innerHeight > 800) {
    screenSize = true;
    return;
  }
  screenSize = false;
}

function scrollFoo(e) {
  if (!flag || $sections.length <= 1) {
    return;
  }
  checkCurrentSection(e);
  addAnimateClass($sections[currentSection]);
  scrollToSection(currentSection);
  setTimeout(()=> {
    addBackgroundHeder();
  }, 500)
}

function checkCurrentSection(e) {
  e.preventDefault();
  (e.deltaY < 0) ? currentSection-- : currentSection++;
  if (currentSection < 0) currentSection = 0;
  else if (currentSection > ($sections.length - 1)) currentSection = ($sections.length - 1);
}

function addAnimateClass(section) {
  const $elemAnimate = section.querySelector('.container');
  $sectionsWrap.forEach((el) => {
    if (el.classList.contains('animate'))
      el.classList.remove('animate')
  })
  $elemAnimate.classList.add('animate');
}

function addBackgroundHeder() {
  (currentSection >= 1 && screenSize || window.pageYOffset >= 60) ? $header.classList.add('header__bc') : $header.classList.remove('header__bc');
}

function scrollToSection(i) {
  $sections[i].scrollIntoView({
    block: "center",
    behavior: 'smooth'
  });
  flag = false;
  setTimeout(() => {
    flag = true;
  }, 500)
}
