<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>44:11 - Activewear Store</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Changed font from Inter to Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
     /* .navigation {
  display: flex;
  justify-content: space-between;
  padding: 10px;
} */
 
        :root {
            /* Brand Colors - UPDATED FOR AirPods Max THEME */
            --primary-navy: #000000;    /* Black for AirPods Max */
            --primary-red: #a3a3a3;    /* Silver/Grey metallic tone */
            
            /* Background Colors */
            --bg-white: #ffffff;
            --bg-light: #f5f5f7;      /* Apple-style light grey */
            --bg-dark: #000000;

             /* BUTTONS: Deep Carbon (Black) */
            --btn-bg: #000000;
            --btn-text: #FFFFFF;
            
            /* Text Colors */
            --text-primary: #1d1d1f;    /* Dark grey for better readability */
            --text-secondary: #86868b;  /* Apple-style medium grey */
            --text-light: #8a8a8e;      /* Lighter grey */
            --text-white: #ffffff;
            
            /* Accent Colors - UPDATED */
            --accent-green: #34c759;    /* Apple green */
            --accent-yellow: #ffcc00;   /* Brighter yellow */
            --accent-blue: #007aff;     /* Apple blue */
            --accent-light-blue: #5ac8fa; /* Sky blue */
            --accent-pink: #ff2d55;     /* Apple pink */
            
            /* UI Colors */
            --border-light: #d2d2d7;    /* Lighter border */
            --border-dark: #1d1d1f;     /* Dark border */
            --shadow-color: rgba(0, 0, 0, 0.08); /* Softer shadow */
            --overlay-color: rgba(0, 0, 0, 0.4); /* Darker overlay */
            
            /* Font Settings */
            --font-main: 'Montserrat', sans-serif;
            --font-size-xs: 0.75rem;
            --font-size-sm: 0.85rem;
            --font-size-md: 0.9rem;
            --font-size-lg: 1rem;
            --font-size-xl: 1.1rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 2.5rem;
            --font-size-4xl: 3.5rem;
            
            /* Spacing */
            --spacing-xs: 5px;
            --spacing-sm: 10px;
            --spacing-md: 15px;
            --spacing-lg: 20px;
            --spacing-xl: 30px;
            --spacing-2xl: 40px;
            
            /* Border Radius */
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 30px;
            --radius-circle: 50%;
            
            /* Transitions */
            --transition-fast: 0.2s;
            --transition-normal: 0.3s;
            --transition-slow: 0.5s;
            
            /* Shadows */
            --shadow-light: 0 2px 5px var(--shadow-color);
            --shadow-medium: 0 5px 15px var(--shadow-color);
            --shadow-heavy: 0 10px 30px var(--shadow-color);
            
            /* Z-index */
            --z-dropdown: 1001;
            --z-navbar: 1030;
            --z-overlay: 1090;
            --z-sidecart: 1100;
            --z-chatwidget: 1000;
        }
        
        body {
            font-family: var(--font-main);
            color: var(--text-primary);
            overflow-x: hidden;
            background-color: var(--bg-white);
        }
        
        /* Top Promo Bar - Updated with primary colors */
        .top-bar {
            background-color: var(--primary-navy);
            font-size: var(--font-size-xs);
            letter-spacing: 1px;
            padding: var(--spacing-sm) 0;
            text-transform: uppercase;
            color: var(--text-white);
            font-weight: 600;
        }
        
        /* Updated Logo Styling for 44:11 */
        .navbar-brand {
            font-weight: 800;
            letter-spacing: 3px;
            font-size: 1.6rem;
            background: linear-gradient(45deg, var(--text-primary), var(--text-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            transition: all var(--transition-normal) ease;
            
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .navbar-brand::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary-red), transparent);
            opacity: 0.7;
        }
        
        /* Updated Nav Links with primary colors */
        .nav-link {
            font-size: var(--font-size-sm);
            font-weight: 500;
            text-transform: uppercase;
            color: var(--text-primary) !important;
            margin: 0 var(--spacing-md);
            position: relative;
            transition: color var(--transition-normal);
        }
        
        .nav-link:hover {
            color: var(--text-secondary) !important;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-red);
            transition: width var(--transition-normal);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--primary-red);
            color: var(--text-white);
            border-radius: var(--radius-circle);
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        /* Search Dropdown - Updated with primary colors */
        .search-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--bg-white);
            width: 300px;
            box-shadow: var(--shadow-heavy);
            border-radius: var(--radius-md);
            padding: var(--spacing-xl);
            z-index: var(--z-dropdown);
            display: none;
            opacity: 0;
            transform: translateY(-10px);
            transition: all var(--transition-normal) ease;
            border-top: 3px solid var(--primary-red);
        }
        
        .search-dropdown.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        
        .search-form {
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border: 2px solid var(--border-light);
            border-radius: var(--radius-sm);
            font-size: var(--font-size-md);
            transition: all var(--transition-normal);
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary-red);
        }
        
        .search-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--primary-red);
            cursor: pointer;
            font-size: var(--font-size-xl);
        }
        
        .search-suggestions {
            margin-top: var(--spacing-xl);
            padding-top: var(--spacing-xl);
            border-top: 1px solid var(--border-light);
        }
        
        .suggestion-title {
            font-size: var(--font-size-xs);
            color: var(--primary-red);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: var(--spacing-md);
            font-weight: 600;
        }
        
        .suggestion-item {
            display: block;
            padding: 8px 0;
            color: #333;
            text-decoration: none;
            font-size: var(--font-size-md);
            transition: all var(--transition-fast);
        }
        
        .suggestion-item:hover {
            color: var(--primary-red);
            padding-left: 5px;
        }
        
        /* Currency Dropdown - Updated with primary colors */
        .currency-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--bg-white);
            width: 120px;
            box-shadow: var(--shadow-heavy);
            border-radius: var(--radius-md);
            padding: 10px 0;
            z-index: var(--z-dropdown);
            display: none;
            opacity: 0;
            transform: translateY(-10px);
            transition: all var(--transition-normal) ease;
            border-top: 3px solid var(--primary-red);
        }
        
        .currency-dropdown.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        
        .currency-item {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            font-size: var(--font-size-sm);
            transition: all var(--transition-fast);
            cursor: pointer;
        }
        
        .currency-item:hover {
            background-color: rgba(163, 163, 163, 0.1);
            color: var(--primary-red);
        }
        
        .currency-item.active {
            color: var(--primary-red);
            font-weight: 600;
            background-color: rgba(163, 163, 163, 0.1);
        }
        
        .currency-selector {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: var(--font-size-xs);
            font-weight: 600;
            margin-right: 10px;
            color: var(--primary-red);
        }
        
        /* Mobile Navbar - Updated */
        @media (max-width: 991.98px) {
            /* Mobile navbar layout */
            .navbar .container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: nowrap;
            }
            
            /* Mobile navbar structure */
            .navbar-toggler {
                order: 1;
                margin-right: 15px;
                border: none;
                padding: 5px;
                color: var(--primary-red);
            }
            
            .navbar-brand {
                order: 2;
                margin: 0;
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                font-size: 1.3rem;
            }
            
            /* Mobile icons container */
            .mobile-icons-container {
                order: 3;
                display: flex !important;
                align-items: center;
                gap: 15px;
                margin-left: auto;
            }
            
            /* Hide desktop icons */
            .nav-icons.d-none.d-lg-flex {
                display: none !important;
            }
            
            /* Show mobile icons */
            .nav-icons.mobile-version {
                display: flex !important;
                align-items: center;
                gap: 15px;
                margin: 0;
            }
            
            .nav-icons.mobile-version i {
                margin-left: 0;
                font-size: var(--font-size-xl);
                color: var(--primary-red);
            }
            
            /* Cart icon positioning */
            .nav-icons.mobile-version .position-relative {
                position: relative;
            }
            
            /* Mobile cart counter */
            .cart-count {
                top: -5px;
                right: -5px;
                width: 16px;
                height: 16px;
                font-size: 0.6rem;
            }
            
            /* Mobile hamburger icon */
            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28163, 163, 163, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
                width: 1.2em;
                height: 1.2em;
            }
            
            /* Mobile menu */
            .navbar-collapse {
                position: fixed;
                top: 56px;
                left: 0;
                right: 0;
                background: var(--bg-white);
                z-index: var(--z-navbar);
                padding: var(--spacing-xl);
                box-shadow: var(--shadow-medium);
                max-height: calc(100vh - 56px);
                overflow-y: auto;
                border-top: 3px solid var(--primary-red);
            }
            
            .navbar-nav {
                text-align: center;
                padding: var(--spacing-xl) 0;
            }
            
            .nav-item {
                margin: 15px 0;
            }
            
            .nav-link {
                font-size: var(--font-size-lg);
                font-weight: 600;
                margin: 0;
                padding: 10px;
            }
            
            /* Mobile currency selector */
            .mobile-currency {
                font-size: var(--font-size-xs);
                font-weight: 600;
                color: var(--primary-red);
                padding: 10px;
                border-top: 1px solid var(--border-light);
                margin-top: 20px;
                text-align: center;
            }
            
            /* Mobile Search Dropdown */
            .mobile-search-dropdown {
                position: fixed;
                top: 75px;
                left: 0;
                right: 0;
                background: var(--bg-white);
                padding: var(--spacing-xl);
                box-shadow: var(--shadow-medium);
                z-index: var(--z-dropdown);
                display: none;
                border-top: 3px solid var(--primary-red);
            }
            
            .mobile-search-dropdown.active {
                display: block;
            }
            
            .mobile-search-form {
                position: relative;
            }
            
            .mobile-search-input {
                width: 100%;
                padding: 15px 50px 15px 15px;
                border: 2px solid var(--border-light);
                border-radius: var(--radius-sm);
                font-size: var(--font-size-lg);
            }
            
            .mobile-search-input:focus {
                border-color: var(--primary-red);
                outline: none;
            }
            
            .mobile-search-btn {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: var(--primary-red);
                font-size: 1.2rem;
            }
            
            /* Mobile promo stays visible */
            .top-bar {
                position: relative;
                z-index: 10;
            }
        }
        
        /* Desktop styles */
        @media (min-width: 992px) {
            /* Hide mobile icons on desktop */
            .mobile-icons-container {
                display: none !important;
            }
            
            /* Show desktop icons */
            .nav-icons.d-none.d-lg-flex {
                display: flex !important;
            }
            
            /* Desktop navbar */
            .navbar-brand {
                position: static;
                transform: none;
            }
            
            /* Position search dropdown for desktop */
            .search-dropdown {
                right: -50px;
            }
        }
        
        /* Shop Essentials Section */
        .section-header {
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: var(--spacing-xl);
            margin-top: 60px;
            font-size: var(--font-size-2xl);
            color: var(--primary-navy);
            position: relative;
            padding-bottom: var(--spacing-md);
        }
        
        .section-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-red);
        }
        
        /* Category Grid - Desktop (4 columns) */
        .category-card {
            position: relative;
            height: 350px;
            overflow: hidden;
            margin-bottom: var(--spacing-xl);
            cursor: pointer;
            border-radius: var(--radius-md);
        }
        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-slow);
        }
        .category-card:hover img {
            transform: scale(1.05);
        }
        .category-text {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: var(--text-white);
            font-weight: 700;
            text-transform: uppercase;
            font-size: var(--font-size-xl);
            text-shadow: 0 2px 5px rgba(0,0,0,0.5);
            background: rgba(0, 0, 0, 0.6);
            padding: var(--spacing-xs) var(--spacing-xl);
            border-radius: var(--radius-lg);
            transition: all var(--transition-normal);
          }
          
          .category-card:hover .category-text {
            background: rgba(163, 163, 163, 0.8);
            transform: translateY(-5px);
        }
        
        /* Mobile Slider for Categories */
        .categories-slider {
            display: none;
            position: relative;
            overflow: visible;
        }
        
        .categories-scroll-container {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            gap: var(--spacing-xl);
            padding: var(--spacing-md) var(--spacing-xl);
            margin: 0 -15px;
            -webkit-overflow-scrolling: touch;
        }
        
        .categories-scroll-container::-webkit-scrollbar {
            display: none;
        }
        
        .category-slide {
            flex: 0 0 calc(70% - 10px);
            scroll-snap-align: start;
            height: 280px;
            border-radius: var(--radius-md);
            overflow: hidden;
        }
        
        .category-slide .category-card {
            height: 100%;
            margin: 0;
        }
        
        /* Mobile View for Categories */
        @media (max-width: 991.98px) {
            .category-grid {
                display: none;
            }
            
            .categories-slider {
                display: block;
            }
            
            .section-header {
                margin-bottom: var(--spacing-xl);
                text-align: center;
            }
            
            .section-header::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .category-card {
                height: 280px;
            }
            
            .category-text {
                font-size: var(--font-size-lg);
                bottom: 15px;
                left: 15px;
            }
            
            .categories-scroll-container {
                scrollbar-width: none;
                -ms-overflow-style: none;
            }
        }
        
        /* Desktop adjustments for 4 columns */
        @media (min-width: 992px) {
            .category-card {
                height: 300px;
            }
            
            .category-grid .col-md-3 {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }
        
        /* Large desktop adjustments */
        @media (min-width: 1200px) {
            .category-card {
                height: 320px;
            }
        }
        
        /* Side Cart - Right Sliding Panel - Updated with primary colors */
        .side-cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--overlay-color);
            z-index: var(--z-overlay);
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-normal) ease;
        }
        
        .side-cart-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .side-cart {
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            max-width: 400px;
            height: 100vh;
            background: var(--bg-white);
            z-index: var(--z-sidecart);
            transition: right var(--transition-normal) ease;
            display: flex;
            flex-direction: column;
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.15);
        }
        
        .side-cart.active {
            right: 0;
        }
        
        .side-cart-header {
            padding: var(--spacing-xl);
            border-bottom: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--primary-red);
            color: var(--text-white);
        }
        
        .side-cart-title {
            font-weight: 700;
            font-size: var(--font-size-2xl);
            margin: 0;
        }
        
        .side-cart-close {
            background: none;
            border: none;
            font-size: var(--font-size-3xl);
            color: var(--text-white);
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }
        
        .side-cart-body {
            flex: 1;
            overflow-y: auto;
            padding: var(--spacing-xl);
        }
        
        .cart-item {
            display: flex;
            align-items: center;
            padding: var(--spacing-xl) 0;
            border-bottom: 1px solid var(--border-light);
        }
        
        .cart-item-img {
            width: 80px;
            height: 100px;
            object-fit: cover;
            margin-right: var(--spacing-xl);
            border-radius: var(--radius-sm);
        }
        
        .cart-item-details {
            flex-grow: 1;
        }
        
        .cart-item-title {
            font-weight: 600;
            font-size: var(--font-size-md);
            margin-bottom: 5px;
        }
        
        .cart-item-price {
            font-size: var(--font-size-md);
            color: var(--primary-red);
            font-weight: 600;
        }
        
        .cart-item-remove {
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            font-size: var(--font-size-2xl);
            padding: var(--spacing-xs);
            transition: color var(--transition-fast);
        }
        
        .cart-item-remove:hover {
            color: var(--primary-red);
        }
        
        .side-cart-footer {
            padding: var(--spacing-xl);
            border-top: 1px solid var(--border-light);
        }
        
        .cart-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-xl);
            font-weight: 700;
            font-size: var(--font-size-xl);
        }
        
        .cart-total span:last-child {
            color: var(--primary-red);
        }
        
        .cart-actions {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-md);
        }
        
        .btn-outline-dark, .btn-dark {
            width: 100%;
            padding: 12px;
            border-radius: var(--radius-sm);
        }
        
        .btn-dark {
            background-color: var(--btn-bg);
            color: var(--btn-text);
            padding: 15px 35px;
            border-radius: 4px; 
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            border: 2px solid var(--btn-bg);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-dark:hover {
             background-color: transparent;
            color: var(--btn-bg);
            transform: translateY(-2px);
        }
        
        /* Responsive adjustments for side cart */
        @media (max-width: 576px) {
            .side-cart {
                max-width: 90%;
            }
        }
        
        @media (max-width: 400px) {
            .side-cart {
                max-width: 100%;
            }
        }
        
        /* Footer Styles - Updated with primary colors */
        .footer {
            background-color: var(--primary-navy);
            color: var(--text-white);
            padding: 60px 0 30px 0;
            margin-top: 80px;
        }
        
        /* Updated Footer Brand for 44:11 */
        .footer-brand {
            font-weight: 800;
            letter-spacing: 3px;
            font-size: var(--font-size-2xl);
            margin-bottom: var(--spacing-xl);
            display: block;
            text-decoration: none;
            background: linear-gradient(45deg, var(--text-primary), var(--text-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .footer-tagline {
            color: var(--text-light);
            font-size: var(--font-size-md);
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .footer-title {
            font-weight: 700;
            font-size: var(--font-size-md);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: var(--spacing-xl);
            color: var(--text-white);
            position: relative;
            padding-bottom: var(--spacing-md);
        }
        
        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background-color: var(--primary-red);
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: var(--text-light);
            text-decoration: none;
            font-size: var(--font-size-md);
            transition: all var(--transition-fast);
        }
        
        .footer-links a:hover {
            color: var(--primary-red);
            padding-left: 5px;
        }
        
        .newsletter-form {
            display: flex;
            gap: var(--spacing-md);
            margin-top: var(--spacing-xl);
        }
        
        .newsletter-input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid var(--border-dark);
            background: transparent;
            color: var(--text-white);
            border-radius: var(--radius-sm);
            font-size: var(--font-size-md);
        }
        
        .newsletter-input::placeholder {
            color: var(--text-light);
        }
        
        .newsletter-input:focus {
            border-color: var(--primary-red);
            outline: none;
        }
        
        .newsletter-btn {
            background: var(--primary-red);
            color: var(--text-white);
            border: none;
            padding: 0 20px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: var(--font-size-sm);
            cursor: pointer;
            transition: all var(--transition-normal);
        }
        
        .newsletter-btn:hover {
            background: #8a8a8a;
        }
        
        .social-icons {
            display: flex;
            gap: var(--spacing-xl);
            margin-top: var(--spacing-xl);
        }
        
        .social-icon {
            color: var(--text-light);
            font-size: var(--font-size-2xl);
            transition: all var(--transition-fast);
        }
        
        .social-icon:hover {
            color: var(--primary-red);
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            border-top: 1px solid var(--border-dark);
            margin-top: 50px;
            padding-top: var(--spacing-xl);
        }
        
        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: var(--spacing-xl);
        }
        
        .copyright {
            color: var(--text-light);
            font-size: var(--font-size-sm);
        }
        
        .payment-methods {
            display: flex;
            gap: var(--spacing-md);
        }
        
        .payment-icon {
            color: var(--text-light);
            font-size: 1.5rem;
            transition: color var(--transition-fast);
        }
        
        .payment-icon:hover {
            color: var(--primary-red);
        }
        
        .footer-links-bottom {
            display: flex;
            gap: 25px;
        }
        
        .footer-links-bottom a {
            color: var(--text-light);
            text-decoration: none;
            font-size: var(--font-size-sm);
            transition: color var(--transition-fast);
        }
        
        .footer-links-bottom a:hover {
            color: var(--primary-red);
        }
        
        /* Mobile Footer */
        @media (max-width: 768px) {
            .footer {
                padding: 40px 0 20px 0;
            }
            
            .footer-title {
                margin-top: 30px;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-btn {
                padding: 12px 20px;
            }
            
            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .footer-links-bottom {
                justify-content: center;
            }
        }
        
        /* Hero Section - Updated with primary colors */
        .hero-section {
            position: relative;
            height: 85vh;
            background-image: url('../img/image.png');
            background-size: cover;
            background-position: center top;
            display: flex;
            align-items: center;
        }
        .hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(90deg, rgba(163, 163, 163, 0.1) 0%, rgba(163, 163, 163, 0) 100%);
        }
        .hero-content {
            position: relative;
            z-index: 2;
            padding-left: 5%;
            max-width: 600px;
        }
        .hero-title {
            font-size: var(--font-size-4xl);
            font-weight: 800;
            line-height: 1.1;
            text-transform: uppercase;
            color: var(--text-white);
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            margin-bottom: 1rem;
        }
        .hero-subtitle {
            color: var(--text-white);
            font-weight: 500;
            margin-bottom: 2rem;
            text-shadow: 0 1px 5px rgba(0,0,0,0.3);
        }
        .btn-custom {
            border-radius: var(--radius-lg);
            padding: 10px 30px;
            font-size: var(--font-size-sm);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
            margin-right: var(--spacing-md);
            transition: all var(--transition-normal);
        }
        .btn-light-custom {
            background: var(--primary-red);
            color: var(--text-white);
            border: 1px solid var(--primary-red);
        }
        
        .btn-light-custom:hover {
            background: #8a8a8a;
            border-color: #8a8a8a;
        }
        
        .btn-outline-custom {
            background: transparent;
            color: var(--text-white);
            border: 2px solid var(--text-white);
        }
        .btn-outline-custom:hover {
            background: var(--text-white);
            color: var(--primary-navy);
        }
        /* Add to Cart Button - Updated with primary colors */
        .add-to-cart-btn {
            background-color: transparent;
            color: var(--btn-bg);
            border: 2px solid var(--btn-bg);
            border-radius: var(--radius-sm);
            padding: 8px 16px;
            font-size: var(--font-size-sm);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: var(--spacing-md);
            width: 100%;
            transition: all var(--transition-normal);
        }
        .add-to-cart-btn:hover {
            background-color: var(--btn-bg);
            color: var(--text-white);
            transform: translateY(-2px);
        }
        .add-to-cart-btn:active {
            transform: translateY(0);
        }
        .add-to-cart-btn.added {
            background-color: var(--accent-green);
        }
        /* Product Cards */
        .product-card {
            border: none;
            margin-bottom: var(--spacing-2xl);
            transition: transform var(--transition-normal);
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-img-wrapper {
            position: relative;
            background: #F4F4F4;
            height: 400px;
            overflow: hidden;
            margin-bottom: var(--spacing-xl);
            border-radius: var(--radius-md);
        }
        .product-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-slow);
        }
        
        .product-card:hover .product-img-wrapper img {
            transform: scale(1.05);
        }
        
        .badge-custom {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: var(--spacing-xs) var(--spacing-md);
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: 600;
            border-radius: var(--radius-sm);
        }
        .badge-sale { background-color: var(--primary-red); color: var(--text-white); }
        .badge-popular { background-color: var(--accent-yellow); color: var(--text-primary); }
        .badge-new { background-color: var(--accent-blue); color: var(--text-white); }
        .product-title {
            font-size: var(--font-size-md);
            font-weight: 600;
            margin-bottom: 5px;
        }
        .product-price {
            font-size: var(--font-size-md);
            color: var(--primary-red);
            font-weight: 600;
        }
        .old-price {
            text-decoration: line-through;
            color: var(--text-light);
            margin-right: 5px;
        }
        /* Swatches & Sizes */
        .color-swatch {
            width: 12px;
            height: 12px;
            border-radius: var(--radius-circle);
            display: inline-block;
            margin-right: 5px;
            border: 1px solid var(--border-light);
            cursor: pointer;
            transition: transform var(--transition-fast);
        }
        
        .color-swatch:hover {
            transform: scale(1.2);
        }
        
        .color-swatch.selected {
            border: 2px solid var(--primary-red);
            transform: scale(1.2);
        }
        .size-selector {
            font-size: 0.65rem;
            color: var(--text-light);
            border: 1px solid var(--border-light);
            padding: 2px 4px;
            margin-right: 2px;
            display: inline-block;
            background: var(--bg-white);
            cursor: pointer;
            border-radius: 2px;
            transition: all var(--transition-fast);
        }
        
        .size-selector:hover {
            border-color: var(--primary-red);
            color: var(--primary-red);
        }
        
        .size-selector.selected {
            background-color: var(--primary-red);
            color: var(--text-white);
            border-color: var(--primary-red);
        }
        /* FlexFit Feature Section */
        .feature-section {
            margin-top: 80px;
            margin-bottom: 80px;
        }
        .feature-img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }
        .feature-content {
            padding: var(--spacing-2xl);
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        .feature-label {
            font-size: var(--font-size-sm);
            color: var(--primary-red);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: var(--spacing-md);
            font-weight: 600;
        }
        .feature-title {
            font-size: var(--font-size-3xl);
            font-weight: 800;
            text-transform: uppercase;
            line-height: 1.1;
            margin-bottom: var(--spacing-xl);
        }
        .btn-black {
            background-color: var(--primary-navy);
            color: var(--text-white);
            border-radius: var(--radius-lg);
            padding: 12px 40px;
            text-transform: uppercase;
            font-size: var(--font-size-sm);
            font-weight: 600;
            width: fit-content;
            border: none;
        }
        .btn-black:hover {
            background-color: #333333;
            color: var(--text-white);
        }
        /* Testimonials - Updated with primary colors */
        .testimonial-box {
            text-align: center;
            padding: var(--spacing-xl);
            border-radius: var(--radius-md);
            transition: all var(--transition-normal);
        }
        
        .testimonial-box:hover {
            box-shadow: 0 5px 15px rgba(163, 163, 163, 0.1);
            transform: translateY(-5px);
        }
        
        .stars {
            color: var(--primary-red);
            margin-bottom: var(--spacing-md);
            font-size: var(--font-size-2xl);
        }
        .testimonial-text {
            font-size: var(--font-size-md);
            font-weight: 600;
        }
        .testimonial-sub {
            font-size: var(--font-size-sm);
            color: var(--primary-red);
            font-weight: 500;
        }
        /* Chat Widget - Updated with primary colors */
        .chat-widget {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: var(--primary-navy);
            color: var(--text-white);
            width: 50px;
            height: 50px;
            border-radius: var(--radius-circle);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-2xl);
            cursor: pointer;
            z-index: var(--z-chatwidget);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: all var(--transition-normal);
        }
        
        .chat-widget:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
            background-color: var(--primary-red);
        }
        
        /* Mobile adjustments */
        @media (max-width: 768px) {
            .hero-title { font-size: 2.5rem; }
            .product-img-wrapper { height: 250px; }
            .feature-img { height: 300px; }
        }
        
        /* VIEW ALL link */
        a.text-decoration-none.text-dark.fw-bold {
            color: var(--primary-red) !important;
            transition: all var(--transition-normal);
        }
        
        a.text-decoration-none.text-dark.fw-bold:hover {
            color: #8a8a8a !important;
            padding-right: 5px;
        }
        
        /* View All link in Hot Right Now section */
        .view-all-link {
            color: var(--primary-red) !important;
            text-decoration: none;
            font-weight: 600;
            transition: all var(--transition-normal);
        }
        
        .view-all-link:hover {
            color: #8a8a8a !important;
            padding-right: 5px;
        }
        
        /* Additional styles for primary colors integration */
        .bi-search, .bi-person, .bi-bag {
            color: var(--primary-navy);
            transition: color var(--transition-normal);
        }
        
        .bi-search:hover, .bi-person:hover, .bi-bag:hover {
            color: var(--primary-red);
        }
        
        .btn-outline-dark {
            border-color: var(--primary-navy);
            color: var(--primary-navy);
        }
        
        .btn-outline-dark:hover {
            background-color: var(--primary-navy);
            color: var(--text-white);
        }
    </style>
