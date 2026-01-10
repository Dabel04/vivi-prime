<?php
// Note: Rename your old contact.html to contact.php
include 'header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center mb-5">
            <h1 class="fw-black text-uppercase display-4 mb-3" style="font-family: 'Montserrat'; letter-spacing: -2px;">Comms Uplink</h1>
            <p class="lead font-mono text-muted">INITIATE CONTACT WITH HQ. RESPONSE TIME: T-MINUS 24 HOURS.</p>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-lg-7">
            <div class="p-5 border border-2 border-dark h-100">
                <form>
                    <div class="mb-4">
                        <label class="font-mono fw-bold small mb-2">OPERATOR NAME</label>
                        <input type="text" class="form-control rounded-0 p-3 bg-light border-0" placeholder="ENTER NAME...">
                    </div>
                    <div class="mb-4">
                        <label class="font-mono fw-bold small mb-2">RETURN FREQUENCY (EMAIL)</label>
                        <input type="email" class="form-control rounded-0 p-3 bg-light border-0" placeholder="ENTER EMAIL...">
                    </div>
                    <div class="mb-4">
                        <label class="font-mono fw-bold small mb-2">MESSAGE PAYLOAD</label>
                        <textarea class="form-control rounded-0 p-3 bg-light border-0" rows="5" placeholder="TYPE MESSAGE..."></textarea>
                    </div>
                    <button type="button" class="btn btn-black w-100 py-3 rounded-0 font-mono fw-bold text-uppercase" onclick="alert('TRANSMISSION SENT. STAND BY.')">
                        TRANSMIT MESSAGE
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="bg-black text-white p-5 h-100 d-flex flex-column justify-content-center">
                <h4 class="font-mono fw-bold mb-4 text-uppercase border-bottom border-secondary pb-3">HQ Coordinates</h4>
                
                <div class="mb-4">
                    <span class="d-block text-secondary font-mono small mb-1">PHYSICAL ADDRESS</span>
                    <p class="fw-bold mb-0">123 Active Street, Sector 4<br>New York, NY 10001</p>
                </div>

                <div class="mb-4">
                    <span class="d-block text-secondary font-mono small mb-1">DIRECT LINE</span>
                    <p class="fw-bold mb-0">1-800-555-1234</p>
                </div>

                <div class="mb-4">
                    <span class="d-block text-secondary font-mono small mb-1">DIGITAL CHANNEL</span>
                    <p class="fw-bold mb-0">hello@44eleven.com</p>
                </div>

                <div class="mt-auto pt-4">
                    <span class="d-block text-secondary font-mono small mb-2">SOCIAL FEEDS</span>
                    <div class="fs-4">
                        <i class="bi bi-instagram me-3"></i>
                        <i class="bi bi-twitter me-3"></i>
                        <i class="bi bi-tiktok"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-black { background: #000; color: white; transition: 0.3s; }
    .btn-black:hover { background: #d7263d; color: white; }
</style>

<?php include 'footer.php'; ?>