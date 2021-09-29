const selectElement = (el) => {
  return document.querySelector(el);
};
const selectElements = (el) => {
  return document.querySelectorAll(el);
};
const toogleDisabler = (elem) => {
  let select = elem.closest(".sp-row").querySelector("select");
  if (null != select) {
    if (elem.checked == false) {
      select.disabled = true;
    } else {
      select.disabled = false;
    }
  }
};
