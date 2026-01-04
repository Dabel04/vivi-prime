<?php include 'header.php'; ?>

<header class="shop-header">
    <div class="container text-center py-5" style="background: var(--bg-light);">
        <h1 class="page-title fw-800 text-uppercase">All Collections</h1>
        <p class="text-secondary">Engineered for elite performance and editorial style.</p>
    </div>
</header>

<main class="container py-5">
    <div class="filter-bar d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <span class="fw-bold">Showing 8 Products</span>
        <select class="form-select w-auto border-0 fw-bold">
            <option>Sort By: Featured</option>
            <option>Price: Low to High</option>
            <option>Newest Arrivals</option>
        </select>
    </div>

    <div class="row">
        <?php 
        // Product List with specific badges and functional data
        $shop_products = [
            ['id' => 5, 'name' => 'Boxy Crop Tee', 'price' => '45.00', 'img' => 'img/Boxy Crop Tee.jpg', 'badge' => 'New', 'badge_class' => 'badge-new'],
            ['id' => 6, 'name' => 'Runner 5 Short', 'price' => '55.00', 'img' => 'img/Runner 5 Short.jpg', 'badge' => 'Popular', 'badge_class' => 'badge-popular'],
            ['id' => 7, 'name' => 'Essential Core Legging', 'price' => '85.00', 'img' => 'img/Essential Core Legging.jpg', 'badge' => '', 'badge_class' => ''],
            ['id' => 8, 'name' => 'Sculpt Sports Bra', 'price' => '48.00', 'img' => 'img/Sculpt Sports Bra.jpg', 'badge' => 'Popular', 'badge_class' => 'badge-popular'],
            ['id' => 9, 'name' => 'Elevate Training Jacket', 'price' => '110.00', 'img' => 'img/Elevate Training Jacket.jpg', 'badge' => '', 'badge_class' => ''],
            ['id' => 10, 'name' => 'Flow Seamless Tank', 'price' => '42.00', 'img' => 'img/Flow Seamless Tank.jpg', 'badge' => 'New', 'badge_class' => 'badge-new'],
            ['id' => 11, 'name' => 'Unisex Core Hoodie', 'price' => '95.00', 'img' => 'img/Unisex Core Hoodie.jpg', 'badge' => '', 'badge_class' => ''],
            ['id' => 12, 'name' => 'Pro Grip Yoga Mat', 'price' => '75.00', 'img' => 'img/Pro Grip Yoga Mat.jpg', 'badge' => '', 'badge_class' => '']
        ];

        foreach($shop_products as $p): ?>
        <div class="col-6 col-lg-3">
            <div class="product-card">
                <div class="product-img-wrapper">
                    <?php if(!empty($p['badge'])): ?>
                        <span class="badge badge-custom <?= $p['badge_class'] ?>"><?= $p['badge'] ?></span>
                    <?php endif; ?>
                    <img src="<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                </div>
                <div class="product-title"><?= $p['name'] ?></div>
                <div class="product-price">$<?= $p['price'] ?></div>
                
                <div class="mt-2">
                    <span class="color-swatch selected" style="background: #000;"></span>
                    <span class="color-swatch" style="background: #a3a3a3;"></span>
                </div>
                <div class="mt-1">
                    <button class="size-selector selected">S</button>
                    <button class="size-selector">M</button>
                    <button class="size-selector">L</button>
                </div>

                <button class="add-to-cart-btn" 
                        data-product-id="<?= $p['id'] ?>" 
                        data-product-name="<?= $p['name'] ?>" 
                        data-product-price="<?= $p['price'] ?>" 
                        data-product-image="<?= $p['img'] ?>">
                    Add to Cart
                </button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'footer.php'; ?>