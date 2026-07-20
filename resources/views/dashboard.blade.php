<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Port Monitoring Platform</title>
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
    
    <style>
        :root {
            --primary-orange: #FF6B35;
            --primary-orange-hover: #E85A24;
            --primary-orange-light: rgba(255, 107, 53, 0.1);
            --bg-light: #F8F9FA;
            --bg-white: #FFFFFF;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --border-light: #E2E8F0;
            --accent-green: #10B981;
            --accent-blue: #3B82F6;
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

        /* Premium Dashboard Cards */
        .card-custom {
            background-color: var(--bg-white);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 24px;
        }

        .card-custom:hover {
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.06);
            border-color: rgba(255, 107, 53, 0.3);
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

        /* Sidebar Port List Items */
        .port-item {
            background: var(--bg-light);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 14px 18px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
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
            transition: all 0.2s ease;
        }

        /* Interactive Map Container */
        #map-container {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-light);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            height: 550px;
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
            box-shadow: 0 0 12px rgba(255, 107, 53, 0.6);
            transition: all 0.2s ease;
        }

        .custom-port-marker:hover {
            transform: scale(1.2);
            background-color: var(--primary-orange-hover);
        }

        /* Leaflet popup customization */
        .leaflet-popup-content-wrapper {
            border-radius: 12px !important;
            padding: 4px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
            border: 1px solid var(--border-light) !important;
        }

        .leaflet-popup-tip {
            box-shadow: none !important;
        }

        /* Custom Stats Widget */
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

        /* Micro animation for loading state */
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
                <i class="fa-solid fa-compass text-orange" style="color: var(--primary-orange);"></i>
                PORT<span>BILA</span>
            </a>
            <span class="badge-orange ms-3 d-none d-sm-inline-block">
                <i class="fa-solid fa-shield-halved me-1"></i> Global Supply Chain Monitor
            </span>
            <div class="ms-auto d-flex align-items-center gap-3">
                <small class="text-secondary d-none d-md-inline-block">Client: <strong>Bila Logistics</strong></small>
                <div class="pulse-loader d-none" id="loading-indicator"></div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid px-4 px-md-5 mb-5">
        <div class="row g-4">
            <!-- Left Panel: Controls & Lists -->
            <div class="col-lg-4">
                <div class="d-flex flex-column gap-4">
                    
                    <!-- Country Selector Card -->
                    <div class="card-custom">
                        <h5 class="fw-bold mb-3 d-flex align-items-center gap-2">
                            <i class="fa-solid fa-earth-americas text-secondary"></i>
                            Pilih Negara Pemantauan
                        </h5>
                        <p class="text-secondary fs-7 mb-4">
                            Peta akan langsung beralih dan memuat daftar pelabuhan hanya dari negara yang Anda pilih di bawah.
                        </p>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted fw-medium fs-7" for="country-selector">Nama Negara</label>
                            <select id="country-selector" class="form-select custom-input">
                                <option value="">Memuat daftar negara...</option>
                            </select>
                        </div>
                    </div>

                    <!-- Selected Country Info / Metadata -->
                    <div class="card-custom d-none" id="country-info-card">
                        <h5 class="fw-bold mb-3 text-orange" style="color: var(--primary-orange);" id="info-country-name">Indonesia</h5>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="stat-widget">
                                    <span class="d-block text-secondary fs-8">ISO Code</span>
                                    <strong class="fs-6" id="info-iso-code">IDN</strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-widget">
                                    <span class="d-block text-secondary fs-8">Currency</span>
                                    <strong class="fs-6" id="info-currency">IDR (Rupiah)</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ports List Card -->
                    <div class="card-custom flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0 d-flex align-items-center gap-2">
                                <i class="fa-solid fa-anchor text-secondary"></i>
                                Pelabuhan Terdaftar
                            </h5>
                            <span class="badge bg-secondary text-white rounded-pill fs-8 px-2 py-1" id="port-count-badge">0 Port</span>
                        </div>

                        <!-- Search Port within Loaded List -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0" style="border-radius: 10px 0 0 10px; border-color: var(--border-light);">
                                    <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                                </span>
                                <input type="text" id="port-search" class="form-control custom-input border-start-0" style="border-radius: 0 10px 10px 0;" placeholder="Cari nama atau kode port..." disabled>
                            </div>
                        </div>

                        <!-- List Container -->
                        <div id="ports-list-container" class="overflow-y-auto" style="max-height: 350px;">
                            <div class="text-center text-muted py-4 fs-7">
                                <i class="fa-solid fa-circle-info d-block fs-3 mb-2 text-secondary"></i>
                                Silakan pilih negara di atas untuk menampilkan pelabuhan.
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Panel: Interactive Leaflet Map -->
            <div class="col-lg-8">
                <div class="d-flex flex-column h-100">
                    <div id="map-container" class="flex-grow-1">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2026 PortBila Monitor. Crafted elegantly with Orange-White theme for Bila Logistics.
    </footer>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const countrySelector = document.getElementById('country-selector');
            const countryInfoCard = document.getElementById('country-info-card');
            const infoCountryName = document.getElementById('info-country-name');
            const infoIsoCode = document.getElementById('info-iso-code');
            const infoCurrency = document.getElementById('info-currency');
            const portsListContainer = document.getElementById('ports-list-container');
            const portSearch = document.getElementById('port-search');
            const portCountBadge = document.getElementById('port-count-badge');
            const loadingIndicator = document.getElementById('loading-indicator');

            let map;
            let markerGroup;
            let countriesData = [];
            let currentPorts = [];
            let markers = {};

            // Initialize Map
            function initMap() {
                // Centered at Equator initially
                map = L.map('map', {
                    zoomControl: false
                }).setView([0, 118], 3);

                // Add zoom control at bottom right
                L.control.zoom({
                    position: 'bottomright'
                }).addTo(map);

                // Light clean map layer matching the white theme
                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
                }).addTo(map);

                markerGroup = L.layerGroup().addTo(map);
            }

            // Show/Hide Loading Indicator
            function showLoading(status) {
                if (status) {
                    loadingIndicator.classList.remove('d-none');
                } else {
                    loadingIndicator.classList.add('d-none');
                }
            }

            // Fetch and Populate Countries list
            async function loadCountries() {
                showLoading(true);
                try {
                    const res = await fetch('/api/countries');
                    countriesData = await res.json();

                    countrySelector.innerHTML = '<option value="">-- Pilih Negara --</option>';
                    countriesData.forEach(country => {
                        const opt = document.createElement('option');
                        opt.value = country.iso2;
                        opt.dataset.lat = country.latitude;
                        opt.dataset.lng = country.longitude;
                        opt.dataset.name = country.name;
                        opt.dataset.iso3 = country.iso3;
                        opt.dataset.currency = `${country.currency_code || 'N/A'} - ${country.currency_name || 'N/A'}`;
                        opt.textContent = `${country.iso2.toUpperCase()} - ${country.name}`;
                        countrySelector.appendChild(opt);
                    });
                } catch (error) {
                    console.error('Error fetching countries:', error);
                    countrySelector.innerHTML = '<option value="">Gagal memuat negara</option>';
                } finally {
                    showLoading(false);
                }
            }

            // Fetch ports of selected country (Lazy Loading)
            async function loadPorts(iso2) {
                showLoading(true);
                portsListContainer.innerHTML = '<div class="text-center py-4"><div class="spinner-border spinner-border-sm text-warning" role="status"></div><span class="ms-2 fs-7 text-muted">Memuat port...</span></div>';
                
                try {
                    const res = await fetch(`/api/ports?country_code=${iso2}`);
                    currentPorts = await res.json();
                    
                    portCountBadge.textContent = `${currentPorts.length} Ports`;
                    portSearch.disabled = false;
                    portSearch.value = '';

                    renderPortsList(currentPorts);
                    renderMapMarkers(currentPorts);
                } catch (error) {
                    console.error('Error fetching ports:', error);
                    portsListContainer.innerHTML = '<div class="text-danger text-center py-3 fs-7">Gagal memuat daftar port.</div>';
                } finally {
                    showLoading(false);
                }
            }

            // Render Ports inside list container
            function renderPortsList(ports) {
                portsListContainer.innerHTML = '';
                
                if (ports.length === 0) {
                    portsListContainer.innerHTML = '<div class="text-muted text-center py-3 fs-7">Tidak ada pelabuhan untuk negara ini.</div>';
                    return;
                }

                ports.forEach(port => {
                    const item = document.createElement('div');
                    item.className = 'port-item';
                    item.dataset.id = port.id;
                    item.innerHTML = `
                        <div class="d-flex align-items-center gap-3">
                            <div class="port-icon">
                                <i class="fa-solid fa-anchor"></i>
                            </div>
                            <div>
                                <h6 class="fw-semibold text-dark-custom mb-1 fs-7" style="color: var(--text-dark);">${port.name}</h6>
                                <span class="text-muted-custom fs-8 text-secondary"><i class="fa-solid fa-barcode me-1"></i> ${port.code || 'N/A'}</span>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-secondary fs-8"></i>
                    `;

                    // Click item to center on map and open popup
                    item.addEventListener('click', () => {
                        document.querySelectorAll('.port-item').forEach(el => el.classList.remove('active'));
                        item.classList.add('active');

                        map.flyTo([port.latitude, port.longitude], 7);
                        if (markers[port.id]) {
                            markers[port.id].openPopup();
                        }
                    });

                    portsListContainer.appendChild(item);
                });
            }

            // Render markers on Leaflet map
            function renderMapMarkers(ports) {
                markerGroup.clearLayers();
                markers = {};

                ports.forEach(port => {
                    // Create Custom Marker HTML/CSS
                    const portIcon = L.divIcon({
                        className: 'custom-port-marker',
                        html: '<i class="fa-solid fa-anchor"></i>',
                        iconSize: [28, 28]
                    });

                    const popupContent = `
                        <div style="width: 200px; font-family: 'Inter', sans-serif; padding: 5px;">
                            <h6 class="fw-bold mb-2 border-bottom pb-2 d-flex align-items-center gap-2" style="color: var(--primary-orange);">
                                <i class="fa-solid fa-anchor"></i> ${port.name}
                            </h6>
                            <div class="d-flex flex-column gap-1 text-muted" style="font-size: 0.8rem;">
                                <div><strong>LOCODE:</strong> ${port.code || 'N/A'}</div>
                                <div><strong>Lat:</strong> ${parseFloat(port.latitude).toFixed(4)}</div>
                                <div><strong>Lng:</strong> ${parseFloat(port.longitude).toFixed(4)}</div>
                            </div>
                        </div>
                    `;

                    const marker = L.marker([port.latitude, port.longitude], { icon: portIcon })
                        .bindPopup(popupContent);
                    
                    markerGroup.addLayer(marker);
                    markers[port.id] = marker;

                    // Sync map marker click to active list item
                    marker.on('click', () => {
                        document.querySelectorAll('.port-item').forEach(el => {
                            if (el.dataset.id == port.id) {
                                el.classList.add('active');
                                el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                            } else {
                                el.classList.remove('active');
                            }
                        });
                    });
                });
            }

            // Dropdown selection change event
            countrySelector.addEventListener('change', (e) => {
                const iso2 = e.target.value;
                if (!iso2) {
                    countryInfoCard.classList.add('d-none');
                    portsListContainer.innerHTML = '<div class="text-center text-muted py-4 fs-7"><i class="fa-solid fa-circle-info d-block fs-3 mb-2 text-secondary"></i>Silakan pilih negara di atas untuk menampilkan pelabuhan.</div>';
                    portCountBadge.textContent = '0 Port';
                    portSearch.disabled = true;
                    portSearch.value = '';
                    markerGroup.clearLayers();
                    return;
                }

                const selectedOpt = countrySelector.options[countrySelector.selectedIndex];
                const lat = parseFloat(selectedOpt.dataset.lat);
                const lng = parseFloat(selectedOpt.dataset.lng);
                const name = selectedOpt.dataset.name;
                const iso3 = selectedOpt.dataset.iso3;
                const currency = selectedOpt.dataset.currency;

                // Update Info panel
                infoCountryName.textContent = name;
                infoIsoCode.textContent = iso3.toUpperCase();
                infoCurrency.textContent = currency;
                countryInfoCard.classList.remove('d-none');

                // Fly map to country center
                if (!isNaN(lat) && !isNaN(lng)) {
                    map.flyTo([lat, lng], 5);
                }

                // Lazy load ports for this country
                loadPorts(iso2);
            });

            // Local Search filtering inside current ports list
            portSearch.addEventListener('input', (e) => {
                const searchVal = e.target.value.toLowerCase();
                const filtered = currentPorts.filter(port => {
                    return port.name.toLowerCase().includes(searchVal) || 
                           (port.code && port.code.toLowerCase().includes(searchVal));
                });
                renderPortsList(filtered);
            });

            // Init everything
            initMap();
            loadCountries();
        });
    </script>
</body>
</html>
