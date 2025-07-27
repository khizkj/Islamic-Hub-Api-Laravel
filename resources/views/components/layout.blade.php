<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $heading ?? 'Islamic API Hub' }} - Islamic Resources</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri+Quran:wght@400;700&family=Lora:wght@400;500;600&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #14532d;
            --secondary-color: #166534;
            --accent-color: #a3e635;
            --text-dark: #1c1c1c;
            --text-light: #6b7280;
            --bg-light: #f0fdf4;
            --border-color: #d1fae5;
            --shadow: 0 4px 15px rgba(20, 83, 45, 0.1);
            --shadow-hover: 0 8px 25px rgba(22, 101, 52, 0.15);
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        body.dark-mode .api-card {
            background: #2d3748;
            color: white;
        }

        body.dark-mode .api-card .card-title,
        body.dark-mode .api-card .card-text {
            color: white;
        }

        body.dark-mode .features-list {
            background: rgba(255, 255, 255, 0.1);
        }

        body.dark-mode .features-text {
            color: rgba(255, 255, 255, 0.8);
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: var(--shadow);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            margin: 0 0.2rem;
        }

        .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.3);
            color: white !important;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="star" viewBox="0,0,10,10" width="10%" height="10%"><polygon points="5,0 7,3 10,3 8,5 9,8 5,6 1,8 2,5 0,3 3,3" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23star)"/></svg>') repeat;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .page-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .page-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            font-weight: 300;
        }

        .main-content {
            padding: 2rem 0;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            background: white;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        .card-body {
            padding: 2rem;
        }

        .card-title {
            font-family: 'Amiri Quran', serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .card-subtitle {
            color: var(--text-light);
            font-weight: 500;
            margin-bottom: 0.8rem;
        }

        .card-text {
            color: var(--text-light);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .btn-chapter,
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 25px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-chapter:hover,
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 139, 87, 0.4);
            color: white;
        }

        .btn-outline-secondary {
            border: 2px solid var(--border-color);
            border-radius: 25px;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .product-grid {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .product-grid:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .product-content {
            padding: 2rem;
        }

        .product-content .title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
            color: var(--text-dark);
        }

        .product-content .price {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .product-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .product-links a {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .product-links a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 139, 87, 0.4);
        }

        .search-container {
            background: white;
            border-radius: 50px;
            box-shadow: var(--shadow);
            padding: 0.5rem;
            margin-bottom: 2rem;
        }

        .search-container input {
            border: none;
            background: transparent;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
        }

        .search-container input:focus {
            outline: none;
            box-shadow: none;
        }

        .info-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .footer {
            background: var(--text-dark);
            color: white;
            padding: 3rem 0 2rem;
            margin-top: 4rem;
        }

        .footer-section h5 {
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--accent-color);
        }

        .theme-toggle {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        /* Dark mode styles */
        body.dark-mode {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #ffffff;
        }

        body.dark-mode .card,
        body.dark-mode .product-grid,
        body.dark-mode .info-section,
        body.dark-mode .search-container {
            background: #2d3748;
            color: #ffffff;
        }

        body.dark-mode .card-title,
        body.dark-mode .product-content .title {
            color: #ffffff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .hero-section {
                padding: 2rem 0;
            }

            .card-body,
            .product-content {
                padding: 1.5rem;
            }
        }

        /* Animation for page load */
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Pagination Styles */
        .pagination {
            justify-content: center;
            margin-top: 2rem;
        }

        .page-link {
            color: var(--primary-color);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            margin: 0 0.2rem;
            padding: 0.6rem 1rem;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-mosque me-2"></i>
                Islamic API Hub
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('quran*') ? 'active' : '' }}" href="/quran">
                            <i class="fas fa-book me-1"></i> Quran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('hadith*') || request()->is('chapters*') ? 'active' : '' }}"
                            href="/hadith">
                            <i class="fas fa-scroll me-1"></i> Hadith
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('prayer*') ? 'active' : '' }}" href="/prayer-times">
                            <i class="fas fa-clock me-1"></i> Prayer Times
                        </a>
                    </li>
                    <li class="nav-item">
                        <button class="theme-toggle" onclick="toggleTheme()">
                            <i class="fas fa-moon" id="theme-icon"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    @if (isset($heading))
        <section class="hero-section">
            <div class="container hero-content text-center">
                <h1 class="page-title">{{ $heading }}</h1>
                @if (isset($subtitle))
                    <p class="page-subtitle">{{ $subtitle }}</p>
                @endif
            </div>
        </section>
    @endif

    <!-- Main Content -->
    <main class="main-content">
        <div class="container fade-in">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-section">
                        <h5>Islamic API Hub</h5>
                        <p>Comprehensive Islamic resources including Quran, Hadith, and Prayer Times APIs.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-section">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="/quran">📖 Quran</a></li>
                            <li><a href="/hadith">📜 Hadith</a></li>
                            <li><a href="/prayer-times">🕌 Prayer Times</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-section">
                        <h5>Connect with me</h5>
                        <div class="social-links">
                            <a href="https://github.com/khizkj" target="_blank" id="github-link">
                                <i class="fab fa-github me-3"></i>
                            </a>
                            <a href="https://linkedin.com/in/khizer-j-kj" target="_blank" id="linkedin-link">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.2);">
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; {{ date('Y') }} Islamic API Hub. Made by Khizer Jamil.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme Toggle Script -->
    <script>
        function toggleTheme() {
            const body = document.body;
            const themeIcon = document.getElementById('theme-icon');

            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                themeIcon.className = 'fas fa-sun';
                localStorage.setItem('theme', 'dark');
            } else {
                themeIcon.className = 'fas fa-moon';
                localStorage.setItem('theme', 'light');
            }
        }

        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            const themeIcon = document.getElementById('theme-icon');

            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                themeIcon.className = 'fas fa-sun';
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
