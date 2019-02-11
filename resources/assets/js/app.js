/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

$(function () {
    $('#get').on('click', function () {
        // var title = $('#title').val();
        // var text = $('#text').val();
        $.ajax({
            url: '/profit',
            type: "POST",
            data: "",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var money = data.money;
                var bonus = data.bonus;
                var surprise = data.surprise;

                $(".money").replaceWith("<span class=\"money\"> Your money:"+money+"</span>");
                $(".bonus").replaceWith("<span class=\"bonus\"> Your bonus:"+bonus+"</span>");
                $(".surprise").replaceWith("<span class=\"surprise\"> Your surprise:"+surprise+"</span>");

            },
            error: function (msg) {

            }
        });
    });
})