const selectElement = (el) => {
  return document.querySelector(el);
};
const selectElements = (el) => {
  return document.querySelectorAll(el);
};
const toogleDisabler = (elem) => {
  let select = elem.closest(".sp-row").querySelector("select");
  return null != select
    ? elem.checked == false
      ? (select.disabled = true)
      : (select.disabled = false)
    : false;
};

const toogleInputValue = (elem) => {
  elem.previousElementSibling.value = elem.checked == true ? "on" : "off";
};
