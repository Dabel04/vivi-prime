<?php
require_once '../db_connect.php';
$db = new Database();
$conn = $db->connect();

// HANDLE STATUS UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$_POST['status'], $_POST['order_id']]);
    echo json_encode(['success' => true]);
    exit;
}

// FETCH ALL ORDERS (Joined with User Info)
$sql = "SELECT o.*, u.name as customer_name, u.email as customer_email 
        FROM orders o 
        JOIN users u ON o.user_id = u.id 
        ORDER BY o.created_at DESC";
$orders = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>44:11 // ORDER COMMAND</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        /* Reusing your Admin CSS */
        body { font-family: 'Montserrat', sans-serif; background-color: #f4f4f4; }
        .sidebar { width: 280px; height: 100vh; background: #0a0a0a; position: fixed; top: 0; left: 0; padding: 40px 30px; z-index: 1000; }
        .sidebar-brand { font-family: 'JetBrains Mono'; font-size: 1.5rem; font-weight: 700; color: white; text-decoration: none; display: block; margin-bottom: 60px; }
        .nav-item { display: flex; align-items: center; padding: 16px 0; color: #666; text-decoration: none; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; border-bottom: 1px solid #222; }
        .nav-item:hover { color: white; padding-left: 10px; }
        .nav-item.active { color: #d7263d; border-bottom: 1px solid #d7263d; }
        .nav-item i { margin-right: 15px; }
        .main-content { margin-left: 280px; padding: 60px; }
        .status-select { border: 1px solid #ccc; padding: 5px; font-family: 'JetBrains Mono'; font-size: 0.8rem; cursor: pointer; }
    </style>
</head>
<body>

    <nav class="sidebar">
        <a href="admin-dashboard.php" class="sidebar-brand">44:11_SYSTEM</a>
        <div class="nav-links">
            <a href="admin-dashboard.php" class="nav-item"><i class="bi bi-grid-fill"></i> Command</a>
            <a href="inventory.php" class="nav-item"><i class="bi bi-box-seam-fill"></i> Inventory</a>
            <a href="orders.php" class="nav-item active"><i class="bi bi-truck"></i> Logistics</a> <a href="users.php" class="nav-item"><i class="bi bi-people-fill"></i> Roster</a>
        </div>
    </nav>

    <main class="main-content">
        <h1 class="fw-black text-uppercase mb-5">Logistics Command</h1>

        <div class="card border-0 shadow-sm rounded-0">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-black text-white">
                        <tr>
                            <th class="ps-4 py-3 font-mono">ORDER ID</th>
                            <th class="py-3 font-mono">CUSTOMER</th>
                            <th class="py-3 font-mono">DATE</th>
                            <th class="py-3 font-mono">TOTAL</th>
                            <th class="py-3 font-mono">STATUS PROTOCOL</th>
                            <th class="pe-4 py-3 text-end font-mono">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order): ?>
                        <tr>
                            <td class="ps-4 font-mono fw-bold">#44-<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></td>
                            <td>
                                <div class="fw-bold"><?= htmlspecialchars($order['customer_name']) ?></div>
                                <div class="small text-muted font-mono"><?= htmlspecialchars($order['customer_email']) ?></div>
                            </td>
                            <td class="font-mono small"><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                            <td class="font-mono fw-bold">$<?= number_format($order['total_amount'], 2) ?></td>
                            <td>
                                <select class="status-select rounded-0" onchange="updateStatus(<?= $order['id'] ?>, this.value)">
                                    <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>PENDING</option>
                                    <option value="shipped" <?= $order['status'] == 'shipped' ? 'selected' : '' ?>>SHIPPED</option>
                                    <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>COMPLETED</option>
                                    <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>CANCELLED</option>
                                </select>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="order-details.php?id=<?= $order['id'] ?>" class="btn btn-sm btn-dark rounded-0 font-mono">INSPECT</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        function updateStatus(id, newStatus) {
            const formData = new FormData();
            formData.append('action', 'update_status');
            formData.append('order_id', id);
            formData.append('status', newStatus);

            fetch('orders.php', { method: 'POST', body: formData })
            .then(r => r.json())
            .then(data => {
                if(data.success) {
                    alert('STATUS PROTOCOL UPDATED.');
                } else {
                    alert('ERROR UPDATING STATUS.');
                }
            });
        }
    </script>
</body>
</html>