var Reset = function() {

    var handleReset = function() {

        $('.reset-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            errorLabelContainer: 'div.alert' ,               
            focusInvalid: false, // do not focus the last invalid input
            groups: {
                resetForm: 'userPassword userPasswordConfirm'
            },
            rules: {
                userPassword: {
                    required: true
                },
                userPasswordConfirm: {
                    equalTo: '#userPassword'
                }
            },

            messages: {
                userPassword: {
                    required: 'Insira sua senha.'
                },
                userPasswordConfirm: {
                    equalTo: 'Senhas nao conferem.'
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger').show();     
            }, 

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group

            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
                $('.alert-danger').hide();

            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.reset-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.reset-form').validate().form()) {
                    $('.reset-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }
  

    return {
        //main function to initiate the module
        init: function() {

            handleReset();

            // init background slide images
            $('.reset-bg').backstretch([
                '/followmeup/assets/img/WAGO/wago_750-881.jpg',
                '/followmeup/assets/img/WAGO/wago_poland2.jpg',
                '/followmeup/assets/img/WAGO/wago_750_modules.jpg',
                '/followmeup/assets/img/WAGO/wago_research.jpg',
                '/followmeup/assets/img/WAGO/wago_entwicklungszentrum_0.jpg',
                '/followmeup/assets/img/WAGO/wago_sonderhausen.jpg',
                '/followmeup/assets/img/WAGO/wago_minden.jpg',
                '/followmeup/assets/img/WAGO/wago_truck_supplier.jpg',
                '/followmeup/assets/img/WAGO/wago_poland.jpg',
                '/followmeup/assets/img/WAGO/wago_usa.jpg'
                ], {
                  fade: 1000,
                  duration: 8000
                }
            );
        }

    };

}();

jQuery(document).ready(function() {
    Reset.init();
});