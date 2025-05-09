const btns = document.querySelectorAll('.btnDelCuidado');
const delLink = document.querySelector('#delLink').getAttribute('href');

btns.forEach((el) => {
 el.addEventListener('click', function (e) {
  const value = e.target.value;
  document.querySelector('#delLink').setAttribute('href', delLink+value);
 });
});
