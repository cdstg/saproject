<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>

    <main>
        <div class="mt-40 text-center text-success">
            <h1>
                <i class="far fa-check-circle"></i>
                Success!
            </h1>
        </div>
        <div class="mt-40 text-center">
            <div class="mt-20 text-center text-secondary border-placeholder">
                Email: <?= esc($email) ?><br>
                Intent ID: <?= esc($intent_id) ?><br>
                Payed Amount: $<span class="amount" data-amount="<?= esc($amount) ?>"></span>

            </div>
        </div>
    </main>
<?= $this->endSection() ?>