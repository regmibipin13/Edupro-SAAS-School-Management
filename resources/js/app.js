
require('./bootstrap');

window.Vue = require('vue').default;



Vue.component('example-component', require('./components/ExampleComponent.vue').default);


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
