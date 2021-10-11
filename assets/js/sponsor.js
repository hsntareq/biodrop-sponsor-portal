let toggles = multipleElement("input.form-toggle-input");
for (let i = 0; i < toggles.length; i++) {
  toggles[i].onchange = (event) => {
    toogleDisabler(event.target);
    toogleInputValue(event.target);
  };
  toogleDisabler(toggles[i]);
  toogleInputValue(toggles[i]);
}

const saveProtocol = singleElement("#save_protocol");
const protocolForm = singleElement("#protocol_form");
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

const selectProtocol = singleElement("#select_protocol");
if (selectProtocol) {
  selectProtocol.onchange = (e) => {
    var formData = new FormData();
    formData.append("protocol_id", e.target.value);
    formData.append("action", "get_selected_protocol");
    formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", _appObject.ajaxUrl, true);
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState === 4) {
        var getData = JSON.parse(xhttp.response);
        Object.entries(getData.data).forEach(([key, value]) => {
          var fieldValue = nameElement(key);
          if (0 !== fieldValue.length) {
            nameElement(key)[0].value = value;
          }
        });

        toastTrigger("success", "The protocol has been changed.");
        console.log(JSON.parse(xhttp.response));
      }
    };
  };
}
