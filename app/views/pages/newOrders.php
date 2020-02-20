<main role="main" class="col-md-9 ml-sm-auto col-lg-9 pt-3 px-4">
    <h2 class="mb-md-3"><?= $title ?></h2>
    <div class="container">
        <div class="row">
    <?php if(count($products) > 0): foreach($products as $product):?>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src=<?= $product->small_image ?> alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $product->name ?></h5>
                <h7 class="card-title">Price <?= $product->price ?> RSD</h7>
                <p class="card-text"><?= $product->description ?></p>
                <p class="card-text"><small class="text-muted">Quantity</small></p>
                <form class="form-inline">
                    <div class="form-group" id="new-order">
                        <input type="text" class="form-control qty-input-text" id="newOrderQuantity" data-id=<?= $product->id ?>>
                        <button type="button" class="btn btn-primary btn-new-order" disabled data-id=<?= $product->id ?>>Order</button>
                    </div>
                </form>
            </div>
        </div>
        <?php endforeach; endif; ?>
    </div>
    </div>
</main>