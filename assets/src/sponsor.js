import {
  singleElement,
  multipleElement,
  nameElement,
  toogleDisabler,
  toogleInputValue,
  tooltipList,
  toastTrigger,
} from "./lib";
let toggles = multipleElement("input.form-toggle-input");
for (let i = 0; i < toggles.length; i++) {
  toggles[i].onchange = (event) => {
    toogleDisabler(event.target);
    toogleInputValue(event.target);
  };
  toogleDisabler(toggles[i]);
  toogleInputValue(toggles[i]);
}

String.prototype.toCapitalize = function () {
  return this.toLowerCase().replace(/^.|\s\S/g, function (a) {
    return a.toUpperCase();
  });
};

const present_item = multipleElement(".preset-item");
if (present_item) {
  Array.from(multipleElement(".preset-item")).forEach(
    (elm) =>
      (elm.onclick = (e) => {
        console.log(elm.dataset.preset);
        let presetName = elm.dataset.preset;

        Array.from(present_item).forEach((el) => el.classList.remove("active"));

        elm.classList.add("active");
        var formData = new FormData();
        formData.append("action", "get_protocol_by_name");
        formData.append("protocol_name", presetName);
        formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", _appObject.ajaxUrl, true);
        xhttp.send(formData);
        xhttp.onreadystatechange = function () {
          if (xhttp.readyState === 4) {
            console.log(JSON.parse(xhttp.response));
            var getData = JSON.parse(xhttp.response);
            if (getData.data) {
              Object.entries(getData.data).forEach(([key, value]) => {
                var fieldValue = nameElement(key);
                if (0 !== fieldValue.length) {
                  nameElement(key)[0].value = value;
                }
              });
            }
            toastTrigger(
              "success",
              'The "' +
                presetName.toCapitalize() +
                '" preset protocol is selected'
            );
          }
        };
      })
  );
}

const saveProtocol = singleElement("#save_protocol");
const protocolForm = singleElement("#protocol_form");
if (saveProtocol) {
  saveProtocol.onclick = (e) => {
    var formData = new FormData(protocolForm);
    formData.append("action", "save_protocol");
    formData.append(_appObject.nonce_key, _appObject._sponsor_nonce);
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", _appObject.ajaxUrl, true);
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState === 4) {
        var getData = JSON.parse(xhttp.response);

        console.log(getData.success);
        if (getData.success == false) {
          toastTrigger("error", "This protocol already exists");
        } else {
          toastTrigger("success", "The protocol is saveed successfully");
        }
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
        console.log(getData);
        if (getData.data) {
          Object.entries(getData.data).forEach(([key, value]) => {
            var fieldValue = nameElement(key);
            if (0 !== fieldValue.length) {
              nameElement(key)[0].value = value;
            }
          });
        }
        toastTrigger("success", "The protocol has been changed.");
        console.log(JSON.parse(xhttp.response));
      }
    };
  };
}
