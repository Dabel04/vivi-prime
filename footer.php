<footer class="footer">
        <div class="container">
            <div class="row">
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
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-5">
                    <h6 class="footer-title">Shop</h6>
                    <ul class="footer-links">
                        <li><a href="shop.php?category=Tops">Tops</a></li>
                        <li><a href="shop.php?category=Bottoms">Bottoms</a></li>
                        <li><a href="shop.php?category=Accessories">Accessories</a></li>
                        <li><a href="shop.php?sort=newest">New Arrivals</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-5">
                    <h6 class="footer-title">Support</h6>
                    <ul class="footer-links">
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="delivery.php">Shipping & Delivery</a></li>
                        <li><a href="#">Returns</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-5">
                    <h6 class="footer-title">Contact</h6>
                    <ul class="footer-links">
                        <li><a href="mailto:hello@44eleven.com">hello@44eleven.com</a></li>
                        <li>Mon-Fri: 9am-6pm EST</li>
                        <li>New York, NY 10001</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="copyright">&copy; 2026 44:11 Activewear. All rights reserved.</div>
                    <div class="payment-methods">
                        <i class="bi bi-credit-card payment-icon"></i>
                        <i class="bi bi-paypal payment-icon"></i>
                        <i class="bi bi-apple payment-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <div class="side-cart-overlay" id="cart-overlay"></div>
    
    <div class="side-cart" id="side-cart">
        <div class="side-cart-header">
            <h3 class="side-cart-title">Your Cart</h3>
            <button class="side-cart-close" id="close-side-cart"><i class="bi bi-x"></i></button>
        </div>
        <div class="side-cart-body">
            <div id="cart-items-container">
                </div>
        </div>
        <div class="side-cart-footer">
            <div class="cart-total">
                <span>Total:</span>
                <span>$<span id="cart-total-price">0.00</span></span>
            </div>
            <div class="cart-actions">
                <button type="button" class="btn btn-outline-dark" id="continue-shopping">Continue Shopping</button>
                <button type="button" class="btn btn-dark checkout-btn" id="checkout-btn">Checkout</button>
            </div>
        </div>
    </div>
    
    <div class="chat-widget"><i class="bi bi-chat-dots-fill"></i></div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        class ShoppingCart {
            constructor() {
                // CHANGED: Unified storage key to 'vivi_cart' to match shop.php
                this.cart = JSON.parse(localStorage.getItem('vivi_cart')) || [];
                this.init();
            }
            
            init() {
                this.bindEvents();
                this.updateCartCount();
                this.updateCartModal();
            }
            
            bindEvents() {
                // Open/Close Cart
                document.getElementById('open-side-cart')?.addEventListener('click', () => this.openSideCart());
                document.getElementById('open-side-cart-desktop')?.addEventListener('click', () => this.openSideCart());
                document.getElementById('close-side-cart')?.addEventListener('click', () => this.closeSideCart());
                document.getElementById('cart-overlay')?.addEventListener('click', () => this.closeSideCart());
                document.getElementById('continue-shopping')?.addEventListener('click', () => this.closeSideCart());
                
                // Remove Item
                document.addEventListener('click', (e) => {
                    if (e.target.closest('.cart-item-remove')) {
                        const idx = e.target.closest('.cart-item-remove').dataset.itemId;
                        this.removeFromCart(idx);
                    }
                });

                // Checkout
                document.getElementById('checkout-btn')?.addEventListener('click', () => {
                    if(this.cart.length === 0) return alert("Cart is empty");
                    window.location.href = 'checkout.php'; 
                });
            }
            
            openSideCart() {
                this.refresh(); // Refresh data before opening
                document.getElementById('side-cart').classList.add('active');
                document.getElementById('cart-overlay').classList.add('active');
                document.body.style.overflow = 'hidden';
            }
            
            closeSideCart() {
                document.getElementById('side-cart').classList.remove('active');
                document.getElementById('cart-overlay').classList.remove('active');
                document.body.style.overflow = '';
            }

            // Called by other pages when they add items
            refresh() {
                this.cart = JSON.parse(localStorage.getItem('vivi_cart')) || [];
                this.updateCartCount();
                this.updateCartModal();
            }
            
            removeFromCart(index) {
                this.cart.splice(index, 1);
                localStorage.setItem('vivi_cart', JSON.stringify(this.cart));
                this.refresh();
            }
            
            updateCartCount() {
                const total = this.cart.reduce((sum, item) => sum + parseInt(item.quantity), 0);
                document.querySelectorAll('.cart-count').forEach(el => el.textContent = total);
            }
            
            updateCartModal() {
                const container = document.getElementById('cart-items-container');
                const total = this.cart.reduce((sum, item) => sum + (parseFloat(item.price) * parseInt(item.quantity)), 0);
                document.getElementById('cart-total-price').textContent = total.toFixed(2);
                
                if (this.cart.length === 0) {
                    container.innerHTML = `<div class="text-center py-5"><i class="bi bi-bag fs-1 text-secondary"></i><p class="mt-2 text-muted">Your cart is empty</p></div>`;
                    return;
                }
                
                container.innerHTML = this.cart.map((item, i) => `
                    <div class="cart-item">
                        <img src="${item.image}" class="cart-item-img">
                        <div class="cart-item-details">
                            <div class="cart-item-title">${item.name}</div>
                            <div class="cart-item-price">$${parseFloat(item.price).toFixed(2)} x ${item.quantity}</div>
                            <div class="small text-muted">Size: ${item.size} | Color: ${item.color}</div>
                        </div>
                        <button class="cart-item-remove" data-item-id="${i}"><i class="bi bi-x"></i></button>
                    </div>
                `).join('');
            }
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            window.cart = new ShoppingCart();
        });

        // GLOBAL HELPER: Open cart automatically when an item is added
        document.addEventListener('click', (e) => {
            if(e.target.classList.contains('add-to-cart-btn')) {
                setTimeout(() => {
                    if(window.cart) window.cart.openSideCart(); 
                }, 100);
            }
        });
    </script>

    <script>
    // 1. Initialize Session
    fetch('track.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ action: 'init' }) });

    // 2. Track "Add to Cart"
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('add-to-cart-btn')) {
            fetch('track.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ action: 'add_to_cart' }) });
            console.log('// SIGNAL: CART_UPDATE SENT');
        }
    });

    // 3. Track "Checkout"
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('checkout-btn')) {
            fetch('track.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ action: 'checkout_start' }) });
            console.log('// SIGNAL: CHECKOUT_INIT SENT');
        }
    });
    </script>
</body>
</html>