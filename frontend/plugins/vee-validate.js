import Vue from 'vue';

// 使用する機能
import { ValidationProvider, ValidationObserver, localize, extend } from 'vee-validate';

// エラーメッセージの日本語
import ja from 'vee-validate/dist/locale/ja.json';

// 使用するルール
import { required, email, min, alpha_dash } from 'vee-validate/dist/rules';
extend('required', required);
extend('email', email);
extend('min', min);
extend('alpha_dash', alpha_dash);

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
localize('ja', ja);
