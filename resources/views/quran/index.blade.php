<x-layout>
    <x-slot:heading>📖 The Holy Quran</x-slot:heading>
    <x-slot:subtitle>Read, Listen, and Explore the Divine Revelation</x-slot:subtitle>

    <!-- Search Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="search-container">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text"
                           id="surahSearchInput"
                           class="form-control border-0"
                           placeholder="🔍 Search Surah by name, number, or meaning..."
                           autocomplete="off">
                    <button class="btn btn-outline-secondary border-0" type="button" onclick="clearSearch()">
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
                            <label class="form-label">Filter by Revelation:</label>
                            <select id="revelationFilter" class="form-select">
                                <option value="">All Surahs</option>
                                <option value="Meccan">🕋 Meccan</option>
                                <option value="Medinan">🕌 Medinan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sort by:</label>
                            <select id="sortBy" class="form-select">
                                <option value="number">Surah Number</option>
                                <option value="name">Arabic Name</option>
                                <option value="englishName">English Name</option>
                                <option value="ayahs">Number of Ayahs</option>
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
                <span id="resultsCount">Showing all {{ count($collection) }} Surahs</span>
            </div>
        </div>
    </div>

    <!-- Surahs Grid -->
    <div class="row" id="surahGrid">
        @foreach ($collection as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 surah-card"
                 data-name="{{ strtolower($item['englishName']) }}"
                 data-arabic="{{ strtolower($item['name']) }}"
                 data-meaning="{{ strtolower($item['englishNameTranslation']) }}"
                 data-number="{{ $item['number'] }}"
                 data-revelation="{{ $item['revelationType'] }}"
                 data-ayahs="{{ $item['numberOfAyahs'] }}">
                <div class="product-grid">
                    <div class="product-image">
                        <div class="surah-number">{{ $item['number'] }}</div>
                        <div class="revelation-type">
                            @if ($item['revelationType'] === 'Medinan')
                                <span class="badge revelation-badge">🕌 Medinan</span>
                            @else
                                <span class="badge revelation-badge">🕋 Meccan</span>
                            @endif
                        </div>
                    </div>
                    <div class="product-content">
                        <h3 class="title arabic-title">{{ $item['name'] }}</h3>
                        <h4 class="title english-title">{{ $item['englishName'] }}</h4>
                        <p class="meaning">{{ $item['englishNameTranslation'] }}</p>
                        <div class="ayah-count">
                            <i class="fas fa-bookmark me-2"></i>
                            <span>{{ $item['numberOfAyahs'] }} Ayahs</span>
                        </div>
                        <ul class="product-links">
                            <li>
                                <a href="/read/{{ $item['number'] }}" class="read-btn">
                                    <i class="fas fa-book-open me-2"></i>
                                    Read Surah
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- No Results Message -->
    <div id="noResults" class="text-center py-5" style="display: none;">
        <div class="card">
            <div class="card-body">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4>No Surahs Found</h4>
                <p class="text-muted">Try adjusting your search terms or filters</p>
                <button class="btn btn-primary" onclick="clearSearch(); resetFilters();">
                    <i class="fas fa-refresh me-2"></i>Show All Surahs
                </button>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="row mt-4">
        <div class="col-12">
            <nav aria-label="Surah pagination">
                <ul class="pagination justify-content-center" id="paginationContainer">
                    <!-- Pagination will be generated by JavaScript -->
                </ul>
            </nav>
        </div>
    </div>

    <style>
        .filter-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
        }

        .filter-card .form-label {
            color: white;
            font-weight: 600;
        }

        .filter-card .form-select {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            backdrop-filter: blur(10px);
        }

        .filter-card .form-select option {
            background: #2d3748;
            color: white;
        }

        .results-info {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            font-weight: 500;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .view-controls {
            display: flex;
            gap: 0.5rem;
        }

        .product-image {
            position: relative;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            text-align: center;
        }

        .surah-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .revelation-type {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
        }

        .revelation-badge {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
            color: white !important;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 15px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(20, 83, 45, 0.3);
        }

        .arabic-title {
            font-family: 'Amiri Quran', serif;
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .english-title {
            font-size: 1.1rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .meaning {
            color: var(--text-light);
            font-style: italic;
            margin-bottom: 1rem;
        }

        .ayah-count {
            background: rgba(46, 139, 87, 0.1);
            padding: 0.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .read-btn {
            display: block;
            width: 100%;
            text-align: center;
            padding: 0.8rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .read-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 139, 87, 0.4);
            color: white;
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
            background: white;
        }

        .page-link:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(20, 83, 45, 0.3);
        }

        .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 15px rgba(20, 83, 45, 0.3);
        }

        .page-item.disabled .page-link {
            color: var(--text-light);
            background: #f8f9fa;
            border-color: var(--border-color);
        }

        .view-list .surah-card {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .view-list .product-grid {
            display: flex;
            align-items: center;
            padding: 1rem;
        }

        .view-list .product-image {
            flex: 0 0 100px;
            margin-right: 2rem;
        }

        .view-list .product-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        @media (max-width: 768px) {
            .results-info {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .view-list .product-grid {
                flex-direction: column;
                text-align: center;
            }

            .view-list .product-image {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
    </style>

    @push('scripts')
    <script>
        let currentView = 'grid';
        let allSurahs = [];
        let filteredSurahs = [];
        let currentPage = 1;
        let itemsPerPage = 20;

        document.addEventListener('DOMContentLoaded', function() {
            // Store all surahs for filtering
            allSurahs = Array.from(document.querySelectorAll('.surah-card')).map(card => ({
                element: card,
                name: card.dataset.name,
                arabic: card.dataset.arabic,
                meaning: card.dataset.meaning,
                number: parseInt(card.dataset.number),
                revelation: card.dataset.revelation,
                ayahs: parseInt(card.dataset.ayahs)
            }));

            filteredSurahs = [...allSurahs];

            // Initialize search
            initializeSearch();
            initializeFilters();
            updateDisplay();
            generatePagination();
        });

        function initializeSearch() {
            const searchInput = document.getElementById('surahSearchInput');

            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                filterSurahs();
            });
        }

        function initializeFilters() {
            const revelationFilter = document.getElementById('revelationFilter');
            const sortBy = document.getElementById('sortBy');

            revelationFilter.addEventListener('change', filterSurahs);
            sortBy.addEventListener('change', filterSurahs);
        }

        function filterSurahs() {
            const query = document.getElementById('surahSearchInput').value.toLowerCase().trim();
            const revelationFilter = document.getElementById('revelationFilter').value;

            // Filter surahs
            filteredSurahs = allSurahs.filter(surah => {
                const matchesSearch = !query ||
                    surah.name.includes(query) ||
                    surah.arabic.includes(query) ||
                    surah.meaning.includes(query) ||
                    surah.number.toString().includes(query);

                const matchesRevelation = !revelationFilter || surah.revelation === revelationFilter;

                return matchesSearch && matchesRevelation;
            });

            // Sort surahs
            sortSurahs();

            // Reset to first page
            currentPage = 1;

            // Update display
            updateDisplay();
            generatePagination();
        }

        function sortSurahs() {
            const sortBy = document.getElementById('sortBy').value;

            filteredSurahs.sort((a, b) => {
                switch(sortBy) {
                    case 'name':
                        return a.arabic.localeCompare(b.arabic);
                    case 'englishName':
                        return a.name.localeCompare(b.name);
                    case 'ayahs':
                        return b.ayahs - a.ayahs;
                    default:
                        return a.number - b.number;
                }
            });
        }

        function updateDisplay() {
            const grid = document.getElementById('surahGrid');
            const noResults = document.getElementById('noResults');
            const resultsCount = document.getElementById('resultsCount');

            // Hide all cards first
            allSurahs.forEach(surah => {
                surah.element.style.display = 'none';
            });

            if (filteredSurahs.length === 0) {
                noResults.style.display = 'block';
                resultsCount.textContent = 'No Surahs found';
            } else {
                noResults.style.display = 'none';

                // Calculate pagination
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const paginatedSurahs = filteredSurahs.slice(startIndex, endIndex);

                resultsCount.textContent = `Showing ${startIndex + 1}-${Math.min(endIndex, filteredSurahs.length)} of ${filteredSurahs.length} Surahs`;

                // Show and reorder paginated cards
                paginatedSurahs.forEach((surah, index) => {
                    surah.element.style.display = 'block';
                    surah.element.style.order = index;
                });
            }
        }

        function generatePagination() {
            const paginationContainer = document.getElementById('paginationContainer');
            const totalPages = Math.ceil(filteredSurahs.length / itemsPerPage);

            if (totalPages <= 1) {
                paginationContainer.innerHTML = '';
                return;
            }

            let paginationHTML = '';

            // Previous button
            paginationHTML += `
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            `;

            // Page numbers
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, currentPage + 2);

            if (startPage > 1) {
                paginationHTML += `
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="changePage(1); return false;">1</a>
                    </li>
                `;
                if (startPage > 2) {
                    paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                paginationHTML += `
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>
                    </li>
                `;
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
                paginationHTML += `
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="changePage(${totalPages}); return false;">${totalPages}</a>
                    </li>
                `;
            }

            // Next button
            paginationHTML += `
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            `;

            paginationContainer.innerHTML = paginationHTML;
        }

        function changePage(page) {
            const totalPages = Math.ceil(filteredSurahs.length / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                updateDisplay();
                generatePagination();

                // Scroll to top smoothly
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        function clearSearch() {
            document.getElementById('surahSearchInput').value = '';
            filterSurahs();
        }

        function resetFilters() {
            document.getElementById('revelationFilter').value = '';
            document.getElementById('sortBy').value = 'number';
            filterSurahs();
        }

        function toggleView(view) {
            const grid = document.getElementById('surahGrid');
            const gridBtn = document.getElementById('gridViewBtn');
            const listBtn = document.getElementById('listViewBtn');

            currentView = view;

            if (view === 'list') {
                grid.classList.add('view-list');
                listBtn.classList.add('active');
                gridBtn.classList.remove('active');
            } else {
                grid.classList.remove('view-list');
                gridBtn.classList.add('active');
                listBtn.classList.remove('active');
            }
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'f') {
                e.preventDefault();
                document.getElementById('surahSearchInput').focus();
            }
        });
    </script>
    @endpush
</x-layout>
