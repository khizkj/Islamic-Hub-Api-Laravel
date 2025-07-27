<x-layout>
    <x-slot:heading>🕌 Islamic API Hub</x-slot:heading>
    <x-slot:subtitle>Your comprehensive resource for Quran, Hadith, and Prayer Times</x-slot:subtitle>

    <!-- Welcome Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card welcome-card">
                <div class="card-body text-center py-5">
                    <h2 class="mb-4 welcome-title">📖 Welcome to Islamic API Hub</h2>
                    <p class="lead mb-4 welcome-text">Access authentic Islamic resources through our comprehensive APIs. Explore the Holy Quran, authentic Hadith collections, and accurate prayer times for your location.</p>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <i class="fas fa-book-open fa-3x welcome-icon mb-3"></i>
                            <h5 class="welcome-subtitle">114 Surahs</h5>
                            <p class="welcome-description">Complete Quran with translations</p>
                        </div>
                        <div class="col-md-4">
                            <i class="fas fa-scroll fa-3x welcome-icon mb-3"></i>
                            <h5 class="welcome-subtitle">Authentic Hadith</h5>
                            <p class="welcome-description">Major hadith collections</p>
                        </div>
                        <div class="col-md-4">
                            <i class="fas fa-clock fa-3x welcome-icon mb-3"></i>
                            <h5 class="welcome-subtitle">Prayer Times</h5>
                            <p class="welcome-description">Accurate timing for any location</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main APIs Section -->
    <div class="row">
        <!-- Quran API -->
<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card h-100 api-card">
        <div class="card-body d-flex flex-column">
            <div class="text-center mb-4">
                <i class="fas fa-book-quran fa-4x mb-3" style="color: #28a745;"></i>
            </div>
            <h4 class="card-title text-center">📖 Quran API</h4>
            <p class="card-text text-center flex-grow-1">
                Access the complete Holy Quran with Arabic text, English translations, and audio recitations. Search through all 114 Surahs with detailed information.
            </p>
            <div class="features-list mb-4">
                <small class="features-text">
                    <i class="fas fa-check text-success me-2"></i>Arabic text with proper formatting<br>
                    <i class="fas fa-check text-success me-2"></i>Multiple Languages Translation<br>
                    <i class="fas fa-check text-success me-2"></i>Audio recitations<br>
                    <i class="fas fa-check text-success me-2"></i>Search functionality
                </small>
            </div>
            <div class="text-center mt-auto">
                <a href="/quran" class="btn btn-chapter btn-lg">
                    <i class="fas fa-book-open me-2"></i>Explore Quran
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Hadith API -->
<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card h-100 api-card">
        <div class="card-body d-flex flex-column">
            <div class="text-center mb-4">
                <i class="fas fa-scroll fa-4x mb-3" style="color: #28a745;"></i>
            </div>
            <h4 class="card-title text-center">📜 Hadith API</h4>
            <p class="card-text text-center flex-grow-1">
                Browse authentic Hadith collections from major Islamic scholars. Organized by books and chapters with Arabic, Urdu, and English text.
            </p>
            <div class="features-list mb-4">
                <small class="features-text">
                    <i class="fas fa-check text-success me-2"></i>Multiple hadith books<br>
                    <i class="fas fa-check text-success me-2"></i>Organized by chapters<br>
                    <i class="fas fa-check text-success me-2"></i>Trilingual support<br>
                    <i class="fas fa-check text-success me-2"></i>Scholar information
                </small>
            </div>
            <div class="text-center mt-auto">
                <a href="/hadith" class="btn btn-chapter btn-lg">
                    <i class="fas fa-scroll me-2"></i>Browse Hadith
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Prayer Times API -->
<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card h-100 api-card">
        <div class="card-body d-flex flex-column">
            <div class="text-center mb-4">
                <i class="fas fa-mosque fa-4x mb-3" style="color: #28a745;"></i>
            </div>
            <h4 class="card-title text-center">🕌 Prayer Times API</h4>
            <p class="card-text text-center flex-grow-1">
                Get accurate prayer times based on your geographical location. Includes Hijri calendar dates and timezone information.
            </p>
            <div class="features-list mb-4">
                <small class="features-text">
                    <i class="fas fa-check text-success me-2"></i>Location-based timing<br>
                    <i class="fas fa-check text-success me-2"></i>All 5 daily prayers<br>
                    <i class="fas fa-check text-success me-2"></i>Hijri calendar<br>
                    <i class="fas fa-check text-success me-2"></i>Timezone support
                </small>
            </div>
            <div class="text-center mt-auto">
                <a href="/prayer-times" class="btn btn-chapter btn-lg">
                    <i class="fas fa-clock me-2"></i>View Prayer Times
                </a>
            </div>
        </div>
    </div>
</div>

    <!-- Quick Stats Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card stats-card">
                <div class="card-body">
                    <h3 class="text-center mb-4 stats-title">📊 API Statistics</h3>
                    <div class="row text-center">
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <h2 class="stats-number">114</h2>
                                <p class="mb-0 stats-text">Surahs Available</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <h2 class="stats-number">6,236</h2>
                                <p class="mb-0 stats-text">Quranic Verses</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <h2 class="stats-number">Multiple</h2>
                                <p class="mb-0 stats-text">Hadith Books</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <h2 class="stats-number">Global</h2>
                                <p class="mb-0 stats-text">Prayer Times</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .welcome-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
        }

        .welcome-card .card-body {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
        }

        .welcome-title,
        .welcome-text,
        .welcome-subtitle,
        .welcome-description {
            color: white;
        }

        .welcome-icon {
            color: white;
        }

        .api-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .api-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .stats-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
        }

        .stats-card .card-body {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
        }

        .stat-item {
            padding: 1rem;
        }

        .stats-title,
        .stats-number,
        .stats-text {
            color: white;
        }

        .stats-number {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .features-list {
            background: rgba(0,0,0,0.05);
            padding: 1rem;
            border-radius: 10px;
            border-left: 4px solid var(--primary-color);
        }

        .features-text {
            color: var(--text-light);
        }

        /* Dark mode styles */
        body.dark-mode .api-card {
            background: #2d3748;
            color: white;
        }

        body.dark-mode .api-card .card-title,
        body.dark-mode .api-card .card-text {
            color: white;
        }

        body.dark-mode .features-list {
            background: rgba(255,255,255,0.1);
        }

        body.dark-mode .features-text {
            color: rgba(255,255,255,0.8);
        }

        @media (max-width: 768px) {
            .stat-item {
                margin-bottom: 1rem;
            }
        }
    </style>
</x-layout>
