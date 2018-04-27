
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

import VModal from 'vue-js-modal'

window.Vue = require('vue');

Vue.use(VModal, { dialog: true })

Vue.component('login-form', require('./components/LoginForm.vue'));
Vue.component('register-form', require('./components/RegisterForm.vue'));

const app = new Vue({
    el: '#app'
});

import SimpleMDE from 'simplemde';
import {} from 'simplemde/dist/simplemde.min.css';
let editors = document.getElementsByClassName('markdown-editor');

if (editors.length) {
    new SimpleMDE({
        element: editors[0],
        spellChecker: false,
        autosave: {
            enabled: false,
            uniqueId: window.location,
        },
        placeholder: "Kirjoita tähän...",
        promptURLs: true,
    });
}