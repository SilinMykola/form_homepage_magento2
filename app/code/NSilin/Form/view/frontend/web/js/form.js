define([
    'jquery',
    'uiComponent',
    'mage/storage',
    'Magento_Checkout/js/model/full-screen-loader',
], function($, Component, storage, fullScreenLoader) {
    'use strict';

    return Component.extend({
        availableCountries: {'countryName': 'Ukraine', 'countryCode': 'Ukraine'},

        getCountryData: function() {
            return this.availableCountries;
        },
        randomCheck: function() {
            let check = Math.round(Math.random());
            if (check) {
                return true;
            } else {
                return false;
            }

        },
        clearFormData: function() {
            $('.form-info-wrapper input').each(function(i, input){
                $(input).val('')
            });
            $('#form-checkbox').attr('checked', false);
        },
        submit: function (data) {
            console.log(data);
            fullScreenLoader.startLoader();
            // storage.post(
            //     'nsilin_formdata/form/submit',
            //     JSON.stringify(data),
            //     true
            // ).done(
            //     function (response) {
            //         alert('Success');
            //         fullScreenLoader.stopLoader();
            //     }
            // ).fail(
            //     function (response) {
            //         fullScreenLoader.stopLoader();
            //     }
            // );
        }
    });
});