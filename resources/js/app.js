window._ = require('lodash');
window.Popper = require('popper.js').default;
try {
    window.$ = window.jQuery = require('jquery');
    window.Dropzone = require('dropzone');
    require('bootstrap');
} catch (e) {}
