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

function showAlert(alertType, alertText, alertIcon) {
    // Create the alert element with Bootstrap classes
    const alertDiv = document.createElement('div');
    alertDiv.classList.add('position-fixed', 'top-0', 'end-0', 'mt-3', 'me-3', 'alert', 'animate__animated', 'animate__fadeInDown', alertIcon, alertType);

    // Add the message to the alert element
    alertDiv.textContent = alertText;
    document.body.appendChild(alertDiv);

    // Hide the alert on the page
    setTimeout(() => alertDiv.classList.add('animate__fadeOutUp'), 2000);
    setTimeout(() => alertDiv.remove(), 3000);
};

function showAlertWithSpinner() {
    // Create the alert element with Bootstrap classes
    const alertElement = document.createElement('div');
    alertElement.classList.add('position-fixed', 'top-0', 'end-0', 'mt-3', 'me-3', 'alert', 'alert-info', 'd-flex', 'align-items-center', 'animate__animated');
    alertElement.setAttribute('role', 'alert');

    // Create the spinner element with Bootstrap classes
    const spinnerElement = document.createElement('span');
    spinnerElement.classList.add('spinner-border', 'spinner-border-sm', 'me-3');
    spinnerElement.setAttribute('role', 'status');
    spinnerElement.setAttribute('aria-hidden', 'true');

    // Create the check element with Bootstrap classes
    const checkElement = document.createElement('span');
    checkElement.classList.add('ri-checkbox-circle-fill', 'me-3');
    checkElement.setAttribute('role', 'status');
    checkElement.setAttribute('aria-hidden', 'true');
    checkElement.style.display = 'none';

    // Create the message element
    const messageElement = document.createTextNode('Loading data');

    // Add the spinner and message to the alert element
    alertElement.appendChild(spinnerElement);
    alertElement.appendChild(checkElement);
    alertElement.appendChild(messageElement);

    // Show the alert on the page
    document.body.appendChild(alertElement);

    // Return an object with show and hide methods to allow manual control
    var alertObject = {
        show: function () {
            alertElement.classList.add('animate__fadeInDown');
            return alertObject;
        },
        hide: function () {
            setTimeout(() => {
                spinnerElement.style.display = 'none';
                checkElement.style.display = 'inline';
                messageElement.textContent = 'Loading complete';
                alertElement.classList.remove('alert-info');
                alertElement.classList.add('alert-success');
            }, 500);
            setTimeout(() => alertElement.classList.add('animate__fadeOutUp'), 2000);
            setTimeout(() => alertElement.remove(), 3000);
            return alertObject;
        }
    };

    // Return the alert object
    return alertObject;
};

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    })
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

    return text.replace(/&#?\w+;/g, match => {
        if (replacements.hasOwnProperty(match)) {
            return replacements[match];
        } else {
            return match;
        }
    });
}

export {
    lStore,
    removeFix,
    delay,
    showAlert,
    scrollToTop,
    showAlertWithSpinner,
    cleanText
};