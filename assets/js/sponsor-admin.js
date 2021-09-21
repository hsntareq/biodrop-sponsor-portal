"use strict";
// alert("not working");
const element = (el) => {
  return document.querySelector(el);
};
const elements = (el) => {
  return document.querySelectorAll(el);
};

const toogle_disabler = (elem) => {
  let select = elem.closest(".sp-row").querySelector("select");
  if (null != select) {
    if (elem.checked == false) {
      select.disabled = true;
    } else {
      select.disabled = false;
    }
  }
};

let toggles = elements("input.form-toggle-input");
for (let i = 0; i < toggles.length; i++) {
  toggles[i].onchange = (event) => {
    toogle_disabler(event.target);
  };
  toogle_disabler(toggles[i]);
}
