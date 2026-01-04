<?php include 'header.php'; ?>    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Elegance In<br>Every Movement</h1>
                <p class="hero-subtitle">Where style meets your workout.</p>
                <div class="d-flex">
                    <button class="btn btn-light-custom shop-now">Shop Tops</button>
                    <button class="btn btn-outline-custom shop-now">Shop Bottoms</button>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Categories Section -->
    <section class="container">
        <h2 class="section-header">Shop The Essentials</h2>
        
        <!-- Desktop Grid (4 columns) -->
        <div class="row category-grid">
            <!-- Col 1 -->
            <div class="col-md-3">
                <div class="category-card shop-now">
                    <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=2070&auto=format&fit=crop" alt="Tops">
                    <div class="category-text">Tops</div>
                </div>
            </div>
            <!-- Col 2 -->
            <div class="col-md-3">
                <div class="category-card shop-now">
                    <img src="img/bottoms.jpg" alt="Bottoms">
                    <div class="category-text">Bottoms</div>
                </div>
            </div>
            <!-- Col 3 -->
            <div class="col-md-3">
                <div class="category-card shop-now">
                    <img src="img/bras.jpg" alt="Sports Bras">
                    <div class="category-text">Sports Bras</div>
                </div>
            </div>
            <!-- Col 4 -->
            <div class="col-md-3">
                <div class="category-card shop-now">
                    <img src="https://images.unsplash.com/photo-1623945419356-9d3298c4d29a?q=80&w=2070&auto=format&fit=crop" alt="Accessories">
                    <div class="category-text">Accessories</div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Slider -->
        <div class="categories-slider">
            <div class="categories-scroll-container" id="categories-scroll">
                <!-- Slide 1 -->
                <div class="category-slide">
                    <div class="category-card shop-now">
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=2070&auto=format&fit=crop" alt="Tops">
                        <div class="category-text">Tops</div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="category-slide">
                    <div class="category-card shop-now">
                        <img src="img/bottoms.jpg" alt="Bottoms">
                        <div class="category-text">Bottoms</div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="category-slide">
                    <div class="category-card shop-now">
                        <img src="img/bras.jpg" alt="Sports Bras">
                        <div class="category-text">Sports Bras</div>
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="category-slide">
                    <div class="category-card shop-now">
                        <img src="img/ass.jpg" alt="Accessories">
                        <div class="category-text">Accessories</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Hot Right Now Section -->
    <section class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-header mb-0 mt-5">Hot Right Now</h2>
            <a href="#" class="view-all-link" style="font-size: 0.8rem;">VIEW ALL ></a>
        </div>
        <div class="row">
            <!-- Product 1 -->
            <div class="col-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <span class="badge badge-custom badge-sale">Save $20</span>
                        <img src="img/leggings.jpg" alt="Leggings">
                    </div>
                    <div class="product-title">High-Waist Training Leggings</div>
                    <div class="product-price"><span class="old-price">$69.00</span> $49.00</div>
                    <div class="mt-2">
                        <span class="color-swatch selected" style="background: #000;"></span>
                        <span class="color-swatch" style="background: #555;"></span>
                    </div>
                    <div class="mt-1">
                        <button class="size-selector selected">XS</button>
                        <button class="size-selector">S</button>
                        <button class="size-selector">M</button>
                    </div>
                    <button class="add-to-cart-btn" data-product-id="1" data-product-name="High-Waist Training Leggings" data-product-price="49.00" data-product-image="https://images.unsplash.com/photo-1506619216599-9d939743f39d?q=80&w=2070&auto=format&fit=crop">Add to Cart</button>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="col-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <span class="badge badge-custom badge-popular">Popular</span>
                        <img src="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?q=80&w=2070&auto=format&fit=crop" alt="Bra">
                    </div>
                    <div class="product-title">Ribbed Performance Set</div>
                    <div class="product-price">$58.00</div>
                    <div class="mt-2">
                        <span class="color-swatch selected" style="background: #fff; border: 1px solid #ccc;"></span>
                        <span class="color-swatch" style="background: #000;"></span>
                    </div>
                    <div class="mt-1">
                        <button class="size-selector selected">XS</button>
                        <button class="size-selector">S</button>
                        <button class="size-selector">M</button>
                        <button class="size-selector">L</button>
                    </div>
                    <button class="add-to-cart-btn" data-product-id="2" data-product-name="Ribbed Performance Set" data-product-price="58.00" data-product-image="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?q=80&w=2070&auto=format&fit=crop">Add to Cart</button>
                </div>
            </div>
            <!-- Product 3 -->
            <div class="col-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <span class="badge badge-custom badge-popular">Popular</span>
                        <img src="https://images.unsplash.com/photo-1518310383802-640c2de311b2?q=80&w=2070&auto=format&fit=crop" alt="Tights">
                    </div>
                    <div class="product-title">High-Rise Athletic Tights</div>
                    <div class="product-price">$61.00</div>
                    <div class="mt-2">
                        <span class="color-swatch selected" style="background: #D2B48C;"></span>
                    </div>
                    <div class="mt-1">
                        <button class="size-selector selected">S</button>
                        <button class="size-selector">M</button>
                        <button class="size-selector">L</button>
                    </div>
                    <button class="add-to-cart-btn" data-product-id="3" data-product-name="High-Rise Athletic Tights" data-product-price="61.00" data-product-image="https://images.unsplash.com/photo-1518310383802-640c2de311b2?q=80&w=2070&auto=format&fit=crop">Add to Cart</button>
                </div>
            </div>
            <!-- Product 4 -->
            <div class="col-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <span class="badge badge-custom badge-new">New</span>
                        <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?q=80&w=2070&auto=format&fit=crop" alt="Bra">
                    </div>
                    <div class="product-title">Full-Support Sports Bra</div>
                    <div class="product-price">$42.00</div>
                    <div class="mt-2">
                        <span class="color-swatch selected" style="background: #ADD8E6;"></span>
                        <span class="color-swatch" style="background: #FFB6C1;"></span>
                    </div>
                    <div class="mt-1">
                        <button class="size-selector selected">XS</button>
                        <button class="size-selector">S</button>
                        <button class="size-selector">M</button>
                    </div>
                    <button class="add-to-cart-btn" data-product-id="4" data-product-name="Full-Support Sports Bra" data-product-price="42.00" data-product-image="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?q=80&w=2070&auto=format&fit=crop">Add to Cart</button>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Feature Section -->
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
                        <button class="btn btn-black shop-now">Shop Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Testimonials -->
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