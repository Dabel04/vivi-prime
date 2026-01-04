<?php include 'header.php'; ?>

<main class="container py-5">
    <div class="row g-5">
        <div class="col-md-7">
            <div class="product-gallery">
                <div class="main-image-container mb-3 overflow-hidden rounded shadow-sm">
                    <img id="mainDisplay" src="img/Essential Core Legging.jpg" class="img-fluid w-100" alt="Core Legging Main">
                </div>
                
                <div class="thumbnail-strip d-flex gap-2 overflow-auto pb-2">
                    <img src="img/Essential Core Legging.jpg" class="thumb active" onclick="swapImage(this)" alt="Angle 1">
                    <img src="img/bottoms.jpg" class="thumb" onclick="swapImage(this)" alt="Angle 2">
                    <img src="img/leggings.jpg" class="thumb" onclick="swapImage(this)" alt="Angle 3">
                    <img src="img/image.png" class="thumb" onclick="swapImage(this)" alt="Angle 4">
                    <img src="img/anotherhero.jpg" class="thumb" onclick="swapImage(this)" alt="Angle 5">
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="purchase-box sticky-top" style="top: 100px;">
                <h1 class="display-6 fw-900 text-uppercase mb-2">Essential Core Legging</h1>
                <p class="text-muted mb-4 small">SERIES 01 // PERFORMANCE TECH</p>
                <div class="h4 fw-700 mb-4">$85.00</div>

                <div class="mb-4">
                    <h6 class="fw-bold text-uppercase x-small mb-3">Select Size</h6>
                    <div class="size-options d-flex gap-2">
                        <button class="size-btn">XS</button>
                        <button class="size-btn active">S</button>
                        <button class="size-btn">M</button>
                        <button class="size-btn">L</button>
                    </div>
                </div>

                <button class="add-to-cart-btn py-3 mb-3">Add to Cart</button>
                
                <div class="product-desc mt-5">
                    <h6 class="fw-bold text-uppercase x-small border-bottom pb-2">Description</h6>
                    <p class="small text-muted pt-2">Engineered for elite performance. Our signature 44:11 compression fabric provides surgical support during high-intensity training. Move with zero friction and maximum style.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    /* Slider Custom Styles */
    .main-image-container {
        height: 600px; /* Controlled height for desktop */
        background: #f8f8f8;
    }
    .main-image-container img {
        height: 100%;
        object-fit: contain; /* Shows full product without cropping */
    }
    .thumbnail-strip::-webkit-scrollbar {
        height: 4px;
    }
    .thumbnail-strip::-webkit-scrollbar-thumb {
        background: #000;
    }
    .thumb {
        width: 80px;
        height: 100px;
        object-fit: cover;
        cursor: pointer;
        opacity: 0.6;
        transition: 0.3s;
        border: 1px solid transparent;
    }
    .thumb:hover, .thumb.active {
        opacity: 1;
        border-color: #000;
    }
    .size-btn {
        border: 1px solid #ddd;
        background: #fff;
        padding: 10px 20px;
        font-size: 12px;
        font-weight: 700;
        transition: 0.2s;
    }
    .size-btn.active, .size-btn:hover {
        background: #000;
        color: #fff;
        border-color: #000;
    }
    .x-small { font-size: 10px; letter-spacing: 1px; }
</style>

<script>
    function swapImage(thumb) {
        // Change Main Image
        document.getElementById('mainDisplay').src = thumb.src;
        
        // Update Active State
        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
    }
</script>

<section class="container mb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <h2 class="section-header mb-0 mt-5">More Like This</h2>
        <a href="shop.php" class="view-all-link" style="font-size: 0.8rem;">VIEW ALL ></a>
    </div>
    <div class="row">
        <?php 
        // Logic to pull related products - Using your uploaded assets
        $related_products = [
            ['name' => 'Sculpt Sports Bra', 'price' => '48.00', 'img' => 'img/Sculpt Sports Bra.jpg', 'badge' => 'Popular', 'badge_class' => 'badge-popular'],
            ['name' => 'Flow Seamless Tank', 'price' => '42.00', 'img' => 'img/Flow Seamless Tank.jpg', 'badge' => 'New', 'badge_class' => 'badge-new'],
            ['name' => 'Boxy Crop Tee', 'price' => '45.00', 'img' => 'img/Boxy Crop Tee.jpg', 'badge' => '', 'badge_class' => ''],
            ['name' => 'Elevate Training Jacket', 'price' => '110.00', 'img' => 'img/Elevate Training Jacket.jpg', 'badge' => '', 'badge_class' => '']
        ];

        foreach($related_products as $p): ?>
        <div class="col-6 col-lg-3">
            <div class="product-card">
                <div class="product-img-wrapper">
                    <?php if($p['badge']): ?>
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
                
                <button class="add-to-cart-btn" 
                        data-product-name="<?= $p['name'] ?>" 
                        data-product-price="<?= $p['price'] ?>" 
                        data-product-image="<?= $p['img'] ?>">
                    Add to Cart
                </button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
