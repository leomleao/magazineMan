var Login = function() {

    var handleLogin = function() {

        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                userPassword: {
                    required: true
                },
                userPassword: {
                    required: true
                },
                remember: {
                    required: false
                }
            },

            messages: {
                userPassword: {
                    required: 'Insira seu usuario.'
                },
                userPassword: {
                    required: 'Insira sua senha.'
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.login-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });

        $('.forget-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        $('#forget-password').click(function(){
            $('div.login-message').find('.alert').remove();              
            $('.login-form').hide();
            $('.forget-form').show();
        });

        $('#back-btn').click(function(){
            $('div.login-message').find('.alert').remove(); 
            $('.forget-form').hide();
            $('.login-form').show(); 
        });

        function printResponse(response) {
            responseText = tryParseJSON(response);
            if (responseText){
                var $div;
                message = document.createTextNode(responseText.message);
                (responseText.status == 'ok') ? $div = $('<div>', {'class': 'alert alert-success'}) : $div = $('<div>', {'class': 'alert alert-danger'});
                $div.append(message);                
                $('div.login-message').append($div);            
            }
        }
        function tryParseJSON (jsonString){
            try {
                var o = JSON.parse(jsonString);               
                if (o && typeof o === 'object') {
                    return o;
                }
            }
            catch (e) { }
            return false;
        };

        $('.forget-form').on('submit', submit);
        function submit(e){
            e && e.preventDefault();  
            $('div.login-message').find('.alert').remove();  

            $('.loader').fadeIn();
            $.post("session/reset", $(this).serialize(), function(result){
                printResponse(result)
            })
            .done(function(){
                $('.loader').hide();
            });

                // formData = $(this).serialize();
                // var ajax = new XMLHttpRequest;
                // ajax.open("POST", "session/reset", true);
                // ajax.setRequestHeader("Content-type", "text/json");
                // ajax.onreadystatechange = function (){
                //     if(ajax.readyState == 4 && ajax.status == 200){
                //           printResponse(ajax.response);
                //     }
                // }               
                // ajax.send(JSON.stringify(formData));
        };
    }

 
  

    return {
        //main function to initiate the module
        init: function() {

            handleLogin();

            // init background slide images
            $('.login-bg').backstretch([
                '/magazineman/assets/img/JW/wallkill.jpg',
                '/magazineman/assets/img/JW/bibles.jpg',
                '/magazineman/assets/img/JW/bethelNY.jpg',
                '/magazineman/assets/img/JW/wallkillInterior.jpg'
                ], {
                  fade: 1000,
                  duration: 8000
                }
            );

            $('.forget-form').hide();

        }

    };

}();

jQuery(document).ready(function() {
    Login.init();
});