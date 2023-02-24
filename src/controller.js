class LocalStore {
    set(key,value) {localStorage.setItem(key,value);}
    get(key) {return localStorage.getItem(key);}
    setObject(key,value) {localStorage.setItem(key,JSON.stringify(value));}
    getObject(key) {return JSON.parse(localStorage.getItem(key));}
    remove(key) {localStorage.removeItem(key);}
    setInObject(parentKey,childKey,value) {
        let parentObject = this.getObject(parentKey);
        parentObject[childKey] = value;
        this.setObject(parentKey,parentObject);
    }
    isset(key) {
        if (localStorage.getItem(key) == null) return false;
        return true;
    }
    getInObject(parentKey,childKey) {
        let parentObject = this.getObject(parentKey);
        return parentObject[childKey];
    }
    objectify(stringObj) {
        stringObj = stringObj.replaceAll('&#34;','"');
        stringObj = JSON.parse(stringObj);
        return stringObj;
    }
}

const lStore = new LocalStore();

function removeFix(object, fix) {
    let newObj = {};
    
    for (let k in object) {
        let key = k.toLowerCase().replaceAll(fix, ''); 
        newObj[key] = object[k];
    }

    return newObj;
}

const delay = t => new Promise(resolve => setTimeout(resolve, t));

function showAlert(alertType, alertText, alertIcon) {
    const alertDiv = document.createElement('div');
    alertDiv.classList.add('position-fixed', 'top-0', 'end-0', 'mt-3', 'me-3', 'alert', 'animate__animated', 'animate__fadeInDown', alertIcon, alertType);
    alertDiv.textContent = alertText;
    document.body.appendChild(alertDiv);
    setTimeout(() => alertDiv.classList.add('animate__fadeOutUp'), 2000);
    setTimeout(() => alertDiv.remove(), 3000);
}

export {
    lStore,
    removeFix,
    delay,
    showAlert
};