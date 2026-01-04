<?php include 'header.php'; ?>

<main class="container py-5" style="margin-top: 50px;">
    <div class="row g-5">
        <div class="col-lg-7">
            <h2 class="section-header mb-4">Checkout</h2>
            
            <form id="checkout-form" class="needs-validation" novalidate>
                <div class="mb-5">
                    <h6 class="fw-bold text-uppercase small mb-3 border-bottom pb-2">Contact Information</h6>
                    <div class="mb-3">
                        <input type="email" class="form-control rounded-0 border-dark" placeholder="Email Address" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="newsletter">
                        <label class="form-check-label small" for="newsletter">Email me with 44:11 performance updates</label>
                    </div>
                </div>

                <div class="mb-5">
                    <h6 class="fw-bold text-uppercase small mb-3 border-bottom pb-2">Shipping Address</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control rounded-0 border-dark" placeholder="First Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control rounded-0 border-dark" placeholder="Last Name" required>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control rounded-0 border-dark" placeholder="Address" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control rounded-0 border-dark" placeholder="City" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control rounded-0 border-dark" placeholder="Postal Code" required>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select rounded-0 border-dark">
                                <option selected>United States</option>
                                <option>United Kingdom</option>
                                <option>Nigeria</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h6 class="fw-bold text-uppercase small mb-3 border-bottom pb-2">Payment Details</h6>
                    <div class="bg-light p-3 border">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment" id="card" checked>
                            <label class="form-check-label fw-bold" for="card">Credit/Debit Card</label>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" class="form-control rounded-0" placeholder="Card Number">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control rounded-0" placeholder="MM/YY">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control rounded-0" placeholder="CVV">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark w-100 py-3 rounded-0 fw-bold text-uppercase">Complete Order</button>
            </form>
        </div>

        <div class="col-lg-5">
            <div class="order-summary-box p-4 bg-light sticky-top" style="top: 100px;">
                <h6 class="fw-bold text-uppercase small mb-4 border-bottom pb-2">Order Summary</h6>
                
                <div id="checkout-items-list">
                    </div>

                <div class="mt-4 pt-4 border-top">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small">Subtotal</span>
                        <span class="fw-bold">$<span id="summary-subtotal">0.00</span></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small">Shipping</span>
                        <span class="text-success small fw-bold">FREE</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3 h5 fw-900 border-top pt-3">
                        <span>Total</span>
                        <span>$<span id="summary-total">0.00</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const cartData = JSON.parse(localStorage.getItem('44eleven_cart')) || [];
    const container = document.getElementById('checkout-items-list');
    let total = 0;

    if (cartData.length === 0) {
        window.location.href = 'shop.php'; // Stress-test: Redirect if empty
    }

    cartData.forEach(item => {
        total += item.price * item.quantity;
        container.innerHTML += `
            <div class="d-flex align-items-center mb-3">
                <div class="position-relative me-3">
                    <img src="${item.image}" width="60" height="80" class="object-fit-cover rounded border">
                    <span class="badge bg-dark rounded-circle position-absolute top-0 start-100 translate-middle" style="font-size: 0.6rem;">${item.quantity}</span>
                </div>
                <div class="flex-grow-1">
                    <div class="small fw-bold">${item.name}</div>
                    <div class="x-small text-muted">Size: ${item.size}</div>
                </div>
                <div class="small fw-bold">$${(item.price * item.quantity).toFixed(2)}</div>
            </div>
        `;
    });

    document.getElementById('summary-subtotal').textContent = total.toFixed(2);
    document.getElementById('summary-total').textContent = total.toFixed(2);
});
</script>

<style>
    .fw-900 { font-weight: 900; }
    .x-small { font-size: 0.75rem; }
    .object-fit-cover { object-fit: cover; }
    .order-summary-box { border: 1px solid var(--border-light); }
    .form-control:focus { border-color: #000; box-shadow: none; }
</style>

<?php include 'footer.php'; ?>