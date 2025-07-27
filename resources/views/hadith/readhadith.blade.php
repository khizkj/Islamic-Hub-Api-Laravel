<x-layout>
    <x-slot:heading>📜 احادیث / Hadiths</x-slot:heading>
    <x-slot:subtitle>Sacred teachings and guidance from Prophet Muhammad (ﷺ)</x-slot:subtitle>

    <!-- Navigation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="navigation-bar">
                <div class="d-flex justify-content-between align-items-center">
                    <button onclick="goBack()" class="btn btn-outline-success">
                        <i class="fas fa-arrow-left me-2"></i>Back to Chapters
                    </button>
                    <div class="hadith-info">
                        <span class="badge bg-success">{{ count($collection) }} Hadiths</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="search-container">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0">
                        <i class="fas fa-search text-success"></i>
                    </span>
                    <input type="text"
                           id="hadithSearchInput"
                           class="form-control border-0"
                           placeholder="🔍 Search hadiths by Arabic, English, or Urdu text..."
                           autocomplete="off">
                    <button class="btn btn-outline-success border-0" type="button" onclick="clearSearch()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Options -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card filter-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <label class="form-label text-white">Language Filter:</label>
                            <select id="languageFilter" class="form-select">
                                <option value="all">All Languages</option>
                                <option value="arabic">Arabic (العربية)</option>
                                <option value="english">English</option>
                                <option value="urdu">Urdu (اردو)</option>
                                <option value="french">French (Français)</option>
                                <option value="spanish">Spanish (Español)</option>
                                <option value="german">German (Deutsch)</option>
                                <option value="turkish">Turkish (Türkçe)</option>
                                <option value="indonesian">Indonesian (Bahasa Indonesia)</option>
                                <option value="malay">Malay (Bahasa Melayu)</option>
                                <option value="bengali">Bengali (বাংলা)</option>
                                <option value="hindi">Hindi (हिन्दी)</option>
                                <option value="persian">Persian (فارسی)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-white">View Mode:</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="viewMode" id="compactView" value="compact" checked>
                                <label class="btn btn-outline-light" for="compactView">
                                    <i class="fas fa-compress me-1"></i>Compact
                                </label>
                                <input type="radio" class="btn-check" name="viewMode" id="expandedView" value="expanded">
                                <label class="btn btn-outline-light" for="expandedView">
                                    <i class="fas fa-expand me-1"></i>Expanded
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-light" onclick="resetFilters()">
                                <i class="fas fa-refresh me-2"></i>Reset Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Info -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="results-info">
                <span id="resultsCount">Showing all {{ count($collection) }} Hadiths</span>
                <div class="float-end">
                    <span class="badge bg-success">Page <span id="currentPage">1</span></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Hadiths Container -->
    <div id="hadithsContainer" class="hadiths-container">
        @foreach ($collection as $index => $hadith)
            <div class="hadith-card-wrapper"
                 data-arabic="{{ strtolower($hadith['hadithArabic'] ?? '') }}"
                 data-english="{{ strtolower($hadith['hadithEnglish'] ?? '') }}"
                 data-urdu="{{ strtolower($hadith['hadithUrdu'] ?? '') }}"
                 data-number="{{ $hadith['hadithNumber'] ?? $index + 1 }}">
                <div class="card hadith-card">
                    <div class="card-header">
                        <div class="hadith-number">
                            <span class="badge bg-light text-success hadith-badge">
                                <i class="fas fa-scroll me-1"></i>
                                Hadith {{ $hadith['hadithNumber'] ?? $index + 1 }}
                            </span>
                        </div>
                        <div class="hadith-actions">
                            <button class="btn btn-sm btn-outline-light" onclick="bookmarkHadith({{ $hadith['hadithNumber'] ?? $index + 1 }})" title="Bookmark">
                                <i class="fas fa-bookmark"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-light" onclick="copyHadith({{ $index }})" title="Copy">
                                <i class="fas fa-copy"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-light" onclick="shareHadith({{ $hadith['hadithNumber'] ?? $index + 1 }})" title="Share">
                                <i class="fas fa-share"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Arabic Text -->
                        <div class="hadith-text arabic-text">
                            <h5 class="text-primary arabic-content">
                                <i class="fas fa-quote-right me-2"></i>
                                {{ $hadith['hadithArabic'] ?? 'النص العربي غير متوفر' }}
                            </h5>
                        </div>

                        <!-- English Text -->
                        <div class="hadith-text english-text">
                            <p class="english-content">
                                <strong>English:</strong>
                                {{ $hadith['hadithEnglish'] ?? 'English text not available' }}
                            </p>
                        </div>

                        <!-- Urdu Text -->
                        <div class="hadith-text urdu-text">
                            <p class="urdu-content">
                                <strong>اردو:</strong>
                                {{ $hadith['hadithUrdu'] ?? 'اردو متن دستیاب نہیں' }}
                            </p>
                        </div>

                        <!-- Hadith Metadata -->
                        <div class="hadith-meta">
                            <div class="row">
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <i class="fas fa-book me-1"></i>
                                        Source: {{ $hadith['bookSlug'] ?? 'Unknown' }}
                                    </small>
                                </div>
                                <div class="col-md-6 text-end">
                                    <small class="text-muted">
                                        <i class="fas fa-hashtag me-1"></i>
                                        Reference: {{ $hadith['hadithNumber'] ?? $index + 1 }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="row mt-4">
        <div class="col-12">
            <nav aria-label="Hadith pagination" id="paginationNav">
                <ul class="pagination justify-content-center" id="paginationList">
                    <!-- Pagination will be dynamically generated -->
                </ul>
            </nav>
        </div>
    </div>

    <!-- No Results Message -->
    <div id="noResults" class="text-center py-5" style="display: none;">
        <div class="card no-results-card">
            <div class="card-body">
                <i class="fas fa-search fa-3x text-success mb-3"></i>
                <h4 class="text-success">No Hadiths Found</h4>
                <p class="text-muted">Try adjusting your search terms or language filter</p>
                <button class="btn btn-success" onclick="clearSearch(); resetFilters();">
                    <i class="fas fa-refresh me-2"></i>Show All Hadiths
                </button>
            </div>
        </div>
    </div>

    <!-- Reading Progress Bar -->
    <div class="reading-progress">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <style>
        .navigation-bar {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
            border: 2px solid var(--border-color);
        }

        .filter-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-hover);
        }

        .filter-card .form-label {
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .filter-card .form-select {
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.2);
            color: white;
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 0.8rem 1rem;
        }

        .filter-card .form-select option {
            background: #2d3748;
            color: white;
        }

        .filter-card .form-select:focus {
            background: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.5);
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.15);
        }

        .btn-outline-light {
            border-color: rgba(255,255,255,0.3);
            color: white;
            font-size: 0.85rem;
        }

        .btn-outline-light:hover {
            background-color: rgba(255,255,255,0.2);
            border-color: white;
            color: white;
        }

        .btn-check:checked + .btn-outline-light {
            background-color: rgba(255,255,255,0.3);
            border-color: white;
            color: white;
        }

        .results-info {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
            font-weight: 500;
            border: 2px solid var(--border-color);
        }

        .search-container {
            background: white;
            border-radius: 25px;
            box-shadow: var(--shadow);
            padding: 0.5rem;
            margin-bottom: 2rem;
            border: 2px solid var(--border-color);
        }

        .search-container input {
            border: none;
            background: transparent;
            padding: 1rem 1.5rem;
            font-size: 1rem;
        }

        .search-container input:focus {
            outline: none;
            box-shadow: none;
        }

        .search-container .input-group-text {
            background: transparent;
            border: none;
            padding: 1rem 1.5rem;
        }

        .search-container .btn {
            border-radius: 20px;
            margin-right: 0.5rem;
        }

        .hadiths-container {
            margin-bottom: 2rem;
        }

        .hadith-card-wrapper {
            margin-bottom: 2rem;
            animation: slideInUp 0.6s ease-out;
        }

        .hadith-card {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            background: white;
            position: relative;
        }

        .hadith-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .hadith-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .hadith-card .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hadith-badge {
            background: rgba(255, 255, 255, 0.9) !important;
            color: var(--primary-color) !important;
            font-weight: 700;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .hadith-actions {
            display: flex;
            gap: 0.5rem;
        }

        .hadith-actions button {
            border-radius: 10px;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .hadith-actions button:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .hadith-card .card-body {
            padding: 2.5rem;
        }

        .hadith-text {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .arabic-text {
            background: linear-gradient(135deg, rgba(20, 83, 45, 0.05) 0%, rgba(22, 101, 52, 0.05) 100%);
            border: 2px solid rgba(20, 83, 45, 0.1);
            border-right: 4px solid var(--primary-color);
        }

        .english-text {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(37, 99, 235, 0.05) 100%);
            border: 2px solid rgba(59, 130, 246, 0.1);
            border-left: 4px solid #3b82f6;
        }

        .urdu-text {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.05) 0%, rgba(147, 51, 234, 0.05) 100%);
            border: 2px solid rgba(168, 85, 247, 0.1);
            border-right: 4px solid #a855f7;
        }

        .arabic-content {
            font-family: 'Amiri Quran', serif;
            font-size: 1.4rem;
            line-height: 2.2;
            color: var(--primary-color);
            text-align: right;
            direction: rtl;
            font-weight: 600;
        }

        .english-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-dark);
            margin: 0;
        }

        .urdu-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-dark);
            margin: 0;
            text-align: right;
            direction: rtl;
        }

        .hadith-meta {
            background: rgba(0,0,0,0.02);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-top: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
        }

        /* View Mode Classes */
        .view-expanded .hadith-text {
            margin-bottom: 2.5rem;
            padding: 2rem;
        }

        .view-expanded .arabic-content {
            font-size: 1.6rem;
            line-height: 2.5;
        }

        .view-expanded .english-content,
        .view-expanded .urdu-content {
            font-size: 1.2rem;
            line-height: 2;
        }

        .view-compact .hadith-text {
            margin-bottom: 1.5rem;
            padding: 1rem;
        }

        .view-compact .arabic-content {
            font-size: 1.2rem;
            line-height: 2;
        }

        .view-compact .english-content,
        .view-compact .urdu-content {
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Reading Progress Bar */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            width: 0%;
            transition: width 0.3s ease;
        }

        /* Pagination Styles */
        .pagination .page-link {
            color: var(--primary-color);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            margin: 0 0.3rem;
            padding: 0.7rem 1.2rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .pagination .page-link:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .no-results-card {
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .translation-notice .alert {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(108, 117, 125, 0.1) 100%);
            border: 1px solid rgba(13, 110, 253, 0.2);
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        .translation-notice .alert-info {
            color: #0c63e4;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .results-info .float-end {
                float: none !important;
                margin-top: 1rem;
                text-align: center;
            }

            .filter-card .row > div {
                margin-bottom: 1rem;
                text-align: center;
            }

            .filter-card .row > div:last-child {
                margin-bottom: 0;
            }

            .navigation-bar {
                padding: 1rem;
            }

            .navigation-bar .d-flex {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .hadith-card .card-body {
                padding: 1.5rem;
            }

            .hadith-text {
                padding: 1rem;
            }

            .arabic-content {
                font-size: 1.2rem !important;
                line-height: 2;
            }

            .english-content,
            .urdu-content {
                font-size: 1rem !important;
            }

            .hadith-actions {
                flex-wrap: wrap;
                gap: 0.3rem;
            }

            .hadith-meta .row {
                text-align: center;
            }

            .hadith-meta .col-md-6:last-child {
                text-align: center !important;
                margin-top: 0.5rem;
            }
        }

        /* Animation */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Staggered animation */
        .hadith-card-wrapper:nth-child(1) { animation-delay: 0.1s; }
        .hadith-card-wrapper:nth-child(2) { animation-delay: 0.2s; }
        .hadith-card-wrapper:nth-child(3) { animation-delay: 0.3s; }
        .hadith-card-wrapper:nth-child(4) { animation-delay: 0.4s; }
        .hadith-card-wrapper:nth-child(5) { animation-delay: 0.5s; }
    </style>

    @push('scripts')
    <script>
        let allHadiths = [];
        let filteredHadiths = [];
        let currentPage = 1;
        let itemsPerPage = 10;

        document.addEventListener('DOMContentLoaded', function() {
            // Store all hadiths for filtering
            allHadiths = Array.from(document.querySelectorAll('.hadith-card-wrapper')).map(wrapper => ({
                element: wrapper,
                arabic: wrapper.dataset.arabic,
                english: wrapper.dataset.english,
                urdu: wrapper.dataset.urdu,
                number: parseInt(wrapper.dataset.number)
            }));

            filteredHadiths = [...allHadiths];

            // Initialize functionality
            initializeSearch();
            initializeFilters();
            initializePagination();
            initializeProgressBar();
            updateDisplay();
        });

        function initializeSearch() {
            const searchInput = document.getElementById('hadithSearchInput');

            searchInput.addEventListener('input', function() {
                filterHadiths();
            });
        }

        function initializeFilters() {
            const languageFilter = document.getElementById('languageFilter');
            const viewMode = document.querySelectorAll('input[name="viewMode"]');

            languageFilter.addEventListener('change', filterHadiths);

            viewMode.forEach(radio => {
                radio.addEventListener('change', function() {
                    applyViewMode(this.value);
                });
            });
        }

        function filterHadiths() {
            const query = document.getElementById('hadithSearchInput').value.toLowerCase().trim();
            const languageFilter = document.getElementById('languageFilter').value;

            // Filter hadiths
            filteredHadiths = allHadiths.filter(hadith => {
                const matchesSearch = !query ||
                    hadith.arabic.includes(query) ||
                    hadith.english.includes(query) ||
                    hadith.urdu.includes(query) ||
                    hadith.number.toString().includes(query);

                // For now, only Arabic, English, and Urdu are available
                // Other languages will show all hadiths until translations are added
                const availableLanguages = ['arabic', 'english', 'urdu'];
                const matchesLanguage = languageFilter === 'all' ||
                    (languageFilter === 'arabic' && hadith.arabic) ||
                    (languageFilter === 'english' && hadith.english) ||
                    (languageFilter === 'urdu' && hadith.urdu) ||
                    (!availableLanguages.includes(languageFilter)); // Show all for unavailable languages

                return matchesSearch && matchesLanguage;
            });

            // Apply language-specific display
            applyLanguageFilter(languageFilter);

            // Reset to first page
            currentPage = 1;

            // Update display
            updateDisplay();
        }

        function applyLanguageFilter(language) {
            allHadiths.forEach(hadith => {
                const arabicText = hadith.element.querySelector('.arabic-text');
                const englishText = hadith.element.querySelector('.english-text');
                const urduText = hadith.element.querySelector('.urdu-text');

                // Reset display
                arabicText.style.display = 'block';
                englishText.style.display = 'block';
                urduText.style.display = 'block';

                // Apply language filter
                if (language !== 'all') {
                    const availableLanguages = ['arabic', 'english', 'urdu'];

                    if (availableLanguages.includes(language)) {
                        switch(language) {
                            case 'arabic':
                                englishText.style.display = 'none';
                                urduText.style.display = 'none';
                                break;
                            case 'english':
                                arabicText.style.display = 'none';
                                urduText.style.display = 'none';
                                break;
                            case 'urdu':
                                arabicText.style.display = 'none';
                                englishText.style.display = 'none';
                                break;
                        }
                    } else {
                        // For languages not yet available, show a notice
                        const noticeHtml = `
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Translation Notice:</strong> ${getLanguageName(language)} translations are coming soon.
                                Currently showing all available languages.
                            </div>
                        `;

                        // Add notice if it doesn't exist
                        if (!hadith.element.querySelector('.translation-notice')) {
                            const cardBody = hadith.element.querySelector('.card-body');
                            const noticeDiv = document.createElement('div');
                            noticeDiv.className = 'translation-notice';
                            noticeDiv.innerHTML = noticeHtml;
                            cardBody.insertBefore(noticeDiv, cardBody.firstChild);
                        }
                    }
                } else {
                    // Remove translation notices when showing all languages
                    const notices = hadith.element.querySelectorAll('.translation-notice');
                    notices.forEach(notice => notice.remove());
                }
            });
        }

        function getLanguageName(languageCode) {
            const languageNames = {
                'french': 'French (Français)',
                'spanish': 'Spanish (Español)',
                'german': 'German (Deutsch)',
                'turkish': 'Turkish (Türkçe)',
                'indonesian': 'Indonesian (Bahasa Indonesia)',
                'malay': 'Malay (Bahasa Melayu)',
                'bengali': 'Bengali (বাংলা)',
                'hindi': 'Hindi (हिन्दी)',
                'persian': 'Persian (فارسی)'
            };
            return languageNames[languageCode] || languageCode;
        }

        function updateDisplay() {
            const container = document.getElementById('hadithsContainer');
            const noResults = document.getElementById('noResults');
            const resultsCount = document.getElementById('resultsCount');

            // Hide all hadiths first
            allHadiths.forEach(hadith => {
                hadith.element.style.display = 'none';
            });

            if (filteredHadiths.length === 0) {
                noResults.style.display = 'block';
                resultsCount.textContent = 'No Hadiths found';
                document.getElementById('paginationNav').style.display = 'none';
            } else {
                noResults.style.display = 'none';
                document.getElementById('paginationNav').style.display = 'block';

                // Calculate pagination
                const totalPages = Math.ceil(filteredHadiths.length / itemsPerPage);
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, filteredHadiths.length);

                resultsCount.textContent = `Showing ${startIndex + 1}-${endIndex} of ${filteredHadiths.length} Hadiths`;

                // Show current page items
                for (let i = startIndex; i < endIndex; i++) {
                    if (filteredHadiths[i]) {
                        filteredHadiths[i].element.style.display = 'block';
                        filteredHadiths[i].element.style.order = i - startIndex;
                    }
                }

                // Update pagination
                updatePagination(totalPages);
            }
        }

        function initializePagination() {
            updateDisplay();
        }

        function updatePagination(totalPages) {
            const paginationList = document.getElementById('paginationList');
            const currentPageSpan = document.getElementById('currentPage');

            currentPageSpan.textContent = currentPage;
            paginationList.innerHTML = '';

            if (totalPages <= 1) {
                return;
            }

            // Previous button
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;">Previous</a>`;
            paginationList.appendChild(prevLi);

            // Page numbers
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, currentPage + 2);

            for (let i = startPage; i <= endPage; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>`;
                paginationList.appendChild(li);
            }

            // Next button
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;">Next</a>`;
            paginationList.appendChild(nextLi);
        }

        function changePage(page) {
            const totalPages = Math.ceil(filteredHadiths.length / itemsPerPage);

            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                updateDisplay();

                // Scroll to top of hadiths
                document.getElementById('hadithsContainer').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        function applyViewMode(mode) {
            const container = document.getElementById('hadithsContainer');

            // Remove existing view mode classes
            container.classList.remove('view-compact', 'view-expanded');

            // Add new view mode class
            container.classList.add(`view-${mode}`);
        }

        function initializeProgressBar() {
            window.addEventListener('scroll', function() {
                const container = document.getElementById('hadithsContainer');
                const containerTop = container.offsetTop;
                const containerHeight = container.offsetHeight;
                const windowHeight = window.innerHeight;
                const scrollTop = window.scrollY;

                const progress = Math.min(100, Math.max(0,
                    ((scrollTop + windowHeight - containerTop) / containerHeight) * 100
                ));

                document.getElementById('progressBar').style.width = progress + '%';
            });
        }

        // Additional utility functions
        function goBack() {
            // Try to go back in browser history first
            if (document.referrer && document.referrer !== window.location.href) {
                window.history.back();
            } else {
                // Fallback to chapters page if no referrer
                window.location.href = '/hadith/chapters';
            }
        }

        function clearSearch() {
            document.getElementById('hadithSearchInput').value = '';
            filterHadiths();
        }

        function resetFilters() {
            document.getElementById('languageFilter').value = 'all';
            document.getElementById('compactView').checked = true;
            document.getElementById('expandedView').checked = false;
            applyViewMode('compact');
            filterHadiths();
        }

        function bookmarkHadith(hadithNumber) {
            // Add bookmark functionality here
            alert(`Hadith ${hadithNumber} bookmarked!`);
        }

        function copyHadith(index) {
            const hadith = allHadiths[index];
            if (hadith) {
                const arabicText = hadith.element.querySelector('.arabic-content').textContent;
                const englishText = hadith.element.querySelector('.english-content').textContent;
                const urduText = hadith.element.querySelector('.urdu-content').textContent;

                const textToCopy = `${arabicText}\n\n${englishText}\n\n${urduText}`;

                navigator.clipboard.writeText(textToCopy).then(function() {
                    alert('Hadith copied to clipboard!');
                }).catch(function(err) {
                    console.error('Could not copy text: ', err);
                });
            }
        }

        function shareHadith(hadithNumber) {
            if (navigator.share) {
                navigator.share({
                    title: `Hadith ${hadithNumber}`,
                    text: `Check out this Hadith from our collection`,
                    url: window.location.href + `#hadith-${hadithNumber}`
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                const url = window.location.href + `#hadith-${hadithNumber}`;
                navigator.clipboard.writeText(url).then(function() {
                    alert('Hadith link copied to clipboard!');
                });
            }
        }
    </script>
    @endpush
</x-layout>
