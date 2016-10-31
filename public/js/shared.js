function confirmDelete(button, itemName) {
  if (confirm(`Do you really want to delete ${itemName}?`)) {
    button.parentNode.submit();
  } else {
    return false;
  }
}

function formData(stringifiedJSON) {
  const formData = new FormData();
  formData.append('dataSet', stringifiedJSON);
  return formData;
}

function postRequest(param) {
  let xhr = window[`xhr${param.id}`];
  if (xhr) xhr.abort();
  window[`xhr${param.id}`] = new XMLHttpRequest();
  xhr = window[`xhr${param.id}`];
  xhr.open("POST", param.url, true);
  xhr.withCredentials = true;
  xhr.async = true;
  // console.log(document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  setRequestEventListeners(param);
  xhr.send(param.data); 
}

function setRequestEventListeners(param) {
  let xhr = window[`xhr${param.id}`];
  xhr.ontimeout = function() {
    console.log('Request Timed Out');
  };

  xhr.onprogress = function() {
    if (param.onProgress) {
      param.onProgress({
        response: JSON.parse(this.responseText),
        responseText: this.responseText
      });
    }
  };

  xhr.onerror = function() {
    console.log('An Error Occurred');
  };
  
  xhr.addEventListener('readystatechange', function() {
    if(this.readyState == 4 && this.status == 200){
      param.afterReturn({
        response: JSON.parse(this.responseText),
        responseText: this.responseText
      });
    }
  }, false);
}

function addOptionToSelect(selectElement, text, value) {
  let option = document.createElement('option');
  option.innerHTML = text;
  option.value = value;
  selectElement.appendChild(option);
}

function manageRequest(trigger, id, action) {
  if (confirm(`Are you sure you want to ${action} this request?`)) {
    let closestWrapper = trigger.closest('div.data-row');
    postRequest({
      id: action,
      data: formData(JSON.stringify({
        id: id,
        action: action,
      })),
      url: `/api/details/action`,
      afterReturn: (responseParam) => {
        let response = responseParam.response;
        console.log(response);
        let actionWord = action === 'approve' ? 'Approved' : 'Rejected';
        if (response.status === 1) {
          alert(`Request Successfully ${actionWord}`);
          closestWrapper.remove();
        } else {
          alert(response.message);
        }
      },
    });
  }
}

function showModal(classNameString) {
  let modal = document.querySelector('div#modal');
  let child = document.querySelector(`div#${classNameString}`);
  // document.body.insertBefore(child, modal.firstChild);
  modal.appendChild(child);
  modal.style.display = 'block';
  child.style.display = 'block';
}

(() => {
  document.body.addEventListener('change', (changeEvent) => {
    if (changeEvent.target.closest('select#bank_id.access-request')) {
      let itemToUpdate = document.querySelector('select#user_id.access-request');
      let itemId = changeEvent.target.closest('select#bank_id.access-request').value;
      let token = document.querySelector('input#token.access-request').value;
      let requesterId = document.querySelector('input#requester_id.access-request').value;
      postRequest({
        id: 'bank',
        data: formData(JSON.stringify({
          bank_id: itemId,
          token: token,
          requester_id: requesterId,
        })),
        url: `/api/users/getUsers`,
        afterReturn: (responseParam) => {
          let response = responseParam.response;
          let status = response.status;
          if (status === 0) {
            alert(`:::${response.message}`);
            itemToUpdate.innerHTML = '';
            addOptionToSelect(itemToUpdate, 'Select User', '');
            document.querySelector('select#detail_id.access-request').innerHTML = '';
            addOptionToSelect(document.querySelector('select#detail_id.access-request'), 'Select Detail Title', '');
          } else {
            document.querySelector('input#authorization_level_id.access-request').value = response.authorizationLevelId;
            itemToUpdate.innerHTML = '';
            addOptionToSelect(itemToUpdate, 'Select User', '');
            response.users.forEach((user) => {
              addOptionToSelect(itemToUpdate, user.name, user.id);
            });
          }
        },
      });
    } else if (changeEvent.target.closest('select#user_id.access-request')) {
      let itemToUpdate = document.querySelector('select#detail_id.access-request');
      let itemId = changeEvent.target.closest('select#user_id.access-request').value;
      let token = document.querySelector('input#token.access-request').value;
      let authorizationLevelId = document.querySelector('input#authorization_level_id.access-request').value;
      let requesterId = document.querySelector('input#requester_id.access-request').value;
      postRequest({
        id: 'user',
        data: formData(JSON.stringify({
          user_id: itemId,
          token: token,
          authorization_level_id: authorizationLevelId,
          requester_id: requesterId,
        })),
        url: `/api/details/getDetails`,
        afterReturn: (responseParam) => {
          let response = responseParam.response;
          let status = response.status;
          if (status === 0) {
            alert(`:::${response.message}`);
            itemToUpdate.innerHTML = '';
            addOptionToSelect(itemToUpdate, 'Select Detail Title', '');
          } else {
            itemToUpdate.innerHTML = '';
            addOptionToSelect(itemToUpdate, 'Select Detail Title', '');
            response.details.forEach((detail) => {
              addOptionToSelect(itemToUpdate, detail.content, detail.id);
            });
          }
        },
      });
    }
  });

  document.body.addEventListener('click', (clickEvent) => {
    if (clickEvent.target.closest('div.modal-close')) {
      let item = clickEvent.target.closest('div.modal-close');
      let modal = document.querySelector('div#modal');
      let child = modal.querySelector('div.wrapper');
      modal.style.display = 'none';
      child.style.display = 'none';
      document.body.appendChild(child);
    }
  });
})();