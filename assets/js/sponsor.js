let toggles = selectElements("input.form-toggle-input");
for (let i = 0; i < toggles.length; i++) {
  toggles[i].onchange = (event) => {
    toogleDisabler(event.target);
    toogleInputValue(event.target);
  };
  toogleDisabler(toggles[i]);
  toogleInputValue(toggles[i]);
}

const saveProtocol = selectElement("#save_protocol");
const protocolForm = selectElement("#protocol_form");
if (saveProtocol) {
  saveProtocol.onclick = (e) => {
    var formData = new FormData(protocolForm);
    formData.append("action", "save_protocols");
    formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", _appObject.ajaxUrl, true);
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState === 4) {
        toastTrigger("success", "The protocol is saveed successfully");
        console.log(JSON.parse(xhttp.response));
      }
    };
  };
}
$(document).ready(function () {
  $(".select2").select2();
});