</head>
<body>
    <!-- Top Promo Bar -->
    <div class="top-bar text-center">
        Free Delivery on orders above $100
    </div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top py-3">
        <div class="container">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <a class="navbar-brand" href="index.php">44:11</a>
            
            <!-- Mobile Icons Container -->
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
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                </ul>
                
                <div class="mobile-currency d-lg-none">
                    <div class="currency-selector" id="mobile-currency-toggle">
                        Currency: <span id="mobile-currency-text">USD $</span> <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </div>
            
            <!-- Desktop Icons -->
            <div class="nav-icons d-none d-lg-flex align-items-center">
                <!-- Currency Dropdown -->
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
                
                <!-- Search Dropdown -->
                <div class="position-relative">
                    <i class="bi bi-search" id="desktop-search-toggle"></i>
                    <div class="search-dropdown" id="desktop-search-dropdown">
                        <form class="search-form" id="desktop-search-form">
                            <input type="text" class="search-input" placeholder="Search products..." id="desktop-search-input">
                            <button type="submit" class="search-btn">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                        <div class="search-suggestions">
                            <div class="suggestion-title">Popular Searches</div>
                            <a href="#" class="suggestion-item">Leggings</a>
                            <a href="#" class="suggestion-item">Sports Bras</a>
                            <a href="#" class="suggestion-item">Training Sets</a>
                            <a href="#" class="suggestion-item">Accessories</a>
                        </div>
                    </div>
                </div>
                
                <a href="profile.html"><i class="bi bi-person"></i></a>
                
                <div class="position-relative">
                    <i class="bi bi-bag cart-icon" id="open-side-cart-desktop"></i>
                    <span id="cart-count-desktop" class="cart-count">0</span>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Search Dropdown -->
    <div class="mobile-search-dropdown d-xl-none" id="mobile-search-dropdown">
        <form class="mobile-search-form" id="mobile-search-form">
            <input type="text" class="mobile-search-input" placeholder="Search products..." id="mobile-search-input">
            <button type="submit" class="mobile-search-btn">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
    