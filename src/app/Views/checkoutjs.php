<script src="https://js.stripe.com/v3/"></script>

<script>

    const stripe = Stripe('<?= esc($publishKey) ?>');
    const options = {
        clientSecret: '<?= esc($clientSecret) ?>',
        appearance: {
            theme: 'stripe',
            variables: {
                fontFamily: 'Roboto, sans-serif'

            }
        }
    }

    const elements = stripe.elements(options);
    const paymentElement = elements.create('payment');

    paymentElement.mount('#payment-element');

    const form = document.getElementById('payment-form');
    const messageContainer = document.querySelector('#error-message');


    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        messageContainer.textContent = '';
        $('#paystripe').prop("disabled", true);
        $('#paystripe_spin').show();

        const {error} = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url:'<?= base_url('payment/success') ?>',
                payment_method_data: {
                    billing_details: {
                        email: form.email.value
                    }
                }
            }
        });

        if (error) {
            $('#paystripe').prop("disabled", false);
            $('#paystripe_spin').hide();

            messageContainer.textContent = error.message;
        }
    });


</script>

