<?php
require_once 'db_connect.php';
$db = new Database();
$conn = $db->connect();

// INCLUDE HEADER (Starts Session)
include 'header.php';

// --- DEV BYPASS: SIMULATE LOGIN (Remove this when Login system is active) ---
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; // Assumes a user with ID 1 exists
    $_SESSION['user_name'] = "Kenton Client";
    $_SESSION['user_email'] = "kenton@44eleven.com";
}
// --------------------------------------------------------------------------

$user_id = $_SESSION['user_id'];

// 1. FETCH USER STATS
$stmt = $conn->prepare("SELECT COUNT(*) as order_count, SUM(total_amount) as total_spent FROM orders WHERE user_id = ?");
$stmt->execute([$user_id]);
$stats = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. FETCH RECENT ORDERS
$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-5">
    <div class="row g-5">
        
        <div class="col-lg-3">
            <div class="user-sidebar sticky-top" style="top: 100px;">
                <div class="user-info mb-4">
                    <h5 class="fw-black text-uppercase mb-0"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Operator') ?></h5>
                    <p class="text-muted font-mono small">ID: #44-<?= str_pad($user_id, 4, '0', STR_PAD_LEFT) ?></p>
                </div>
                
                <div class="nav flex-column user-nav">
                    <a href="user-dashboard.php" class="nav-link active"><i class="bi bi-grid-fill me-2"></i> COMMAND CENTER</a>
                    <a href="user-profile.php" class="nav-link"><i class="bi bi-person-gear me-2"></i> IDENTITY PROTOCOL</a>
                    <a href="#" class="nav-link"><i class="bi bi-credit-card me-2"></i> PAYMENT METHODS</a>
                    <a href="logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-right me-2"></i> DISCONNECT</a>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <h4 class="fw-black text-uppercase mb-4">Logistics Overview</h4>

            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="stat-card">
                        <div class="stat-label">TOTAL ACQUISITIONS</div>
                        <div class="stat-value"><?= number_format($stats['order_count']) ?></div>
                        <div class="stat-icon"><i class="bi bi-bag-check"></i></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <div class="stat-label">LIFETIME VALUE</div>
                        <div class="stat-value">$<?= number_format($stats['total_spent'] ?? 0, 2) ?></div>
                        <div class="stat-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    </div>
                </div>
            </div>

            <h5 class="fw-bold text-uppercase mb-3">Recent Deployments</h5>
            <div class="card border-0 shadow-sm rounded-0">
                <?php if(empty($orders)): ?>
                    <div class="p-5 text-center text-muted font-mono">
                        NO ACTIVE DEPLOYMENTS FOUND.
                        <br><br>
                        <a href="shop.php" class="btn btn-dark btn-sm rounded-0">INITIATE ORDER</a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="font-mono small fw-bold py-3 ps-4">ORDER ID</th>
                                    <th class="font-mono small fw-bold py-3">DATE</th>
                                    <th class="font-mono small fw-bold py-3">STATUS</th>
                                    <th class="font-mono small fw-bold py-3">TOTAL</th>
                                    <th class="font-mono small fw-bold py-3 pe-4 text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orders as $order): ?>
                                <tr>
                                    <td class="ps-4 font-mono fw-bold">#<?= $order['id'] ?></td>
                                    <td class="font-mono small text-muted"><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                                    <td>
                                        <?php 
                                            $statusClass = match($order['status']) {
                                                'completed' => 'bg-success',
                                                'pending' => 'bg-warning text-dark',
                                                'delayed' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                        ?>
                                        <span class="badge <?= $statusClass ?> rounded-0 font-mono" style="font-weight: 500; letter-spacing: 1px;">
                                            <?= strtoupper($order['status']) ?>
                                        </span>
                                    </td>
                                    <td class="font-mono fw-bold">$<?= number_format($order['total_amount'], 2) ?></td>
                                    <td class="pe-4 text-end">
                                        <a href="order-details.php?id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-dark rounded-0 font-mono fw-bold">VIEW INTEL</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    /* PAGE SPECIFIC STYLES */
    .user-sidebar { background: #fff; padding: 30px; border: 1px solid #eee; }
    .user-nav .nav-link { 
        color: #666; padding: 12px 0; font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; border-bottom: 1px solid #f9f9f9; 
        transition: 0.3s;
    }
    .user-nav .nav-link:hover, .user-nav .nav-link.active { color: #000; padding-left: 10px; font-weight: 700; border-left: 2px solid #d7263d; }
    
    .stat-card { background: #000; color: white; padding: 25px; position: relative; overflow: hidden; height: 100%; }
    .stat-label { font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; color: #888; margin-bottom: 10px; }
    .stat-value { font-family: 'Montserrat', sans-serif; font-weight: 900; font-size: 2.5rem; line-height: 1; }
    .stat-icon { position: absolute; right: 20px; bottom: 20px; font-size: 3rem; color: #222; transform: rotate(-10deg); }
    
    .table th { border-bottom: 2px solid #000; }
    .table td { padding-top: 15px; padding-bottom: 15px; }
</style>

<?php include 'footer.php'; ?>