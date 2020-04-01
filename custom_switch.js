var scriptElement = document.createElement('script');
var scriptSrc = document.currentScript.src;
var customJS = window.BRAVEN_NEW_HTML ? 'braven_custom' : 'bz_custom'
scriptElement.src = scriptSrc.replace('custom_switch', customJS);
document.head.appendChild(scriptElement);