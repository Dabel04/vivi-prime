<?php
require_once '../db_connect.php';
$db = new Database();
$conn = $db->connect();

$order_id = $_GET['id'] ?? 0;

// 1. FETCH ORDER DETAILS
$sql = "SELECT o.*, u.name as customer_name, u.email as customer_email 
        FROM orders o 
        JOIN users u ON o.user_id = u.id 
        WHERE o.id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("ORDER NOT FOUND");
}

// 2. FETCH ORDER ITEMS
$stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt->execute([$order_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDER #<?= $order_id ?> // INSPECTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #f4f4f4; padding-bottom: 50px; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .card { border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .btn-black { background: #000; color: white; border: 1px solid #000; transition: 0.2s; }
        .btn-black:hover { background: transparent; color: #000; }
        
        /* PRINT STYLES (For Packing Slip) */
        @media print {
            body { background: white; padding: 0; }
            .no-print { display: none !important; }
            .card { box-shadow: none; border: 1px solid #000; }
        }
    </style>
</head>
<body>

    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4 no-print">
            <a href="orders.php" class="btn btn-outline-dark font-mono btn-sm fw-bold">
                <i class="bi bi-arrow-left"></i> BACK TO LOGISTICS
            </a>
            <button onclick="window.print()" class="btn btn-black font-mono btn-sm fw-bold">
                <i class="bi bi-printer"></i> PRINT PACKING SLIP
            </button>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card rounded-0 p-5">
                    
                    <div class="d-flex justify-content-between border-bottom border-2 border-dark pb-4 mb-4">
                        <div>
                            <h4 class="fw-black m-0">44:11 // PACKING SLIP</h4>
                            <p class="font-mono text-muted small m-0">HQ TERMINAL: NEW YORK, NY</p>
                        </div>
                        <div class="text-end">
                            <h2 class="font-mono fw-bold m-0">#44-<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></h2>
                            <p class="font-mono small m-0"><?= date('Y-m-d H:i', strtotime($order['created_at'])) ?></p>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-6">
                            <h6 class="font-mono fw-bold text-uppercase text-secondary small">SHIP TO:</h6>
                            <div class="fw-bold"><?= htmlspecialchars($order['customer_name']) ?></div>
                            <div class="font-mono small"><?= htmlspecialchars($order['customer_email']) ?></div>
                            <div class="font-mono small text-muted mt-2">123 Active Blvd (Placeholder Addr)</div> 
                        </div>
                        <div class="col-6 text-end">
                            <h6 class="font-mono fw-bold text-uppercase text-secondary small">STATUS:</h6>
                            <span class="badge bg-dark rounded-0 font-mono fs-6"><?= strtoupper($order['status']) ?></span>
                        </div>
                    </div>

                    <table class="table table-bordered border-dark mb-4">
                        <thead class="bg-light">
                            <tr>
                                <th class="font-mono py-2">ASSET DESCRIPTION</th>
                                <th class="font-mono py-2 text-center" style="width: 80px;">QTY</th>
                                <th class="font-mono py-2 text-center" style="width: 100px;">CHECK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($items as $item): ?>
                            <tr>
                                <td class="py-3">
                                    <span class="fw-bold d-block"><?= htmlspecialchars($item['product_name']) ?></span>
                                    <span class="font-mono small text-muted">$<?= number_format($item['price'], 2) ?></span>
                                </td>
                                <td class="text-center py-3 font-mono fs-5 fw-bold"><?= $item['quantity'] ?></td>
                                <td class="text-center py-3">
                                    <div class="border border-dark d-inline-block" style="width: 20px; height: 20px;"></div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top border-secondary">
                        <div class="font-mono small text-muted">
                            AUTHORIZED BY: ______________________
                        </div>
                        <div class="text-end">
                            <span class="font-mono small fw-bold me-3">TOTAL VALUE:</span>
                            <span class="fw-black fs-4">$<?= number_format($order['total_amount'], 2) ?></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>