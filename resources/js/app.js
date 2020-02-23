/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(document).ready(function () {

    $('#filter_menu_trigger').on('click', function () {
        $('.filter-container').slideToggle(300);
    });
    calcTotals();
    calcGrandTotal();

    // generate invoice lines
    var i = ($('.invoice-line').length) + 1;
    $('#add_invoice_line').on('click', function (e) {
        e.preventDefault();
        var invoiceLine = '                                <div class="form-row invoice-line">\n' +
            '                                    <div class="col-4">\n' +
            '                                        <div class="form-group form-row">\n' +
            '                                            <label class="col-form-label col-12">\n' +
            '                                                Paslauga/pavadinimas\n' +
            '                                                <input type="text" name="lines[' + i + '][item_name]" class="form-control item-name" required>\n' +
            '                                            </label>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-3">\n' +
            '                                        <div class="form-group form-row">\n' +
            '                                            <label class="col-form-label col-12">\n' +
            '                                                Konteinerio nr.\n' +
            '                                                <select type="text" name="lines[' + i + '][booking_id]" class="form-control booking-select2">\n' +
            '                                                    <option></option>\n' +
            '                                                </select>\n' +
            '                                            </label>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-1">\n' +
            '                                        <div class="form-group form-row">\n' +
            '                                            <label class="col-form-label col-12">\n' +
            '                                                Kiekis\n' +
            '                                                <input type="text" name=" lines[' + i + '][item_quantity]" value="1" class="form-control item-quantity" required >\n' +
            '                                            </label>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-2">\n' +
            '                                        <div class="form-group form-row">\n' +
            '                                            <label class="col-form-label col-12">\n' +
            '                                                Kaina\n' +
            '                                                <input type="text" name="lines[' + i + '][item_price]" class="form-control item-price" required >\n' +
            '                                            </label>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-2">\n' +
            '                                        <div class="form-group form-row">\n' +
            '                                            <label class="col-form-label col-9">\n' +
            '                                                Viso\n' +
            '                                                <input type="text" name="lines[' + i + '][item_total]" class="form-control item-total" value="" readonly>\n' +
            '                                            </label>\n' +
            '                                           <div class="col-form-label col-2">\n' +
            '                                              <br>\n' +
            '                                                <a href="#" class="btn btn-danger remove-line">X</a>\n' +
            '                                           </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </div>\n';

        $('.invoice-lines-container').append(invoiceLine);
        i++;
        bookingSelectEventListener();
        $('input.item-quantity, input.item-price').on('change', function () {
            calcTotals();
        });

        //delete invoice lines
        $('.remove-line').on('click', function (e) {
            e.preventDefault();
            $(this).closest($('.invoice-line')).remove();
            calcGrandTotal();
        });
    });


    //delete invoice lines
    $('.remove-line').on('click', function (e) {
        e.preventDefault();
        $(this).closest($('.invoice-line')).remove();
        calcGrandTotal();
    });



    //calc total for each line and grand total
    function calcTotals() {
        var total = 0;
        $('.invoice-line').each(function () {
            var qnt = parseFloat($(this).find('input.item-quantity').val().replace(',', '.'));
            var price = parseFloat($(this).find('input.item-price').val().replace(',', '.'));
            total = qnt * price;
            if (total >= 0) {
                $(this).find('input.item-total').val(total)
            }
            calcGrandTotal();
        });
    }

        $('input.item-quantity, input.item-price').on('change', function () {
            calcTotals();
        });


    function calcGrandTotal() {
        var grandTotal = 0;
        $('input.item-total').each(function () {
            grandTotal += parseFloat($(this).val());
        });
        $('.grand-total span').html(grandTotal);
        $('input[name=grand_total]').val(grandTotal);
    }

    function bookingSelectEventListener() {
        $('.booking-select2').on('change', function() {
            var data = $(this).select2('data')[0];
            console.log(data);
            var price = (data.price)/100;
            $(this).closest('.invoice-line').find('input.item-price').val(price);
            calcTotals();
        });
    }

    bookingSelectEventListener();


 /*   function initBookingSelectEdit(control, id, text, price) {
        var data =  {
            id: id,
            text: text,
            price: price,
        };
        var initOption = new Option( data.text, data.id , false, false)
    }*/



});








