<?php
require_once 'db_connect.php';
$db = new Database();
$conn = $db->connect();

// 1. FETCH "HOT RIGHT NOW" (Newest 4 Items)
// We use 'LIMIT 4' to fit the grid perfectly
$stmt = $conn->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 4");
$hot_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// INCLUDE HEADER (Starts Session & Opens HTML)
include 'header.php';
?>

<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Elegance In<br>Every Movement</h1>
            <p class="hero-subtitle">Where style meets your workout.</p>
            <div class="d-flex">
                <button class="btn btn-light-custom shop-now" onclick="window.location.href='shop.php?category=Tops'">Shop Tops</button>
                <button class="btn btn-outline-custom shop-now" onclick="window.location.href='shop.php?category=Bottoms'">Shop Bottoms</button>
            </div>
        </div>
    </div>
</section>

<section class="container">
    <h2 class="section-header">Shop The Essentials</h2>
    
    <div class="row category-grid">
        <div class="col-md-3">
            <div class="category-card shop-now" onclick="window.location.href='shop.php?category=Tops'">
                <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=2070&auto=format&fit=crop" alt="Tops">
                <div class="category-text">Tops</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="category-card shop-now" onclick="window.location.href='shop.php?category=Bottoms'">
                <img src="img/bottoms.jpg" alt="Bottoms">
                <div class="category-text">Bottoms</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="category-card shop-now" onclick="window.location.href='shop.php?category=Accessories'">
                <img src="img/bras.jpg" alt="Sports Bras">
                <div class="category-text">Sports Bras</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="category-card shop-now" onclick="window.location.href='shop.php?category=Accessories'">
                <img src="https://images.unsplash.com/photo-1623945419356-9d3298c4d29a?q=80&w=2070&auto=format&fit=crop" alt="Accessories">
                <div class="category-text">Accessories</div>
            </div>
        </div>
    </div>
    
    <div class="categories-slider">
        <div class="categories-scroll-container" id="categories-scroll">
            <div class="category-slide">
                <div class="category-card shop-now" onclick="window.location.href='shop.php?category=Tops'">
                    <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=2070&auto=format&fit=crop" alt="Tops">
                    <div class="category-text">Tops</div>
                </div>
            </div>
            <div class="category-slide">
                <div class="category-card shop-now" onclick="window.location.href='shop.php?category=Bottoms'">
                    <img src="img/bottoms.jpg" alt="Bottoms">
                    <div class="category-text">Bottoms</div>
                </div>
            </div>
            <div class="category-slide">
                <div class="category-card shop-now" onclick="window.location.href='shop.php?category=Accessories'">
                    <img src="img/bras.jpg" alt="Sports Bras">
                    <div class="category-text">Sports Bras</div>
                </div>
            </div>
            <div class="category-slide">
                <div class="category-card shop-now" onclick="window.location.href='shop.php?category=Accessories'">
                    <img src="img/ass.jpg" alt="Accessories">
                    <div class="category-text">Accessories</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <h2 class="section-header mb-0 mt-5">Hot Right Now</h2>
        <a href="shop.php" class="view-all-link" style="font-size: 0.8rem;">VIEW ALL ></a>
    </div>
    <div class="row">
        <?php if (empty($hot_products)): ?>
            <div class="col-12 text-center py-5 text-muted">
                System Offline: No Assets Deployed.
            </div>
        <?php else: ?>
            <?php foreach ($hot_products as $product): ?>
            <?php 
                $is_sold_out = $product['stock'] <= 0;
                $sizes = !empty($product['size']) ? explode(', ', $product['size']) : ['OS'];
                $colors = !empty($product['color']) ? explode(', ', $product['color']) : ['#000'];
            ?>
            <div class="col-6 col-lg-3">
                <div class="product-card <?= $is_sold_out ? 'sold-out' : '' ?>">
                    <div class="product-img-wrapper">
                        <?php if($product['price'] > 100): ?>
                            <span class="badge badge-custom badge-popular">Premium</span>
                        <?php elseif(!$is_sold_out): ?>
                            <span class="badge badge-custom badge-new">New</span>
                        <?php endif; ?>
                        
                        <a href="product-details.php?id=<?= $product['id'] ?>">
                            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        </a>

                        <?php if($is_sold_out): ?>
                            <div class="sold-out-overlay" style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); background:rgba(255,255,255,0.9); padding:5px 10px; border:2px solid #000; font-weight:bold;">DEPLETED</div>
                        <?php endif; ?>
                    </div>

                    <a href="product-details.php?id=<?= $product['id'] ?>" class="text-decoration-none text-dark">
                        <div class="product-title" style="<?= $is_sold_out ? 'opacity:0.5' : '' ?>">
                            <?= htmlspecialchars($product['name']) ?>
                        </div>
                    </a>
                    
                    <div class="product-price">$<?= number_format($product['price'], 2) ?></div>
                    
                    <?php if(!$is_sold_out): ?>
                        <div class="mt-2">
                            <?php foreach($colors as $i => $color): ?>
                                <span class="color-swatch <?= $i===0 ? 'selected' : '' ?>" 
                                      style="background: <?= strtolower($color) ?>;"
                                      title="<?= $color ?>"></span>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="mt-1">
                            <?php foreach($sizes as $i => $size): ?>
                                <button class="size-selector <?= $i===0 ? 'selected' : '' ?>"><?= $size ?></button>
                            <?php endforeach; ?>
                        </div>
                        
                        <button class="add-to-cart-btn" 
                                data-product-id="<?= $product['id'] ?>" 
                                data-product-name="<?= htmlspecialchars($product['name']) ?>" 
                                data-product-price="<?= $product['price'] ?>" 
                                data-product-image="<?= htmlspecialchars($product['image_url']) ?>">
                            Add to Cart
                        </button>
                    <?php else: ?>
                        <div class="mt-3">
                            <button class="btn btn-secondary w-100 btn-sm" disabled>Out of Stock</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<section class="feature-section">
    <div class="container">
        <div class="row g-0">
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2069&auto=format&fit=crop" class="feature-img" alt="FlexFit">
            </div>
            <div class="col-md-6 bg-light">
                <div class="feature-content">
                    <span class="feature-label">Perfect Stretch, Perfect Fit</span>
                    <h2 class="feature-title">Discover FlexFit Freedom</h2>
                    <p class="mb-4 text-muted">Introducing FlexFit: our breakthrough activewear material. It effortlessly adapts to your form for a tailor-made fit without the squeeze. Move with ease and style in every stride.</p>
                    <button class="btn btn-black shop-now" onclick="window.location.href='shop.php'">Shop Now</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mb-5">
    <h5 class="fw-bold text-uppercase mb-4">What Do Our Customers Say?</h5>
    <div class="row">
        <div class="col-md-4 testimonial-box">
            <div class="stars">★★★★★</div>
            <div class="testimonial-text">"Love these for the gym!"</div>
            <div class="testimonial-sub">Verified Buyer</div>
        </div>
        <div class="col-md-4 testimonial-box">
            <div class="stars">★★★★★</div>
            <div class="testimonial-text">"Sweat? No Problem!"</div>
            <div class="testimonial-sub">Verified Buyer</div>
        </div>
        <div class="col-md-4 testimonial-box">
            <div class="stars">★★★★★</div>
            <div class="testimonial-text">"Stylish and Functional"</div>
            <div class="testimonial-sub">Verified Buyer</div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<script>
    // Logic to toggle 'selected' class on homepage cards so Add To Cart works immediately
    document.addEventListener('click', function(e) {
        // Size Selector Click
        if (e.target.classList.contains('size-selector')) {
            const wrapper = e.target.parentElement;
            const buttons = wrapper.querySelectorAll('.size-selector');
            buttons.forEach(btn => btn.classList.remove('selected'));
            e.target.classList.add('selected');
        }

        // Color Swatch Click
        if (e.target.classList.contains('color-swatch')) {
            const wrapper = e.target.parentElement;
            const swatches = wrapper.querySelectorAll('.color-swatch');
            swatches.forEach(swatch => swatch.classList.remove('selected'));
            e.target.classList.add('selected');
        }
    });
</script>