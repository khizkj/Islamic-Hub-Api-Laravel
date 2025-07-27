<x-layout>
    <x-slot:heading>🕌 Prayer Times</x-slot:heading>
    <x-slot:subtitle>Accurate prayer times based on your location</x-slot:subtitle>

    <!-- Location Detection Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card location-card">
                <div class="card-body text-center">
                    <h4 class="mb-4">
                        <i class="fas fa-map-marker-alt text-white me-2"></i>
                        Get Prayer Times for Your Location
                    </h4>
                    <div class="location-buttons">
                        <button class="btn btn-light btn-lg me-3" onclick="getLocation()">
                            <i class="fas fa-crosshairs me-2"></i>
                            Detect My Location
                        </button>
                        <button class="btn btn-outline-light btn-lg" onclick="showManualLocation()">
                            <i class="fas fa-edit me-2"></i>
                            Enter Manually
                        </button>
                    </div>
                    <p class="mt-3 text-white-50">
                        <i class="fas fa-shield-alt me-1"></i>
                        Your location data is only used to calculate prayer times and is not stored.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Manual Location Input (Hidden by default) -->
    <div class="row mb-4" id="manualLocationSection" style="display: none;">
        <div class="col-12">
            <div class="card manual-location-card">
                <div class="card-body">
                    <h5 class="card-title text-white">
                        <i class="fas fa-globe me-2"></i>
                        Enter Location Manually
                    </h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label text-white">Latitude</label>
                            <input type="number" id="manualLat" class="form-control" placeholder="e.g., 24.8607" step="any">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-white">Longitude</label>
                            <input type="number" id="manualLng" class="form-control" placeholder="e.g., 67.0011" step="any">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button class="btn btn-light w-100" onclick="getManualPrayerTimes()">
                                <i class="fas fa-search me-2"></i>
                                Get Prayer Times
                            </button>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-white-50">
                            <i class="fas fa-info-circle me-1"></i>
                            You can find coordinates using Google Maps or similar services.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Indicator -->
    <div id="loadingIndicator" class="text-center py-5" style="display: none;">
        <div class="card loading-card">
            <div class="card-body">
                <div class="spinner-border text-success mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5 class="text-success">Getting Prayer Times...</h5>
                <p class="text-muted">Please wait while we fetch accurate prayer times for your location.</p>
            </div>
        </div>
    </div>

    <!-- Prayer Times Information -->
    <div id="info" class="info-section" style="display: none;">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card info-card">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="info-item">
                                    <i class="fas fa-calendar-alt text-white"></i>
                                    <h6 class="text-white">Gregorian Date</h6>
                                    <p id="gregorian-date" class="mb-0 text-white-75">-</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-item">
                                    <i class="fas fa-moon text-white"></i>
                                    <h6 class="text-white">Hijri Date</h6>
                                    <p id="hijri-date" class="mb-0 text-white-75">-</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-item">
                                    <i class="fas fa-clock text-white"></i>
                                    <h6 class="text-white">Timezone</h6>
                                    <p id="timezone" class="mb-0 text-white-75">-</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                    <h6 class="text-white">Location</h6>
                                    <p id="location-name" class="mb-0 text-white-75">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Prayer Times Display -->
    <div id="prayer-times" class="prayer-times-container"></div>

    <!-- Prayer Times Settings -->
    <div id="settingsSection" class="row mt-4" style="display: none;">
        <div class="col-12">
            <div class="card settings-card">
                <div class="card-body">
                    <h5 class="card-title text-success">
                        <i class="fas fa-cog me-2"></i>
                        Prayer Settings
                    </h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Calculation Method</label>
                            <select id="calculationMethod" class="form-select">
                                <option value="2">Islamic Society of North America</option>
                                <option value="1">University of Islamic Sciences, Karachi</option>
                                <option value="3">Muslim World League</option>
                                <option value="4">Umm Al-Qura University, Makkah</option>
                                <option value="5">Egyptian General Authority</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Juristic Method</label>
                            <select id="juristicMethod" class="form-select">
                                <option value="0">Shafi, Maliki, Hanbali</option>
                                <option value="1">Hanafi</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button class="btn btn-success w-100" onclick="refreshPrayerTimes()">
                                <i class="fas fa-sync me-2"></i>
                                Update Times
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Next Prayer Countdown -->
    <div id="countdownSection" class="row mt-4" style="display: none;">
        <div class="col-12">
            <div class="card countdown-card">
                <div class="card-body text-center">
                    <h4 id="nextPrayerName" class="text-white mb-3">Next Prayer</h4>
                    <div id="countdown" class="countdown-display">
                        <div class="time-unit">
                            <span id="hours" class="time-number">00</span>
                            <span class="time-label">Hours</span>
                        </div>
                        <div class="time-separator">:</div>
                        <div class="time-unit">
                            <span id="minutes" class="time-number">00</span>
                            <span class="time-label">Minutes</span>
                        </div>
                        <div class="time-separator">:</div>
                        <div class="time-unit">
                            <span id="seconds" class="time-number">00</span>
                            <span class="time-label">Seconds</span>
                        </div>
                    </div>
                    <p id="nextPrayerTime" class="mt-3 text-white-75">-</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Qibla Direction -->
    <div id="qiblaSection" class="row mt-4" style="display: none;">
        <div class="col-12">
            <div class="card qibla-card">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">
                        <i class="fas fa-compass me-2"></i>
                        Qibla Direction
                    </h5>
                    <div class="qibla-compass">
                        <div id="compass" class="compass-container">
                            <div class="compass-circle">
                                <div class="compass-needle" id="qiblaArrow"></div>
                                <div class="compass-center"></div>
                                <div class="compass-label compass-n">N</div>
                                <div class="compass-label compass-s">S</div>
                                <div class="compass-label compass-e">E</div>
                                <div class="compass-label compass-w">W</div>
                            </div>
                        </div>
                        <p id="qiblaDirection" class="mt-3 text-success">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-white-50 {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        .text-white-75 {
            color: rgba(255, 255, 255, 0.75) !important;
        }

        .location-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-hover);
        }

        .location-card .card-body {
            padding: 3rem 2rem;
        }

        .location-buttons .btn {
            margin: 0.5rem;
            padding: 1rem 2.5rem;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .location-buttons .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .manual-location-card {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .manual-location-card .form-control {
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.2);
            color: white;
            border-radius: 15px;
            padding: 0.8rem 1.2rem;
        }

        .manual-location-card .form-control::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .manual-location-card .form-control:focus {
            background: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.5);
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.15);
        }

        .loading-card {
            background: linear-gradient(135deg, var(--bg-light) 0%, #f0fdf4 100%);
            border: 2px solid var(--border-color);
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .info-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-hover);
        }

        .info-card .card-body {
            padding: 2.5rem;
        }

        .info-item {
            padding: 1.5rem 1rem;
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-2px);
        }

        .info-item i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .info-item h6 {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-item p {
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Prayer Times Container - 2-2-1 Layout */
        .prayer-times-container {
            margin-bottom: 2rem;
        }

        .prayer-times-row {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .prayer-times-row.two-cards {
            justify-content: center;
        }

        .prayer-times-row.single-card {
            justify-content: center;
        }

        .prayer-card {
            flex: 0 0 auto;
            width: 280px;
            border: none;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(20, 83, 45, 0.15);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            background: white;
            position: relative;
        }

        .prayer-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .prayer-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(20, 83, 45, 0.25);
        }

        .prayer-card .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 2rem 1.5rem 1.5rem;
            text-align: center;
            position: relative;
        }

        .prayer-card .card-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            border-top: 10px solid var(--secondary-color);
        }

        .prayer-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .prayer-name {
            font-size: 1.6rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .prayer-arabic {
            font-family: 'Amiri Quran', serif;
            font-size: 1.3rem;
            opacity: 0.85;
            margin-top: 0.5rem;
            font-weight: 400;
        }

        .prayer-card .card-body {
            padding: 2.5rem 1.5rem;
            text-align: center;
            background: white;
        }

        .prayer-time {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--primary-color);
            margin: 0;
            font-family: 'Inter', sans-serif;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
        }

        .prayer-card .card-footer {
            border: none;
            padding: 1rem 1.5rem 1.5rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-current {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .status-next {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .status-passed {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }

        .settings-card {
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .settings-card .form-select {
            border-radius: 15px;
            border: 2px solid var(--border-color);
            padding: 0.8rem 1rem;
        }

        .settings-card .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(20, 83, 45, 0.15);
        }

        .countdown-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 25px;
            box-shadow: var(--shadow-hover);
        }

        .countdown-card .card-body {
            padding: 3rem 2rem;
        }

        .countdown-display {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Inter', sans-serif;
            margin: 2rem 0;
            gap: 1rem;
        }

        .time-unit {
            text-align: center;
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 1.5rem 1rem;
            min-width: 100px;
        }

        .time-number {
            display: block;
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            line-height: 1;
        }

        .time-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255,255,255,0.8);
            margin-top: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .time-separator {
            font-size: 3rem;
            font-weight: 700;
            color: rgba(255,255,255,0.7);
        }

        .qibla-card {
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .compass-container {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
        }

        .compass-circle {
            position: relative;
            width: 220px;
            height: 220px;
            border: 4px solid var(--primary-color);
            border-radius: 50%;
            background: linear-gradient(135deg, var(--bg-light) 0%, #f0fdf4 100%);
            box-shadow: inset 0 4px 15px rgba(20, 83, 45, 0.1);
        }

        .compass-needle {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 4px;
            height: 90px;
            background: linear-gradient(to top, transparent 50%, #dc2626 50%);
            transform-origin: bottom center;
            transform: translate(-50%, -100%) rotate(0deg);
            transition: transform 0.5s ease;
            border-radius: 2px;
        }

        .compass-needle::after {
            content: '';
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 12px solid #dc2626;
        }

        .compass-center {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 12px;
            height: 12px;
            background: var(--primary-color);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .compass-label {
            position: absolute;
            font-weight: 800;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .compass-n { top: 10px; left: 50%; transform: translateX(-50%); }
        .compass-s { bottom: 10px; left: 50%; transform: translateX(-50%); }
        .compass-e { right: 10px; top: 50%; transform: translateY(-50%); }
        .compass-w { left: 10px; top: 50%; transform: translateY(-50%); }

        /* Dark mode styles */
        body.dark-mode .prayer-card {
            background: #2d3748;
            color: white;
        }

        body.dark-mode .prayer-time {
            color: #90cdf4;
        }

        body.dark-mode .settings-card,
        body.dark-mode .qibla-card,
        body.dark-mode .loading-card {
            background: #2d3748;
            color: white;
            border-color: #4a5568;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .prayer-card {
                width: 260px;
            }

            .prayer-times-row {
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .location-buttons .btn {
                display: block;
                width: 100%;
                margin: 0.5rem 0;
            }

            .prayer-card {
                width: 100%;
                max-width: 300px;
            }

            .prayer-times-row {
                flex-direction: column;
                align-items: center;
                gap: 1.5rem;
            }

            .countdown-display {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .time-unit {
                min-width: 80px;
                padding: 1rem 0.5rem;
            }

            .time-number {
                font-size: 2.5rem;
            }

            .compass-circle {
                width: 180px;
                height: 180px;
            }

            .compass-needle {
                height: 70px;
            }

            .info-item {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 576px) {
            .prayer-card {
                width: 100%;
            }

            .time-separator {
                display: none;
            }

            .countdown-display {
                gap: 0.5rem;
            }
        }

        /* Animation for prayer cards */
        .prayer-card-enter {
            animation: slideInUp 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Pulse animation for next prayer */
        .status-next {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(245, 158, 11, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
            }
        }
    </style>

    @push('scripts')
    <script>
        let currentLocation = null;
        let prayerTimesData = null;
        let countdownInterval = null;

        function getLocation() {
            if (navigator.geolocation) {
                showLoading();
                navigator.geolocation.getCurrentPosition(showPrayerTimes, showError, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 300000
                });
            } else {
                showNotification("Geolocation is not supported by this browser.", 'error');
            }
        }

        function showManualLocation() {
            const section = document.getElementById('manualLocationSection');
            section.style.display = section.style.display === 'none' ? 'block' : 'none';
        }

        function getManualPrayerTimes() {
            const lat = document.getElementById('manualLat').value;
            const lng = document.getElementById('manualLng').value;

            if (!lat || !lng) {
                showNotification('Please enter both latitude and longitude', 'error');
                return;
            }

            const position = {
                coords: {
                    latitude: parseFloat(lat),
                    longitude: parseFloat(lng)
                }
            };

            showPrayerTimes(position);
        }

        function showPrayerTimes(position) {
            currentLocation = position;

            const method = document.getElementById('calculationMethod')?.value || '2';
            const school = document.getElementById('juristicMethod')?.value || '0';

            fetch("/fetch-prayer-times", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    lat: position.coords.latitude,
                    long: position.coords.longitude,
                    method: method,
                    school: school
                })
            })
            .then(response => response.json())
            .then(data => {
                prayerTimesData = data;
                displayPrayerTimes(data);
                displayLocationInfo(data);
                startCountdown(data.timings);
                calculateQibla(position.coords.latitude, position.coords.longitude);
                hideLoading();
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to fetch prayer times. Please try again.', 'error');
                hideLoading();
            });
        }

        function displayLocationInfo(data) {
            document.getElementById('gregorian-date').textContent = data.gregorian || 'N/A';
            document.getElementById('hijri-date').textContent = data.hijri || 'N/A';
            document.getElementById('timezone').textContent = data.timezone || 'N/A';
            document.getElementById('location-name').textContent = data.location || 'Unknown Location';

            document.getElementById('info').style.display = 'block';
            document.getElementById('settingsSection').style.display = 'block';
        }

        function displayPrayerTimes(data) {
            const container = document.getElementById('prayer-times');
            const timings = data.timings;

            const prayerNames = {
                'Fajr': { name: 'Fajr', arabic: 'الفجر', icon: 'fas fa-sunrise' },
                'Dhuhr': { name: 'Dhuhr', arabic: 'الظهر', icon: 'fas fa-sun' },
                'Asr': { name: 'Asr', arabic: 'العصر', icon: 'fas fa-cloud-sun' },
                'Maghrib': { name: 'Maghrib', arabic: 'المغرب', icon: 'fas fa-sunset' },
                'Isha': { name: 'Isha', arabic: 'العشاء', icon: 'fas fa-moon' }
            };

            container.innerHTML = '';

            const currentTime = new Date();
            let nextPrayer = null;

            const prayers = Object.keys(prayerNames);
            const prayerCards = [];

            prayers.forEach((prayer) => {
                if (timings[prayer]) {
                    const prayerTime = new Date();
                    const [hours, minutes] = timings[prayer].split(':');
                    prayerTime.setHours(parseInt(hours), parseInt(minutes));

                    let status = 'passed';
                    if (!nextPrayer && prayerTime > currentTime) {
                        status = 'next';
                        nextPrayer = prayer;
                    } else if (nextPrayer === prayer) {
                        status = 'next';
                    }

                    prayerCards.push({
                        prayer,
                        data: prayerNames[prayer],
                        time: timings[prayer],
                        status
                    });
                }
            });

            // Create 2-2-1 layout
            if (prayerCards.length >= 4) {
                // First row: 2 cards
                const firstRow = document.createElement('div');
                firstRow.className = 'prayer-times-row two-cards';

                for (let i = 0; i < 2; i++) {
                    if (prayerCards[i]) {
                        firstRow.appendChild(createPrayerCard(prayerCards[i], i));
                    }
                }
                container.appendChild(firstRow);

                // Second row: 2 cards
                const secondRow = document.createElement('div');
                secondRow.className = 'prayer-times-row two-cards';

                for (let i = 2; i < 4; i++) {
                    if (prayerCards[i]) {
                        secondRow.appendChild(createPrayerCard(prayerCards[i], i));
                    }
                }
                container.appendChild(secondRow);

                // Third row: 1 card (if exists)
                if (prayerCards[4]) {
                    const thirdRow = document.createElement('div');
                    thirdRow.className = 'prayer-times-row single-card';
                    thirdRow.appendChild(createPrayerCard(prayerCards[4], 4));
                    container.appendChild(thirdRow);
                }
            } else {
                // Fallback for fewer cards
                const row = document.createElement('div');
                row.className = 'prayer-times-row';
                prayerCards.forEach((card, index) => {
                    row.appendChild(createPrayerCard(card, index));
                });
                container.appendChild(row);
            }
        }

        function createPrayerCard(cardData, index) {
            const { prayer, data, time, status } = cardData;

            const cardElement = document.createElement('div');
            cardElement.className = 'prayer-card prayer-card-enter';
            cardElement.style.animationDelay = `${index * 0.15}s`;

            cardElement.innerHTML = `
                <div class="card-header">
                    <i class="${data.icon} prayer-icon"></i>
                    <h5 class="prayer-name">${data.name}</h5>
                    <div class="prayer-arabic">${data.arabic}</div>
                </div>
                <div class="card-body">
                    <h3 class="prayer-time">${time}</h3>
                </div>
                <div class="card-footer status-${status}">
                    ${status === 'next' ? '⏰ Next Prayer' : status === 'current' ? '🕐 Current' : '✓ Completed'}
                </div>
            `;

            return cardElement;
        }

        function startCountdown(timings) {
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }

            const prayers = ['Fajr', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
            const currentTime = new Date();
            let nextPrayer = null;
            let nextPrayerTime = null;

            // Find next prayer
            for (const prayer of prayers) {
                if (timings[prayer]) {
                    const prayerTime = new Date();
                    const [hours, minutes] = timings[prayer].split(':');
                    prayerTime.setHours(parseInt(hours), parseInt(minutes));

                    if (prayerTime > currentTime) {
                        nextPrayer = prayer;
                        nextPrayerTime = prayerTime;
                        break;
                    }
                }
            }

            // If no prayer found for today, get Fajr for tomorrow
            if (!nextPrayer) {
                nextPrayer = 'Fajr';
                nextPrayerTime = new Date();
                const [hours, minutes] = timings['Fajr'].split(':');
                nextPrayerTime.setDate(nextPrayerTime.getDate() + 1);
                nextPrayerTime.setHours(parseInt(hours), parseInt(minutes));
            }

            document.getElementById('nextPrayerName').textContent = `Next Prayer: ${nextPrayer}`;
            document.getElementById('nextPrayerTime').textContent = `at ${timings[nextPrayer]}`;
            document.getElementById('countdownSection').style.display = 'block';

            countdownInterval = setInterval(() => {
                const now = new Date();
                const difference = nextPrayerTime - now;

                if (difference > 0) {
                    const hours = Math.floor(difference / (1000 * 60 * 60));
                    const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((difference % (1000 * 60)) / 1000);

                    document.getElementById('hours').textContent = String(hours).padStart(2, '0');
                    document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
                    document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
                } else {
                    // Prayer time reached, refresh data
                    clearInterval(countdownInterval);
                    showNotification(`It's time for ${nextPrayer} prayer!`, 'success');
                    if (currentLocation) {
                        showPrayerTimes(currentLocation);
                    }
                }
            }, 1000);
        }

        function calculateQibla(lat, lng) {
            // Kaaba coordinates
            const kaabaLat = 21.4225;
            const kaabaLng = 39.8262;

            const phi1 = lat * Math.PI / 180;
            const phi2 = kaabaLat * Math.PI / 180;
            const deltaLng = (kaabaLng - lng) * Math.PI / 180;

            const y = Math.sin(deltaLng) * Math.cos(phi2);
            const x = Math.cos(phi1) * Math.sin(phi2) - Math.sin(phi1) * Math.cos(phi2) * Math.cos(deltaLng);

            let bearing = Math.atan2(y, x) * 180 / Math.PI;
            bearing = (bearing + 360) % 360;

            document.getElementById('qiblaArrow').style.transform = `translate(-50%, -100%) rotate(${bearing}deg)`;
            document.getElementById('qiblaDirection').textContent = `Qibla is ${Math.round(bearing)}° from North`;
            document.getElementById('qiblaSection').style.display = 'block';
        }

        function refreshPrayerTimes() {
            if (currentLocation) {
                showLoading();
                showPrayerTimes(currentLocation);
            } else {
                showNotification('Please detect your location first', 'error');
            }
        }

        function showLoading() {
            document.getElementById('loadingIndicator').style.display = 'block';
        }

        function hideLoading() {
            document.getElementById('loadingIndicator').style.display = 'none';
        }

        function showError(error) {
            hideLoading();
            let message = "Unable to retrieve your location. ";

            switch(error.code) {
                case error.PERMISSION_DENIED:
                    message += "Please allow location access and try again.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    message += "Location information is unavailable.";
                    break;
                case error.TIMEOUT:
                    message += "Location request timed out.";
                    break;
                default:
                    message += "An unknown error occurred.";
                    break;
            }

            showNotification(message, 'error');
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
            }, 5000);
        }

        // Initialize settings when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Load saved settings
            const savedMethod = localStorage.getItem('calculationMethod');
            const savedSchool = localStorage.getItem('juristicMethod');

            if (savedMethod) {
                document.getElementById('calculationMethod').value = savedMethod;
            }
            if (savedSchool) {
                document.getElementById('juristicMethod').value = savedSchool;
            }

            // Save settings when changed
            document.getElementById('calculationMethod').addEventListener('change', function() {
                localStorage.setItem('calculationMethod', this.value);
            });

            document.getElementById('juristicMethod').addEventListener('change', function() {
                localStorage.setItem('juristicMethod', this.value);
            });
        });

        // Clean up intervals when page unloads
        window.addEventListener('beforeunload', function() {
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }
        });
    </script>
    @endpush
</x-layout>
