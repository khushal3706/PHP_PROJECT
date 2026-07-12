<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Spatial UI</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        /* Animated Deep Dark Gradient Background */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body {
            background: linear-gradient(-45deg, #020617, #0f172a, #1e1b4b, #172554);
            background-size: 400% 400%;
            animation: gradientBG 20s ease infinite;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Spatial Glass Panel Utility */
        .glass-panel {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(20px) saturate(150%);
            -webkit-backdrop-filter: blur(20px) saturate(150%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8), 
                        0 0 30px rgba(255, 255, 255, 0.03) inset;
        }

        /* Form Inputs Inside Glass Panel */
        .glass-panel .form-control {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transition: all 0.3s ease;
        }
        
        .glass-panel .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(99, 102, 241, 0.6);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
            color: #ffffff;
        }
        
        .glass-panel .form-floating label {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Floating Navbar */
        .glass-navbar {
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Gradient Text Utility */
        .text-gradient {
            background: linear-gradient(to right, #60a5fa, #a78bfa, #f472b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Glowing Button */
        .btn-glow {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border: none;
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-glow:hover {
            box-shadow: 0 0 25px rgba(124, 58, 237, 0.7);
            transform: translateY(-2px);
            color: white;
        }
        
        /* Split Screen Utility */
        .min-vh-100-nav {
            min-height: calc(100vh - 72px);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark glass-navbar sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold fs-4 text-gradient" href="index.php">✨ AI Portal</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-medium">
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="register.php">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>