<?php
require_once 'db_connect.php';
$db = new Database();
$conn = $db->connect();

include 'header.php';

// --- SECURITY PROTOCOL ---
// 1. Check Login
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='index.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$order_id = $_GET['id'] ?? 0;

// 2. Fetch Order (AND verify it belongs to this user)
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
$stmt->execute([$order_id, $user_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    echo "<div class='container py-5 text-center font-mono'><h3>ACCESS DENIED // INVALID ORDER ID</h3><a href='user-dashboard.php' class='btn btn-dark mt-3'>RETURN TO BASE</a></div>";
    include 'footer.php';
    exit;
}

// 3. Fetch Items
$stmtItems = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmtItems->execute([$order_id]);
$items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="d-flex justify-content-between align-items-end mb-4 pb-3 border-bottom border-2 border-dark">
                <div>
                    <div class="font-mono text-muted small mb-1">DEPLOYMENT ID</div>
                    <h2 class="fw-black m-0">#44-<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></h2>
                </div>
                <div class="text-end">
                    <div class="font-mono text-muted small mb-1">DATE</div>
                    <div class="fw-bold font-mono"><?= date('d M Y // H:i', strtotime($order['created_at'])) ?></div>
                </div>
            </div>

            <div class="bg-light p-4 mb-5 border border-1 border-secondary">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <span class="font-mono small fw-bold d-block mb-2 text-muted">CURRENT STATUS</span>
                        <?php 
                            $statusColor = match($order['status']) {
                                'completed' => 'text-success',
                                'pending' => 'text-warning',
                                'shipped' => 'text-primary',
                                'cancelled' => 'text-danger',
                                default => 'text-dark'
                            };
                            $statusIcon = match($order['status']) {
                                'completed' => 'bi-check-circle-fill',
                                'pending' => 'bi-hourglass-split',
                                'shipped' => 'bi-truck',
                                'cancelled' => 'bi-x-circle-fill',
                                default => 'bi-circle'
                            };
                        ?>
                        <h3 class="text-uppercase fw-black mb-0 <?= $statusColor ?>">
                            <i class="bi <?= $statusIcon ?> me-2"></i> <?= $order['status'] ?>
                        </h3>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <button onclick="window.print()" class="btn btn-outline-dark rounded-0 font-mono fw-bold btn-sm">
                            <i class="bi bi-printer me-2"></i> PRINT MANIFEST
                        </button>
                    </div>
                </div>
            </div>

            <h5 class="fw-bold text-uppercase mb-3">Asset Manifest</h5>
            <div class="table-responsive mb-5">
                <table class="table table-bordered border-dark mb-0">
                    <thead class="bg-black text-white">
                        <tr>
                            <th class="font-mono py-3 ps-3">ITEM DESCRIPTION</th>
                            <th class="font-mono py-3 text-center">QTY</th>
                            <th class="font-mono py-3 text-end pe-3">VALUE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($items as $item): ?>
                        <tr>
                            <td class="ps-3 py-3">
                                <div class="fw-bold text-uppercase"><?= htmlspecialchars($item['product_name']) ?></div>
                                </td>
                            <td class="text-center py-3 font-mono"><?= $item['quantity'] ?></td>
                            <td class="text-end py-3 pe-3 font-mono fw-bold">$<?= number_format($item['price'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="bg-light">
                        <tr>
                            <td colspan="2" class="text-end py-3 pe-3 font-mono fw-bold">TOTAL DEPLOYMENT COST</td>
                            <td class="text-end py-3 pe-3 font-mono fw-black fs-5">$<?= number_format($order['total_amount'], 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between">
                <a href="user-dashboard.php" class="btn btn-link text-dark font-mono text-decoration-none px-0">
                    <i class="bi bi-arrow-left me-2"></i> RETURN TO COMMAND
                </a>
                <a href="contact.html" class="btn btn-dark rounded-0 font-mono fw-bold px-4">
                    REPORT ISSUE
                </a>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>