<x-layout :heading="'📖 Surah Recitation'">

    <!-- Navigation -->
    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                <div class="navigation-bar">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/quran" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Surahs
                        </a>
                        <div class="surah-navigation">
                            @if($snum > 1)
                                <a href="/read/{{ $snum - 1 }}" class="btn btn-outline-primary me-2">
                                    <i class="fas fa-chevron-left me-1"></i>Previous
                                </a>
                            @endif
                            @if($snum < 114)
                                <a href="/read/{{ $snum + 1 }}" class="btn btn-outline-primary">
                                    Next<i class="fas fa-chevron-right ms-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Surah Info -->
    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card surah-info-card">
                    <div class="card-body text-center">
                        <h2 class="surah-title mb-3" id="surahTitle">Loading Surah Information...</h2>
                        <div class="surah-details" id="surahDetails">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-item">
                                        <i class="fas fa-bookmark text-white"></i>
                                        <span>Surah {{ $snum }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item">
                                        <i class="fas fa-list text-white"></i>
                                        <span id="ayahCount">Loading...</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item">
                                        <i class="fas fa-map-marker-alt text-white"></i>
                                        <span id="revelation">Loading...</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item">
                                        <i class="fas fa-globe text-white"></i>
                                        <span id="meaning">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reading Controls -->
    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card controls-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label class="form-label">Font Size:</label>
                                <input type="range" class="form-range" id="fontSizeSlider" min="14" max="28" value="20">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Translation:</label>
                                <select class="form-select" id="translationSelect">
                                    <option value="en.asad">English (Asad)</option>
                                    <option value="en.pickthall">English (Pickthall)</option>
                                    <option value="en.yusufali">English (Yusuf Ali)</option>
                                    <option value="ur.junagarhi">Urdu (Junagarhi)</option>
                                    <option value="ur.kanzuliman">Urdu (Kanz ul Iman)</option>
                                    <option value="ru.kuliev">Russian (Kuliev)</option>
                                    <option value="ru.osmanov">Russian (Osmanov)</option>
                                    <option value="zh.jian">Chinese (Simplified)</option>
                                    <option value="ja.japanese">Japanese</option>
                                    <option value="fr.hamidullah">French (Hamidullah)</option>
                                    <option value="de.bubenheim">German (Bubenheim)</option>
                                    <option value="es.cortes">Spanish (Cortes)</option>
                                    <option value="tr.diyanet">Turkish (Diyanet)</option>
                                    <option value="id.indonesian">Indonesian</option>
                                    <option value="ms.basmeih">Malay (Basmeih)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Audio Reciter:</label>
                                <select class="form-select" id="reciterSelect">
                                    <option value="ar.alafasy">Mishary Alafasy</option>
                                    <option value="ar.husary">Mahmoud Husary</option>
                                    <option value="ar.minshawi">Mohamed Minshawi</option>
                                    <option value="ar.abdulbasit">Abdul Basit</option>
                                    <option value="ar.sudais">Abdul Rahman Al-Sudais</option>
                                    <option value="ar.shaatri">Abu Bakr Al-Shatri</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ayahs Container -->
    <div class="container">
        <div class="row" id="ayahCardsContainer">
            @foreach ($collection as $index => $item)
                <div class="col-12 mb-4 ayah-card">
                    <div class="card ayah-item">
                        <div class="card-body">
                            <!-- Ayah Number -->
                            <div class="ayah-header">
                                <div class="ayah-number">
                                    <span class="badge bg-primary">آیت {{ $index + 1 }}</span>
                                    <span class="badge bg-secondary">Ayah #{{ $index + 1 }}</span>
                                </div>
                                <div class="ayah-actions">
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyAyah({{ $index }})">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary" onclick="shareAyah({{ $index }})">
                                        <i class="fas fa-share"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary" onclick="bookmarkAyah({{ $index }})">
                                        <i class="fas fa-bookmark"></i>
                                    </button>
                                </div>
                            </div>

                            <hr>

                            <!-- Arabic Text -->
                            <div class="arabic-text" id="arabic_{{ $index }}">
                                <h4 class="quran-arabic">{{ $item['text'] }}</h4>
                            </div>

                            <!-- Translation -->
                            <div class="translation-text mt-4">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-language text-primary me-2"></i>
                                    <strong>Translation:</strong>
                                </div>
                                <p id="translation_{{ $index }}" class="translation-content">
                                    🔄 Loading translation...
                                </p>
                            </div>

                            <!-- Audio Controls -->
                            <div class="audio-section mt-4" id="audio_{{ $index }}">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-volume-up text-primary me-2"></i>
                                    <strong>Audio Recitation:</strong>
                                </div>
                                <div class="audio-content">
                                    🔄 Loading audio...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-3">Loading Surah content...</p>
    </div>

    <style>
        .navigation-bar {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .surah-info-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
        }

        .surah-info-card .card-body {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
        }

        .surah-title {
            font-family: 'Amiri Quran', serif;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .info-item {
            padding: 0.5rem;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }

        .info-item i {
            margin-right: 0.5rem;
        }

        .controls-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
        }

        .controls-card .form-label {
            color: white;
            font-weight: 600;
        }

        .controls-card .form-select,
        .controls-card .form-range {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
        }

        .controls-card .form-select option {
            background: #2d3748;
            color: white;
        }

        .ayah-item {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            background: white;
        }

        .ayah-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .ayah-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .ayah-number .badge {
            margin-right: 0.5rem;
        }

        .ayah-actions button {
            margin-left: 0.5rem;
        }

        .quran-arabic {
            font-family: 'Amiri Quran', serif;
            font-size: 1.8rem;
            line-height: 2.5;
            text-align: right;
            color: var(--text-dark);
            margin: 0;
            padding: 1rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            border-right: 4px solid var(--primary-color);
        }

        .translation-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-dark);
            background: rgba(46, 139, 87, 0.05);
            padding: 1rem;
            border-radius: 10px;
            border-left: 4px solid var(--primary-color);
            margin: 0;
        }

        .audio-content {
            background: rgba(0,0,0,0.05);
            padding: 1rem;
            border-radius: 10px;
        }

        .audio-content audio {
            width: 100%;
            border-radius: 8px;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.9);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(5px);
        }

        .loading-overlay.hidden {
            display: none;
        }

        /* Dark mode styles */
        body.dark-mode .ayah-item {
            background: #2d3748;
            color: white;
        }

        body.dark-mode .quran-arabic {
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            color: white;
        }

        body.dark-mode .translation-content {
            background: rgba(46, 139, 87, 0.2);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .surah-title {
                font-size: 1.8rem;
            }

            .quran-arabic {
                font-size: 1.4rem;
                line-height: 2.2;
            }

            .ayah-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .ayah-actions {
                margin-top: 1rem;
            }
        }
    </style>

    @push('scripts')
    <script>
        let currentAudio = null;
        let audioQueue = [];
        let currentPlayingIndex = -1;

        document.addEventListener('DOMContentLoaded', async function () {
            const surahNumber = {{ $snum }};
            showLoading();

            try {
                // Load surah information
                await loadSurahInfo(surahNumber);

                // Load initial translation and audio
                await loadTranslationAndAudio(surahNumber);

                // Initialize controls
                initializeControls();

            } catch (error) {
                console.error('Failed to load surah content:', error);
                showError('Failed to load content. Please try again.');
            } finally {
                hideLoading();
            }
        });

        async function loadSurahInfo(surahNumber) {
            try {
                const response = await fetch(`https://api.alquran.cloud/v1/surah/${surahNumber}`);
                const data = await response.json();

                if (data.data) {
                    const surah = data.data;
                    document.getElementById('surahTitle').innerHTML = `
                        <span class="arabic-name">${surah.name}</span>
                        <br>
                        <span class="english-name">${surah.englishName}</span>
                    `;

                    document.getElementById('ayahCount').textContent = `${surah.numberOfAyahs} Ayahs`;
                    document.getElementById('revelation').innerHTML = surah.revelationType === 'Medinan'
                        ? '<i class="fas fa-mosque me-1"></i>Medinan'
                        : '<i class="fas fa-kaaba me-1"></i>Meccan';
                    document.getElementById('meaning').textContent = surah.englishNameTranslation;
                }
            } catch (error) {
                console.error('Error loading surah info:', error);
            }
        }

        async function loadTranslationAndAudio(surahNumber) {
            const translationEdition = document.getElementById('translationSelect').value;
            const reciterEdition = document.getElementById('reciterSelect').value;

            try {
                const [translationResponse, audioResponse] = await Promise.all([
                    fetch(`https://api.alquran.cloud/v1/surah/${surahNumber}/${translationEdition}`),
                    fetch(`https://api.alquran.cloud/v1/surah/${surahNumber}/${reciterEdition}`)
                ]);

                const translationData = await translationResponse.json();
                const audioData = await audioResponse.json();

                const translationAyahs = translationData.data.ayahs;
                const audioAyahs = audioData.data.ayahs;

                translationAyahs.forEach((ayah, index) => {
                    const translationElem = document.getElementById(`translation_${index}`);
                    const audioElem = document.getElementById(`audio_${index}`);

                    // Update translation
                    if (translationElem) {
                        translationElem.textContent = ayah.text || 'No translation available';
                    }

                    // Update audio
                    if (audioElem && audioAyahs[index]?.audio) {
                        const audioUrl = audioAyahs[index].audio;
                        audioElem.innerHTML = `
                            <div class="audio-content">
                                <div class="d-flex align-items-center justify-content-between">
                                    <audio controls preload="none" onplay="setCurrentAudio(this, ${index})">
                                        <source src="${audioUrl}" type="audio/mp3">
                                        Your browser does not support the audio element.
                                    </audio>
                                    <button class="btn btn-sm btn-outline-primary ms-2" onclick="downloadAudio('${audioUrl}', ${index})">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                            </div>
                        `;

                        // Store audio URL for queue
                        audioQueue[index] = audioUrl;
                    } else if (audioElem) {
                        audioElem.innerHTML = '<div class="audio-content text-muted">🎵 No Audio Available</div>';
                    }
                });
            } catch (error) {
                console.error('Failed to fetch translation or audio:', error);
                showError('Failed to load translation and audio. Please check your connection.');
            }
        }

        function initializeControls() {
            const fontSizeSlider = document.getElementById('fontSizeSlider');
            const translationSelect = document.getElementById('translationSelect');
            const reciterSelect = document.getElementById('reciterSelect');

            // Font size control
            fontSizeSlider.addEventListener('input', function() {
                const fontSize = this.value + 'px';
                document.querySelectorAll('.quran-arabic').forEach(element => {
                    element.style.fontSize = fontSize;
                });
            });

            // Translation change
            translationSelect.addEventListener('change', function() {
                showLoading();
                loadTranslationAndAudio({{ $snum }}).finally(() => hideLoading());
            });

            // Reciter change
            reciterSelect.addEventListener('change', function() {
                showLoading();
                loadTranslationAndAudio({{ $snum }}).finally(() => hideLoading());
            });
        }

        function setCurrentAudio(audioElement, index) {
            if (currentAudio && currentAudio !== audioElement) {
                currentAudio.pause();
            }
            currentAudio = audioElement;
            currentPlayingIndex = index;

            // Auto-play next when current ends
            audioElement.addEventListener('ended', function() {
                playNextAudio();
            });
        }

        function playNextAudio() {
            if (currentPlayingIndex < audioQueue.length - 1) {
                currentPlayingIndex++;
                playAudioAtIndex(currentPlayingIndex);
            }
        }

        function playAudioAtIndex(index) {
            const audioElement = document.querySelector(`#audio_${index} audio`);
            if (audioElement) {
                audioElement.play();
                setCurrentAudio(audioElement, index);

                // Scroll to current ayah
                document.querySelector(`.ayah-card:nth-child(${index + 1})`).scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }

        function copyAyah(index) {
            const arabicText = document.getElementById(`arabic_${index}`).textContent;
            const translationText = document.getElementById(`translation_${index}`).textContent;
            const textToCopy = `${arabicText.trim()}\n\n${translationText.trim()}\n\n- Quran ${{{ $snum }}}:${index + 1}`;

            navigator.clipboard.writeText(textToCopy).then(() => {
                showNotification('Ayah copied to clipboard!', 'success');
            }).catch(() => {
                showNotification('Failed to copy ayah', 'error');
            });
        }

        function shareAyah(index) {
            const arabicText = document.getElementById(`arabic_${index}`).textContent;
            const translationText = document.getElementById(`translation_${index}`).textContent;
            const textToShare = `${arabicText.trim()}\n\n${translationText.trim()}\n\n- Quran ${{{ $snum }}}:${index + 1}`;

            if (navigator.share) {
                navigator.share({
                    title: `Quran ${{{ $snum }}}:${index + 1}`,
                    text: textToShare,
                    url: window.location.href
                });
            } else {
                copyAyah(index);
            }
        }

        function bookmarkAyah(index) {
            const bookmark = {
                surah: {{ $snum }},
                ayah: index + 1,
                arabic: document.getElementById(`arabic_${index}`).textContent.trim(),
                translation: document.getElementById(`translation_${index}`).textContent.trim(),
                timestamp: new Date().toISOString()
            };

            let bookmarks = JSON.parse(localStorage.getItem('quranBookmarks') || '[]');

            // Check if already bookmarked
            const existingIndex = bookmarks.findIndex(b => b.surah === bookmark.surah && b.ayah === bookmark.ayah);

            if (existingIndex >= 0) {
                bookmarks.splice(existingIndex, 1);
                showNotification('Bookmark removed', 'info');
            } else {
                bookmarks.push(bookmark);
                showNotification('Ayah bookmarked!', 'success');
            }

            localStorage.setItem('quranBookmarks', JSON.stringify(bookmarks));
        }

        function downloadAudio(audioUrl, index) {
            const link = document.createElement('a');
            link.href = audioUrl;
            link.download = `quran_${{{ $snum }}}_${index + 1}.mp3`;
            link.click();
        }

        function showLoading() {
            document.getElementById('loadingOverlay').classList.remove('hidden');
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').classList.add('hidden');
        }

        function showError(message) {
            showNotification(message, 'error');
        }

        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} alert-dismissible fade show notification-toast`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 10000;
                min-width: 300px;
            `;
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 3000);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === ' ' && e.target.tagName !== 'INPUT') {
                e.preventDefault();
                if (currentAudio) {
                    if (currentAudio.paused) {
                        currentAudio.play();
                    } else {
                        currentAudio.pause();
                    }
                }
            } else if (e.key === 'ArrowRight' && currentPlayingIndex >= 0) {
                e.preventDefault();
                playNextAudio();
            } else if (e.key === 'Escape') {
                e.preventDefault();
                if (currentAudio) {
                    currentAudio.pause();
                    currentAudio.currentTime = 0;
                }
            }
        });

        // Save reading position
        window.addEventListener('beforeunload', function() {
            const scrollPosition = window.pageYOffset;
            localStorage.setItem(`quran_position_${{{ $snum }}}`, scrollPosition);
        });

        // Restore reading position
        window.addEventListener('load', function() {
            const savedPosition = localStorage.getItem(`quran_position_${{{ $snum }}}`);
            if (savedPosition) {
                setTimeout(() => {
                    window.scrollTo(0, parseInt(savedPosition));
                }, 500);
            }
        });
    </script>
    @endpush
</x-layout>
