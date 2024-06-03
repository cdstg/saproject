<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>

<div class="text-center mt-40">
    <h1>
        Stripe Press Shop
    </h1>
    <p class="text-secondary">
        Select an item to purchase
    </p>
</div>

<div class="mt-40 row">
    <div class="col">
        <div class="card box-shadow">
            <img src="/images/art-science-eng.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">The Art of Doing Science and Engineering</h5>
                <strong>Richard Hamming</strong>
                <p class="card-text mt-20">
                    The Art of Doing Science and Engineering is a reminder that a childlike capacity for learning and
                    creativity are accessible to everyone.
                </p>
                <a href="/checkout?item=1" class="btn btn-primary btn-block">Purchase — $23</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card box-shadow">
            <img src="/images/prince-of-persia.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">The Making of Prince of Persia: Journals 1985-1993</h5>
                <strong>Jordan Mechner</strong>
                <p class="card-text mt-20">
                    In The Making of Prince of Persia, on the 30th anniversary of the game’s release, Mechner looks back
                    at the journals he kept from 1985 to 1993..
                </p>
                <a href="/checkout?item=2" class="btn btn-primary btn-block">Purchase - $25</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card box-shadow">
            <img src="/images/working-in-public.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Working in Public: The Making and Maintenance of Open Source</h5>
                <strong>Nadia Eghbal</strong>
                <p class="card-text mt-20">
                    Nadia Eghbal takes an inside look at modern open source and offers a model through which to
                    understand the challenges faced by online creators.
                </p>
                <a href="/checkout?item=3" class="btn btn-primary btn-block">Purchase - $28</a>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
