<?php
require_once 'db_connect.php';
$db = new Database();
$conn = $db->connect();

include 'header.php';

// --- DEV BYPASS: Auto-Login for Testing ---
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = "Sim User";
    $_SESSION['user_email'] = "sim@test.com";
}
// ------------------------------------------

$user_id = $_SESSION['user_id'];

// HANDLE ORDER SUBMISSION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if ($data) {
        try {
            // 1. Create Order Record
            $total = $data['total'];
            $status = 'pending'; // Default status
            
            $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $total, $status]);
            $order_id = $conn->lastInsertId();

            // 2. Insert Order Items
            $stmtItem = $conn->prepare("INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
            
            // 3. Update Inventory (Deduct Stock)
            $stmtStock = $conn->prepare("UPDATE products SET stock = stock - ? WHERE name = ?");

            foreach ($data['items'] as $item) {
                // Add to order_items
                $stmtItem->execute([$order_id, $item['name'], $item['quantity'], $item['price']]);
                
                // Deduct from inventory
                $stmtStock->execute([$item['quantity'], $item['name']]);
            }

            // 4. Log Activity
            $logStmt = $conn->prepare("INSERT INTO activity_logs (message, type) VALUES (?, 'order')");
            $logStmt->execute(["New Order #$order_id confirmed ($$total)"]);

            // 5. Success Response
            echo json_encode(['success' => true, 'order_id' => $order_id]);
            exit;

        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            exit;
        }
    }
}
?>

<div class="container py-5">
    <div class="row g-5">
        
        <div class="col-lg-7">
            <div class="checkout-section mb-5">
                <h4 class="section-title">SHIPPING PROTOCOL</h4>
                <form id="checkoutForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="input-label">FULL NAME</label>
                            <input type="text" class="form-control theme-input" value="<?= htmlspecialchars($_SESSION['user_name']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="input-label">CONTACT EMAIL</label>
                            <input type="email" class="form-control theme-input" value="<?= htmlspecialchars($_SESSION['user_email']) ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="input-label">STREET ADDRESS</label>
                            <input type="text" class="form-control theme-input" placeholder="123 Active Blvd" required>
                        </div>
                        <div class="col-md-5">
                            <label class="input-label">CITY / SECTOR</label>
                            <input type="text" class="form-control theme-input" placeholder="New York" required>
                        </div>
                        <div class="col-md-4">
                            <label class="input-label">REGION / STATE</label>
                            <select class="form-select theme-input" required>
                                <option value="">SELECT...</option>
                                <option value="NY">NY</option>
                                <option value="CA">CA</option>
                                <option value="TX">TX</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="input-label">ZIP CODE</label>
                            <input type="text" class="form-control theme-input" placeholder="10001" required>
                        </div>
                    </div>
                </form>
            </div>

            <div class="checkout-section">
                <h4 class="section-title">PAYMENT AUTHORIZATION</h4>
                <div class="p-4 border border-1 bg-light">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="cc" checked>
                        <label class="form-check-label font-mono fw-bold" for="cc">CREDIT CARD</label>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <input type="text" class="form-control theme-input" placeholder="0000 0000 0000 0000">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control theme-input" placeholder="MM / YY">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control theme-input" placeholder="CVC">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="sticky-top" style="top: 100px;">
                <div class="bg-black text-white p-4">
                    <h4 class="font-mono fw-bold mb-4">DEPLOYMENT MANIFEST</h4>
                    
                    <div id="checkoutCartItems" class="mb-4">
                        <div class="text-center text-muted font-mono small py-3">SCANNING CART DATA...</div>
                    </div>

                    <div class="border-top border-secondary pt-3 mt-3">
                        <div class="d-flex justify-content-between font-mono mb-2 text-secondary small">
                            <span>SUBTOTAL</span>
                            <span id="summarySubtotal">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between font-mono mb-3 text-secondary small">
                            <span>SHIPPING</span>
                            <span>FREE</span>
                        </div>
                        <div class="d-flex justify-content-between font-mono fw-bold fs-5">
                            <span>TOTAL</span>
                            <span id="summaryTotal" class="text-danger">$0.00</span>
                        </div>
                    </div>

                    <button type="button" class="btn btn-light w-100 mt-4 rounded-0 py-3 fw-bold font-mono text-uppercase" onclick="processOrder()">
                        CONFIRM & DEPLOY ORDER
                    </button>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted font-mono" style="font-size: 0.65rem;">
                            SECURE ENCRYPTED TRANSMISSION // 256-BIT SSL
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .section-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -1px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #000;
    }

    .input-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 8px;
        display: block;
    }

    .theme-input {
        border-radius: 0;
        border: 1px solid #ccc;
        padding: 12px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.85rem;
    }
    .theme-input:focus {
        border-color: #000;
        box-shadow: none;
        background-color: #f9f9f9;
    }

    .checkout-item {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #333;
        padding-bottom: 15px;
    }
    .checkout-item-img {
        width: 60px;
        height: 70px;
        object-fit: cover;
        background: #333;
    }
