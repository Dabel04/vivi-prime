<?php
// INITIALIZE SESSION (Header handles this, but good practice)
require_once 'db_connect.php';
$db = new Database();
$conn = $db->connect();

include 'header.php';
?>

<div class="container py-5">
    
    <div class="row mb-5">
        <div class="col-lg-8">
            <h1 class="fw-black text-uppercase display-5 mb-3" style="font-family: 'Montserrat', sans-serif; letter-spacing: -2px;">Logistics &<br>Recovery Protocols</h1>
            <p class="lead font-mono text-muted">OPERATIONAL GUIDELINES FOR ASSET ACQUISITION AND RETRIEVAL.</p>
        </div>
    </div>

    <div class="row g-5">
        
        <div class="col-lg-6">
            <div class="p-4 border border-1 border-dark h-100">
                <h4 class="fw-bold text-uppercase mb-4 border-bottom border-dark pb-3"> <i class="bi bi-truck me-2"></i> Deployment (Shipping)</h4>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="font-mono fw-bold">STANDARD GROUND</span>
                        <span class="badge bg-dark rounded-0 font-mono">FREE > $100</span>
                    </div>
                    <p class="small text-muted mb-1">Estimated Arrival: <span class="text-dark fw-bold">3-5 Business Days</span></p>
                    <p class="small text-muted">Cost: <span class="text-dark fw-bold">$10.00</span> (Free for orders over $100)</p>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="font-mono fw-bold text-danger">PRIORITY AIR (EXPRESS)</span>
                        <span class="badge bg-danger rounded-0 font-mono">$25.00</span>
                    </div>
                    <p class="small text-muted mb-1">Estimated Arrival: <span class="text-dark fw-bold">1-2 Business Days</span></p>
                    <p class="small text-muted">Cutoff Time: Orders placed before 1400 EST ship same day.</p>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="font-mono fw-bold">GLOBAL OPS (INTL)</span>
                        <span class="badge bg-secondary rounded-0 font-mono">VARIES</span>
                    </div>
                    <p class="small text-muted mb-0">Calculated at checkout based on destination sector.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="p-4 bg-light h-100">
                <h4 class="fw-bold text-uppercase mb-4 border-bottom pb-3"> <i class="bi bi-box-seam me-2"></i> Asset Retrieval (Pickup)</h4>
                
                <div class="mb-4">
                    <span class="font-mono fw-bold d-block mb-2">BASE OF OPERATIONS</span>
                    <address class="small text-muted font-mono mb-3">
                        44:11 HQ Terminal<br>
                        123 Active Street, Sector 4<br>
                        New York, NY 10001
                    </address>
                    <a href="https://maps.google.com" target="_blank" class="btn btn-outline-dark btn-sm rounded-0 font-mono fw-bold">GET COORDINATES (MAP)</a>
                </div>

                <div class="mb-4">
                    <span class="font-mono fw-bold d-block mb-2">OPERATIONAL WINDOW</span>
                    <ul class="list-unstyled small text-muted font-mono">
                        <li>MON - FRI: 0900 - 1800</li>
                        <li>SAT: 1000 - 1600</li>
                        <li>SUN: CLOSED (MAINTENANCE)</li>
                    </ul>
                </div>

                <div class="alert alert-warning rounded-0 border-0 d-flex align-items-center small">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div>
                        <strong>REQUIREMENTS:</strong> Valid Gov ID & Order #44-XXXX required for release of assets.
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-5 pt-5">
        <div class="col-12 text-center">
            <h3 class="fw-bold text-uppercase mb-3">Incoming Asset Status</h3>
            <p class="text-muted mb-4">Already deployed an order? access the command center to track coordinates.</p>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="user-dashboard.php" class="btn btn-black px-5 py-3 rounded-0 font-mono fw-bold text-uppercase">
                    TRACK IN DASHBOARD
                </a>
            <?php else: ?>
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control rounded-0 font-mono" placeholder="ENTER ORDER ID (e.g. 44-1023)">
                            <button class="btn btn-dark rounded-0 font-mono fw-bold">TRACK</button>
                        </div>
                        <small class="text-muted mt-2 d-block">Or log in to view full history.</small>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-5 pt-5 g-4">
        <div class="col-12 mb-2">
            <h5 class="fw-bold text-uppercase border-bottom pb-2">Contingencies (FAQ)</h5>
        </div>
        
        <div class="col-md-4">
            <h6 class="fw-bold font-mono small">MISSING PACKAGE?</h6>
            <p class="small text-muted">If status shows 'DELIVERED' but assets are not secured, contact HQ within 24 hours for investigation protocol.</p>
        </div>
        
        <div class="col-md-4">
            <h6 class="fw-bold font-mono small">DAMAGED ASSETS?</h6>
            <p class="small text-muted">Document damage immediately (photos required). Submit evidence to <a href="mailto:support@44eleven.com" class="text-dark fw-bold">support@44eleven.com</a>.</p>
        </div>
        
        <div class="col-md-4">
            <h6 class="fw-bold font-mono small">CHANGE COORDINATES?</h6>
            <p class="small text-muted">Address changes are only authorized within 60 minutes of order deployment. Contact us immediately.</p>
        </div>
    </div>

</div>

<style>
    /* LOCAL STYLES */
    .btn-black { background: #000; color: white; border: 1px solid #000; transition: 0.3s; }
    .btn-black:hover { background: transparent; color: #000; }
    
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<?php include 'footer.php'; ?>