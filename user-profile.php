<?php
require_once 'db_connect.php';
$db = new Database();
$conn = $db->connect();

include 'header.php';

// --- DEV BYPASS (Remove in Production) ---
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; 
    $_SESSION['user_name'] = "Kenton Client";
    $_SESSION['user_email'] = "kenton@44eleven.com";
}
// ------------------------------------------

$user_id = $_SESSION['user_id'];
$message = "";
$msg_type = "";

// HANDLE FORM SUBMISSION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $new_pass = $_POST['new_password'];

    try {
        if (!empty($new_pass)) {
            // Update with Password
            // Note: In a real app, use password_hash($new_pass, PASSWORD_DEFAULT)
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
            $stmt->execute([$name, $email, $new_pass, $user_id]);
        } else {
            // Update Info Only
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->execute([$name, $email, $user_id]);
        }

        // Update Session
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;

        $message = "IDENTITY PROTOCOL UPDATED SUCCESSFULLY.";
        $msg_type = "success";

    } catch (PDOException $e) {
        $message = "SYSTEM ERROR: " . $e->getMessage();
        $msg_type = "danger";
    }
}

// FETCH CURRENT DATA
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container py-5">
    <div class="row g-5">
        
        <div class="col-lg-3">
            <div class="user-sidebar sticky-top" style="top: 100px;">
                <div class="user-info mb-4">
                    <h5 class="fw-black text-uppercase mb-0"><?= htmlspecialchars($_SESSION['user_name']) ?></h5>
                    <p class="text-muted font-mono small">ID: #44-<?= str_pad($user_id, 4, '0', STR_PAD_LEFT) ?></p>
                </div>
                
                <div class="nav flex-column user-nav">
                    <a href="user-dashboard.php" class="nav-link"><i class="bi bi-grid-fill me-2"></i> COMMAND CENTER</a>
                    <a href="user-profile.php" class="nav-link active"><i class="bi bi-person-gear me-2"></i> IDENTITY PROTOCOL</a>
                    <a href="#" class="nav-link"><i class="bi bi-credit-card me-2"></i> PAYMENT METHODS</a>
                    <a href="logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-right me-2"></i> DISCONNECT</a>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <h4 class="fw-black text-uppercase mb-4">Identity Configuration</h4>

            <?php if($message): ?>
                <div class="alert alert-<?= $msg_type ?> rounded-0 font-mono small fw-bold">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm p-4 rounded-0">
                <form method="POST">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label font-mono small fw-bold">OPERATOR NAME</label>
                            <input type="text" name="name" class="form-control rounded-0 p-3" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-mono small fw-bold">CONTACT FREQUENCY (EMAIL)</label>
                            <input type="email" name="email" class="form-control rounded-0 p-3" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                        </div>
                        
                        <div class="col-12">
                            <hr class="my-4">
                            <h6 class="fw-bold text-uppercase mb-3">Security Protocol</h6>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label font-mono small fw-bold">NEW PASSWORD</label>
                            <input type="password" name="new_password" class="form-control rounded-0 p-3" placeholder="LEAVE EMPTY TO KEEP CURRENT">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-mono small fw-bold">CONFIRM PASSWORD</label>
                            <input type="password" class="form-control rounded-0 p-3" placeholder="CONFIRM NEW PASSWORD">
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-black w-100 py-3 fw-bold font-mono text-uppercase">
                                UPDATE PROTOCOLS
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Reuse Sidebar Styles */
    .user-sidebar { background: #fff; padding: 30px; border: 1px solid #eee; }
    .user-nav .nav-link { color: #666; padding: 12px 0; font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; border-bottom: 1px solid #f9f9f9; transition: 0.3s; }
    .user-nav .nav-link:hover, .user-nav .nav-link.active { color: #000; padding-left: 10px; font-weight: 700; border-left: 2px solid #d7263d; }
    
    .form-control:focus { box-shadow: none; border-color: #000; background: #f9f9f9; }
    .btn-black { background: #000; color: white; border: none; transition: 0.3s; }
    .btn-black:hover { background: #d7263d; }
</style>

<?php include 'footer.php'; ?>