<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>44:11 Admin Login</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-body: #F4F5F7;
            --text-primary: #111111;
            --btn-primary: #000000;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--bg-body);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
        }

        .login-card {
            background: #FFFFFF;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 400px;
            text-align: center;
            border: 1px solid #E5E7EB;
        }

        .brand-logo {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 10px;
            display: block;
            color: var(--text-primary);
            text-decoration: none;
        }

        .login-subtitle {
            color: #6B7280;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        .form-control {
            background-color: #F9FAFB;
            border: 1px solid #E5E7EB;
            padding: 12px;
            font-size: 0.95rem;
            margin-bottom: 15px;
            border-radius: 6px;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
        }

        .btn-login {
            width: 100%;
            background-color: var(--btn-primary);
            color: #fff;
            padding: 12px;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background-color: #333;
            transform: translateY(-1px);
        }

        .forgot-link {
            font-size: 0.85rem;
            color: #6B7280;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
        }
        
        .forgot-link:hover { color: #000; }
    </style>
</head>
<body>

    <div class="login-card">
        <a href="#" class="brand-logo">44:11</a>
        <p class="login-subtitle">Sign in to manage your store</p>

        <form action="admin-dashboard.html"> <!-- Links to dashboard for demo -->
            <input type="email" class="form-control" placeholder="admin@4411.com" value="admin@4411.com" required>
            <input type="password" class="form-control" placeholder="••••••••" value="password" required>
            
            <button type="submit" class="btn-login">Sign In</button>
        </form>

        <a href="#" class="forgot-link">Forgot your password?</a>
    </div>

</body>
</html>