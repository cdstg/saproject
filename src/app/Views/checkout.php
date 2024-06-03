<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>


    <div class="row justify-content-md-center">
        <div class="col-6">
            <div class="text-center mt-40">
                <h1>
                    Checkout — Stripe Press
                </h1>

                <h5 class="text-secondary">
                    <?= esc($title) ?>"
                </h5>

                <hr class="mt-40">

                <div class="mt-20 text-info">
                    <?php if (!$error): ?>
                        Total due: $<span class="amount" data-amount="<?= esc($amount) ?>"></span>
                    <?php else: ?>
                        <span class="text-danger"> An Error has occurred please try again <a class="text-danger"
                                                                                             href="/">Return</a></span>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!$error): ?>
                <div class="card box-shadow mt-40">
                    <div class="card-body">
                        <form id="payment-form">
                            <div>
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="you@email.com">
                            </div>
                            <!--  The JS will insert the strip form here-->
                            <div class="mt-20" id="payment-element"></div>
                            <div id="error-message" class="text-danger"></div>

                            <div class="mt-20">
                                <button id="paystripe" class="btn btn-lg btn-block btn-primary">
                                    <span id="paystripe_spin" class="spinner-border spinner-border-sm"
                                          style="display: none;" role="status" aria-hidden="true"></span>
                                    Pay $<span class="amount" data-amount="<?= esc($amount) ?>"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>

<?= $checkoutjs ?>

<?= $this->endSection() ?>