# Stripe: Solutions Architect Take Home 
### - Craig St George

This is a simple e-commerce application that a customer can use to purchase a book and pay using Stripe.

The application is PHP based on the [codeigniter framework](https://codeigniter.com/). The styling is based on the Python boilerplate application that was provided. 
[https://github.com/marko-stripe/sa-takehome-project-python](https://github.com/marko-stripe/sa-takehome-project-python) for the project.


## Requirements 
- Select a book to purchase.
- Checkout and purchase the item using Stripe Elements.
- Display a confirmation of purchase to the user with the total amount of the charge and Stripe Payment Intent ID (beginning with pi_).
- The application should bne structured in such a way that you’re able to run it locally and integrate other Stripe features easily later.


## Running the Application

To run the project locally, start by cloning the repository `git clone https://github.com/cdstg/saproject.git`

Change to the `src` directory and Rename `sample.env` to `.env`

Edit the `.evn` file and enter your Stripe account's test API keys

You will need to set your Stripe STRIPE_SECRET_KEY  and STRIPE_PUBLISHABLE_KEY
in file.
You can obtain these at  [stripe.com](https://dashboard.stripe.com/login/) with an existing account or you can create and account.

### Running with Docker
The quickest way to run the project is with Docker.

In the projects root directory run 

`docker compose up -d`

Navigate to [http://localhost:8080](http://localhost:8080) to view the application in your browser.

If that port is already in use you can edit the `docker-compose.yml`  and change  the port.

> [!IMPORTANT]
> if you have already run docker compose up,  and you have changed the port or the stripe keys
> run `docker compose up -d --build` to rebuild the container.

### Running with PHP locally
Alternately you can run the project locally with PHP.

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

If  the port is in use edit the `.evn` file  and change to the port you require

```
app.baseURL = 'http://localhost:8080/'

app.baseURL = 'http://localhost: <your port>/'

php spark serve -port <your port>
```


## Usage
Select a book to purchase and you will be then presented with a payment page when you can enter a card number.

Test card numbers for both Success and Declines are available at 
[https://docs.stripe.com/testing](https://docs.stripe.com/testing)


## Solution Approach
After reviewing the requirements, reading the Stripe documentation and running the supplied Python boilerplate application I concluded that the Payment Intents API would be the best method to meet the requirements.

I decided to build the application in PHP with a framework as this will make it more flexible and faster to build should we need to add database, validation, authentication and other features later on.
I chose the [codeigniter framework](https://codeigniter.com/) as its quite fast when compared to some other frameworks and very flexible.

As the project required the application to run standalone I created a docker container so tha person running or testing the application would not need to have PHP installed and the other requirements for the application to run locally.

The application can run locally under PHP as long at the application requirements are met that are explained in the [Running the Application](#running-the-application).

 
## How the solution works

The customer enters the site, and the default control displays the default view with a listing of the books for sale.

The customer selects a book to purchase, on clicking the purchase button it does a form post to the checkout controller which has the products and prices hard coded.

The checkout controller calls the Payment Intents API create method which returns the Intent and a customer secret.  It then displays the checkout view where the Stripe form will display.

The checkout view includes the Stripe JS library as well as  initialising  the Stripe elements that are then displayed to the customer (This is embedded on the  HTML page via an Iframe)

The Customer enters their card details, and they are validated and then when they click pay the stripe.confirmPayment() method  is called by JavaScript.

This method decides if the payment is a success or failure. If the payment failed the error is trapped and displayed to the customer where they can try again.

If the payment is successful a Charge is created on the Stripe backend and the JavaScript issues a redirect to the `return_url`  with the Payment Intent ID provided as a GET parameter.

The Success controller calls the Payment Intents API to receive the information about the payment, and additionally it calls the Charges API to obtain additional information and then displays the success view.


## Challenges
The main challenge I had was working out how to retrieve the email address I had set under the Billing Address in the Intent.
as the paymentIntents->retrieve did not provide that information.

When I realised that a Charge had been created I could retrieve that information using the Charges APi as the charge id is in the Intent object that was  retrieved. 

I also had to familiarise myself with the Methods and Attributes of the Payments Intents API as previously I had only used the now Deprecated Stripe Charges API.


## Resources used

The following are links to the Stripe Documentation that I used to integrate the Payment Integrate dnd the Stripe Elements


- [How Payment Intents work](https://docs.stripe.com/payments/paymentintents/lifecycle)
- [Payment Intents API](https://docs.stripe.com/api/payment_intents)
- [Charges API ](https://docs.stripe.com/api/charges)
- [JS API payment_intents](https://docs.stripe.com/js/payment_intents)
- [Stripe Web Elements](https://docs.stripe.com/payments/elements)


## Improvements 

### Short Term Improvements

- Avoid Duplicate Payment intents. Currently, every load of the checkout route creates a new Intent. 
We could avoid this by using sessions and setting an idempotency_key (based on product. price and unique sesssionid )
- As books are physical, we should collect shipping and billing information and create a customer record.
- Add validation to the email address and shipping address.
- Send the customer an email receipt.
- Load the credit card form via Ajax to improve the customers' page load experience.
- Handle the Stripe exceptions in the backend gracefully.

### Future Improvements
- Add a shopping basket so the customer can purchase more than one book at a time.
- Use Stripe Webhooks this will allow payment methods that are not real time and deal with any transient network issues as the webhook will retry .

Additionally, we could track what the customer has brought and provide both a customer portal and admin portal.

This would require a lot of code to make the application a full ecommerce store which is beyond the scope and intent for the original project.

There are many opensource ecommerce solutions that are more than capable of providing these functions for a much lower cost than that of the development cost of extending this application both in time and money.  


## Observations and Remarks
While I was reading the Stripe documentation, I realised that there were some other faster methods that could be used to sell the books online and would be ideal in a real-world solution.

These methods would not meet the intent of this projects requirements though, but certainly could be used for a simple and fast way to sell something online with low or no code.

Specifically there are

-  __Payment Links__  These would allow the creation of a payment link that could be posted on Social Media or sent via email and the customer would see a hosted payment form
  [https://buy.stripe.com/test_eVa03w6yb7fN2Ig9AB]
- __Stripe Checkout__  with either a hosted page or an embed  form this uses the product that you have created in the Stripe portal or via the API . A working domain for the hosted page is required as you need to set the success_url and the cancel_url

Stripe offers many ways of achieving the goal of taking payment and the documentation is very extensive.

The project gave me the knowledge and the understanding of the Stripe Payment Intents API so that I can now convert the applications we run that use the Deprecated Stripe Charges API to the newer Payment Intents API.