</style>

<script>
    // 1. LOAD CART ON INIT
    document.addEventListener('DOMContentLoaded', () => {
        loadCheckoutSummary();
    });

    function loadCheckoutSummary() {
        const cart = JSON.parse(localStorage.getItem('vivi_cart')) || [];
        const container = document.getElementById('checkoutCartItems');
        
        if(cart.length === 0) {
            container.innerHTML = '<div class="font-mono text-center text-secondary">NO ASSETS DETECTED</div>';
            document.getElementById('summarySubtotal').innerText = '$0.00';
            document.getElementById('summaryTotal').innerText = '$0.00';
            return;
        }

        let html = '';
        let total = 0;

        cart.forEach(item => {
            const itemTotal = parseFloat(item.price) * parseInt(item.quantity);
            total += itemTotal;
            
            html += `
            <div class="checkout-item">
                <img src="${item.image}" class="checkout-item-img">
                <div class="flex-grow-1">
                    <div class="font-mono fw-bold small text-uppercase">${item.name}</div>
                    <div class="font-mono x-small text-secondary">
                        SIZE: ${item.size} / COLOR: ${item.color}
                    </div>
                    <div class="font-mono x-small mt-1">
                        QTY: ${item.quantity} x $${parseFloat(item.price).toFixed(2)}
                    </div>
                </div>
                <div class="font-mono fw-bold small">
                    $${itemTotal.toFixed(2)}
                </div>
            </div>
            `;
        });

        container.innerHTML = html;
        document.getElementById('summarySubtotal').innerText = '$' + total.toFixed(2);
        document.getElementById('summaryTotal').innerText = '$' + total.toFixed(2);
    }

    // 2. PROCESS ORDER (SEND TO PHP)
    function processOrder() {
        const cart = JSON.parse(localStorage.getItem('vivi_cart')) || [];
        
        if(cart.length === 0) {
            alert("SYSTEM ALERT: CART IS EMPTY.");
            return;
        }

        // Calculate Total
        const total = cart.reduce((sum, item) => sum + (parseFloat(item.price) * parseInt(item.quantity)), 0);

        // Prepare Data Payload
        const payload = {
            items: cart,
            total: total
        };

        // Send to Backend
        fetch('checkout.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // CLEAR CART & REDIRECT
                localStorage.removeItem('vivi_cart');
                alert("ORDER DEPLOYED SUCCESSFULLY. REFERENCE ID: #" + data.order_id);
                window.location.href = 'user-dashboard.php';
            } else {
                alert("DEPLOYMENT FAILED: " + (data.error || "Unknown Error"));
            }
        })
        .catch(err => {
            console.error(err);
            alert("SYSTEM ERROR: CONNECTION FAILED.");
        });
    }
</script>

<?php include 'footer.php'; ?>