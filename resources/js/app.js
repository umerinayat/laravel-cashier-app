require('./bootstrap');


jQuery(function () {

    $('#subscribeForm').on('submit', function(e) {

        let form = $(this);

        // disable the form button
        form.find('button').prop('disabled', true);

        Stripe.card.createToken(form, (status, response) => {

            if (response.error) {

                    form.find('.stripe-errors').text(response.error.message).addClass('alert alert-danger');
                    form.find('button').prop('disabled', false);


            } else {
                console.log(response);
            
                // append the token to the form
                form.append($('<input type="hidden" name="cc_token">').val(response.id));
    
                // submit the form
                form.get(0).submit();
            }

        });

        e.preventDefault();

    });

});