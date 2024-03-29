// Class definition

var KTInputmask = function () {

    // Private functions
    var demos = function () {
        // Date format
        $(".date-input-mask").inputmask("99/99/9999", {
            "placeholder": "DD/MM/AAAA",
            autoUnmask: true
        });

        // Decimal format
        $(".decimal-input-mask").inputmask({
            alias: "decimal",
            integerDigits: 20,
            digits: 2,
            allowMinus:false,
            digitsOptional: false,
            placeholder: "0"
        });

        // phone number format
        $(".phone-input-mask").inputmask("mask", {
            "mask": "(999) 999-9999"
        });

        // RIF format
        $(".input-mask-rif").inputmask({
            "mask": "99999999-9",
            placeholder: "" // remove underscores from the input mask
        });

        // repeating mask
        $("#kt_inputmask_5").inputmask({
            "mask": "9",
            "repeat": 10,
            "greedy": false
        }); // ~ mask "9" or mask "99" or ... mask "9999999999"

        // decimal format
        $("#kt_inputmask_6").inputmask('decimal', {
            rightAlignNumerics: false
        });

        //ip address
        $("#kt_inputmask_8").inputmask({
            "mask": "999.999.999.999"
        });

        //email address
        $(".email-input-mask").inputmask({
            mask: "*{1,45}[.*{1,45}][.*{1,45}][.*{1,45}]@*{1,45}[.*{2,6}][.*{1,2}]",
            greedy: false,
            onBeforePaste: function (pastedValue, opts) {
                pastedValue = pastedValue.toLowerCase();
                return pastedValue.replace("mailto:", "");
            },
            definitions: {
                '*': {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                    cardinality: 1,
                    casing: "lower"
                }
            }
        });
    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

jQuery(document).ready(function() {
    KTInputmask.init();
});
