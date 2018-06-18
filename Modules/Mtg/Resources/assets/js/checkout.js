$(function () {
    // Create a Stripe client.
    let stripe = Stripe(strip_api);

// Create an instance of Elements.
    let elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
    let style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

// Create an instance of the card Element.
    let card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

// Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        let displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });


    $('#frm_checkout').validate({
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    $('#btn_pay').click(function (e) {
        e.preventDefault();

        if( ! $('#frm_checkout').valid() ){
            return false;
        }

        let amount = $('#amount').val();

        swal({
                title: "Are You Sure ?",
                text: 'You are about to pay £' + amount + ' toward MTG Trader!',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Proceed!",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            },
            function(){
                $('#frm_checkout').submit();
            }
        );

    });


    $('#frm_checkout').submit(function (e) {
        e.preventDefault();

        $.LoadingOverlay('show');

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                $.LoadingOverlay('hide');
                let errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                // stripeTokenHandler(result.token);
                // stripe_token = result.token;
                $('#frm_checkout').ajaxSubmit({
                    data: { stripe_token: result.token.id },
                    success: function (result) {
                        // payment has been taken

                        $.LoadingOverlay('hide');


                        if(result.err){
                            swal(result.msg, '', 'error');
                        }else{window.location.href = 'mtg/thank-you';
                        }
                    }
                });
            }
        });
    });


});