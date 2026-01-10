<?php require_once 'setup_db.php'; // Auto-run setup ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>44:11 // COMMAND CENTER</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-black: #0a0a0a;
            --primary-red: #d7263d;
            --tech-grey: #e5e5e5;
            --bg-canvas: #f4f7f9;
            --card-bg: #ffffff;
            --border-sharp: #000;
        }

        body { 
            font-family: 'Montserrat', sans-serif; 
            background-color: var(--bg-canvas); 
            color: var(--primary-black); 
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar { 
            width: 260px; height: 100vh; background: var(--primary-black); 
            position: fixed; top: 0; left: 0; padding: 40px 25px; 
            z-index: 1000; border-right: 1px solid #333; 
        }
        .sidebar-brand { 
            font-family: 'JetBrains Mono', monospace; font-size: 1.5rem; 
            font-weight: 700; color: white; text-decoration: none; 
            display: block; margin-bottom: 60px; letter-spacing: -1px; 
        }
        .nav-item { 
            display: flex; align-items: center; padding: 16px 0; 
            color: #666; text-decoration: none; font-size: 0.85rem; 
            font-weight: 600; text-transform: uppercase; letter-spacing: 1px; 
            border-bottom: 1px solid #222; transition: 0.2s; 
        }
        .nav-item:hover { color: white; padding-left: 10px; }
        .nav-item.active { color: var(--primary-red); border-bottom: 1px solid var(--primary-red); }
        .nav-item i { margin-right: 15px; font-size: 1.1rem; }

        /* --- MAIN CONTENT --- */
        .main-content { margin-left: 260px; padding: 40px; }

        /* --- HEADER --- */
        .dashboard-header {
            display: flex; justify-content: space-between; align-items: flex-end;
            margin-bottom: 40px; border-bottom: 2px solid var(--primary-black); padding-bottom: 20px;
        }
        .header-title h1 { font-weight: 900; font-size: 2.2rem; letter-spacing: -1px; margin: 0; line-height: 1; }
        .header-subtitle { font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #666; margin-top: 5px; }
        
        .header-actions button {
            background: transparent; border: 1px solid var(--primary-black);
            padding: 10px 20px; font-family: 'JetBrains Mono', monospace;
            font-weight: 700; font-size: 0.8rem; text-transform: uppercase;
            transition: 0.2s; cursor: pointer;
        }
        .header-actions button:hover { background: var(--primary-black); color: white; }
        .header-actions .btn-sim { background: var(--primary-black); color: white; }
        .header-actions .btn-sim:hover { background: var(--primary-red); border-color: var(--primary-red); }

        /* --- METRIC CARDS --- */
        .kpi-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .kpi-card {
            background: var(--card-bg); border: 1px solid #ddd; padding: 25px;
            position: relative; transition: 0.2s;
        }
        .kpi-card:hover { transform: translateY(-3px); box-shadow: 5px 5px 0 rgba(0,0,0,0.1); border-color: black; }
        .kpi-label { font-family: 'JetBrains Mono'; font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 1px; }
        .kpi-value { font-weight: 800; font-size: 2rem; margin: 10px 0; color: var(--primary-black); line-height: 1; }
        .kpi-delta { font-family: 'JetBrains Mono'; font-size: 0.75rem; font-weight: 700; }
        .delta-up { color: #10b981; } .delta-down { color: var(--primary-red); }

        /* --- GRAPH & SIDEBAR GRID --- */
        .mid-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 30px; }
        
        .graph-card { background: var(--card-bg); border: 1px solid #ddd; padding: 25px; height: 100%; }
        .graph-header { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .graph-title { font-weight: 800; text-transform: uppercase; font-size: 1rem; }
        .live-tag { background: var(--primary-red); color: white; padding: 2px 8px; font-size: 0.6rem; font-family: 'JetBrains Mono'; border-radius: 2px; animation: pulse 2s infinite; }

        /* --- PODIUM & FEED --- */
        .side-panel { display: flex; flex-direction: column; gap: 20px; }
        .podium-card, .feed-card { background: var(--card-bg); border: 1px solid #ddd; padding: 20px; }
        .section-title { font-family: 'JetBrains Mono'; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px; }
        
        .podium-item { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px dashed #eee; }
        .podium-rank { font-weight: 900; font-size: 1.2rem; color: #ddd; margin-right: 10px; }
        .podium-info { flex-grow: 1; }
        .podium-name { font-weight: 700; font-size: 0.9rem; display: block; }
        .podium-stats { font-family: 'JetBrains Mono'; font-size: 0.7rem; color: #666; }
        
        .feed-item { font-family: 'JetBrains Mono'; font-size: 0.75rem; margin-bottom: 12px; border-left: 2px solid #ddd; padding-left: 10px; }
        .feed-time { color: #999; font-size: 0.65rem; display: block; margin-bottom: 2px; }

        /* --- ALERTS & FUNNEL --- */
        .bottom-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 20px; }
        
        .alert-card { background: var(--primary-black); color: white; padding: 25px; }
        .alert-item { border-left: 3px solid var(--primary-red); padding-left: 15px; margin-bottom: 15px; }
        .alert-msg { font-weight: 600; font-size: 0.9rem; display: block; }
        .alert-meta { font-family: 'JetBrains Mono'; font-size: 0.7rem; color: #888; }
        .btn-resolve { width: 100%; border: 1px solid #444; background: transparent; color: white; padding: 10px; font-family: 'JetBrains Mono'; font-size: 0.7rem; text-transform: uppercase; cursor: pointer; transition: 0.2s; margin-top: 10px; }
        .btn-resolve:hover { background: white; color: black; }

        .funnel-card { background: var(--card-bg); border: 1px solid #ddd; padding: 25px; }
        .funnel-row { display: flex; align-items: center; margin-bottom: 15px; }
        .funnel-label { width: 100px; font-family: 'JetBrains Mono'; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
        .funnel-bar-bg { flex-grow: 1; background: #f0f0f0; height: 24px; position: relative; }
        .funnel-bar-fill { background: var(--primary-black); height: 100%; width: 0%; transition: width 1s ease; }
        .funnel-val { margin-left: 15px; font-family: 'JetBrains Mono'; font-weight: 700; width: 50px; text-align: right; }

        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.5; } 100% { opacity: 1; } }
    </style>
</head>
<body>

    <nav class="sidebar">
        <a href="#" class="sidebar-brand">44:11_SYSTEM</a>
        <div class="nav-links">
            <a href="admin-dashboard.php" class="nav-item active"><i class="bi bi-grid-fill"></i> Command</a>
            <a href="inventory.php" class="nav-item"><i class="bi bi-box-seam-fill"></i> Inventory</a>
            <a href="orders.php" class="nav-item"><i class="bi bi-truck"></i> Logistics</a>
            <a href="users.php" class="nav-item"><i class="bi bi-people-fill"></i> Roster</a>
        </div>
    </nav>

    <main class="main-content">
        
        <header class="dashboard-header">
            <div class="header-title">
                <h1>COMMAND CENTER</h1>
                <div class="header-subtitle">SYS_STAMP // <span id="sysDate">LOADING...</span></div>
            </div>
            <div class="header-actions">
                <button onclick="fetchData()"><i class="bi bi-arrow-clockwise"></i> REFRESH</button>
                <button class="btn-sim" onclick="simulateOrder()"><i class="bi bi-lightning-fill"></i> SIMULATE ORDER</button>
            </div>
        </header>

        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-label">NET REVENUE (24H)</div>
                <div class="kpi-value" id="kpi-revenue">--</div>
                <div class="kpi-delta delta-up"><i class="bi bi-arrow-up"></i> LIVE FEED</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">ORDERS & DELAYS</div>
                <div class="kpi-value"><span id="kpi-orders">--</span> <span style="font-size:1rem; color:#ccc;">/ 24h</span></div>
                <div class="kpi-delta delta-down"><span id="kpi-delays">0</span> LOGISTICS FLAGS</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">CONVERSION RATE</div>
                <div class="kpi-value" id="kpi-rate">--%</div>
                <div class="kpi-delta delta-up">BASED ON SESSIONS</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">LIVE ROSTER</div>
                <div class="kpi-value" id="kpi-users">--</div>
                <div class="kpi-delta delta-up"><span id="kpi-new-users">--</span> NEW TODAY</div>
            </div>
        </div>

        <div class="mid-grid">
            <div class="graph-card">
                <div class="graph-header">
                    <div class="graph-title">REVENUE VELOCITY CYCLES</div>
                    <div class="live-tag">LIVE_FEED</div>
                </div>
                <div style="height: 300px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <div class="side-panel">
                <div class="podium-card">
                    <div class="section-title">THE PODIUM // TOP GEAR</div>
                    <div id="podium-list">
                        </div>
                    <a href="inventory.php" class="btn btn-sm btn-outline-dark w-100 mt-2" style="border-radius:0; font-family:'JetBrains Mono'; font-size:0.7rem; font-weight:700;">MANAGE INVENTORY</a>
                </div>
                
                <div class="feed-card">
                    <div class="section-title">PERFORMANCE FEED</div>
                    <div id="feed-list">
                        </div>
                </div>
            </div>
        </div>

        <div class="bottom-grid">
            <div class="alert-card">
                <div class="section-title" style="border-color:#333; color:white;">CRITICAL ALERTS</div>
                <div id="alerts-list">
                    </div>
                <button class="btn-resolve" onclick="resolveAlerts()">RESOLVE ALL PROTOCOLS</button>
            </div>

            <div class="funnel-card">
                <div class="section-title">CONVERSION FUNNEL</div>
                <div id="funnel-container">
                    </div>
            </div>
        </div>

    </main>

    <script>
        // --- 1. INITIALIZATION ---
        const ctx = document.getElementById('revenueChart').getContext('2d');
        let revenueChart;

        function initChart() {
            revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Revenue ($)',
                        data: [],
                        borderColor: '#0a0a0a',
                        backgroundColor: 'rgba(10, 10, 10, 0.05)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false }, ticks: { font: { family: 'JetBrains Mono' } } },
                        y: { border: { display: false }, ticks: { font: { family: 'JetBrains Mono' } } }
                    }
                }
            });
        }

        // --- 2. DATA FETCHING ---
        async function fetchData() {
            try {
                const res = await fetch('dashboard-api.php?action=fetch_data');
                const data = await res.json();

                // Date
                document.getElementById('sysDate').innerText = new Date().toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' }).toUpperCase();

                // KPIs
                document.getElementById('kpi-revenue').innerText = '$' + data.revenue;
                document.getElementById('kpi-orders').innerText = data.orders_today;
                document.getElementById('kpi-delays').innerText = data.delays;
                document.getElementById('kpi-rate').innerText = data.conversion_rate + '%';
                document.getElementById('kpi-users').innerText = data.total_users;
                document.getElementById('kpi-new-users').innerText = '+' + data.new_users;

                // Chart
                revenueChart.data.labels = data.graph.labels;
                revenueChart.data.datasets[0].data = data.graph.data;
                revenueChart.update();

                // Podium
                const podiumHTML = data.podium.map((p, i) => `
                    <div class="podium-item">
                        <div class="podium-rank">0${i+1}</div>
                        <div class="podium-info">
                            <span class="podium-name">${p.product_name}</span>
                            <div class="podium-stats">${p.units} SOLD // $${parseFloat(p.revenue).toFixed(2)} REV</div>
                        </div>
                        <i class="bi bi-arrow-up-right text-success"></i>
                    </div>
                `).join('');
                document.getElementById('podium-list').innerHTML = podiumHTML || '<div class="text-muted small">No sales data yet.</div>';

                // Feed
                const feedHTML = data.logs.map(log => `
                    <div class="feed-item">
                        <span class="feed-time">${new Date(log.created_at).toLocaleTimeString()}</span>
                        ${log.message}
                    </div>
                `).join('');
                document.getElementById('feed-list').innerHTML = feedHTML;

                // Alerts
                const alertsHTML = data.alerts.length > 0 ? data.alerts.map(a => `
                    <div class="alert-item">
                        <span class="alert-msg">${a.message}</span>
                        <span class="alert-meta">${a.type.toUpperCase()} // PENDING</span>
                    </div>
                `).join('') : '<div class="text-secondary small">ALL SYSTEMS NOMINAL</div>';
                document.getElementById('alerts-list').innerHTML = alertsHTML;

                // Funnel
                const f = data.funnel;
                const max = f.sessions || 1;
                const funnelHTML = `
                    ${renderFunnelRow('SESSIONS', f.sessions, max)}
                    ${renderFunnelRow('CART', f.cart, max)}
                    ${renderFunnelRow('CHECKOUT', f.checkout, max)}
                    ${renderFunnelRow('PURCHASE', f.purchase, max)}
                `;
                document.getElementById('funnel-container').innerHTML = funnelHTML;

            } catch (err) {
                console.error("Mainframe Sync Error:", err);
            }
        }

        function renderFunnelRow(label, val, max) {
            const pct = Math.max((val / max) * 100, 1);
            return `
                <div class="funnel-row">
                    <div class="funnel-label">${label}</div>
                    <div class="funnel-bar-bg">
                        <div class="funnel-bar-fill" style="width: ${pct}%"></div>
                    </div>
                    <div class="funnel-val">${val}</div>
                </div>
            `;
        }

        // --- 3. ACTIONS ---
        async function simulateOrder() {
            const btn = document.querySelector('.btn-sim');
            btn.innerText = "PROCESSING...";
            await fetch('dashboard-api.php?action=simulate_order');
            await fetchData(); // Refresh UI
            btn.innerHTML = '<i class="bi bi-lightning-fill"></i> SIMULATE ORDER';
        }

        async function resolveAlerts() {
            await fetch('dashboard-api.php?action=resolve_alerts');
            fetchData();
        }

        // --- 4. STARTUP ---
        initChart();
        fetchData();
        // Auto-refresh every 30s
        setInterval(fetchData, 30000);

    </script>
</body>
</html>