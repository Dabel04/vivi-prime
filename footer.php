  <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Brand & Description -->
                <div class="col-lg-4 col-md-6 mb-5">
                    <a href="#" class="footer-brand">44:11</a>
                    <p class="footer-tagline">
                        Elevate your workout with premium activewear designed for performance and style. 
                        Experience the perfect blend of comfort, durability, and elegance in every piece.
                    </p>
                    <div class="newsletter-form">
                        <input type="email" class="newsletter-input" placeholder="Your email address">
                        <button type="submit" class="newsletter-btn">Subscribe</button>
                    </div>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-pinterest"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-5">
                    <h6 class="footer-title">Shop</h6>
                    <ul class="footer-links">
                        <li><a href="#">Tops</a></li>
                        <li><a href="#">Bottoms</a></li>
                        <li><a href="#">Sports Bras</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="#">Best Sellers</a></li>
                    </ul>
                </div>
                
                <!-- Support -->
                <div class="col-lg-2 col-md-6 mb-5">
                    <h6 class="footer-title">Support</h6>
                    <ul class="footer-links">
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Size Guide</a></li>
                        <li><a href="#">Care Instructions</a></li>
                    </ul>
                </div>
                
                <!-- Company -->
                <div class="col-lg-2 col-md-6 mb-5">
                    <h6 class="footer-title">Company</h6>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Sustainability</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Wholesale</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-2 col-md-6 mb-5">
                    <h6 class="footer-title">Contact</h6>
                    <ul class="footer-links">
                        <li><a href="mailto:hello@44eleven.com">hello@44eleven.com</a></li>
                        <li><a href="tel:+18005551234">1-800-555-1234</a></li>
                        <li>Mon-Fri: 9am-6pm EST</li>
                        <li>123 Active Street</li>
                        <li>New York, NY 10001</li>
                    </ul>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        &copy; 2024 44:11 Activewear. All rights reserved.
                    </div>
                    
                    <div class="footer-links-bottom">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Cookie Policy</a>
                        <a href="#">Accessibility</a>
                    </div>
                    
                    <div class="payment-methods">
                        <i class="bi bi-credit-card payment-icon"></i>
                        <i class="bi bi-paypal payment-icon"></i>
                        <i class="bi bi-google payment-icon"></i>
                        <i class="bi bi-apple payment-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Side Cart (Right Sliding Panel) -->
    <div class="side-cart-overlay" id="cart-overlay"></div>
    
    <div class="side-cart" id="side-cart">
        <div class="side-cart-header">
            <h3 class="side-cart-title">Your Shopping Cart</h3>
            <button class="side-cart-close" id="close-side-cart">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="side-cart-body">
            <div id="cart-items-container">
                <!-- Cart items will be dynamically added here -->
                <div class="text-center py-4" id="empty-cart-message">
                    <i class="bi bi-bag" style="font-size: 2rem; color: #ccc;"></i>
                    <p class="mt-2">Your cart is empty</p>
                </div>
            </div>
        </div>
        <div class="side-cart-footer">
            <div class="cart-total">
                <span>Total:</span>
                <span>$<span id="cart-total-price">0.00</span></span>
            </div>
            <div class="cart-actions">
                <button type="button" class="btn btn-outline-dark" id="continue-shopping">Continue Shopping</button>
                <button type="button" class="btn btn-dark" id="checkout-btn">Checkout</button>
            </div>
        </div>
    </div>
    
    <!-- Chat Widget -->
    <div class="chat-widget">
        <i class="bi bi-chat-dots-fill"></i>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Cart JavaScript -->
    <script>
        // Cart functionality
        class ShoppingCart {
            constructor() {
                this.cart = JSON.parse(localStorage.getItem('44eleven_cart')) || [];
                this.currentCurrency = localStorage.getItem('44eleven_currency') || 'USD';
                this.init();
            }
            
            init() {
                this.bindEvents();
                this.updateCartCount();
                this.updateCartModal();
                this.setupMobileSlider();
                this.setupDropdowns();
                this.updateCurrencyDisplay();
            }
            
            bindEvents() {
                // Add to Cart buttons
                document.addEventListener('click', (e) => {
                    if (e.target.classList.contains('add-to-cart-btn')) {
                        this.addToCart(e.target);
                    }
                    
                    // Shop Now buttons
                    if (e.target.classList.contains('shop-now') || e.target.closest('.shop-now')) {
                        this.handleShopNow(e);
                    }
                    
                    // Size selectors
                    if (e.target.classList.contains('size-selector')) {
                        this.selectSize(e.target);
                    }
                    
                    // Color swatches
                    if (e.target.classList.contains('color-swatch')) {
                        this.selectColor(e.target);
                    }
                    
                    // Remove item from cart
                    if (e.target.classList.contains('cart-item-remove') || e.target.closest('.cart-item-remove')) {
                        const button = e.target.classList.contains('cart-item-remove') ? 
                            e.target : e.target.closest('.cart-item-remove');
                        this.removeFromCart(button.dataset.itemId);
                    }
                });
                
                // Checkout button
                document.getElementById('checkout-btn').addEventListener('click', () => {
                    this.checkout();
                });
                
                // Continue shopping button
                document.getElementById('continue-shopping').addEventListener('click', () => {
                    this.closeSideCart();
                });
                
                // Open side cart buttons
                document.getElementById('open-side-cart').addEventListener('click', () => {
                    this.openSideCart();
                });
                
                document.getElementById('open-side-cart-desktop').addEventListener('click', () => {
                    this.openSideCart();
                });
                
                // Close side cart buttons
                document.getElementById('close-side-cart').addEventListener('click', () => {
                    this.closeSideCart();
                });
                
                document.getElementById('cart-overlay').addEventListener('click', () => {
                    this.closeSideCart();
                });
                
                // Search form submissions
                document.getElementById('desktop-search-form').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.handleSearch();
                });
                
                document.getElementById('mobile-search-form').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.handleMobileSearch();
                });
                
                // Newsletter subscription
                document.querySelector('.newsletter-btn').addEventListener('click', (e) => {
                    e.preventDefault();
                    this.handleNewsletter();
                });
            }
            
            setupDropdowns() {
                // Desktop search toggle
                document.getElementById('desktop-search-toggle').addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleDesktopSearch();
                });
                
                // Mobile search toggle
                document.getElementById('mobile-search-toggle').addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleMobileSearch();
                });
                
                // Desktop currency toggle
                document.getElementById('desktop-currency-toggle').addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleDesktopCurrency();
                });
                
                // Mobile currency toggle
                document.getElementById('mobile-currency-toggle').addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.showCurrencyModal();
                });
                
                // Currency selection
                document.querySelectorAll('.currency-item').forEach(item => {
                    item.addEventListener('click', (e) => {
                        const currency = e.target.dataset.currency;
                        this.setCurrency(currency);
                        this.closeAllDropdowns();
                    });
                });
                
                // Close dropdowns when clicking outside
                document.addEventListener('click', () => {
                    this.closeAllDropdowns();
                });
                
                // Prevent dropdown close when clicking inside
                document.querySelectorAll('.search-dropdown, .currency-dropdown').forEach(dropdown => {
                    dropdown.addEventListener('click', (e) => {
                        e.stopPropagation();
                    });
                });
            }
            
            toggleDesktopSearch() {
                const dropdown = document.getElementById('desktop-search-dropdown');
                const isActive = dropdown.classList.contains('active');
                
                this.closeAllDropdowns();
                
                if (!isActive) {
                    dropdown.classList.add('active');
                    document.getElementById('desktop-search-input').focus();
                }
            }
            
            toggleMobileSearch() {
                const dropdown = document.getElementById('mobile-search-dropdown');
                const isActive = dropdown.classList.contains('active');
                
                if (isActive) {
                    dropdown.classList.remove('active');
                } else {
                    dropdown.classList.add('active');
                    document.getElementById('mobile-search-input').focus();
                }
            }
            
            toggleDesktopCurrency() {
                const dropdown = document.getElementById('desktop-currency-dropdown');
                const isActive = dropdown.classList.contains('active');
                
                this.closeAllDropdowns();
                
                if (!isActive) {
                    dropdown.classList.add('active');
                }
            }
            
            showCurrencyModal() {
                const currencies = ['USD', 'EUR', 'GBP', 'CAD'];
                let modalContent = '<div class="text-center p-3">';
                modalContent += '<h6 class="mb-3">Select Currency</h6>';
                
                currencies.forEach(currency => {
                    const isActive = currency === this.currentCurrency;
                    const symbol = this.getCurrencySymbol(currency);
                    modalContent += `
                        <button class="btn ${isActive ? 'btn-dark' : 'btn-outline-dark'} w-100 mb-2 currency-modal-item" 
                                data-currency="${currency}">
                            ${currency} ${symbol}
                        </button>
                    `;
                });
                
                modalContent += '</div>';
                
                // Create modal
                const modal = document.createElement('div');
                modal.className = 'modal fade show d-block';
                modal.style.backgroundColor = 'rgba(0,0,0,0.5)';
                modal.innerHTML = `
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">Select Currency</h5>
                                <button type="button" class="btn-close" id="close-currency-modal"></button>
                            </div>
                            <div class="modal-body">
                                ${modalContent}
                            </div>
                        </div>
                    </div>
                `;
                
                document.body.appendChild(modal);
                document.body.style.overflow = 'hidden';
                
                // Add event listeners
                document.getElementById('close-currency-modal').addEventListener('click', () => {
                    this.closeCurrencyModal();
                });
                
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        this.closeCurrencyModal();
                    }
                });
                
                document.querySelectorAll('.currency-modal-item').forEach(item => {
                    item.addEventListener('click', (e) => {
                        const currency = e.target.dataset.currency;
                        this.setCurrency(currency);
                        this.closeCurrencyModal();
                    });
                });
            }
            
            closeCurrencyModal() {
                const modal = document.querySelector('.modal.show');
                if (modal) {
                    modal.remove();
                    document.body.style.overflow = '';
                }
            }
            
            closeAllDropdowns() {
                document.querySelectorAll('.search-dropdown.active, .currency-dropdown.active').forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
                
                document.getElementById('mobile-search-dropdown').classList.remove('active');
            }
            
            setCurrency(currency) {
                this.currentCurrency = currency;
                localStorage.setItem('44eleven_currency', currency);
                this.updateCurrencyDisplay();
                
                // Update active state in dropdown
                document.querySelectorAll('.currency-item').forEach(item => {
                    if (item.dataset.currency === currency) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
            }
            
            updateCurrencyDisplay() {
                const symbol = this.getCurrencySymbol(this.currentCurrency);
                const displayText = `${this.currentCurrency} ${symbol}`;
                
                document.getElementById('desktop-currency-text').textContent = displayText;
                document.getElementById('mobile-currency-text').textContent = displayText;
            }
            
            getCurrencySymbol(currency) {
                const symbols = {
                    'USD': '$',
                    'EUR': '€',
                    'GBP': '£',
                    'CAD': '$'
                };
                return symbols[currency] || '$';
            }
            
            handleSearch() {
                const query = document.getElementById('desktop-search-input').value.trim();
                if (query) {
                    alert(`Searching for: ${query}`);
                    // In real implementation, redirect to search results page
                    // window.location.href = `/search?q=${encodeURIComponent(query)}`;
                    this.closeAllDropdowns();
                }
            }
            
            handleMobileSearch() {
                const query = document.getElementById('mobile-search-input').value.trim();
                if (query) {
                    alert(`Searching for: ${query}`);
                    // In real implementation, redirect to search results page
                    // window.location.href = `/search?q=${encodeURIComponent(query)}`;
                    this.toggleMobileSearch();
                }
            }
            
            handleNewsletter() {
                const email = document.querySelector('.newsletter-input').value.trim();
                if (email && this.validateEmail(email)) {
                    alert(`Thank you for subscribing with ${email}!`);
                    document.querySelector('.newsletter-input').value = '';
                } else {
                    alert('Please enter a valid email address.');
                }
            }
            
            validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
            
            setupMobileSlider() {
                const scrollContainer = document.getElementById('categories-scroll');
                if (scrollContainer) {
                    let isDown = false;
                    let startX;
                    let scrollLeft;
                    
                    scrollContainer.addEventListener('mousedown', (e) => {
                        isDown = true;
                        startX = e.pageX - scrollContainer.offsetLeft;
                        scrollLeft = scrollContainer.scrollLeft;
                        scrollContainer.style.cursor = 'grabbing';
                    });
                    
                    scrollContainer.addEventListener('mouseleave', () => {
                        isDown = false;
                        scrollContainer.style.cursor = 'grab';
                    });
                    
                    scrollContainer.addEventListener('mouseup', () => {
                        isDown = false;
                        scrollContainer.style.cursor = 'grab';
                    });
                    
                    scrollContainer.addEventListener('mousemove', (e) => {
                        if (!isDown) return;
                        e.preventDefault();
                        const x = e.pageX - scrollContainer.offsetLeft;
                        const walk = (x - startX) * 2;
                        scrollContainer.scrollLeft = scrollLeft - walk;
                    });
                    
                    scrollContainer.addEventListener('touchstart', (e) => {
                        startX = e.touches[0].pageX - scrollContainer.offsetLeft;
                        scrollLeft = scrollContainer.scrollLeft;
                    });
                    
                    scrollContainer.addEventListener('touchmove', (e) => {
                        e.preventDefault();
                        const x = e.touches[0].pageX - scrollContainer.offsetLeft;
                        const walk = (x - startX) * 2;
                        scrollContainer.scrollLeft = scrollLeft - walk;
                    });
                }
            }
            
            openSideCart() {
                document.getElementById('side-cart').classList.add('active');
                document.getElementById('cart-overlay').classList.add('active');
                document.body.style.overflow = 'hidden';
                this.closeAllDropdowns();
            }
            
            closeSideCart() {
                document.getElementById('side-cart').classList.remove('active');
                document.getElementById('cart-overlay').classList.remove('active');
                document.body.style.overflow = '';
            }
            
            addToCart(button) {
                const productId = button.dataset.productId;
                const productName = button.dataset.productName;
                const productPrice = parseFloat(button.dataset.productPrice);
                const productImage = button.dataset.productImage;
                
                const productCard = button.closest('.product-card');
                const selectedSize = productCard.querySelector('.size-selector.selected').textContent;
                const selectedColor = productCard.querySelector('.color-swatch.selected').style.backgroundColor;
                
                const item = {
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    size: selectedSize,
                    color: selectedColor,
                    quantity: 1
                };
                
                const existingItemIndex = this.cart.findIndex(cartItem => 
                    cartItem.id === item.id && 
                    cartItem.size === item.size && 
                    cartItem.color === item.color
                );
                
                if (existingItemIndex > -1) {
                    this.cart[existingItemIndex].quantity++;
                } else {
                    this.cart.push(item);
                }
                
                this.saveCart();
                this.updateCartCount();
                this.updateCartModal();
                this.showAddedFeedback(button);
                this.openSideCart();
            }
            
            removeFromCart(itemId) {
                this.cart.splice(itemId, 1);
                this.saveCart();
                this.updateCartCount();
                this.updateCartModal();
            }
            
            saveCart() {
                localStorage.setItem('44eleven_cart', JSON.stringify(this.cart));
            }
            
            updateCartCount() {
                const totalItems = this.cart.reduce((total, item) => total + item.quantity, 0);
                document.getElementById('cart-count-mobile').textContent = totalItems;
                document.getElementById('cart-count-desktop').textContent = totalItems;
            }
            
            updateCartModal() {
                const container = document.getElementById('cart-items-container');
                const totalPrice = this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
                
                document.getElementById('cart-total-price').textContent = totalPrice.toFixed(2);
                
                if (this.cart.length === 0) {
                    container.innerHTML = `
                        <div class="text-center py-4" id="empty-cart-message">
                            <i class="bi bi-bag" style="font-size: 2rem; color: #ccc;"></i>
                            <p class="mt-2">Your cart is empty</p>
                        </div>
                    `;
                    return;
                }
                
                const emptyMessage = document.getElementById('empty-cart-message');
                if (emptyMessage) {
                    emptyMessage.remove();
                }
                
                let cartHTML = '';
                this.cart.forEach((item, index) => {
                    cartHTML += `
                        <div class="cart-item">
                            <img src="${item.image}" class="cart-item-img" alt="${item.name}">
                            <div class="cart-item-details">
                                <div class="cart-item-title">${item.name}</div>
                                <div class="cart-item-price">$${item.price.toFixed(2)} × ${item.quantity}</div>
                                <div class="small text-muted">Size: ${item.size} | Color: <span class="d-inline-block" style="width: 12px; height: 12px; border-radius: 50%; background-color: ${item.color};"></span></div>
                            </div>
                            <button class="cart-item-remove" data-item-id="${index}">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    `;
                });
                
                container.innerHTML = cartHTML;
            }
            
            selectSize(button) {
                const productCard = button.closest('.product-card');
                productCard.querySelectorAll('.size-selector').forEach(btn => {
                    btn.classList.remove('selected');
                });
                button.classList.add('selected');
            }
            
            selectColor(swatch) {
                const productCard = swatch.closest('.product-card');
                productCard.querySelectorAll('.color-swatch').forEach(s => {
                    s.classList.remove('selected');
                });
                swatch.classList.add('selected');
            }
            
            handleShopNow(e) {
                e.preventDefault();
                alert('Redirecting to shop page...');
            }
            
            showAddedFeedback(button) {
                const originalText = button.textContent;
                button.textContent = 'Added to Cart!';
                button.classList.add('added');
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('added');
                }, 1500);
            }
            
            checkout() {
                if (this.cart.length === 0) {
                    alert('Your cart is empty!');
                    return;
                }
                
                alert(`Proceeding to checkout with ${this.cart.length} item(s). Total: $${this.cart.reduce((total, item) => total + (item.price * item.quantity), 0).toFixed(2)}`);
                this.closeSideCart();
            }
        }
        
        // Initialize cart when page loads
        document.addEventListener('DOMContentLoaded', () => {
            window.cart = new ShoppingCart();
        });
    </script>
</body>
</html>