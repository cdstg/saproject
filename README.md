# Stripe: Solutions Architect Take Home - Craig St George

This is a simple e-commerce application that a customer can use to purchase a book and pay using Stripe.

The application is PHP based on the [codeigniter framework](https://codeigniter.com/). The styling is based on the Python boilerplate application that was provided. 
[https://github.com/marko-stripe/sa-takehome-project-python](https://github.com/marko-stripe/sa-takehome-project-python)


## Requirements 
- Select a book to purchase.
- Checkout and purchase the item using Stripe Elements.
- Display a confirmation of purchase to the user with the total amount of the charge and Stripe Payment Intent ID (beginning with pi_).

## Running the Application

To run the project locally, start by cloning the repository `git clone https://github.com/cdstg/saproject.git`

Change to the `src` directory and Rename `sample.evn` to `.env`

Edit the .`evn` file and enter your Stripe account's test API keys

You will need to set your Stripe STRIPE_SECRET_KEY  and STRIPE_PUBLISHABLE_KEY
in file you can obtain these at  [stripe.com](https://dashboard.stripe.com/login/)

### Running with Docker
The quickest way to run the project is with Docker.

In the root directory run 

`docker compose up -d`

Navigate to [http://localhost:8080](http://localhost:8080) to view the application in your browser.

If that port is alreay in use you can edit the `docker-compose.yml
` and change  the port.

> [!IMPORTANT]
> if you have already run docker compose up  and you have changed the port or the stripe keys
> run `docker compose up -d --build` to rebuild the container.

### Running with PHP locally
Alternately you can run the project locally with PHP

PHP version 8.1 or higher is required, with the following extensions installed:

- intl
- mbstring

Composer is also required  [https://getcomposer.org/](https://getcomposer.org/)

Change to the src directory and run

```
 composer up
 php spark serve 
  ```
Navigate to [http://localhost:8080](http://localhost:8080) to view the application in your browser.

if the port is in use you can run `php spark serve -port <your port>`

## Usage
Select a book to purchase and you will be then presented with a payment page when you can enter a card number.

Test card numbers for both Success and Declines are available at 
[https://docs.stripe.com/testing](https://docs.stripe.com/testing)


##

## How the solution works

The application uses the Payment Intents API to create the intent to pay and received the information about the payment with the Charges API

## Challenges
The main challenge I had was working out how to retrieve the email address I had set under the Billing Address in the Intent.
as the paymentIntents->retrieve did not provide that.

I also had to familiarize my self with the Methods and Attributes of the Intents API as previously I had only used the now Deprecated Stripe Charges API.


## Resources used

The followig are links to the Stripe Documantion for the API's used in the appication.

- [Stripe Web Elements](https://docs.stripe.com/payments/elements)
- [How Payment Intents work](https://docs.stripe.com/payments/paymentintents/lifecycle)
- [JS API payment_intents](https://docs.stripe.com/js/payment_intents)
- [Payment Intents API](https://docs.stripe.com/api/payment_intents)
- [Charges API ](https://docs.stripe.com/api/charges)


## Improvements 

### Short Term Improvements

- Avoid Duplicate Payment intents . Currently every load of the checkout route creates a new Intent. 
We could avoid this by using sessions and setting an idempotency_key (based on product price and unique sesssionid ) and the to track that same person is purchasing the same book and the payment is not completed.
- As books are physical we should collect shipping and billing information and create a customer record.
- Add validation to the Email address and shipping address.
- Send the customer an Email Receipt.
- Load the  credit card form via Ajax too improve the customers page load experience.
- Handle the Stripe exceptions in the backend gracefully.

### Future Improvements
- Add a shopping basket so the customer can purchase more than one book at a time
- Use Stripe Webhooks this will allow payment methods that are not real time and deal with any transient network issues as the webhook will retry 

Additionaly we could track what the customer has brought and provide both a customer portal and admin portal.

This would require a lot of code to make the application a full ecommerce store which is beyond the scope and intent for the original project.

There are many opensource ecommerce solutions that are more than capable to provide these functions for a much lower cost than that of the development cost of such an application.  

## Observations and Remarks
While I was reading the Stripe documentation I realised that there were some other faster methods that could be used to sell the books online and would be ideal if this was a real world example.

These methods would not meet the intent of the project requirements though but certainly could be used for a simple and fast way to sell something online with low or no code.

Specifically there are

-  __Payment Links__  These would allow the creation of a payment link that could be posted  on Social Media or sent  vial email and the customer would see a hosted payment form
  ( But  the  )[https://buy.stripe.com/test_eVa03w6yb7fN2Ig9AB]
- __Stripe Checkout__  with either a hosted page or an embbed  form this uses the prdoduct that you have created in the Stripe portal or via the API this requires a working domain for the hosted page as you need to set the success_url and the cancel_url

Strip offers many ways of achieving a goal of taking payment and the documentation is very extensive.

The project gave me the knowledge and the understanding of the Stripe Intents API so that I can now covert the application we run that use the Deprecated Stripe Charges API to the newer Intents API.






