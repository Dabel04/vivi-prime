<?php include 'header.php'; ?>

    <header class="shop-header">
        <div class="container">
            <h1 class="page-title">All Collections</h1>
            <p class="text-secondary">Engineered for elite performance and editorial style.</p>
        </div>
    </header>

    <main class="container py-5">
        <div class="filter-bar">
            <span class="fw-bold">Showing 8 Products</span>
            <select class="form-select w-auto border-0 fw-bold">
                <option>Sort By: Featured</option>
                <option>Price: Low to High</option>
                <option>Newest Arrivals</option>
            </select>
        </div>

        <div class="row">
            <?php 
            // USING YOUR UPLOADED IMAGE NAMES FOR REALISM
            $shop_products = [
                ['name' => 'Boxy Crop Tee', 'price' => '45.00', 'img' => 'img/Boxy Crop Tee.jpg'],
                ['name' => 'Runner 5 Short', 'price' => '55.00', 'img' => 'img/Runner 5 Short.jpg'],
                ['name' => 'Essential Core Legging', 'price' => '85.00', 'img' => 'img/Essential Core Legging.jpg'],
                ['name' => 'Sculpt Sports Bra', 'price' => '48.00', 'img' => 'img/Sculpt Sports Bra.jpg'],
                ['name' => 'Elevate Training Jacket', 'price' => '110.00', 'img' => 'img/Elevate Training Jacket.jpg'],
                ['name' => 'Flow Seamless Tank', 'price' => '42.00', 'img' => 'img/Flow Seamless Tank.jpg'],
                ['name' => 'Unisex Core Hoodie', 'price' => '95.00', 'img' => 'img/Unisex Core Hoodie.jpg'],
                ['name' => 'Pro Grip Yoga Mat', 'price' => '75.00', 'img' => 'img/Pro Grip Yoga Mat.jpg']
            ];

            foreach($shop_products as $p): ?>
            <div class="col-md-3 col-6 mb-5">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                    </div>
                    <div class="fw-bold mb-1"><?= $p['name'] ?></div>
                    <div class="text-secondary">$<?= $p['price'] ?></div>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

 <?php include 'footer.php'; ?>