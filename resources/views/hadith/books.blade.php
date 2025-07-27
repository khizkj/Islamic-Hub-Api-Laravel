<x-layout>
    <x-slot:heading>📚 Hadith Collections</x-slot:heading>
    <x-slot:subtitle>Authentic Sayings and Teachings of Prophet Muhammad (ﷺ)</x-slot:subtitle>

    <!-- Search Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="search-container">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0">
                        <i class="fas fa-search text-success"></i>
                    </span>
                    <input type="text" id="bookSearchInput" class="form-control border-0"
                        placeholder="🔍 Search hadith books by name, author, or slug..." autocomplete="off">
                    <button class="btn btn-outline-success border-0" type="button" onclick="clearSearch()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Sort Options -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card filter-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <label class="form-label text-white">Sort by:</label>
                            <select id="sortBy" class="form-select">
                                <option value="bookName">Book Name</option>
                                <option value="writerName">Author Name</option>
                                <option value="bookSlug">Book Slug</option>
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
                <span id="resultsCount">Showing all {{ count($collection) }} Hadith Books</span>
                <div class="float-end">
                    <span class="badge bg-success">{{ count($collection) }} Collections Available</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Books Grid -->
    <div class="row" id="booksGrid">
        @foreach ($collection as $item)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 book-card" data-name="{{ strtolower($item['bookName']) }}"
                data-author="{{ strtolower($item['writerName']) }}" data-slug="{{ strtolower($item['bookSlug']) }}">
                <div class="card h-100 hadith-book-card">
                    <div class="card-header">
                        <div class="book-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title book-title">{{ $item['bookName'] }}</h5>
                        <h6 class="card-subtitle author-name">
                            <i class="fas fa-user-edit me-2"></i>{{ $item['writerName'] }}
                        </h6>
                        <div class="book-slug">
                            <i class="fas fa-tag me-2"></i>
                            <code>{{ $item['bookSlug'] }}</code>
                        </div>
                        <div class="book-description mt-3 flex-grow-1">
                            <p class="text-muted">
                                Explore the chapters and authentic hadiths from this renowned collection
                                by {{ $item['writerName'] }}.
                            </p>
                        </div>
                        <div class="card-actions mt-auto">
                            <a href="/hadith/chapters/{{ $item['bookSlug'] }}" class="btn btn-chapter w-100">
                                <i class="fas fa-list me-2"></i>
                                View Chapters
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- No Results Message -->
    <div id="noResults" class="text-center py-5" style="display: none;">
        <div class="card no-results-card">
            <div class="card-body">
                <i class="fas fa-search fa-3x text-success mb-3"></i>
                <h4 class="text-success">No Hadith Books Found</h4>
                <p class="text-muted">Try adjusting your search terms</p>
                <button class="btn btn-success" onclick="clearSearch(); resetFilters();">
                    <i class="fas fa-refresh me-2"></i>Show All Books
                </button>
            </div>
        </div>
    </div>

    <!-- About Hadith Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card about-hadith-card">
                <div class="card-body">
                    <h3 class="text-center mb-4 text-white">📖 About Hadith Collections</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-white"><i class="fas fa-info-circle me-2"></i>What are Hadiths?</h5>
                            <p class="text-white-75">
                                Hadiths are the recorded sayings, actions, and approvals of Prophet Muhammad (ﷺ).
                                They serve as the second source of Islamic guidance after the Quran and provide
                                practical examples of how to implement Quranic teachings.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-white"><i class="fas fa-shield-alt me-2"></i>Authentic Collections</h5>
                            <p class="text-white-75">
                                These collections have been meticulously compiled by renowned Islamic scholars
                                who verified the authenticity of each hadith through rigorous chains of transmission
                                (isnad) and content analysis.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-white-75 {
            color: rgba(255, 255, 255, 0.75) !important;
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
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
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
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.15);
        }

        .results-info {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
            font-weight: 500;
            border: 2px solid var(--border-color);
        }

        .hadith-book-card {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            background: white;
            position: relative;
        }

        .hadith-book-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .hadith-book-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-hover);
        }

        .hadith-book-card .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 2.5rem 1.5rem 2rem;
            text-align: center;
            position: relative;
        }

        .hadith-book-card .card-header::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 15px solid var(--secondary-color);
        }

        .book-icon {
            text-align: center;
        }

        .book-icon i {
            font-size: 3rem;
            opacity: 0.9;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .hadith-book-card .card-body {
            padding: 2.5rem 2rem;
        }

        .book-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.2rem;
            line-height: 1.4;
            text-align: center;
        }

        .author-name {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.2rem;
            text-align: center;
            font-size: 1.1rem;
        }

        .book-slug {
            background: linear-gradient(135deg, rgba(20, 83, 45, 0.1) 0%, rgba(22, 101, 52, 0.1) 100%);
            padding: 0.8rem 1rem;
            border-radius: 12px;
            color: var(--primary-color);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            text-align: center;
            border: 2px solid rgba(20, 83, 45, 0.1);
        }

        .book-slug code {
            background: transparent;
            color: inherit;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .book-description {
            font-size: 0.95rem;
            line-height: 1.6;
            text-align: center;
        }

        .card-actions .btn-chapter {
            font-weight: 600;
            padding: 1rem;
            border-radius: 15px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .card-actions .btn-chapter:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 83, 45, 0.3);
            color: white;
        }

        .no-results-card {
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .about-hadith-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 25px;
            box-shadow: var(--shadow-hover);
        }

        .about-hadith-card .card-body {
            padding: 3rem 2.5rem;
        }

        .about-hadith-card h5 {
            color: white;
            margin-bottom: 1.2rem;
            font-weight: 600;
        }

        .about-hadith-card p {
            line-height: 1.8;
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
        body.dark-mode .hadith-book-card {
            background: #2d3748;
            color: white;
        }

        body.dark-mode .book-title {
            color: white;
        }

        body.dark-mode .results-info,
        body.dark-mode .search-container,
        body.dark-mode .no-results-card {
            background: #2d3748;
            color: white;
            border-color: #4a5568;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .results-info .float-end {
                float: none !important;
                margin-top: 1rem;
                text-align: center;
            }

            .filter-card .card-body .row {
                text-align: center;
            }

            .filter-card .col-md-6:last-child {
                margin-top: 1rem;
            }

            .hadith-book-card .card-header {
                padding: 2rem 1rem 1.5rem;
            }

            .book-icon i {
                font-size: 2.5rem;
            }

            .about-hadith-card .card-body {
                padding: 2rem 1.5rem;
            }
        }

        /* Animation for book cards */
        .book-card {
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
        .book-card:nth-child(1) { animation-delay: 0.1s; }
        .book-card:nth-child(2) { animation-delay: 0.2s; }
        .book-card:nth-child(3) { animation-delay: 0.3s; }
        .book-card:nth-child(4) { animation-delay: 0.4s; }
        .book-card:nth-child(5) { animation-delay: 0.5s; }
        .book-card:nth-child(6) { animation-delay: 0.6s; }
    </style>

    @push('scripts')
        <script>
            let allBooks = [];
            let filteredBooks = [];

            document.addEventListener('DOMContentLoaded', function() {
                // Store all books for filtering
                allBooks = Array.from(document.querySelectorAll('.book-card')).map(card => ({
                    element: card,
                    name: card.dataset.name,
                    author: card.dataset.author,
                    slug: card.dataset.slug
                }));

                filteredBooks = [...allBooks];

                // Initialize search and filters
                initializeSearch();
                initializeFilters();
            });

            function initializeSearch() {
                const searchInput = document.getElementById('bookSearchInput');

                searchInput.addEventListener('input', function() {
                    filterBooks();
                });
            }

            function initializeFilters() {
                const sortBy = document.getElementById('sortBy');
                sortBy.addEventListener('change', filterBooks);
            }

            function filterBooks() {
                const query = document.getElementById('bookSearchInput').value.toLowerCase().trim();

                // Filter books
                filteredBooks = allBooks.filter(book => {
                    return !query ||
                        book.name.includes(query) ||
                        book.author.includes(query) ||
                        book.slug.includes(query);
                });

                // Sort books
                sortBooks();

                // Update display
                updateDisplay();
            }

            function sortBooks() {
                const sortBy = document.getElementById('sortBy').value;

                filteredBooks.sort((a, b) => {
                    switch (sortBy) {
                        case 'writerName':
                            return a.author.localeCompare(b.author);
                        case 'bookSlug':
                            return a.slug.localeCompare(b.slug);
                        default:
                            return a.name.localeCompare(b.name);
                    }
                });
            }

            function updateDisplay() {
                const grid = document.getElementById('booksGrid');
                const noResults = document.getElementById('noResults');
                const resultsCount = document.getElementById('resultsCount');

                // Hide all cards first
                allBooks.forEach(book => {
                    book.element.style.display = 'none';
                });

                if (filteredBooks.length === 0) {
                    noResults.style.display = 'block';
                    resultsCount.textContent = 'No Hadith Books found';
                } else {
                    noResults.style.display = 'none';
                    resultsCount.textContent = `Showing ${filteredBooks.length} of ${allBooks.length} Hadith Books`;

                    // Show and reorder filtered cards
                    filteredBooks.forEach((book, index) => {
                        book.element.style.display = 'block';
                        book.element.style.order = index;
                    });
                }
            }

            function clearSearch() {
                document.getElementById('bookSearchInput').value = '';
                filterBooks();
            }

            function resetFilters() {
                document.getElementById('sortBy').value = 'bookName';
                filterBooks();
            }

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 'f') {
                    e.preventDefault();
                    document.getElementById('bookSearchInput').focus();
                }
            });

            // Add loading animation for card hover effects
            document.querySelectorAll('.hadith-book-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        </script>
    @endpush
</x-layout>
