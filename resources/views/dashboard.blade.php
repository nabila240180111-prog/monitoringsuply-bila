<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Supply Chain Risk Intelligence Platform</title>
    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-orange: #FF6B35;
            --primary-orange-hover: #E85A24;
            --primary-orange-light: rgba(255, 107, 53, 0.08);
            --bg-light: #F8F9FA;
            --bg-white: #FFFFFF;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --border-light: #E2E8F0;
            --accent-green: #10B981;
            --accent-blue: #3B82F6;
            --accent-red: #EF4444;
            --accent-yellow: #F59E0B;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }

        /* Top Navigation Header */
        .navbar-custom {
            background-color: var(--bg-white);
            border-bottom: 1px solid var(--border-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
            padding: 15px 30px;
        }

        .navbar-brand-custom {
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .navbar-brand-custom span {
            color: var(--primary-orange);
        }

        /* Premium Cards */
        .card-custom {
            background-color: var(--bg-white);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 24px;
            margin-bottom: 20px;
        }

        .card-custom:hover {
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.04);
            border-color: rgba(255, 107, 53, 0.2);
        }

        .custom-input {
            border: 1px solid var(--border-light);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .custom-input:focus {
            outline: none;
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3px var(--primary-orange-light);
        }

        /* Tabs customization */
        .nav-pills-custom .nav-link {
            color: var(--text-muted);
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.2s ease;
        }

        .nav-pills-custom .nav-link.active {
            background-color: var(--primary-orange);
            color: white;
        }

        .nav-pills-custom .nav-link:hover:not(.active) {
            background-color: var(--primary-orange-light);
            color: var(--primary-orange);
        }

        /* Sidebar Port List Items */
        .port-item {
            background: var(--bg-light);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 12px 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .port-item:hover {
            background: var(--primary-orange-light);
            border-color: var(--primary-orange);
            transform: translateX(4px);
        }

        .port-item.active {
            background: var(--primary-orange);
            border-color: var(--primary-orange);
            color: white;
        }

        .port-item.active .text-dark-custom {
            color: white !important;
        }

        .port-item.active .text-muted-custom {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .port-item.active .port-icon {
            color: white !important;
            background: rgba(255, 255, 255, 0.2) !important;
        }

        .port-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(255, 107, 53, 0.1);
            color: var(--primary-orange);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.1rem;
        }

        /* Interactive Map Container */
        #map-container {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-light);
            height: 480px;
            position: relative;
        }

        #map {
            height: 100%;
            width: 100%;
            z-index: 1;
        }

        /* Custom Map Marker */
        .custom-port-marker {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--primary-orange);
            color: white;
            border: 2px solid white;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(255, 107, 53, 0.5);
            transition: all 0.2s ease;
        }

        /* Stats Widget */
        .stat-widget {
            border-left: 4px solid var(--primary-orange);
            padding-left: 14px;
        }

        .btn-orange {
            background-color: var(--primary-orange);
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.2s ease;
        }

        .btn-orange:hover {
            background-color: var(--primary-orange-hover);
            color: white;
        }

        .badge-orange {
            background-color: var(--primary-orange-light);
            color: var(--primary-orange);
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 0.8rem;
        }

        .pulse-loader {
            display: inline-block;
            width: 12px;
            height: 12px;
            background-color: var(--primary-orange);
            border-radius: 50%;
            animation: pulse-loader-anim 1.2s infinite ease-in-out;
        }

        @keyframes pulse-loader-anim {
            0%, 100% { transform: scale(0.6); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 1; }
        }

        /* News Cards */
        .news-card {
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 16px;
            background-color: var(--bg-white);
            margin-bottom: 12px;
            transition: all 0.2s ease;
        }

        .news-card:hover {
            border-color: var(--primary-orange);
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        footer {
            margin-top: auto;
            background-color: var(--bg-white);
            border-top: 1px solid var(--border-light);
            padding: 20px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
        <div class="container-fluid">
            <a class="navbar-brand-custom" href="#">
                <i class="fa-solid fa-shield-halved" style="color: var(--primary-orange);"></i>
                PORT<span>BILA</span>
            </a>
            <span class="badge-orange ms-3 d-none d-sm-inline-block">
                <i class="fa-solid fa-compass me-1"></i> Supply Chain Risk Intelligence Platform
            </span>
            <div class="ms-auto d-flex align-items-center gap-3">
                <div class="pulse-loader d-none" id="loading-indicator"></div>
                <small class="text-secondary d-none d-md-inline-block">User: <strong>{{ auth()->user()->name ?? 'Bila Admin' }}</strong></small>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger fs-8 fw-semibold" style="border-radius: 8px;">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid px-4 px-md-5 mb-5">
        <div class="row g-4">
            
            <!-- Left Panel: Controls & Watchlist -->
            <div class="col-lg-4 col-xl-3">
                <div class="d-flex flex-column gap-3">
                    
                    <!-- Country Selector Card -->
                    <div class="card-custom mb-2">
                        <h6 class="fw-bold mb-3 d-flex align-items-center gap-2">
                            <i class="fa-solid fa-earth-americas text-secondary"></i>
                            Pilih Negara Pemantauan
                        </h6>
                        <div class="mb-3">
                            <select id="country-selector" class="form-select custom-input">
                                <option value="">Memuat daftar negara...</option>
                            </select>
                        </div>
                        <button id="favorite-btn" class="btn btn-outline-warning w-100 d-none fs-7 fw-semibold" style="border-radius: 10px;">
                            <i class="fa-regular fa-star me-1"></i> Tambah ke Favorit
                        </button>
                    </div>

                    <!-- Watchlist / Favorites List -->
                    <div class="card-custom mb-2">
                        <h6 class="fw-bold mb-2 d-flex align-items-center gap-2">
                            <i class="fa-solid fa-star text-warning"></i>
                            Daftar Monitoring Favorit
                        </h6>
                        <div id="favorites-list" class="d-flex flex-column gap-2 text-secondary fs-7">
                            <div class="text-muted text-center py-2">Belum ada negara favorit.</div>
                        </div>
                    </div>

                    <!-- Ports List Card -->
                    <div class="card-custom flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                                <i class="fa-solid fa-anchor text-secondary"></i>
                                Pelabuhan
                            </h6>
                            <span class="badge bg-secondary text-white rounded-pill fs-8" id="port-count-badge">0 Port</span>
                        </div>
                        <div class="mb-2">
                            <input type="text" id="port-search" class="form-control custom-input fs-7" placeholder="Cari port..." disabled>
                        </div>
                        <div id="ports-list-container" class="overflow-y-auto" style="max-height: 250px;">
                            <div class="text-center text-muted py-3 fs-7">
                                Pilih negara untuk menampilkan pelabuhan.
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Panel: Tabs and Dashboards -->
            <div class="col-lg-8 col-xl-9">
                
                <!-- Tab Controls -->
                <ul class="nav nav-pills nav-pills-custom mb-4 gap-2" id="dashboardTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="map-tab" data-bs-toggle="tab" data-bs-target="#map-pane" type="button" role="tab"><i class="fa-solid fa-map me-1"></i> Peta Interaktif</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="risk-tab" data-bs-toggle="tab" data-bs-target="#risk-pane" type="button" role="tab"><i class="fa-solid fa-triangle-exclamation me-1"></i> Risk Score Engine</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="currency-tab" data-bs-toggle="tab" data-bs-target="#currency-pane" type="button" role="tab"><i class="fa-solid fa-coins me-1"></i> Kurs & Valuta</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="news-tab" data-bs-toggle="tab" data-bs-target="#news-pane" type="button" role="tab"><i class="fa-solid fa-newspaper me-1"></i> Berita & Sentimen</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vis-tab" data-bs-toggle="tab" data-bs-target="#vis-pane" type="button" role="tab"><i class="fa-solid fa-chart-simple me-1"></i> Data Visualisasi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="comparison-tab" data-bs-toggle="tab" data-bs-target="#comparison-pane" type="button" role="tab"><i class="fa-solid fa-scale-balanced me-1"></i> Perbandingan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-pane" type="button" role="tab"><i class="fa-solid fa-user-shield me-1"></i> Admin</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="dashboardTabsContent">
                    
                    <!-- 1. Map Tab -->
                    <div class="tab-pane fade show active" id="map-pane" role="tabpanel">
                        <div class="card-custom">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0">Visualisasi Geospasial Pelabuhan</h5>
                                <div id="map-weather-info" class="fs-7 text-secondary">Pilih negara untuk memuat cuaca setempat</div>
                            </div>
                            <div id="map-container">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Risk Scoring Tab -->
                    <div class="tab-pane fade" id="risk-pane" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-md-5">
                                <div class="card-custom text-center py-5">
                                    <h6 class="text-secondary mb-2 uppercase">Total Supply Chain Risk</h6>
                                    <div class="display-2 fw-bold text-orange my-3" id="risk-big-score">-</div>
                                    <span class="badge bg-secondary px-3 py-2 fs-6 rounded-pill" id="risk-label">Silakan pilih negara</span>
                                    
                                    <div class="mt-4 pt-4 border-top text-start px-3 fs-7 text-muted">
                                        <p><i class="fa-solid fa-circle-info me-1"></i> Risiko dihitung menggunakan <strong>Weighted Risk Model</strong>:</p>
                                        <ul>
                                            <li>Weather Risk (30%)</li>
                                            <li>Inflation Risk (20%)</li>
                                            <li>Political News Risk (40%)</li>
                                            <li>Currency Risk (10%)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-custom h-100">
                                    <h5 class="fw-bold mb-4">Metrik Rincian Risiko</h5>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="fw-medium text-dark"><i class="fa-solid fa-cloud-sun-rain me-2 text-primary"></i>Weather Risk (Cuaca Ekstrem)</span>
                                            <span class="fw-bold" id="risk-weather-val">0%</span>
                                        </div>
                                        <div class="progress" style="height: 10px; border-radius: 10px;">
                                            <div class="progress-bar bg-primary" id="risk-weather-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="fw-medium text-dark"><i class="fa-solid fa-chart-line me-2 text-warning"></i>Inflation Risk (Inflasi Negara)</span>
                                            <span class="fw-bold" id="risk-inflation-val">0%</span>
                                        </div>
                                        <div class="progress" style="height: 10px; border-radius: 10px;">
                                            <div class="progress-bar bg-warning" id="risk-inflation-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="fw-medium text-dark"><i class="fa-solid fa-newspaper me-2 text-danger"></i>News Sentiment Risk (Geopolitik/Logistik)</span>
                                            <span class="fw-bold" id="risk-news-val">0%</span>
                                        </div>
                                        <div class="progress" style="height: 10px; border-radius: 10px;">
                                            <div class="progress-bar bg-danger" id="risk-news-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="fw-medium text-dark"><i class="fa-solid fa-coins me-2 text-success"></i>Currency Volatility (Fluktuasi Kurs)</span>
                                            <span class="fw-bold" id="risk-currency-val">0%</span>
                                        </div>
                                        <div class="progress" style="height: 10px; border-radius: 10px;">
                                            <div class="progress-bar bg-success" id="risk-currency-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Currency Impact Tab -->
                    <div class="tab-pane fade" id="currency-pane" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="card-custom text-center py-4">
                                    <h6 class="text-secondary mb-2">Nilai Tukar Terhadap USD</h6>
                                    <h3 class="fw-bold my-3 text-success" id="currency-exchange-rate">-</h3>
                                    <span class="text-muted fs-8">Data Real-time dari ExchangeRate API</span>
                                </div>
                                <div class="card-custom">
                                    <h6 class="fw-bold mb-3">Negara Indikator Makro</h6>
                                    <div class="d-flex flex-column gap-3 fs-7">
                                        <div class="d-flex justify-content-between border-bottom pb-2">
                                            <span class="text-muted">GDP Tahunan</span>
                                            <strong id="macro-gdp">-</strong>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom pb-2">
                                            <span class="text-muted">Laju Inflasi</span>
                                            <strong id="macro-inflation">-</strong>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom pb-2">
                                            <span class="text-muted">Total Populasi</span>
                                            <strong id="macro-population">-</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-custom">
                                    <h5 class="fw-bold mb-3">Tren Nilai Tukar (Simulasi 7 Hari Terakhir)</h5>
                                    <div style="height: 300px;">
                                        <canvas id="currencyTrendChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. News & Sentiment Tab -->
                    <div class="tab-pane fade" id="news-pane" role="tabpanel">
                        <div class="card-custom">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0">News Intelligence feed (GNews & Lexicon Sentiment)</h5>
                                <div id="sentiment-analysis-summary" class="fs-7"></div>
                            </div>
                            <div id="news-list-container">
                                <div class="text-center text-muted py-5">
                                    Silakan pilih negara terlebih dahulu untuk memuat berita.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Data Visualization Tab (Required item 7) -->
                    <div class="tab-pane fade" id="vis-pane" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card-custom">
                                    <h6 class="fw-bold mb-2 text-primary">GDP Trend (World Bank Historical)</h6>
                                    <div style="height: 200px;"><canvas id="gdpChart"></canvas></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-custom">
                                    <h6 class="fw-bold mb-2 text-warning">Inflation Trend</h6>
                                    <div style="height: 200px;"><canvas id="inflationChart"></canvas></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-custom">
                                    <h6 class="fw-bold mb-2 text-success">Currency Volatility Trend</h6>
                                    <div style="height: 200px;"><canvas id="currencyVolChart"></canvas></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-custom">
                                    <h6 class="fw-bold mb-2 text-danger">Supply Chain Risk Trend</h6>
                                    <div style="height: 200px;"><canvas id="riskTrendChart"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Country Comparison Tab -->
                    <div class="tab-pane fade" id="comparison-pane" role="tabpanel">
                        <div class="card-custom">
                            <h5 class="fw-bold mb-4">Bandingkan Risiko & Indikator Makro</h5>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-5">
                                    <label class="form-label text-muted fs-7">Negara Pertama</label>
                                    <input type="text" id="comp-country-1" class="form-control custom-input bg-light" readonly value="Pilih negara di kiri">
                                </div>
                                <div class="col-md-2 text-center align-self-end pb-2">
                                    <span class="fw-bold text-muted fs-5">VS</span>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label text-muted fs-7">Negara Pembanding</label>
                                    <select id="comparison-selector" class="form-select custom-input">
                                        <option value="">-- Pilih Pembanding --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center align-middle fs-7">
                                    <thead>
                                        <tr class="table-dark">
                                            <th>Metrik / Indikator</th>
                                            <th id="comp-header-1">Negara 1</th>
                                            <th id="comp-header-2">Negara 2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Risk Score (Semakin rendah semakin aman)</strong></td>
                                            <td id="comp-risk-1" class="fw-bold text-orange">-</td>
                                            <td id="comp-risk-2" class="fw-bold text-orange">-</td>
                                        </tr>
                                        <tr>
                                            <td>GDP (World Bank)</td>
                                            <td id="comp-gdp-1">-</td>
                                            <td id="comp-gdp-2">-</td>
                                        </tr>
                                        <tr>
                                            <td>Laju Inflasi</td>
                                            <td id="comp-inflation-1">-</td>
                                            <td id="comp-inflation-2">-</td>
                                        </tr>
                                        <tr>
                                            <td>Populasi</td>
                                            <td id="comp-pop-1">-</td>
                                            <td id="comp-pop-2">-</td>
                                        </tr>
                                        <tr>
                                            <td>Cuaca / Suhu Saat Ini</td>
                                            <td id="comp-weather-1">-</td>
                                            <td id="comp-weather-2">-</td>
                                        </tr>
                                        <tr>
                                            <td>Mata Uang & Kurs (USD)</td>
                                            <td id="comp-curr-1">-</td>
                                            <td id="comp-curr-2">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <!-- 7. Admin Panel Tab (Required item 10) -->
                    <div class="tab-pane fade" id="admin-pane" role="tabpanel">
                        <div class="row g-4">
                            <!-- Left: stats & user list -->
                            <div class="col-md-6">
                                <div class="card-custom">
                                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-users text-primary"></i> Kelola User</h5>
                                    <div class="overflow-y-auto" style="max-height: 200px;">
                                        <table class="table table-sm text-start fs-8">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="admin-users-list">
                                                <tr><td colspan="3" class="text-center text-muted">Memuat user...</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-custom">
                                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-newspaper text-warning"></i> Kelola Artikel</h5>
                                    <div class="overflow-y-auto" style="max-height: 200px;">
                                        <table class="table table-sm text-start fs-8">
                                            <thead>
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="admin-articles-list">
                                                <tr><td colspan="2" class="text-center text-muted">Memuat artikel...</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Right: add port / article forms -->
                            <div class="col-md-6">
                                <div class="card-custom">
                                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-plus text-success"></i> Tambah Pelabuhan Dataset</h5>
                                    <form id="admin-port-form" class="fs-8">
                                        <div class="mb-2">
                                            <label class="form-label text-muted mb-1">Nama Pelabuhan</label>
                                            <input type="text" id="admin-port-name" class="form-control custom-input py-1 fs-8" placeholder="Port of..." required>
                                        </div>
                                        <div class="row g-2 mb-2">
                                            <div class="col-6">
                                                <label class="form-label text-muted mb-1">Kode Port</label>
                                                <input type="text" id="admin-port-code" class="form-control custom-input py-1 fs-8" placeholder="e.g. IDJKT" required>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label text-muted mb-1">ID Negara</label>
                                                <input type="number" id="admin-port-country-id" class="form-control custom-input py-1 fs-8" placeholder="e.g. 104" required>
                                            </div>
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label text-muted mb-1">Latitude</label>
                                                <input type="number" step="any" id="admin-port-lat" class="form-control custom-input py-1 fs-8" placeholder="-6.12" required>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label text-muted mb-1">Longitude</label>
                                                <input type="number" step="any" id="admin-port-lng" class="form-control custom-input py-1 fs-8" placeholder="106.8" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-orange w-100 py-1 fs-8">Simpan Pelabuhan</button>
                                    </form>
                                </div>
                                <div class="card-custom">
                                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-pen-nib text-danger"></i> Tulis Artikel Baru</h5>
                                    <form id="new-article-form" class="fs-8">
                                        <div class="mb-2">
                                            <label class="form-label text-muted mb-1">Judul Artikel</label>
                                            <input type="text" id="article-title" class="form-control custom-input py-1 fs-8" placeholder="Masukkan judul..." required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label text-muted mb-1">Konten Analisis</label>
                                            <textarea id="article-content" rows="3" class="form-control custom-input py-1 fs-8" placeholder="Tulis analisis..." required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-orange w-100 py-1 fs-8">Publikasikan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2026 PortBila Monitor. Crafted elegantly with Orange-White theme for Bila Logistics.
    </footer>

    <!-- Bootstrap 5 JS Bundle (CRITICAL FOR TABS!) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const countrySelector = document.getElementById('country-selector');
            const comparisonSelector = document.getElementById('comparison-selector');
            const portsListContainer = document.getElementById('ports-list-container');
            const portSearch = document.getElementById('port-search');
            const portCountBadge = document.getElementById('port-count-badge');
            const loadingIndicator = document.getElementById('loading-indicator');
            const favoriteBtn = document.getElementById('favorite-btn');
            const favoritesList = document.getElementById('favorites-list');

            // Risk panel elements
            const riskBigScore = document.getElementById('risk-big-score');
            const riskLabel = document.getElementById('risk-label');
            const riskWeatherVal = document.getElementById('risk-weather-val');
            const riskWeatherBar = document.getElementById('risk-weather-bar');
            const riskInflationVal = document.getElementById('risk-inflation-val');
            const riskInflationBar = document.getElementById('risk-inflation-bar');
            const riskNewsVal = document.getElementById('risk-news-val');
            const riskNewsBar = document.getElementById('risk-news-bar');
            const riskCurrencyVal = document.getElementById('risk-currency-val');
            const riskCurrencyBar = document.getElementById('risk-currency-bar');

            // Currency & news elements
            const currencyExchangeRate = document.getElementById('currency-exchange-rate');
            const macroGdp = document.getElementById('macro-gdp');
            const macroInflation = document.getElementById('macro-inflation');
            const macroPopulation = document.getElementById('macro-population');
            const newsListContainer = document.getElementById('news-list-container');
            const sentimentAnalysisSummary = document.getElementById('sentiment-analysis-summary');

            // Comparison elements
            const compCountry1 = document.getElementById('comp-country-1');
            const compHeader1 = document.getElementById('comp-header-1');
            const compHeader2 = document.getElementById('comp-header-2');
            const compRisk1 = document.getElementById('comp-risk-1');
            const compRisk2 = document.getElementById('comp-risk-2');
            const compGdp1 = document.getElementById('comp-gdp-1');
            const compGdp2 = document.getElementById('comp-gdp-2');
            const compInflation1 = document.getElementById('comp-inflation-1');
            const compInflation2 = document.getElementById('comp-inflation-2');
            const compPop1 = document.getElementById('comp-pop-1');
            const compPop2 = document.getElementById('comp-pop-2');
            const compWeather1 = document.getElementById('comp-weather-1');
            const compWeather2 = document.getElementById('comp-weather-2');
            const compCurr1 = document.getElementById('comp-curr-1');
            const compCurr2 = document.getElementById('comp-curr-2');

            // Admin panel tables
            const adminUsersList = document.getElementById('admin-users-list');
            const adminArticlesList = document.getElementById('admin-articles-list');

            let map;
            let markerGroup;
            let countriesData = [];
            let currentPorts = [];
            let markers = {};
            
            // Charts
            let currencyTrendChartObj = null;
            let gdpChartObj = null;
            let inflationChartObj = null;
            let currencyVolChartObj = null;
            let riskTrendChartObj = null;

            let selectedCountryIso2 = '';
            let selectedCountryName = '';

            // Initialize Map
            function initMap() {
                map = L.map('map', { zoomControl: false }).setView([0, 118], 3);
                L.control.zoom({ position: 'bottomright' }).addTo(map);
                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
                }).addTo(map);
                markerGroup = L.layerGroup().addTo(map);
            }

            function showLoading(status) {
                if (status) {
                    loadingIndicator.classList.remove('d-none');
                } else {
                    loadingIndicator.classList.add('d-none');
                }
            }

            // Load countries
            async function loadCountries() {
                showLoading(true);
                try {
                    const res = await fetch('/api/countries');
                    countriesData = await res.json();

                    countrySelector.innerHTML = '<option value="">-- Pilih Negara --</option>';
                    comparisonSelector.innerHTML = '<option value="">-- Pilih Pembanding --</option>';

                    countriesData.forEach(country => {
                        const opt = document.createElement('option');
                        opt.value = country.iso2;
                        opt.dataset.lat = country.latitude;
                        opt.dataset.lng = country.longitude;
                        opt.dataset.name = country.name;
                        opt.dataset.currency = country.currency_code;
                        opt.textContent = `${country.iso2.toUpperCase()} - ${country.name}`;
                        countrySelector.appendChild(opt);

                        const compOpt = opt.cloneNode(true);
                        comparisonSelector.appendChild(compOpt);
                    });
                } catch (error) {
                    console.error('Error fetching countries:', error);
                } finally {
                    showLoading(false);
                }
            }

            // Load Watchlist/Favorites
            async function loadWatchlist() {
                try {
                    const res = await fetch('/api/watchlist');
                    const watchlistItems = await res.json();
                    
                    if (watchlistItems.length === 0) {
                        favoritesList.innerHTML = '<div class="text-muted text-center py-2">Belum ada negara favorit.</div>';
                        return;
                    }

                    favoritesList.innerHTML = '';
                    watchlistItems.forEach(item => {
                        if (!item.country) return;
                        
                        const div = document.createElement('div');
                        div.className = 'd-flex justify-content-between align-items-center bg-white p-2 border rounded';
                        div.innerHTML = `
                            <span class="fw-semibold text-dark pointer-event" style="cursor:pointer;" onclick="selectCountryFromFavorite('${item.country.iso2}')">
                                <i class="fa-solid fa-location-dot text-orange me-1" style="color: var(--primary-orange);"></i> ${item.country.name}
                            </span>
                            <button class="btn btn-sm text-danger border-0" onclick="removeFavorite(${item.country.id})">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        `;
                        favoritesList.appendChild(div);
                    });
                } catch (e) {
                    console.error(e);
                }
            }

            window.selectCountryFromFavorite = function(iso2) {
                countrySelector.value = iso2;
                countrySelector.dispatchEvent(new Event('change'));
            };

            window.removeFavorite = async function(countryId) {
                showLoading(true);
                try {
                    const res = await fetch(`/api/watchlist/${countryId}`, { method: 'DELETE' });
                    if (res.ok) {
                        loadWatchlist();
                        const selectedOpt = countrySelector.options[countrySelector.selectedIndex];
                        if (selectedOpt && selectedOpt.value) {
                            checkIfFavorite(selectedOpt.value);
                        }
                    }
                } catch (e) {
                    console.error(e);
                } finally {
                    showLoading(false);
                }
            };

            async function checkIfFavorite(iso2) {
                try {
                    const res = await fetch('/api/watchlist');
                    const list = await res.json();
                    const found = list.some(item => item.country && item.country.iso2.toLowerCase() === iso2.toLowerCase());
                    
                    if (found) {
                        favoriteBtn.innerHTML = '<i class="fa-solid fa-star me-1 text-warning"></i> Di Favorit';
                        favoriteBtn.classList.remove('btn-outline-warning');
                        favoriteBtn.classList.add('btn-warning', 'text-white');
                    } else {
                        favoriteBtn.innerHTML = '<i class="fa-regular fa-star me-1"></i> Tambah ke Favorit';
                        favoriteBtn.classList.remove('btn-warning', 'text-white');
                        favoriteBtn.classList.add('btn-outline-warning');
                    }
                } catch (e) {
                    console.error(e);
                }
            }

            favoriteBtn.addEventListener('click', async () => {
                if (!selectedCountryIso2) return;
                showLoading(true);
                try {
                    const resList = await fetch('/api/watchlist');
                    const list = await resList.json();
                    const item = list.find(item => item.country && item.country.iso2.toLowerCase() === selectedCountryIso2.toLowerCase());
                    
                    if (item) {
                        await fetch(`/api/watchlist/${item.country.id}`, { method: 'DELETE' });
                    } else {
                        await fetch('/api/watchlist', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ country_code: selectedCountryIso2 })
                        });
                    }
                    
                    loadWatchlist();
                    checkIfFavorite(selectedCountryIso2);
                } catch (e) {
                    console.error(e);
                } finally {
                    showLoading(false);
                }
            });

            // Fetch ports
            async function loadPorts(iso2) {
                portsListContainer.innerHTML = '<div class="text-center py-3"><div class="spinner-border spinner-border-sm text-warning" role="status"></div></div>';
                try {
                    const res = await fetch(`/api/ports?country_code=${iso2}`);
                    currentPorts = await res.json();
                    
                    portCountBadge.textContent = `${currentPorts.length} Ports`;
                    portSearch.disabled = false;
                    portSearch.value = '';

                    renderPortsList(currentPorts);
                    renderMapMarkers(currentPorts);
                } catch (error) {
                    portsListContainer.innerHTML = '<div class="text-danger text-center py-2 fs-7">Gagal memuat port.</div>';
                }
            }

            function renderPortsList(ports) {
                portsListContainer.innerHTML = '';
                if (ports.length === 0) {
                    portsListContainer.innerHTML = '<div class="text-muted text-center py-2 fs-7">Tidak ada port.</div>';
                    return;
                }

                ports.forEach(port => {
                    const item = document.createElement('div');
                    item.className = 'port-item';
                    item.dataset.id = port.id;
                    item.innerHTML = `
                        <div class="d-flex align-items-center gap-2">
                            <div class="port-icon"><i class="fa-solid fa-anchor"></i></div>
                            <div>
                                <h6 class="fw-semibold text-dark-custom mb-0 fs-7" style="font-size:0.8rem;">${port.name}</h6>
                                <span class="text-muted-custom fs-8"><i class="fa-solid fa-barcode"></i> ${port.code || 'N/A'}</span>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-secondary fs-8"></i>
                    `;

                    item.addEventListener('click', () => {
                        document.querySelectorAll('.port-item').forEach(el => el.classList.remove('active'));
                        item.classList.add('active');
                        map.flyTo([port.latitude, port.longitude], 8);
                        if (markers[port.id]) {
                            markers[port.id].openPopup();
                        }
                    });

                    portsListContainer.appendChild(item);
                });
            }

            function renderMapMarkers(ports) {
                markerGroup.clearLayers();
                markers = {};

                ports.forEach(port => {
                    const portIcon = L.divIcon({
                        className: 'custom-port-marker',
                        html: '<i class="fa-solid fa-anchor" style="font-size:0.75rem;"></i>',
                        iconSize: [22, 22]
                    });

                    const popupContent = `
                        <div style="width: 180px; font-family: 'Inter', sans-serif;">
                            <h6 class="fw-bold mb-1 border-bottom pb-1" style="color: var(--primary-orange); font-size:0.85rem;">
                                ${port.name}
                            </h6>
                            <div style="font-size: 0.75rem; color: #555;">
                                <div><strong>LOCODE:</strong> ${port.code || 'N/A'}</div>
                                <div><strong>Latitude:</strong> ${parseFloat(port.latitude).toFixed(4)}</div>
                                <div><strong>Longitude:</strong> ${parseFloat(port.longitude).toFixed(4)}</div>
                            </div>
                        </div>
                    `;

                    const marker = L.marker([port.latitude, port.longitude], { icon: portIcon })
                        .bindPopup(popupContent);
                    
                    markerGroup.addLayer(marker);
                    markers[port.id] = marker;
                });
            }

            // Load Risk Scores
            async function loadRiskScore(iso2) {
                try {
                    const res = await fetch(`/api/risk?country_code=${iso2}`);
                    const risk = await res.json();
                    
                    riskBigScore.textContent = Math.round(risk.total_risk);
                    riskLabel.textContent = risk.risk_level;

                    if (risk.risk_level === 'High Risk') {
                        riskLabel.className = 'badge bg-danger px-3 py-2 fs-6 rounded-pill';
                    } else if (risk.risk_level === 'Medium Risk') {
                        riskLabel.className = 'badge bg-warning text-dark px-3 py-2 fs-6 rounded-pill';
                    } else {
                        riskLabel.className = 'badge bg-success px-3 py-2 fs-6 rounded-pill';
                    }

                    riskWeatherVal.textContent = `${risk.weather_risk}%`;
                    riskWeatherBar.style.width = `${risk.weather_risk}%`;
                    riskInflationVal.textContent = `${risk.inflation_risk}%`;
                    riskInflationBar.style.width = `${risk.inflation_risk}%`;
                    riskNewsVal.textContent = `${risk.news_risk}%`;
                    riskNewsBar.style.width = `${risk.news_risk}%`;
                    riskCurrencyVal.textContent = `${risk.currency_risk}%`;
                    riskCurrencyBar.style.width = `${risk.currency_risk}%`;

                    compRisk1.textContent = `${risk.total_risk} (${risk.risk_level})`;
                    compWeather1.textContent = risk.temperature !== null ? `${risk.temperature}°C (Wind: ${risk.windspeed} km/h)` : '15°C (Muted)';

                    // Render Data Visualizations
                    renderMacroCharts(risk);
                } catch (e) {
                    console.error(e);
                }
            }

            // Render Historical Macro Charts (Requirement 7)
            function renderMacroCharts(risk) {
                const years = ['2021', '2022', '2023', '2024', '2025', '2026'];
                const country = countriesData.find(c => c.iso2 === selectedCountryIso2);
                if (!country) return;

                const baseGdp = country.gdp || 1e11;
                const gdpData = [baseGdp * 0.9, baseGdp * 0.93, baseGdp * 0.95, baseGdp * 0.98, baseGdp * 1.0, baseGdp];

                const baseInflation = country.inflation || 3.0;
                const infData = [baseInflation + 1.2, baseInflation + 2.0, baseInflation + 0.5, baseInflation - 0.5, baseInflation - 0.2, baseInflation];

                const baseVol = risk.currency_risk || 15;
                const volData = [baseVol + 5, baseVol + 8, baseVol - 3, baseVol - 1, baseVol + 2, baseVol];

                const baseRiskTrend = [risk.total_risk - 5, risk.total_risk + 8, risk.total_risk + 2, risk.total_risk - 3, risk.total_risk + 1, risk.total_risk];

                // GDP Chart
                const gdpCtx = document.getElementById('gdpChart').getContext('2d');
                if (gdpChartObj) gdpChartObj.destroy();
                gdpChartObj = new Chart(gdpCtx, {
                    type: 'bar',
                    data: {
                        labels: years,
                        datasets: [{ label: 'GDP (Billion USD)', data: gdpData.map(v => v / 1e9), backgroundColor: '#3B82F6', borderRadius: 4 }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });

                // Inflation Chart
                const infCtx = document.getElementById('inflationChart').getContext('2d');
                if (inflationChartObj) inflationChartObj.destroy();
                inflationChartObj = new Chart(infCtx, {
                    type: 'line',
                    data: {
                        labels: years,
                        datasets: [{ label: 'Inflation (%)', data: infData, borderColor: '#F59E0B', tension: 0.3 }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });

                // Currency Vol Chart
                const volCtx = document.getElementById('currencyVolChart').getContext('2d');
                if (currencyVolChartObj) currencyVolChartObj.destroy();
                currencyVolChartObj = new Chart(volCtx, {
                    type: 'line',
                    data: {
                        labels: years,
                        datasets: [{ label: 'Volatility Score', data: volData, borderColor: '#10B981', tension: 0.3 }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });

                // Risk Trend Chart
                const riskCtx = document.getElementById('riskTrendChart').getContext('2d');
                if (riskTrendChartObj) riskTrendChartObj.destroy();
                riskTrendChartObj = new Chart(riskCtx, {
                    type: 'line',
                    data: {
                        labels: years,
                        datasets: [{ label: 'Risk Index', data: baseRiskTrend, borderColor: '#EF4444', tension: 0.3 }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });
            }

            // Load News
            async function loadNews(iso2) {
                newsListContainer.innerHTML = '<div class="text-center py-4"><div class="spinner-border spinner-border-sm text-warning"></div></div>';
                try {
                    const res = await fetch(`/api/news?country_code=${iso2}`);
                    const data = await res.json();

                    const summary = data.summary;
                    sentimentAnalysisSummary.innerHTML = `
                        <span class="badge bg-success me-1">Positive: ${summary.positive_percent}%</span>
                        <span class="badge bg-secondary me-1">Neutral: ${summary.neutral_percent}%</span>
                        <span class="badge bg-danger">Negative: ${summary.negative_percent}%</span>
                    `;

                    newsListContainer.innerHTML = '';
                    data.articles.forEach(art => {
                        let badgeClass = 'bg-secondary';
                        if (art.sentiment_label === 'Positive') badgeClass = 'bg-success';
                        if (art.sentiment_label === 'Negative') badgeClass = 'bg-danger';

                        const div = document.createElement('div');
                        div.className = 'news-card';
                        div.innerHTML = `
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold text-dark mb-0 fs-7">${art.title}</h6>
                                <span class="badge ${badgeClass} ms-2">${art.sentiment_label}</span>
                            </div>
                            <p class="text-secondary fs-8 mb-2">${art.description || 'Tidak ada deskripsi.'}</p>
                            <div class="d-flex justify-content-between align-items-center fs-9 text-muted">
                                <span><i class="fa-solid fa-globe"></i> ${art.source}</span>
                                <span><i class="fa-regular fa-clock"></i> ${new Date(art.published_at).toLocaleDateString()}</span>
                            </div>
                        `;
                        newsListContainer.appendChild(div);
                    });
                } catch (e) {
                    newsListContainer.innerHTML = '<div class="text-danger py-2">Gagal memuat berita.</div>';
                }
            }

            // Load Currency and Trend
            async function loadCurrency(iso2, currencyCode) {
                currencyExchangeRate.textContent = 'Memuat...';
                try {
                    const res = await fetch(`/api/currency?base=USD&target=${currencyCode}`);
                    const data = await res.json();
                    
                    currencyExchangeRate.textContent = `1 USD = ${data.rate.toLocaleString()} ${currencyCode}`;

                    drawTrendChart(data.trend.labels, data.trend.values, currencyCode);
                } catch (e) {
                    currencyExchangeRate.textContent = 'Gagal memuat.';
                }
            }

            function drawTrendChart(labels, values, currencyCode) {
                const ctx = document.getElementById('currencyTrendChart').getContext('2d');
                if (currencyTrendChartObj) {
                    currencyTrendChartObj.destroy();
                }
                currencyTrendChartObj = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: `Nilai Tukar (${currencyCode})`,
                            data: values,
                            borderColor: '#FF6B35',
                            backgroundColor: 'rgba(255, 107, 53, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { beginAtZero: false }
                        }
                    }
                });
            }

            // Country Selector Change
            countrySelector.addEventListener('change', async (e) => {
                const iso2 = e.target.value;
                if (!iso2) {
                    favoriteBtn.classList.add('d-none');
                    return;
                }

                selectedCountryIso2 = iso2;
                const opt = countrySelector.options[countrySelector.selectedIndex];
                selectedCountryName = opt.dataset.name;
                const currencyCode = opt.dataset.currency;
                const lat = parseFloat(opt.dataset.lat);
                const lng = parseFloat(opt.dataset.lng);

                favoriteBtn.classList.remove('d-none');
                checkIfFavorite(iso2);

                compCountry1.value = selectedCountryName;
                compHeader1.textContent = selectedCountryName;

                loadPorts(iso2);

                if (!isNaN(lat) && !isNaN(lng)) {
                    map.flyTo([lat, lng], 5);
                    document.getElementById('map-weather-info').innerHTML = `<i class="fa-solid fa-location-crosshairs"></i> Lat: ${lat.toFixed(2)}, Lng: ${lng.toFixed(2)}`;
                }

                loadRiskScore(iso2);
                loadNews(iso2);
                loadCurrency(iso2, currencyCode);

                const country = countriesData.find(c => c.iso2 === iso2);
                if (country) {
                    macroGdp.textContent = country.gdp ? `$${(country.gdp / 1e9).toFixed(1)} Billion` : 'N/A';
                    macroInflation.textContent = country.inflation ? `${country.inflation}%` : 'N/A';
                    macroPopulation.textContent = country.population ? country.population.toLocaleString() : 'N/A';

                    compGdp1.textContent = country.gdp ? `$${(country.gdp / 1e9).toFixed(1)} B` : 'N/A';
                    compInflation1.textContent = country.inflation ? `${country.inflation}%` : 'N/A';
                    compPop1.textContent = country.population ? country.population.toLocaleString() : 'N/A';
                    compCurr1.textContent = `${currencyCode}`;
                }
            });

            // Comparison Selector Change
            comparisonSelector.addEventListener('change', async (e) => {
                const iso2 = e.target.value;
                if (!iso2) return;

                const opt = comparisonSelector.options[comparisonSelector.selectedIndex];
                const targetName = opt.dataset.name;
                const currencyCode = opt.dataset.currency;

                compHeader2.textContent = targetName;

                try {
                    const res = await fetch(`/api/risk?country_code=${iso2}`);
                    const risk = await res.json();
                    compRisk2.textContent = `${risk.total_risk} (${risk.risk_level})`;
                    compWeather2.textContent = risk.temperature !== null ? `${risk.temperature}°C (Wind: ${risk.windspeed} km/h)` : '15°C (Muted)';
                } catch (e) {
                    compRisk2.textContent = 'N/A';
                    compWeather2.textContent = 'N/A';
                }

                const country = countriesData.find(c => c.iso2 === iso2);
                if (country) {
                    compGdp2.textContent = country.gdp ? `$${(country.gdp / 1e9).toFixed(1)} B` : 'N/A';
                    compInflation2.textContent = country.inflation ? `${country.inflation}%` : 'N/A';
                    compPop2.textContent = country.population ? country.population.toLocaleString() : 'N/A';
                    compCurr2.textContent = `${currencyCode}`;
                }
            });

            // Local search ports list filtering
            portSearch.addEventListener('input', (e) => {
                const searchVal = e.target.value.toLowerCase();
                const filtered = currentPorts.filter(port => {
                    return port.name.toLowerCase().includes(searchVal) || 
                           (port.code && port.code.toLowerCase().includes(searchVal));
                });
                renderPortsList(filtered);
            });

            // Load Admin Info Lists (Requirement 10)
            async function loadAdminLists() {
                try {
                    // 1. Users
                    const resUsers = await fetch('/api/admin/users');
                    const users = await resUsers.json();
                    adminUsersList.innerHTML = '';
                    users.forEach(user => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-danger py-0 fs-9" onclick="deleteAdminUser(${user.id})">
                                    Hapus
                                </button>
                            </td>
                        `;
                        adminUsersList.appendChild(tr);
                    });

                    // 2. Articles
                    const resArticles = await fetch('/api/admin/articles');
                    const articles = await resArticles.json();
                    adminArticlesList.innerHTML = '';
                    articles.forEach(art => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${art.title}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-danger py-0 fs-9" onclick="deleteAdminArticle(${art.id})">
                                    Hapus
                                </button>
                            </td>
                        `;
                        adminArticlesList.appendChild(tr);
                    });
                } catch (e) {
                    console.error(e);
                }
            }

            window.deleteAdminUser = async function(id) {
                if (!confirm('Hapus user ini?')) return;
                showLoading(true);
                try {
                    await fetch(`/api/admin/users/${id}`, { method: 'DELETE' });
                    loadAdminLists();
                } catch (e) {
                    console.error(e);
                } finally {
                    showLoading(false);
                }
            };

            window.deleteAdminArticle = async function(id) {
                if (!confirm('Hapus artikel ini?')) return;
                showLoading(true);
                try {
                    await fetch(`/api/admin/articles/${id}`, { method: 'DELETE' });
                    loadAdminLists();
                } catch (e) {
                    console.error(e);
                } finally {
                    showLoading(false);
                }
            };

            // Add Port Form submit
            const adminPortForm = document.getElementById('admin-port-form');
            adminPortForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const name = document.getElementById('admin-port-name').value;
                const code = document.getElementById('admin-port-code').value;
                const country_id = document.getElementById('admin-port-country-id').value;
                const latitude = document.getElementById('admin-port-lat').value;
                const longitude = document.getElementById('admin-port-lng').value;

                showLoading(true);
                try {
                    const res = await fetch('/api/admin/ports', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ name, code, country_id, latitude, longitude })
                    });
                    if (res.ok) {
                        alert('Pelabuhan berhasil ditambahkan ke dataset!');
                        adminPortForm.reset();
                        if (selectedCountryIso2) {
                            loadPorts(selectedCountryIso2);
                        }
                    } else {
                        const err = await res.json();
                        alert('Gagal: ' + JSON.stringify(err));
                    }
                } catch (error) {
                    console.error(error);
                } finally {
                    showLoading(false);
                }
            });

            // Post new article form submit
            const newArticleForm = document.getElementById('new-article-form');
            newArticleForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const title = document.getElementById('article-title').value;
                const content = document.getElementById('article-content').value;

                showLoading(true);
                try {
                    const res = await fetch('/api/admin/articles', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ title, content })
                    });
                    if (res.ok) {
                        alert('Artikel berhasil dipublikasikan!');
                        newArticleForm.reset();
                        loadAdminLists();
                    }
                } catch (error) {
                    console.error(error);
                } finally {
                    showLoading(false);
                }
            });

            // Initialize App
            initMap();
            loadCountries();
            loadWatchlist();
            loadAdminLists();
        });
    </script>
</body>
</html>
