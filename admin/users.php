<?php
require_once '../db_connect.php';
$db = new Database();
$conn = $db->connect();

// FETCH USERS & STATS
$sql = "SELECT u.*, 
        COUNT(o.id) as total_orders, 
        SUM(o.total_amount) as lifetime_value,
        MAX(o.created_at) as last_active
        FROM users u
        LEFT JOIN orders o ON u.id = o.user_id
        GROUP BY u.id
        ORDER BY lifetime_value DESC";
$users = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>44:11 // ROSTER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #f4f4f4; }
        .sidebar { width: 280px; height: 100vh; background: #0a0a0a; position: fixed; top: 0; left: 0; padding: 40px 30px; z-index: 1000; }
        .sidebar-brand { font-family: 'JetBrains Mono'; font-size: 1.5rem; font-weight: 700; color: white; text-decoration: none; display: block; margin-bottom: 60px; }
        .nav-item { display: flex; align-items: center; padding: 16px 0; color: #666; text-decoration: none; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; border-bottom: 1px solid #222; }
        .nav-item:hover { color: white; padding-left: 10px; }
        .nav-item.active { color: #d7263d; border-bottom: 1px solid #d7263d; }
        .nav-item i { margin-right: 15px; }
        .main-content { margin-left: 280px; padding: 60px; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .avatar-circle { width: 40px; height: 40px; background: #ddd; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }
    </style>
</head>
<body>

    <nav class="sidebar">
        <a href="admin-dashboard.php" class="sidebar-brand">44:11_SYSTEM</a>
        <div class="nav-links">
            <a href="admin-dashboard.php" class="nav-item"><i class="bi bi-grid-fill"></i> Command</a>
            <a href="inventory.php" class="nav-item"><i class="bi bi-box-seam-fill"></i> Inventory</a>
            <a href="orders.php" class="nav-item"><i class="bi bi-truck"></i> Logistics</a>
            <a href="users.php" class="nav-item active"><i class="bi bi-people-fill"></i> Roster</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h1 class="fw-black text-uppercase m-0">Active Roster</h1>
                <p class="text-muted font-mono small mt-1">TOTAL AGENTS: <?= count($users) ?></p>
            </div>
            <button class="btn btn-dark rounded-0 font-mono fw-bold text-uppercase" onclick="alert('EXPORT FEATURE PENDING')">
                <i class="bi bi-download me-2"></i> Export Data
            </button>
        </div>

        <div class="card border-0 shadow-sm rounded-0">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-black text-white">
                        <tr>
                            <th class="ps-4 py-3 font-mono">OPERATOR</th>
                            <th class="py-3 font-mono">CONTACT</th>
                            <th class="py-3 font-mono">JOINED</th>
                            <th class="py-3 font-mono text-center">ORDERS</th>
                            <th class="py-3 font-mono text-end pe-4">LIFETIME VALUE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle bg-dark text-white font-mono small">
                                        <?= strtoupper(substr($user['name'], 0, 2)) ?>
                                    </div>
                                    <div class="fw-bold text-uppercase"><?= htmlspecialchars($user['name']) ?></div>
                                </div>
                            </td>
                            <td class="font-mono small text-muted"><?= htmlspecialchars($user['email']) ?></td>
                            <td class="font-mono small"><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                            <td class="text-center font-mono fw-bold"><?= $user['total_orders'] ?></td>
                            <td class="text-end pe-4 font-mono fw-black text-success">
                                $<?= number_format($user['lifetime_value'] ?? 0, 2) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>