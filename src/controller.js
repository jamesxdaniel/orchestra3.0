class LocalStore {
    set(key, value) { localStorage.setItem(key, value); }
    get(key) { return localStorage.getItem(key); }
    setObject(key, value) { localStorage.setItem(key, JSON.stringify(value)); }
    getObject(key) { return JSON.parse(localStorage.getItem(key)); }
    remove(key) { localStorage.removeItem(key); }
    setInObject(parentKey, childKey, value) {
        let parentObject = this.getObject(parentKey);
        parentObject[childKey] = value;
        this.setObject(parentKey, parentObject);
    }
    isset(key) {
        if (localStorage.getItem(key) == null) return false;
        return true;
    }
    getInObject(parentKey, childKey) {
        let parentObject = this.getObject(parentKey);
        return parentObject[childKey];
    }
    objectify(stringObj) {
        stringObj = stringObj.replaceAll('&#34;', '"');
        stringObj = JSON.parse(stringObj);
        return stringObj;
    }
};

const lStore = new LocalStore();

function removeFix(object, fix) {
    let newObj = {};

    for (let k in object) {
        let key = k.toLowerCase().replaceAll(fix, '');
        newObj[key] = object[k];
    }

    return newObj;
};

const delay = t => new Promise(resolve => setTimeout(resolve, t));

function showToast(alertMessage, alertType = 'alert-info', alertLoader = false) {
    // Create the alert element
    const alertContainerElement = document.querySelector('#alert');
    alertContainerElement.classList.add('position-fixed', 'top-0', 'end-0', 'me-3');

    // Create the alert element
    const alertElement = document.createElement('div');
    alertElement.classList.add('position-static', 'mt-3', 'alert', alertType, 'd-flex', 'align-items-center', 'animate__animated');
    alertElement.setAttribute('role', 'alert');

    // Create the spinner element
    const spinnerElement = document.createElement('span');
    spinnerElement.classList.add('spinner', 'spinner-border', 'spinner-border-sm');
    spinnerElement.setAttribute('role', 'status');
    spinnerElement.setAttribute('aria-hidden', 'true');

    // Create the info icon element
    const infoElement = document.createElement('span');
    infoElement.classList.add('ri', 'ri-message-fill');
    infoElement.setAttribute('role', 'status');
    infoElement.setAttribute('aria-hidden', 'true');
    infoElement.style.display = 'inline';

    // Create the success icon element
    const successElement = document.createElement('span');
    successElement.classList.add('ri', 'ri-checkbox-circle-fill');
    successElement.setAttribute('role', 'status');
    successElement.setAttribute('aria-hidden', 'true');
    if (alertLoader == true) successElement.style.display = 'none';
    else successElement.style.display = 'inline';

    // Create the error icon element
    const errorElement = document.createElement('span');
    errorElement.classList.add('ri', 'ri-error-warning-fill');
    errorElement.setAttribute('role', 'status');
    errorElement.setAttribute('aria-hidden', 'true');
    errorElement.style.display = 'inline';

    // Create the heading element
    const headingElement = document.createElement('h4');
    headingElement.classList.add('alert-heading', 'fs-6', 'fw-bolder', 'm-0', 'mb-1');
    if (alertType == 'alert-info') headingElement.textContent = 'Info';
    if (alertType == 'alert-success') headingElement.textContent = 'Success';
    if (alertType == 'alert-danger') headingElement.textContent = 'Error';

    // Create the message element
    const messageElement = document.createElement('span');
    messageElement.textContent = alertMessage;

    // Create the icon container element
    const icontainerElement = document.createElement('div');
    icontainerElement.classList.add('alert-icon', 'd-flex', 'align-items-center', 'me-3');
    if (alertLoader == true) icontainerElement.appendChild(spinnerElement);
    if (alertLoader == true) icontainerElement.appendChild(successElement);
    if (alertType == 'alert-info' && alertLoader == false) icontainerElement.appendChild(infoElement);
    if (alertType == 'alert-success') icontainerElement.appendChild(successElement);
    if (alertType == 'alert-danger') icontainerElement.appendChild(errorElement);

    // Create the text container element
    const containerElement = document.createElement('div');
    containerElement.classList.add('alert-container', 'w-100', 'm-0');
    containerElement.appendChild(headingElement);
    containerElement.appendChild(messageElement);

    // Add the spinner, message, and progress bar to the alert element
    alertElement.appendChild(icontainerElement);
    alertElement.appendChild(containerElement);

    // Show the alert on the page
    alertContainerElement.insertBefore(alertElement, alertContainerElement.firstChild);

    // Return an object with hide method to allow manual control
    const alertObject = {
        show: function () {
            alertElement.classList.add('animate__fadeIn');
            return alertObject;
        },
        hide: function () {
            setTimeout(() => {
                spinnerElement.style.display = 'none';
                successElement.style.display = 'inline';
                messageElement.textContent = alertMessage + ' ' + 'complete';
                alertElement.classList.remove('alert-info');
                alertElement.classList.add('alert-success');
            }, 500);
            setTimeout(() => alertElement.classList.add('animate__fadeOut'), 1500);
            setTimeout(() => alertElement.remove(), 2500);
            return alertObject;
        }
    };

    // Hide the alert automatically if alertLoader is false
    if (!alertLoader) {
        alertElement.classList.add('animate__fadeIn');
        setTimeout(() => {
            alertElement.classList.add('animate__fadeOut');
            setTimeout(() => alertElement.remove(), 1500);
        }, 2500);
    }

    // Return the alert object
    return alertObject;
};

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

function cleanText(text) {
    const replacements = {
        '&#039;': "'",
        '&quot;': '"',
        '&lt;': '<',
        '&gt;': '>',
        '&amp;': '&',
        // add more replacements as needed
    };

    const cleaner = text.replace(/&#?\w+;/g, match => {
        if (replacements.hasOwnProperty(match)) {
            return replacements[match];
        } else {
            return match;
        }
    });

    return cleaner.trim();
};

export {
    lStore,
    removeFix,
    delay,
    scrollToTop,
    showToast,
    cleanText
};