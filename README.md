# Stripe: Solutions Architect Take Home - Craig St George

This is a simple e-commerce application that a customer can use to purchase a book.

The application is PHP based on the [https://codeigniter.com/](https://codeigniter.com/)  .The 




## Requirements 
- Select a book to purchase.
- Checkout and purchase the item using Stripe Elements.
- Display a confirmation of purchase to the user with the total amount of the charge and Stripe Payment Intent ID (beginning with pi_).

## Running the Project

To run the project locally, start by cloning the repository `git clone https://github.com/cdstg/saproject.git`

Change to the `src` directory and Rename sample.evn to .env

Edit the .evn file and enter your Stripe account's test API keys

You will need to set your Stripe STRIPE_SECRET_KEY  and STRIPE_PUBLISHABLE_KEY
in file you can obtain these at  [GitHub Pages](https://pages.github.com/)

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

### Running with PHP localy
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
Select a book to purchase and you will be then presented with a payment page when you can enter a card numer.

Test card numbers for both Success and Declines are available at 
[https://docs.stripe.com/testing](https://docs.stripe.com/testing)

## Resources Used
- [Stripe Web Elements](https://docs.stripe.com/payments/elements)
- [How PaymentIntents work](https://docs.stripe.com/payments/paymentintents/lifecycle)
- [JS API payment_intents](https://docs.stripe.com/js/payment_intents)
- [Payment Intents API](https://docs.stripe.com/api/payment_intents)
- [Charges API ](https://docs.stripe.com/api/charges)



## Improvements 

### Short Term Improvements

- Avoid Duplicate Payment intents . Every load of the checkout route creates a new Intent we could avoid this by using sessions id the same  person is purchasing the same book.
- As books are physical we should collect shipping and billing information and create a customer record.
- Add validation to the Email address and shipping address.
- Load the  credit card form via Ajax too improve the customers page load experience
- Handle the Stripe exceptions in the backend gracefully
- Send the customer an Email Receipt 


### Future Improvements
- Security - Improve
- Add a shopping basket so the customer can purchase more than one book at a time
- Use Stripe Webhooks 
- 






