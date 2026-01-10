<?php
// INITIALIZE SURVEILLANCE SESSION
// This is required for track.php to link clicks to a specific user session in the DB
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>44:11 // ACTIVEWEAR PROTOCOL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="top-bar text-center">
        Free Delivery on orders above $100
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top py-3">
        <div class="container">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <a class="navbar-brand" href="index.php">44:11</a>
            
            <div class="mobile-icons-container d-lg-none">
                <div class="nav-icons mobile-version">
                    <i class="bi bi-search" id="mobile-search-toggle"></i>
                    <i class="bi bi-person"></i>
                    <div class="position-relative">
                        <i class="bi bi-bag cart-icon" id="open-side-cart"></i>
                        <span id="cart-count-mobile" class="cart-count">0</span>
                    </div>
                </div>
            </div>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                
                <div class="mobile-currency d-lg-none">
                    <div class="currency-selector" id="mobile-currency-toggle">
                        Currency: <span id="mobile-currency-text">USD $</span> <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </div>
            
           <div class="nav-icons d-none d-lg-flex align-items-center">
                
                <div class="position-relative">
                    <div class="currency-selector" id="desktop-currency-toggle">
                        <span id="desktop-currency-text">USD $</span> <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="currency-dropdown" id="desktop-currency-dropdown">
                        <div class="currency-item active" data-currency="USD">USD $</div>
                        <div class="currency-item" data-currency="EUR">EUR €</div>
                        <div class="currency-item" data-currency="GBP">GBP £</div>
                        <div class="currency-item" data-currency="CAD">CAD $</div>
                    </div>
                </div>
                
                <div class="position-relative">
                    <i class="bi bi-search" id="desktop-search-toggle"></i>
                    <div class="search-dropdown" id="desktop-search-dropdown">
                        <form class="search-form" id="desktop-search-form" action="shop.php" method="GET">
                            <input type="text" name="search" class="search-input" placeholder="Search products..." id="desktop-search-input">
                            <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
                        </form>
                    </div>
                </div>
                
                <div class="position-relative account-hover-container">
                    <a href="user-dashboard.php" class="account-link">
                        <i class="bi bi-person"></i>
                    </a>
                    
                    <div class="account-dropdown-menu">
                        <div class="dropdown-header-user">
                            <?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'GUEST' ?>
                        </div>
                        <a href="user-dashboard.php" class="dropdown-item-custom">
                            <i class="bi bi-grid-fill me-2"></i> Dashboard
                        </a>
                        <a href="user-profile.php" class="dropdown-item-custom">
                            <i class="bi bi-gear-fill me-2"></i> Settings
                        </a>
                        <div class="dropdown-divider-custom"></div>
                        <a href="logout.php" class="dropdown-item-custom text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>
                    </div>
                </div>
                
                <div class="position-relative">
                    <i class="bi bi-bag cart-icon" id="open-side-cart-desktop"></i>
                    <span id="cart-count-desktop" class="cart-count">0</span>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="mobile-search-dropdown d-xl-none" id="mobile-search-dropdown">
        <form class="mobile-search-form" id="mobile-search-form" action="shop.php" method="GET">
            <input type="text" name="search" class="mobile-search-input" placeholder="Search products..." id="mobile-search-input">
            <button type="submit" class="mobile-search-btn"><i class="bi bi-search"></i></button>
        </form>
    </div>