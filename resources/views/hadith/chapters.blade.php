<x-layout>
    <x-slot:heading>📖 Hadith Chapters</x-slot:heading>
    <x-slot:subtitle>Browse chapters and organized topics</x-slot:subtitle>

    <!-- Navigation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="navigation-bar">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/hadith" class="btn btn-outline-success">
                        <i class="fas fa-arrow-left me-2"></i>Back to Books
                    </a>
                    <div class="book-info">
                        <span class="badge bg-success">{{ count($collection) }} Chapters</span>
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
                           id="chapterSearchInput"
                           class="form-control border-0"
                           placeholder="🔍 Search chapters by Arabic, English, or Urdu text..."
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
                        <div class="col-md-4">
                            <label class="form-label text-white">Sort by:</label>
                            <select id="sortBy" class="form-select">
                                <option value="chapterNumber">Chapter Number</option>
                                <option value="chapterArabic">Arabic Title</option>
                                <option value="chapterEnglish">English Title</option>
                            </select>
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
                <span id="resultsCount">Showing all {{ count($collection) }} Chapters</span>
                <div class="float-end">
                    <span class="badge bg-success">Page <span id="currentPage">1</span></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Chapters Grid -->
    <div class="row" id="chaptersGrid">
        @foreach ($collection as $chapter)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 chapter-card"
                 data-arabic="{{ strtolower($chapter['chapterArabic'] ?? '') }}"
                 data-english="{{ strtolower($chapter['chapterEnglish'] ?? '') }}"
                 data-urdu="{{ strtolower($chapter['chapterUrdu'] ?? '') }}"
                 data-number="{{ $chapter['chapterNumber'] ?? 0 }}">
                <div class="card h-100 hadith-chapter-card">
                    <div class="card-header">
                        <div class="chapter-number">
                            <span class="badge bg-light text-success chapter-badge">Chapter {{ $chapter['chapterNumber'] ?? 'N/A' }}</span>
                        </div>
                        <div class="chapter-actions">
                            <button class="btn btn-sm btn-outline-light" onclick="bookmarkChapter({{ $chapter['chapterNumber'] ?? 0 }})" title="Bookmark">
                                <i class="fas fa-bookmark"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-light" onclick="shareChapter({{ $chapter['chapterNumber'] ?? 0 }})" title="Share">
                                <i class="fas fa-share"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="chapter-titles">
                            <h5 class="arabic-title">{{ $chapter['chapterArabic'] ?? 'غير متوفر' }}</h5>
                            <h6 class="english-title">{{ $chapter['chapterEnglish'] ?? 'Not Available' }}</h6>
                            <p class="urdu-title">{{ $chapter['chapterUrdu'] ?? 'دستیاب نہیں' }}</p>
                        </div>
                        <div class="chapter-meta mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted book-slug-display">
                                    <i class="fas fa-book me-1"></i>
                                    {{ $chapter['bookSlug'] ?? 'unknown' }}
                                </small>
                                <div class="chapter-link">
                                    <a href="{{ url('/hadith/chapters/' . ($chapter['bookSlug'] ?? 'unknown') . '/' . ($chapter['chapterNumber'] ?? 0)) }}"
                                       class="btn btn-chapter">
                                        <i class="fas fa-scroll me-2"></i>Read Hadiths
                                    </a>
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
            <nav aria-label="Chapter pagination" id="paginationNav">
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
                <h4 class="text-success">No Chapters Found</h4>
                <p class="text-muted">Try adjusting your search terms</p>
                <button class="btn btn-success" onclick="clearSearch(); resetFilters();">
                    <i class="fas fa-refresh me-2"></i>Show All Chapters
                </button>
            </div>
        </div>
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

        .hadith-chapter-card {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            background: white;
            position: relative;
        }

        .hadith-chapter-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .hadith-chapter-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-hover);
        }

        .hadith-chapter-card .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chapter-badge {
            background: rgba(255, 255, 255, 0.9) !important;
            color: var(--primary-color) !important;
            font-weight: 700;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .chapter-actions {
            display: flex;
            gap: 0.5rem;
        }

        .chapter-actions button {
            border-radius: 10px;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hadith-chapter-card .card-body {
            padding: 2rem 1.5rem;
        }

        .chapter-titles {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .arabic-title {
            font-family: 'Amiri Quran', serif;
            font-size: 1.4rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            line-height: 1.6;
            font-weight: 600;
        }

        .english-title {
            font-size: 1.1rem;
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .urdu-title {
            color: var(--text-light);
            font-size: 1rem;
            margin: 0;
            font-style: italic;
        }

        .chapter-meta {
            background: linear-gradient(135deg, rgba(20, 83, 45, 0.05) 0%, rgba(22, 101, 52, 0.05) 100%);
            padding: 1.2rem;
            border-radius: 15px;
            border: 2px solid rgba(20, 83, 45, 0.1);
        }

        .book-slug-display {
            background: rgba(20, 83, 45, 0.1);
            padding: 0.3rem 0.8rem;
            border-radius: 10px;
            font-weight: 600;
            color: var(--primary-color) !important;
        }

        .chapter-link .btn-chapter {
            padding: 0.7rem 1.3rem;
            font-weight: 600;
            border-radius: 15px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .chapter-link .btn-chapter:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(20, 83, 45, 0.3);
            color: white;
        }

        /* List View Styles - Mobile Responsive */
        .view-list .chapter-card {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .view-list .hadith-chapter-card {
            display: flex;
            flex-direction: row;
            align-items: stretch;
            min-height: 200px;
        }

        .view-list .card-header {
            flex: 0 0 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            writing-mode: horizontal-tb;
        }

        .view-list .card-body {
            flex: 1;
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 1.5rem;
        }

        .view-list .chapter-titles {
            flex: 1;
            text-align: left;
            margin-bottom: 0;
            margin-right: 2rem;
        }

        .view-list .chapter-meta {
            flex: 0 0 250px;
            margin-top: 0;
        }

        /* Mobile responsive for list view */
        @media (max-width: 768px) {
            .view-list .hadith-chapter-card {
                flex-direction: column;
                min-height: auto;
            }

            .view-list .card-header {
                flex: none;
                width: 100%;
                flex-direction: row;
                justify-content: space-between;
                padding: 1rem 1.5rem;
            }

            .view-list .card-body {
                flex-direction: column;
                padding: 1.5rem;
            }

            .view-list .chapter-titles {
                margin-right: 0;
                margin-bottom: 1.5rem;
                text-align: center;
            }

            .view-list .chapter-meta {
                flex: none;
                width: 100%;
            }
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

        /* Search container enhancement */
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

        /* Dark mode styles */
        body.dark-mode .hadith-chapter-card {
            background: #2d3748;
            color: white;
        }

        body.dark-mode .arabic-title {
            color: #90cdf4;
        }

        body.dark-mode .english-title {
            color: white;
        }

        body.dark-mode .navigation-bar,
        body.dark-mode .results-info,
        body.dark-mode .search-container,
        body.dark-mode .no-results-card {
            background: #2d3748;
            color: white;
            border-color: #4a5568;
        }

        body.dark-mode .chapter-meta {
            background: rgba(144, 205, 244, 0.1);
            border-color: rgba(144, 205, 244, 0.2);
        }

        body.dark-mode .book-slug-display {
            background: rgba(144, 205, 244, 0.2);
            color: #90cdf4 !important;
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

            .chapter-titles {
                padding: 0 0.5rem;
            }

            .arabic-title {
                font-size: 1.2rem;
            }

            .english-title {
                font-size: 1rem;
            }

            .chapter-meta {
                padding: 1rem;
            }

            .chapter-meta .d-flex {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }

        /* Animation for chapter cards */
        .chapter-card {
            animation: slideInUp 0.6s ease-out;
        }

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
        .chapter-card:nth-child(1) { animation-delay: 0.1s; }
        .chapter-card:nth-child(2) { animation-delay: 0.2s; }
        .chapter-card:nth-child(3) { animation-delay: 0.3s; }
        .chapter-card:nth-child(4) { animation-delay: 0.4s; }
        .chapter-card:nth-child(5) { animation-delay: 0.5s; }
        .chapter-card:nth-child(6) { animation-delay: 0.6s; }
    </style>

    @push('scripts')
    <script>
        let allChapters = [];
        let filteredChapters = [];
        let currentPage = 1;
        let itemsPerPage = 12;

        document.addEventListener('DOMContentLoaded', function() {
            // Store all chapters for filtering
            allChapters = Array.from(document.querySelectorAll('.chapter-card')).map(card => ({
                element: card,
                arabic: card.dataset.arabic,
                english: card.dataset.english,
                urdu: card.dataset.urdu,
                number: parseInt(card.dataset.number)
            }));

            filteredChapters = [...allChapters];

            // Initialize functionality
            initializeSearch();
            initializeFilters();
            initializePagination();
            updateDisplay();
        });

        function initializeSearch() {
            const searchInput = document.getElementById('chapterSearchInput');

            searchInput.addEventListener('input', function() {
                filterChapters();
            });
        }

        function initializeFilters() {
            const sortBy = document.getElementById('sortBy');
            const viewType = document.querySelectorAll('input[name="viewType"]');

            sortBy.addEventListener('change', filterChapters);

            viewType.forEach(radio => {
                radio.addEventListener('change', function() {
                    toggleView(this.value);
                });
            });
        }

        function filterChapters() {
            const query = document.getElementById('chapterSearchInput').value.toLowerCase().trim();

            // Filter chapters
            filteredChapters = allChapters.filter(chapter => {
                return !query ||
                    chapter.arabic.includes(query) ||
                    chapter.english.includes(query) ||
                    chapter.urdu.includes(query) ||
                    chapter.number.toString().includes(query);
            });

            // Sort chapters
            sortChapters();

            // Reset to first page
            currentPage = 1;

            // Update display
            updateDisplay();
        }

        function sortChapters() {
            const sortBy = document.getElementById('sortBy').value;

            filteredChapters.sort((a, b) => {
                switch(sortBy) {
                    case 'chapterArabic':
                        return a.arabic.localeCompare(b.arabic);
                    case 'chapterEnglish':
                        return a.english.localeCompare(b.english);
                    default:
                        return a.number - b.number;
                }
            });
        }

        function updateDisplay() {
            const grid = document.getElementById('chaptersGrid');
            const noResults = document.getElementById('noResults');
            const resultsCount = document.getElementById('resultsCount');

            // Hide all cards first
            allChapters.forEach(chapter => {
                chapter.element.style.display = 'none';
            });

            if (filteredChapters.length === 0) {
                noResults.style.display = 'block';
                resultsCount.textContent = 'No Chapters found';
                document.getElementById('paginationNav').style.display = 'none';
            } else {
                noResults.style.display = 'none';
                document.getElementById('paginationNav').style.display = 'block';

                // Calculate pagination
                const totalPages = Math.ceil(filteredChapters.length / itemsPerPage);
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, filteredChapters.length);

                resultsCount.textContent = `Showing ${startIndex + 1}-${endIndex} of ${filteredChapters.length} Chapters`;

                // Show current page items
                for (let i = startIndex; i < endIndex; i++) {
                    if (filteredChapters[i]) {
                        filteredChapters[i].element.style.display = 'block';
                        filteredChapters[i].element.style.order = i - startIndex;
                    }
                }

                // Update pagination
                updatePagination(totalPages);
            }
        }

        function initializePagination() {
            // Initial pagination setup
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
            prevLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage - 1})">Previous</a>`;
            paginationList.appendChild(prevLi);

            // Page numbers
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, currentPage + 2);

            if (startPage > 1) {
                const firstLi = document.createElement('li');
                firstLi.className = 'page-item';
                firstLi.innerHTML = '<a class="page-link" href="#" onclick="changePage(1)">1</a>';
                paginationList.appendChild(firstLi);

                if (startPage > 2) {
                    const dotsLi = document.createElement('li');
                    dotsLi.className = 'page-item disabled';
                    dotsLi.innerHTML = '<span class="page-link">...</span>';
                    paginationList.appendChild(dotsLi);
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
                paginationList.appendChild(li);
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const dotsLi = document.createElement('li');
                    dotsLi.className = 'page-item disabled';
                    dotsLi.innerHTML = '<span class="page-link">...</span>';
                    paginationList.appendChild(dotsLi);
                }

                const lastLi = document.createElement('li');
                lastLi.className = 'page-item';
                lastLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${totalPages})">${totalPages}</a>`;
                paginationList.appendChild(lastLi);
            }

            // Next button
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage + 1})">Next</a>`;
            paginationList.appendChild(nextLi);
        }

        function changePage(page) {
            const totalPages = Math.ceil(filteredChapters.length / itemsPerPage);

            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                updateDisplay();

                // Scroll to top of chapters
                document.getElementById('chaptersGrid').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        function toggleView(view) {
            const grid = document.getElementById('chaptersGrid');

            if (view === 'list') {
                grid.classList.add('view-list');
            } else {
                grid.classList.remove('view-list');
            }
        }

        function clearSearch() {
            document.getElementById('chapterSearchInput').value = '';
            filterChapters();
        }

        function bookmarkChapter(chapterNumber) {
            const bookmark = {
                chapterNumber: chapterNumber,
                timestamp: new Date().toISOString()
            };

            let bookmarks = JSON.parse(localStorage.getItem('hadithBookmarks') || '[]');

            const existingIndex = bookmarks.findIndex(b => b.chapterNumber === chapterNumber);

            if (existingIndex >= 0) {
                bookmarks.splice(existingIndex, 1);
                showNotification('Bookmark removed', 'info');
            } else {
                bookmarks.push(bookmark);
                showNotification('Chapter bookmarked!', 'success');
            }

            localStorage.setItem('hadithBookmarks', JSON.stringify(bookmarks));
        }

        function shareChapter(chapterNumber) {
            const url = window.location.href;
            const text = `Check out this Hadith Chapter #${chapterNumber}`;

            if (navigator.share) {
                navigator.share({
                    title: `Hadith Chapter ${chapterNumber}`,
                    text: text,
                    url: url
                });
            } else {
                navigator.clipboard.writeText(`${text}\n${url}`).then(() => {
                    showNotification('Chapter link copied to clipboard!', 'success');
                });
            }
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} alert-dismissible fade show notification-toast`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 10000;
                min-width: 300px;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            `;
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 3000);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'f') {
                e.preventDefault();
                document.getElementById('chapterSearchInput').focus();
            } else if (e.key === 'ArrowLeft' && currentPage > 1) {
                e.preventDefault();
                changePage(currentPage - 1);
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                const totalPages = Math.ceil(filteredChapters.length / itemsPerPage);
                if (currentPage < totalPages) {
                    changePage(currentPage + 1);
                }
            }
        });
    </script>
    @endpush
</x-layout>
