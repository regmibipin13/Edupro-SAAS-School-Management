
require('./bootstrap');

window.Vue = require('vue').default;

import Multiselect from 'vue-multiselect'
import "vue-multiselect/dist/vue-multiselect.min.css";

import VueLoading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

import VueToast from 'vue-toast-notification';
//import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast);

// register globally
Vue.component('multiselect', Multiselect)
Vue.use(VueLoading)


Vue.component('admit-student',require('./components/AdmitStudent.vue').default);
Vue.component('admit-student-edit',require('./components/AdmitStudentEdit.vue').default);
Vue.component('marks-entry', require('./components/MarksEntry.vue').default);
Vue.component('attendance-lists', require('./components/AttendanceList.vue').default);
Vue.component('attendance-create', require('./components/AttendanceCreate.vue').default);
Vue.component('timetable', require('./components/Timetable.vue').default);
Vue.component('timetable-show', require('./components/TimetableShow.vue').default);
Vue.component('fee', require('./components/Fee.vue').default);




const app = new Vue({
    el: '#app',
});




// Some jQuery Scripts here
$(document).ready(function() {
    var rowCount = $('table thead tr th').length;
    $('#colspan-automate').attr("colspan", rowCount);

    // Initializing the select2
    $('.select2').select2({
        placeholder: 'Select an option',
        theme:'classic',
        closeOnSelect:false,
        allowClear:true,
        selectionCssClass:'all'
    });

});
