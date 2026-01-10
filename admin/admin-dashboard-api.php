<?php
require_once '../db_connect.php';
header('Content-Type: application/json');

$db = new Database();
$conn = $db->connect();

$action = $_GET['action'] ?? '';

// --- 1. FETCH DASHBOARD DATA ---
if ($action === 'fetch_data') {
    
    // A. Revenue (Last 24h)
    $stmt = $conn->query("SELECT SUM(total_amount) as total FROM orders WHERE created_at >= NOW() - INTERVAL 24 HOUR AND status != 'refunded'");
    $revenue = $stmt->fetch()['total'] ?? 0;

    // B. Orders & Delays (Today)
    $stmt = $conn->query("SELECT COUNT(*) as total FROM orders WHERE DATE(created_at) = CURDATE()");
    $orders_today = $stmt->fetch()['total'];
    
    $stmt = $conn->query("SELECT COUNT(*) as total FROM orders WHERE status = 'delayed'");
    $delays = $stmt->fetch()['total'];

    // C. Conversion Rate
    $stmt = $conn->query("SELECT COUNT(*) FROM sessions WHERE created_at >= NOW() - INTERVAL 24 HOUR");
    $total_sessions = $stmt->fetchColumn();
    $conversions = $orders_today; 
    $conversion_rate = $total_sessions > 0 ? round(($conversions / $total_sessions) * 100, 1) : 0;

    // D. Roster (Users)
    $stmt = $conn->query("SELECT COUNT(*) FROM users");
    $total_users = $stmt->fetchColumn();
    $stmt = $conn->query("SELECT COUNT(*) FROM users WHERE DATE(created_at) = CURDATE()");
    $new_users = $stmt->fetchColumn();

    // E. Graph Data (Revenue by Hour - Last 12h)
    $graph_labels = [];
    $graph_data = [];
    for ($i = 11; $i >= 0; $i--) {
        $hour = date('H:00', strtotime("-$i hours"));
        $graph_labels[] = $hour;
        
        $sql = "SELECT SUM(total_amount) FROM orders WHERE created_at BETWEEN DATE_SUB(NOW(), INTERVAL ? HOUR) AND DATE_SUB(NOW(), INTERVAL ? HOUR)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$i+1, $i]);
        $graph_data[] = $stmt->fetchColumn() ?? 0;
    }

    // F. The Podium (Top 3 Products)
    $stmt = $conn->query("SELECT product_name, SUM(quantity) as units, SUM(price * quantity) as revenue 
                          FROM order_items GROUP BY product_name ORDER BY revenue DESC LIMIT 3");
    $podium = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // G. Activity Log
    $stmt = $conn->query("SELECT * FROM activity_logs ORDER BY created_at DESC LIMIT 5");
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // H. ALERTS (SYSTEM + INVENTORY LOGIC) [UPDATED]
    // 1. Fetch Manual System Alerts
    $stmt = $conn->query("SELECT * FROM alerts WHERE status = 'active' ORDER BY created_at DESC");
    $db_alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 2. Scan for Low Stock (Less than 5)
    $stmt = $conn->query("SELECT name, stock FROM products WHERE stock < 5 AND stock > 0");
    $low_stock = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 3. Scan for Stockouts (0)
    $stmt = $conn->query("SELECT name FROM products WHERE stock <= 0");
    $stockouts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Merge Inventory Alerts into the Feed
    foreach ($low_stock as $item) {
        array_unshift($db_alerts, [
            'message' => "Low Stock: {$item['name']} ({$item['stock']} left)",
            'type' => 'logistics'
        ]);
    }
    foreach ($stockouts as $item) {
        array_unshift($db_alerts, [
            'message' => "STOCKOUT: {$item['name']} - REPLENISH ASAP",
            'type' => 'critical'
        ]);
    }
    $alerts = $db_alerts;

    // I. FUNNEL (REAL SURVEILLANCE DATA)
    $stmt = $conn->query("SELECT COUNT(*) FROM sessions WHERE created_at >= NOW() - INTERVAL 24 HOUR");
    $sessions_count = $stmt->fetchColumn();

    $stmt = $conn->query("SELECT COUNT(*) FROM sessions WHERE has_cart = 1 AND created_at >= NOW() - INTERVAL 24 HOUR");
    $cart_count = $stmt->fetchColumn();

    $stmt = $conn->query("SELECT COUNT(*) FROM sessions WHERE has_checkout = 1 AND created_at >= NOW() - INTERVAL 24 HOUR");
    $checkout_count = $stmt->fetchColumn();

    $stmt = $conn->query("SELECT COUNT(*) FROM orders WHERE created_at >= NOW() - INTERVAL 24 HOUR");
    $purchase_count = $stmt->fetchColumn();

    $funnel = [
        'sessions' => (int)$sessions_count,
        'cart' => (int)$cart_count,
        'checkout' => (int)$checkout_count,
        'purchase' => (int)$purchase_count
    ];

    echo json_encode([
        'revenue' => number_format($revenue, 2),
        'orders_today' => $orders_today,
        'delays' => $delays,
        'conversion_rate' => $conversion_rate,
        'total_users' => $total_users,
        'new_users' => $new_users,
        'graph' => ['labels' => $graph_labels, 'data' => $graph_data],
        'podium' => $podium,
        'logs' => $logs,
        'alerts' => $alerts,
        'funnel' => $funnel
    ]);
    exit;
}

// --- 2. SIMULATE ORDER ---
if ($action === 'simulate_order') {
    $conn->query("INSERT INTO users (name, email) VALUES ('Sim User', 'sim@test.com')");
    $user_id = $conn->lastInsertId();

    $amount = rand(45, 200);
    $conn->query("INSERT INTO orders (user_id, total_amount, status) VALUES ($user_id, $amount, 'completed')");
    $order_id = $conn->lastInsertId();

    $products = ['Thermo-Shield Jacket', 'Boxy Crop Tee', 'Pro Grip Yoga Mat', 'Runner 5 Short'];
    $product = $products[array_rand($products)];
    $qty = rand(1, 3);
    $conn->query("INSERT INTO order_items (order_id, product_name, quantity, price) VALUES ($order_id, '$product', $qty, $amount)");

    $conn->query("INSERT INTO activity_logs (message, type) VALUES ('New Order #$order_id verified ($$amount)', 'order')");
    $conn->query("INSERT INTO sessions (session_id, has_cart, has_checkout, converted) VALUES ('sim_session_" . time() . "', 1, 1, 1)");

    echo json_encode(['success' => true]);
    exit;
}

// --- 3. RESOLVE ALERTS ---
if ($action === 'resolve_alerts') {
    $conn->query("UPDATE alerts SET status = 'resolved' WHERE status = 'active'");
    $conn->query("INSERT INTO activity_logs (message, type) VALUES ('Manual Override: All alerts resolved', 'system')");
    echo json_encode(['success' => true]);
    exit;
}
?>