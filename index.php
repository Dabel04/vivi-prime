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
            
            <a class="navbar-brand" href="#">44:11</a>
            
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
                    <li class="nav-item"><a class="nav-link" href="shop.html">Shop</a></li>
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
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Elegance In<br>Every Movement</h1>
                <p class="hero-subtitle">Where style meets your workout.</p>
                <div class="d-flex">
                    <button class="btn btn-light-custom shop-now">Shop Tops</button>
                    <button class="btn btn-outline-custom shop-now">Shop Bottoms</button>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Categories Section -->
    <section class="container">
        <h2 class="section-header">Shop The Essentials</h2>
        
        <!-- Desktop Grid (4 columns) -->
        <div class="row category-grid">
            <!-- Col 1 -->
            <div class="col-md-3">
                <div class="category-card shop-now">
                    <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=2070&auto=format&fit=crop" alt="Tops">
                    <div class="category-text">Tops</div>
                </div>
            </div>
            <!-- Col 2 -->
            <div class="col-md-3">
                <div class="category-card shop-now">
                    <img src="img/bottoms.jpg" alt="Bottoms">
                    <div class="category-text">Bottoms</div>
                </div>
            </div>
            <!-- Col 3 -->
            <div class="col-md-3">
                <div class="category-card shop-now">
                    <img src="img/bras.jpg" alt="Sports Bras">
                    <div class="category-text">Sports Bras</div>
                </div>
            </div>
            <!-- Col 4 -->
            <div class="col-md-3">
                <div class="category-card shop-now">
                    <img src="https://images.unsplash.com/photo-1623945419356-9d3298c4d29a?q=80&w=2070&auto=format&fit=crop" alt="Accessories">
                    <div class="category-text">Accessories</div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Slider -->
        <div class="categories-slider">
            <div class="categories-scroll-container" id="categories-scroll">
                <!-- Slide 1 -->
                <div class="category-slide">
                    <div class="category-card shop-now">
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=2070&auto=format&fit=crop" alt="Tops">
                        <div class="category-text">Tops</div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="category-slide">
                    <div class="category-card shop-now">
                        <img src="img/bottoms.jpg" alt="Bottoms">
                        <div class="category-text">Bottoms</div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="category-slide">
                    <div class="category-card shop-now">
                        <img src="img/bras.jpg" alt="Sports Bras">
                        <div class="category-text">Sports Bras</div>
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="category-slide">
                    <div class="category-card shop-now">
                        <img src="img/ass.jpg" alt="Accessories">
                        <div class="category-text">Accessories</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Hot Right Now Section -->
    <section class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-header mb-0 mt-5">Hot Right Now</h2>
            <a href="#" class="view-all-link" style="font-size: 0.8rem;">VIEW ALL ></a>
        </div>
        <div class="row">
            <!-- Product 1 -->
            <div class="col-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <span class="badge badge-custom badge-sale">Save $20</span>
                        <img src="img/leggings.jpg" alt="Leggings">
                    </div>
                    <div class="product-title">High-Waist Training Leggings</div>
                    <div class="product-price"><span class="old-price">$69.00</span> $49.00</div>
                    <div class="mt-2">
                        <span class="color-swatch selected" style="background: #000;"></span>
                        <span class="color-swatch" style="background: #555;"></span>
                    </div>
                    <div class="mt-1">
                        <button class="size-selector selected">XS</button>
                        <button class="size-selector">S</button>
                        <button class="size-selector">M</button>
                    </div>
                    <button class="add-to-cart-btn" data-product-id="1" data-product-name="High-Waist Training Leggings" data-product-price="49.00" data-product-image="https://images.unsplash.com/photo-1506619216599-9d939743f39d?q=80&w=2070&auto=format&fit=crop">Add to Cart</button>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="col-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <span class="badge badge-custom badge-popular">Popular</span>
                        <img src="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?q=80&w=2070&auto=format&fit=crop" alt="Bra">
                    </div>
                    <div class="product-title">Ribbed Performance Set</div>
                    <div class="product-price">$58.00</div>
                    <div class="mt-2">
                        <span class="color-swatch selected" style="background: #fff; border: 1px solid #ccc;"></span>
                        <span class="color-swatch" style="background: #000;"></span>
                    </div>
                    <div class="mt-1">
                        <button class="size-selector selected">XS</button>
                        <button class="size-selector">S</button>
                        <button class="size-selector">M</button>
                        <button class="size-selector">L</button>
                    </div>
                    <button class="add-to-cart-btn" data-product-id="2" data-product-name="Ribbed Performance Set" data-product-price="58.00" data-product-image="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?q=80&w=2070&auto=format&fit=crop">Add to Cart</button>
                </div>
            </div>
            <!-- Product 3 -->
            <div class="col-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <span class="badge badge-custom badge-popular">Popular</span>
                        <img src="https://images.unsplash.com/photo-1518310383802-640c2de311b2?q=80&w=2070&auto=format&fit=crop" alt="Tights">
                    </div>
                    <div class="product-title">High-Rise Athletic Tights</div>
                    <div class="product-price">$61.00</div>
                    <div class="mt-2">
                        <span class="color-swatch selected" style="background: #D2B48C;"></span>
                    </div>
                    <div class="mt-1">
                        <button class="size-selector selected">S</button>
                        <button class="size-selector">M</button>
                        <button class="size-selector">L</button>
                    </div>
                    <button class="add-to-cart-btn" data-product-id="3" data-product-name="High-Rise Athletic Tights" data-product-price="61.00" data-product-image="https://images.unsplash.com/photo-1518310383802-640c2de311b2?q=80&w=2070&auto=format&fit=crop">Add to Cart</button>
                </div>
            </div>
            <!-- Product 4 -->
            <div class="col-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <span class="badge badge-custom badge-new">New</span>
                        <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?q=80&w=2070&auto=format&fit=crop" alt="Bra">
                    </div>
                    <div class="product-title">Full-Support Sports Bra</div>
                    <div class="product-price">$42.00</div>
                    <div class="mt-2">
                        <span class="color-swatch selected" style="background: #ADD8E6;"></span>
                        <span class="color-swatch" style="background: #FFB6C1;"></span>
                    </div>
                    <div class="mt-1">
                        <button class="size-selector selected">XS</button>
                        <button class="size-selector">S</button>
                        <button class="size-selector">M</button>
                    </div>
                    <button class="add-to-cart-btn" data-product-id="4" data-product-name="Full-Support Sports Bra" data-product-price="42.00" data-product-image="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?q=80&w=2070&auto=format&fit=crop">Add to Cart</button>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Feature Section -->
    <section class="feature-section">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?q=80&w=2069&auto=format&fit=crop" class="feature-img" alt="FlexFit">
                </div>
                <div class="col-md-6 bg-light">
                    <div class="feature-content">
                        <span class="feature-label">Perfect Stretch, Perfect Fit</span>
                        <h2 class="feature-title">Discover FlexFit Freedom</h2>
                        <p class="mb-4 text-muted">Introducing FlexFit: our breakthrough activewear material. It effortlessly adapts to your form for a tailor-made fit without the squeeze. Move with ease and style in every stride.</p>
                        <button class="btn btn-black shop-now">Shop Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Testimonials -->
    <section class="container mb-5">
        <h5 class="fw-bold text-uppercase mb-4">What Do Our Customers Say?</h5>
        <div class="row">
            <div class="col-md-4 testimonial-box">
                <div class="stars">★★★★★</div>
                <div class="testimonial-text">"Love these for the gym!"</div>
                <div class="testimonial-sub">Verified Buyer</div>
            </div>
            <div class="col-md-4 testimonial-box">
                <div class="stars">★★★★★</div>
                <div class="testimonial-text">"Sweat? No Problem!"</div>
                <div class="testimonial-sub">Verified Buyer</div>
            </div>
            <div class="col-md-4 testimonial-box">
                <div class="stars">★★★★★</div>
                <div class="testimonial-text">"Stylish and Functional"</div>
                <div class="testimonial-sub">Verified Buyer</div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Brand & Description -->
                <div class="col-lg-4 col-md-6 mb-5">
                    <a href="#" class="footer-brand">44:11</a>
                    <p class="footer-tagline">
                        Elevate your workout with premium activewear designed for performance and style. 
                        Experience the perfect blend of comfort, durability, and elegance in every piece.
                    </p>
                    <div class="newsletter-form">
                        <input type="email" class="newsletter-input" placeholder="Your email address">
                        <button type="submit" class="newsletter-btn">Subscribe</button>
                    </div>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-pinterest"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-5">
                    <h6 class="footer-title">Shop</h6>
                    <ul class="footer-links">
                        <li><a href="#">Tops</a></li>
                        <li><a href="#">Bottoms</a></li>
                        <li><a href="#">Sports Bras</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="#">Best Sellers</a></li>
                    </ul>
                </div>
                
                <!-- Support -->
                <div class="col-lg-2 col-md-6 mb-5">
                    <h6 class="footer-title">Support</h6>
                    <ul class="footer-links">
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Size Guide</a></li>
                        <li><a href="#">Care Instructions</a></li>
                    </ul>
                </div>
                
                <!-- Company -->
                <div class="col-lg-2 col-md-6 mb-5">
                    <h6 class="footer-title">Company</h6>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Sustainability</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Wholesale</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-2 col-md-6 mb-5">
                    <h6 class="footer-title">Contact</h6>
                    <ul class="footer-links">
                        <li><a href="mailto:hello@44eleven.com">hello@44eleven.com</a></li>
                        <li><a href="tel:+18005551234">1-800-555-1234</a></li>
                        <li>Mon-Fri: 9am-6pm EST</li>
                        <li>123 Active Street</li>
                        <li>New York, NY 10001</li>
                    </ul>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        &copy; 2024 44:11 Activewear. All rights reserved.
                    </div>
                    
                    <div class="footer-links-bottom">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Cookie Policy</a>
                        <a href="#">Accessibility</a>
                    </div>
                    
                    <div class="payment-methods">
                        <i class="bi bi-credit-card payment-icon"></i>
                        <i class="bi bi-paypal payment-icon"></i>
                        <i class="bi bi-google payment-icon"></i>
                        <i class="bi bi-apple payment-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Side Cart (Right Sliding Panel) -->
    <div class="side-cart-overlay" id="cart-overlay"></div>
    
    <div class="side-cart" id="side-cart">
        <div class="side-cart-header">
            <h3 class="side-cart-title">Your Shopping Cart</h3>
            <button class="side-cart-close" id="close-side-cart">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="side-cart-body">
            <div id="cart-items-container">
                <!-- Cart items will be dynamically added here -->
                <div class="text-center py-4" id="empty-cart-message">
                    <i class="bi bi-bag" style="font-size: 2rem; color: #ccc;"></i>
                    <p class="mt-2">Your cart is empty</p>
                </div>
            </div>
        </div>
        <div class="side-cart-footer">
            <div class="cart-total">
                <span>Total:</span>
                <span>$<span id="cart-total-price">0.00</span></span>
            </div>
            <div class="cart-actions">
                <button type="button" class="btn btn-outline-dark" id="continue-shopping">Continue Shopping</button>
                <button type="button" class="btn btn-dark" id="checkout-btn">Checkout</button>
            </div>
        </div>
    </div>
    
    <!-- Chat Widget -->
    <div class="chat-widget">
        <i class="bi bi-chat-dots-fill"></i>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Cart JavaScript -->
    <script>
        // Cart functionality
        class ShoppingCart {
            constructor() {
                this.cart = JSON.parse(localStorage.getItem('44eleven_cart')) || [];
                this.currentCurrency = localStorage.getItem('44eleven_currency') || 'USD';
                this.init();
            }
            
            init() {
                this.bindEvents();
                this.updateCartCount();
                this.updateCartModal();
                this.setupMobileSlider();
                this.setupDropdowns();
                this.updateCurrencyDisplay();
            }
            
            bindEvents() {
                // Add to Cart buttons
                document.addEventListener('click', (e) => {
                    if (e.target.classList.contains('add-to-cart-btn')) {
                        this.addToCart(e.target);
                    }
                    
                    // Shop Now buttons
                    if (e.target.classList.contains('shop-now') || e.target.closest('.shop-now')) {
                        this.handleShopNow(e);
                    }
                    
                    // Size selectors
                    if (e.target.classList.contains('size-selector')) {
                        this.selectSize(e.target);
                    }
                    
                    // Color swatches
                    if (e.target.classList.contains('color-swatch')) {
                        this.selectColor(e.target);
                    }
                    
                    // Remove item from cart
                    if (e.target.classList.contains('cart-item-remove') || e.target.closest('.cart-item-remove')) {
                        const button = e.target.classList.contains('cart-item-remove') ? 
                            e.target : e.target.closest('.cart-item-remove');
                        this.removeFromCart(button.dataset.itemId);
                    }
                });
                
                // Checkout button
                document.getElementById('checkout-btn').addEventListener('click', () => {
                    this.checkout();
                });
                
                // Continue shopping button
                document.getElementById('continue-shopping').addEventListener('click', () => {
                    this.closeSideCart();
                });
                
                // Open side cart buttons
                document.getElementById('open-side-cart').addEventListener('click', () => {
                    this.openSideCart();
                });
                
                document.getElementById('open-side-cart-desktop').addEventListener('click', () => {
                    this.openSideCart();
                });
                
                // Close side cart buttons
                document.getElementById('close-side-cart').addEventListener('click', () => {
                    this.closeSideCart();
                });
                
                document.getElementById('cart-overlay').addEventListener('click', () => {
                    this.closeSideCart();
                });
                
                // Search form submissions
                document.getElementById('desktop-search-form').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.handleSearch();
                });
                
                document.getElementById('mobile-search-form').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.handleMobileSearch();
                });
                
                // Newsletter subscription
                document.querySelector('.newsletter-btn').addEventListener('click', (e) => {
                    e.preventDefault();
                    this.handleNewsletter();
                });
            }
            
            setupDropdowns() {
                // Desktop search toggle
                document.getElementById('desktop-search-toggle').addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleDesktopSearch();
                });
                
                // Mobile search toggle
                document.getElementById('mobile-search-toggle').addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleMobileSearch();
                });
                
                // Desktop currency toggle
                document.getElementById('desktop-currency-toggle').addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleDesktopCurrency();
                });
                
                // Mobile currency toggle
                document.getElementById('mobile-currency-toggle').addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.showCurrencyModal();
                });
                
                // Currency selection
                document.querySelectorAll('.currency-item').forEach(item => {
                    item.addEventListener('click', (e) => {
                        const currency = e.target.dataset.currency;
                        this.setCurrency(currency);
                        this.closeAllDropdowns();
                    });
                });
                
                // Close dropdowns when clicking outside
                document.addEventListener('click', () => {
                    this.closeAllDropdowns();
                });
                
                // Prevent dropdown close when clicking inside
                document.querySelectorAll('.search-dropdown, .currency-dropdown').forEach(dropdown => {
                    dropdown.addEventListener('click', (e) => {
                        e.stopPropagation();
                    });
                });
            }
            
            toggleDesktopSearch() {
                const dropdown = document.getElementById('desktop-search-dropdown');
                const isActive = dropdown.classList.contains('active');
                
                this.closeAllDropdowns();
                
                if (!isActive) {
                    dropdown.classList.add('active');
                    document.getElementById('desktop-search-input').focus();
                }
            }
            
            toggleMobileSearch() {
                const dropdown = document.getElementById('mobile-search-dropdown');
                const isActive = dropdown.classList.contains('active');
                
                if (isActive) {
                    dropdown.classList.remove('active');
                } else {
                    dropdown.classList.add('active');
                    document.getElementById('mobile-search-input').focus();
                }
            }
            
            toggleDesktopCurrency() {
                const dropdown = document.getElementById('desktop-currency-dropdown');
                const isActive = dropdown.classList.contains('active');
                
                this.closeAllDropdowns();
                
                if (!isActive) {
                    dropdown.classList.add('active');
                }
            }
            
            showCurrencyModal() {
                const currencies = ['USD', 'EUR', 'GBP', 'CAD'];
                let modalContent = '<div class="text-center p-3">';
                modalContent += '<h6 class="mb-3">Select Currency</h6>';
                
                currencies.forEach(currency => {
                    const isActive = currency === this.currentCurrency;
                    const symbol = this.getCurrencySymbol(currency);
                    modalContent += `
                        <button class="btn ${isActive ? 'btn-dark' : 'btn-outline-dark'} w-100 mb-2 currency-modal-item" 
                                data-currency="${currency}">
                            ${currency} ${symbol}
                        </button>
                    `;
                });
                
                modalContent += '</div>';
                
                // Create modal
                const modal = document.createElement('div');
                modal.className = 'modal fade show d-block';
                modal.style.backgroundColor = 'rgba(0,0,0,0.5)';
                modal.innerHTML = `
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">Select Currency</h5>
                                <button type="button" class="btn-close" id="close-currency-modal"></button>
                            </div>
                            <div class="modal-body">
                                ${modalContent}
                            </div>
                        </div>
                    </div>
                `;
                
                document.body.appendChild(modal);
                document.body.style.overflow = 'hidden';
                
                // Add event listeners
                document.getElementById('close-currency-modal').addEventListener('click', () => {
                    this.closeCurrencyModal();
                });
                
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        this.closeCurrencyModal();
                    }
                });
                
                document.querySelectorAll('.currency-modal-item').forEach(item => {
                    item.addEventListener('click', (e) => {
                        const currency = e.target.dataset.currency;
                        this.setCurrency(currency);
                        this.closeCurrencyModal();
                    });
                });
            }
            
            closeCurrencyModal() {
                const modal = document.querySelector('.modal.show');
                if (modal) {
                    modal.remove();
                    document.body.style.overflow = '';
                }
            }
            
            closeAllDropdowns() {
                document.querySelectorAll('.search-dropdown.active, .currency-dropdown.active').forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
                
                document.getElementById('mobile-search-dropdown').classList.remove('active');
            }
            
            setCurrency(currency) {
                this.currentCurrency = currency;
                localStorage.setItem('44eleven_currency', currency);
                this.updateCurrencyDisplay();
                
                // Update active state in dropdown
                document.querySelectorAll('.currency-item').forEach(item => {
                    if (item.dataset.currency === currency) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
            }
            
            updateCurrencyDisplay() {
                const symbol = this.getCurrencySymbol(this.currentCurrency);
                const displayText = `${this.currentCurrency} ${symbol}`;
                
                document.getElementById('desktop-currency-text').textContent = displayText;
                document.getElementById('mobile-currency-text').textContent = displayText;
            }
            
            getCurrencySymbol(currency) {
                const symbols = {
                    'USD': '$',
                    'EUR': '€',
                    'GBP': '£',
                    'CAD': '$'
                };
                return symbols[currency] || '$';
            }
            
            handleSearch() {
                const query = document.getElementById('desktop-search-input').value.trim();
                if (query) {
                    alert(`Searching for: ${query}`);
                    // In real implementation, redirect to search results page
                    // window.location.href = `/search?q=${encodeURIComponent(query)}`;
                    this.closeAllDropdowns();
                }
            }
            
            handleMobileSearch() {
                const query = document.getElementById('mobile-search-input').value.trim();
                if (query) {
                    alert(`Searching for: ${query}`);
                    // In real implementation, redirect to search results page
                    // window.location.href = `/search?q=${encodeURIComponent(query)}`;
                    this.toggleMobileSearch();
                }
            }
            
            handleNewsletter() {
                const email = document.querySelector('.newsletter-input').value.trim();
                if (email && this.validateEmail(email)) {
                    alert(`Thank you for subscribing with ${email}!`);
                    document.querySelector('.newsletter-input').value = '';
                } else {
                    alert('Please enter a valid email address.');
                }
            }
            
            validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
            
            setupMobileSlider() {
                const scrollContainer = document.getElementById('categories-scroll');
                if (scrollContainer) {
                    let isDown = false;
                    let startX;
                    let scrollLeft;
                    
                    scrollContainer.addEventListener('mousedown', (e) => {
                        isDown = true;
                        startX = e.pageX - scrollContainer.offsetLeft;
                        scrollLeft = scrollContainer.scrollLeft;
                        scrollContainer.style.cursor = 'grabbing';
                    });
                    
                    scrollContainer.addEventListener('mouseleave', () => {
                        isDown = false;
                        scrollContainer.style.cursor = 'grab';
                    });
                    
                    scrollContainer.addEventListener('mouseup', () => {
                        isDown = false;
                        scrollContainer.style.cursor = 'grab';
                    });
                    
                    scrollContainer.addEventListener('mousemove', (e) => {
                        if (!isDown) return;
                        e.preventDefault();
                        const x = e.pageX - scrollContainer.offsetLeft;
                        const walk = (x - startX) * 2;
                        scrollContainer.scrollLeft = scrollLeft - walk;
                    });
                    
                    scrollContainer.addEventListener('touchstart', (e) => {
                        startX = e.touches[0].pageX - scrollContainer.offsetLeft;
                        scrollLeft = scrollContainer.scrollLeft;
                    });
                    
                    scrollContainer.addEventListener('touchmove', (e) => {
                        e.preventDefault();
                        const x = e.touches[0].pageX - scrollContainer.offsetLeft;
                        const walk = (x - startX) * 2;
                        scrollContainer.scrollLeft = scrollLeft - walk;
                    });
                }
            }
            
            openSideCart() {
                document.getElementById('side-cart').classList.add('active');
                document.getElementById('cart-overlay').classList.add('active');
                document.body.style.overflow = 'hidden';
                this.closeAllDropdowns();
            }
            
            closeSideCart() {
                document.getElementById('side-cart').classList.remove('active');
                document.getElementById('cart-overlay').classList.remove('active');
                document.body.style.overflow = '';
            }
            
            addToCart(button) {
                const productId = button.dataset.productId;
                const productName = button.dataset.productName;
                const productPrice = parseFloat(button.dataset.productPrice);
                const productImage = button.dataset.productImage;
                
                const productCard = button.closest('.product-card');
                const selectedSize = productCard.querySelector('.size-selector.selected').textContent;
                const selectedColor = productCard.querySelector('.color-swatch.selected').style.backgroundColor;
                
                const item = {
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    size: selectedSize,
                    color: selectedColor,
                    quantity: 1
                };
                
                const existingItemIndex = this.cart.findIndex(cartItem => 
                    cartItem.id === item.id && 
                    cartItem.size === item.size && 
                    cartItem.color === item.color
                );
                
                if (existingItemIndex > -1) {
                    this.cart[existingItemIndex].quantity++;
                } else {
                    this.cart.push(item);
                }
                
                this.saveCart();
                this.updateCartCount();
                this.updateCartModal();
                this.showAddedFeedback(button);
                this.openSideCart();
            }
            
            removeFromCart(itemId) {
                this.cart.splice(itemId, 1);
                this.saveCart();
                this.updateCartCount();
                this.updateCartModal();
            }
            
            saveCart() {
                localStorage.setItem('44eleven_cart', JSON.stringify(this.cart));
            }
            
            updateCartCount() {
                const totalItems = this.cart.reduce((total, item) => total + item.quantity, 0);
                document.getElementById('cart-count-mobile').textContent = totalItems;
                document.getElementById('cart-count-desktop').textContent = totalItems;
            }
            
            updateCartModal() {
                const container = document.getElementById('cart-items-container');
                const totalPrice = this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
                
                document.getElementById('cart-total-price').textContent = totalPrice.toFixed(2);
                
                if (this.cart.length === 0) {
                    container.innerHTML = `
                        <div class="text-center py-4" id="empty-cart-message">
                            <i class="bi bi-bag" style="font-size: 2rem; color: #ccc;"></i>
                            <p class="mt-2">Your cart is empty</p>
                        </div>
                    `;
                    return;
                }
                
                const emptyMessage = document.getElementById('empty-cart-message');
                if (emptyMessage) {
                    emptyMessage.remove();
                }
                
                let cartHTML = '';
                this.cart.forEach((item, index) => {
                    cartHTML += `
                        <div class="cart-item">
                            <img src="${item.image}" class="cart-item-img" alt="${item.name}">
                            <div class="cart-item-details">
                                <div class="cart-item-title">${item.name}</div>
                                <div class="cart-item-price">$${item.price.toFixed(2)} × ${item.quantity}</div>
                                <div class="small text-muted">Size: ${item.size} | Color: <span class="d-inline-block" style="width: 12px; height: 12px; border-radius: 50%; background-color: ${item.color};"></span></div>
                            </div>
                            <button class="cart-item-remove" data-item-id="${index}">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    `;
                });
                
                container.innerHTML = cartHTML;
            }
            
            selectSize(button) {
                const productCard = button.closest('.product-card');
                productCard.querySelectorAll('.size-selector').forEach(btn => {
                    btn.classList.remove('selected');
                });
                button.classList.add('selected');
            }
            
            selectColor(swatch) {
                const productCard = swatch.closest('.product-card');
                productCard.querySelectorAll('.color-swatch').forEach(s => {
                    s.classList.remove('selected');
                });
                swatch.classList.add('selected');
            }
            
            handleShopNow(e) {
                e.preventDefault();
                alert('Redirecting to shop page...');
            }
            
            showAddedFeedback(button) {
                const originalText = button.textContent;
                button.textContent = 'Added to Cart!';
                button.classList.add('added');
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('added');
                }, 1500);
            }
            
            checkout() {
                if (this.cart.length === 0) {
                    alert('Your cart is empty!');
                    return;
                }
                
                alert(`Proceeding to checkout with ${this.cart.length} item(s). Total: $${this.cart.reduce((total, item) => total + (item.price * item.quantity), 0).toFixed(2)}`);
                this.closeSideCart();
            }
        }
        
        // Initialize cart when page loads
        document.addEventListener('DOMContentLoaded', () => {
            window.cart = new ShoppingCart();
        });
    </script>
</body>
</html>