<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>44:11 // COMMAND CENTER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-red: #d7263d;
            --primary-navy: #02182b;
            --bg-light: #f4f7f9;
            --text-primary: #000000;
            --text-secondary: #6c757d;
            --border-color: #e9ecef;
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* --- Sidebar --- */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: var(--primary-navy);
            position: fixed;
            top: 0; left: 0;
            padding: 30px 20px;
            z-index: 1000;
            color: white;
        }

        .sidebar-brand {
            font-size: 1.8rem;
            font-weight: 900;
            letter-spacing: -1.5px;
            color: white;
            text-decoration: none;
            margin-bottom: 50px;
            display: block;
            text-align: center;
            font-style: italic;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 6px;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item:hover { color: white; background: rgba(255,255,255,0.08); }
        .nav-item.active { background: var(--primary-red); color: white; box-shadow: 0 8px 20px rgba(215, 38, 61, 0.35); }
        .nav-item i { margin-right: 12px; font-size: 1.2rem; }

        /* --- Layout --- */
        .main-content { margin-left: 260px; padding: 40px; }
        .section-card { background: white; border-radius: 16px; border: none; box-shadow: var(--shadow-sm); padding: 24px; height: 100%; }
        .page-title { font-weight: 900; text-transform: uppercase; font-style: italic; letter-spacing: -1px; }
        
        /* Stats & Data Viz */
        .stat-box { border-left: 4px solid var(--primary-navy); }
        .stat-box.highlight { border-left-color: var(--primary-red); }
        .stat-label { font-size: 0.7rem; font-weight: 800; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .stat-value { font-size: 1.8rem; font-weight: 900; color: var(--primary-navy); }

        /* The Podium (Top Sellers) */
        .podium-item { display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid var(--border-color); }
        .podium-rank { width: 30px; font-weight: 900; color: var(--primary-red); font-style: italic; font-size: 1.1rem; }
        .podium-name { font-weight: 700; font-size: 0.85rem; text-transform: uppercase; }
        .podium-meta { font-size: 0.7rem; color: var(--text-secondary); font-family: 'JetBrains Mono'; }

        /* Live Activity Feed */
        .activity-feed { max-height: 350px; overflow-y: auto; padding-right: 10px; }
        .activity-item { position: relative; padding-left: 20px; padding-bottom: 20px; border-left: 2px solid var(--border-color); }
        .activity-item::before { content: ''; position: absolute; left: -6px; top: 0; width: 10px; height: 10px; border-radius: 50%; background: var(--primary-navy); }
        .activity-item.urgent::before { background: var(--primary-red); }
        .activity-text { font-size: 0.8rem; font-weight: 600; }
        .activity-time { font-size: 0.7rem; color: var(--text-secondary); font-family: 'JetBrains Mono'; }

        /* Funnel Graph */
        .funnel-step { height: 40px; background: var(--primary-navy); margin-bottom: 4px; border-radius: 4px; display: flex; align-items: center; padding: 0 15px; color: white; font-weight: 700; font-size: 0.7rem; }

        .btn-action { background: var(--primary-navy); color: white; font-weight: 800; font-size: 0.75rem; border-radius: 6px; padding: 10px 20px; border: none; text-transform: uppercase; }
        .btn-action:hover { background: var(--primary-red); color: white; }

        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body>

    <nav class="sidebar">
        <a href="admin-dashboard.html" class="sidebar-brand">44:11<span style="color:var(--primary-red)">.</span></a>
        
        <div class="nav-links">
            <a href="admin-dashboard.html" class="nav-item active">
                <i class="bi bi-grid-1x2-fill"></i> Command Center
            </a>
            <a href="inventory.html" class="nav-item">
                <i class="bi bi-stack"></i> Inventory
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-lightning-fill"></i> Logistics
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-person-badge-fill"></i> The Roster
            </a>
        </div>

        <div class="mt-auto">
            <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-success rounded-circle me-2" style="width:8px; height:8px;"></div>
                    <small class="fw-bold text-uppercase opacity-50" style="font-size: 0.6rem;">Server: ACTIVE</small>
                </div>
                <p class="mb-0 fw-black italic small" id="liveClock">00:00:00</p>
            </div>
        </div>
    </nav>

    <main class="main-content">
        
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h1 class="page-title mb-0">Command Center</h1>
                <p class="text-secondary small fw-bold mt-1" id="systemStamp">INITIALIZING SYSTEM...</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-dark btn-sm fw-bold px-3" onclick="location.reload()">REFRESH</button>
                <button class="btn btn-action btn-sm" onclick="simulateSale()">SIMULATE ORDER</button>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="section-card stat-box highlight">
                    <div class="stat-label">Net Revenue (24H)</div>
                    <div class="stat-value" id="dash-revenue">$4,820.00</div>
                    <div class="mt-2 small fw-bold text-success font-mono">+12.4% ↑</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="section-card stat-box">
                    <div class="stat-label)Active Logistics</div>
                    <div class="stat-value" id="dash-orders">24</div>
                    <div class="mt-2 small fw-bold text-secondary font-mono">3 DELAYS</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="section-card stat-box">
                    <div class="stat-label">Conv. Rate</div>
                    <div class="stat-value">3.2%</div>
                    <div class="mt-2 small fw-bold text-danger font-mono">-0.4% ↓</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="section-card stat-box">
                    <div class="stat-label">Live Roster</div>
                    <div class="stat-value">842</div>
                    <div class="mt-2 small fw-bold text-success font-mono">12 NEW TODAY</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="section-card">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <h6 class="fw-black italic text-uppercase small">Revenue Velocity Cycles</h6>
                        <span class="badge bg-light text-dark font-mono">LIVE_FEED</span>
                    </div>
                    <canvas id="revenueChart" style="max-height: 300px;"></canvas>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="section-card">
                    <h6 class="fw-black italic text-uppercase small mb-4">The Podium // Top Gear</h6>
                    <div id="podiumList">
                        <div class="podium-item">
                            <div class="podium-rank">01</div>
                            <div class="flex-grow-1">
                                <div class="podium-name">Alpha Velocity Tights</div>
                                <div class="podium-meta">142 UNITS // $12,070 REV</div>
                            </div>
                            <i class="bi bi-graph-up-arrow text-success"></i>
                        </div>
                        <div class="podium-item">
                            <div class="podium-rank">02</div>
                            <div class="flex-grow-1">
                                <div class="podium-name">Elite Speed Runner</div>
                                <div class="podium-meta">110 UNITS // $17,600 REV</div>
                            </div>
                            <i class="bi bi-graph-up-arrow text-success"></i>
                        </div>
                    </div>
                    <a href="inventory.html" class="btn btn-light btn-sm w-100 mt-3 fw-bold py-2">MANAGE INVENTORY</a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="section-card">
                    <h6 class="fw-black italic text-uppercase small mb-4">Performance Feed</h6>
                    <div class="activity-feed" id="activityFeed">
                        <div class="activity-item urgent">
                            <p class="activity-text mb-0">System Check: Inventory node synced</p>
                            <span class="activity-time">JUST NOW</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="section-card">
                            <h6 class="fw-black italic text-uppercase small mb-4">Conversion Funnel</h6>
                            <div class="funnel-step" style="width: 100%;">SESSIONS (12,402)</div>
                            <div class="funnel-step" style="width: 75%;">ADD TO CART (3,105)</div>
                            <div class="funnel-step" style="width: 45%;">CHECKOUT (840)</div>
                            <div class="funnel-step" style="width: 25%; background: var(--primary-red);">PURCHASE (392)</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="section-card" style="background: var(--primary-navy); color: white;">
                            <h6 class="fw-black italic text-uppercase small mb-4" style="color: var(--primary-red);">Critical Alerts</h6>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-exclamation-triangle-fill text-warning me-3 fs-4"></i>
                                <div>
                                    <p class="mb-0 fw-bold small">3 Pending Refunds</p>
                                    <small class="opacity-50 font-mono">NEEDS ATTENTION</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-truck text-info me-3 fs-4"></i>
                                <div>
                                    <p class="mb-0 fw-bold small">12 Logistics Delays</p>
                                    <small class="opacity-50 font-mono">OVER 24H SINCE ORDER</small>
                                </div>
                            </div>
                            <button class="btn btn-danger w-100 fw-bold small py-2 mt-2">RESOLVE ALL</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        // Real-Time Simulation
        function simulateSale() {
            const amount = Math.floor(Math.random() * 200) + 50;
            const feed = document.getElementById('activityFeed');
            const log = document.createElement('div');
            log.className = 'activity-item urgent';
            log.innerHTML = `<p class="activity-text mb-0">New Order Processed: $${amount}.00</p><span class="activity-time">JUST NOW</span>`;
            feed.prepend(log);
            
            // Update UI State
            const revEl = document.getElementById('dash-revenue');
            let currentRev = parseInt(revEl.innerText.replace(/[$,]/g, ''));
            revEl.innerText = `$${(currentRev + amount).toLocaleString()}.00`;
        }

        // Init Chart.js
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00'],
                    datasets: [{
                        data: [1200, 1900, 1500, 2800, 2100, 3600, 4200],
                        borderColor: '#d7263d',
                        borderWidth: 4,
                        tension: 0.4,
                        fill: false,
                        pointRadius: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { 
                        y: { display: false },
                        x: { grid: { display: false }, ticks: { font: { weight: 'bold' } } } 
                    }
                }
            });

            // Live Clock & Stamp
            setInterval(() => {
                const now = new Date();
                document.getElementById('liveClock').innerText = now.toLocaleTimeString();
                document.getElementById('systemStamp').innerText = `SYS_STAMP // ${now.toDateString().toUpperCase()}`;
            }, 1000);
        });
    </script>
</body>
</html>