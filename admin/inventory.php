<?php
require_once '../db_connect.php'; 
$db = new Database();
$conn = $db->connect();

try {
    $stmt = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
    $inventory = $stmt->fetchAll();
} catch (PDOException $e) {
    $inventory = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>44:11 // INVENTORY PROTOCOL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-black: #0a0a0a;
            --primary-red: #d7263d;
            --tech-grey: #e5e5e5;
            --bg-canvas: #ffffff;
            --border-sharp: #111;
        }

        body { 
            font-family: 'Montserrat', sans-serif; 
            background-color: var(--bg-canvas); 
            color: var(--primary-black); 
        }

        /* --- SIDEBAR: The Monolith --- */
        .sidebar { 
            width: 280px; 
            height: 100vh; 
            background: var(--primary-black); 
            position: fixed; 
            top: 0; left: 0; 
            padding: 40px 30px; 
            z-index: 1000; 
            border-right: 1px solid #333;
        }
        .sidebar-brand { 
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.5rem; 
            font-weight: 700; 
            color: white; 
            text-decoration: none; 
            display: block; 
            margin-bottom: 60px; 
            letter-spacing: -1px;
        }
        .nav-item { 
            display: flex; 
            align-items: center; 
            padding: 16px 0; 
            color: #666; 
            text-decoration: none; 
            font-size: 0.85rem; 
            font-weight: 600; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            border-bottom: 1px solid #222;
            transition: 0.2s;
        }
        .nav-item:hover { color: white; padding-left: 10px; }
        .nav-item.active { color: var(--primary-red); border-bottom: 1px solid var(--primary-red); }
        .nav-item i { margin-right: 15px; font-size: 1.1rem; }

        /* --- MAIN CONTENT --- */
        .main-content { margin-left: 280px; padding: 60px; }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 50px;
            border-bottom: 2px solid var(--primary-black);
            padding-bottom: 20px;
        }
        .page-title { 
            font-weight: 800; 
            text-transform: uppercase; 
            font-size: 2.5rem; 
            line-height: 0.9;
            letter-spacing: -1.5px;
        }
        .page-subtitle {
            font-family: 'JetBrains Mono', monospace;
            color: #666;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        /* --- THE GRID --- */
        .inventory-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        /* --- ASSET CARD: Technical & Flat --- */
        .asset-card {
            background: white;
            border: 1px solid var(--tech-grey);
            padding: 15px;
            transition: all 0.2s ease;
            position: relative;
        }
        .asset-card:hover {
            border-color: var(--primary-black);
            transform: translateY(-2px);
            box-shadow: 5px 5px 0px rgba(0,0,0,1);
        }
        .asset-img-container {
            width: 100%;
            height: 220px;
            background: #f4f4f4;
            margin-bottom: 15px;
            overflow: hidden;
            position: relative;
        }
        .asset-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(20%);
            transition: 0.3s;
        }
        .asset-card:hover img { filter: grayscale(0%); scale: 1.05; }
        
        .asset-meta {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            color: #666;
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
        }
        .asset-title {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 1rem;
            margin-bottom: 10px;
            line-height: 1.1;
        }
        .asset-price {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--primary-black);
        }
        
        /* --- BUTTONS: Brutalist --- */
        .btn-action {
            display: inline-block;
            width: 100%;
            padding: 12px 0;
            text-align: center;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            border: 1px solid var(--primary-black);
            background: transparent;
            color: var(--primary-black);
            cursor: pointer;
            transition: 0.2s;
            font-family: 'JetBrains Mono', monospace;
        }
        .btn-action:hover {
            background: var(--primary-black);
            color: white;
        }
        .btn-delete {
            border-color: var(--primary-red);
            color: var(--primary-red);
        }
        .btn-delete:hover {
            background: var(--primary-red);
            color: white;
        }

        /* --- MODAL: Clean --- */
        .modal-content { border-radius: 0; border: 2px solid black; box-shadow: 10px 10px 0 rgba(0,0,0,0.1); }
        .form-control, .form-select {
            border-radius: 0;
            border: 1px solid #ccc;
            padding: 12px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: black;
            background: #fafafa;
        }
        
        /* Primary CTA */
        .btn-deploy {
            background: var(--primary-black);
            color: white;
            border: none;
            padding: 15px 30px;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 1px;
            font-size: 0.9rem;
            border-radius: 0;
            transition: 0.2s;
        }
        .btn-deploy:hover {
            background: var(--primary-red);
            transform: translateY(-2px);
            box-shadow: 4px 4px 0 rgba(0,0,0,0.2);
        }

        /* Multi-Select Styling */
        .size-btn { 
            border: 1px solid #ddd; 
            padding: 10px 15px; 
            cursor: pointer; 
            font-weight: 700; 
            font-family: 'JetBrains Mono';
            font-size: 0.8rem;
            transition: 0.2s;
        }
        .size-btn:hover { border-color: black; }
        .size-btn.active { background: black; color: white; border-color: black; }

        .color-dot { width: 30px; height: 30px; display: inline-block; cursor: pointer; border: 2px solid transparent; transition: 0.2s; position: relative; }
        .color-dot.active { border-color: var(--primary-black); transform: scale(1.1); box-shadow: 0 0 0 2px white, 0 0 0 4px var(--primary-black); z-index: 2; }
    </style>
</head>
<body>

    <nav class="sidebar">
        <a href="admin-dashboard.php" class="sidebar-brand">44:11_SYSTEM</a>
        <div class="nav-links">
            <a href="admin-dashboard.php" class="nav-item"><i class="bi bi-grid-fill"></i> Command</a>
            <a href="inventory.php" class="nav-item active"><i class="bi bi-box-seam-fill"></i> Inventory</a>
            <a href="orders.php" class="nav-item"><i class="bi bi-truck"></i> Logistics</a>
            <a href="users.php" class="nav-item"><i class="bi bi-people-fill"></i> Roster</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1 class="page-title">Inventory<br>Protocol</h1>
                <p class="page-subtitle">SECURE // DEPLOY // TRACK</p>
            </div>
            <button class="btn-deploy" id="openAddModalBtn">
                + Deploy Asset
            </button>
        </div>

        <div class="inventory-grid">
            <?php if (empty($inventory)): ?>
                <div class="col-12 p-5 text-center" style="grid-column: 1/-1; border: 1px dashed #ccc;">
                    <p class="text-secondary font-monospace">SYSTEM STATUS: EMPTY</p>
                </div>
            <?php else: ?>
                <?php foreach ($inventory as $item): ?>
                <div class="asset-card">
                    <div class="asset-img-container">
                        <img src="../<?= htmlspecialchars($item['image_url']) ?>" alt="Asset">
                    </div>
                    
                    <div class="asset-meta">
                        <span><?= htmlspecialchars($item['category']) ?></span>
                        <span>QTY: <?= (int)$item['stock'] ?></span>
                    </div>
                    
                    <div class="asset-title"><?= htmlspecialchars($item['name']) ?></div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="asset-price">$<?= number_format($item['price'], 2) ?></span>
                        <?php if(!empty($item['size'])): ?>
                            <span style="font-size: 0.7rem; font-family:'JetBrains Mono'; color:#888;">[<?= htmlspecialchars($item['size']) ?>]</span>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn-action edit-btn" 
                            data-id="<?= $item['id'] ?>"
                            data-name="<?= htmlspecialchars($item['name']) ?>"
                            data-category="<?= htmlspecialchars($item['category']) ?>"
                            data-description="<?= htmlspecialchars($item['description']) ?>"
                            data-price="<?= $item['price'] ?>"
                            data-stock="<?= $item['stock'] ?>"
                            data-size="<?= htmlspecialchars($item['size']) ?>"
                            data-color="<?= htmlspecialchars($item['color']) ?>"
                        >EDIT</button>
                        <button class="btn-action btn-delete delete-btn" data-id="<?= $item['id'] ?>">SCRAP</button>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <div class="modal fade" id="addGearModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 p-4">
                    <h5 class="modal-title fw-bold font-monospace" id="modalTitle">ASSET_DEPLOYMENT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <form id="gearForm">
                        <input type="hidden" id="editProductId" name="edit_id">
                        <div class="row g-4">
                            <div class="col-md-5">
                                <label class="fw-bold font-monospace small mb-2 d-block">VISUALS</label>
                                <div class="drop-zone" id="dropZone" onclick="document.getElementById('fileInput').click()" style="border: 2px dashed #000; padding: 40px; text-align: center; cursor: pointer;">
                                    <i class="bi bi-upload fs-2"></i>
                                    <div class="font-monospace small mt-2">DROP_FILES</div>
                                    <input type="file" id="fileInput" hidden accept="image/*" multiple name="images[]">
                                    <div id="previewTray" class="d-flex gap-1 mt-2 flex-wrap"></div>
                                </div>
                            </div>
                            
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="fw-bold font-monospace small mb-1">NAME</label>
                                    <input type="text" id="productName" class="form-control" placeholder="ASSET ID...">
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <label class="fw-bold font-monospace small mb-1">CATEGORY</label>
                                        <select id="productCategory" class="form-select">
                                            <option value="Tops">TOPS</option>
                                            <option value="Bottoms">BOTTOMS</option>
                                            <option value="Outerwear">OUTERWEAR</option>
                                            <option value="Overalls">OVERALLS</option>
                                            <option value="Sets">SETS</option>
                                            <option value="Accessories">ACCESSORIES</option>
                                            <option value="Footwear">FOOTWEAR</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="fw-bold font-monospace small mb-1">QTY</label>
                                        <input type="number" id="productStock" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold font-monospace small mb-1">PRICE</label>
                                    <input type="number" id="productPrice" class="form-control" step="0.01">
                                </div>
                                <textarea id="productDescription" class="form-control mb-3" rows="2" placeholder="SPECS..."></textarea>
                                
                                <input type="hidden" id="selectedSize">
                                <input type="hidden" id="selectedColor">
                            </div>
                            
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="fw-bold font-monospace small mb-2 d-block">SIZE_MATRIX</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <div class="size-btn">XS</div><div class="size-btn">S</div><div class="size-btn">M</div>
                                            <div class="size-btn">L</div><div class="size-btn">XL</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-bold font-monospace small mb-2 d-block">COLOR_MATRIX</label>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <span class="color-dot" style="background:#000" data-color-name="Black" title="Black"></span>
                                            <span class="color-dot" style="background:#fff; border:1px solid #ccc" data-color-name="White" title="White"></span>
                                            <span class="color-dot" style="background:#808080" data-color-name="Grey" title="Grey"></span>
                                            <span class="color-dot" style="background:#000080" data-color-name="Navy" title="Navy"></span>
                                            <span class="color-dot" style="background:#556b2f" data-color-name="Olive" title="Olive"></span>
                                            <span class="color-dot" style="background:#f5f5dc; border:1px solid #ccc" data-color-name="Beige" title="Beige"></span>
                                            <span class="color-dot" style="background:#d7263d" data-color-name="Red" title="Red"></span>
                                            <span class="color-dot" style="background:#4169e1" data-color-name="Royal Blue" title="Royal Blue"></span>
                                            <span class="color-dot" style="background:#ffc0cb" data-color-name="Pink" title="Pink"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0 p-4">
                    <button type="button" id="confirmDeployBtn" class="btn-deploy w-100">CONFIRM PROTOCOL</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // --- 1. SETUP ---
        const fileInput = document.getElementById('fileInput');
        const previewTray = document.getElementById('previewTray');
        const modal = new bootstrap.Modal(document.getElementById('addGearModal'));

        // --- 2. MULTI-SELECT LOGIC ---
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.addEventListener('click', function() { this.classList.toggle('active'); });
        });
        document.querySelectorAll('.color-dot').forEach(btn => {
            btn.addEventListener('click', function() { this.classList.toggle('active'); });
        });

        function collectSelections() {
            const sizes = Array.from(document.querySelectorAll('.size-btn.active')).map(b => b.innerText).join(', ');
            const colors = Array.from(document.querySelectorAll('.color-dot.active')).map(d => d.dataset.colorName).join(', ');
            document.getElementById('selectedSize').value = sizes;
            document.getElementById('selectedColor').value = colors;
        }

        // --- 3. IMAGE PREVIEW ---
        fileInput.addEventListener('change', function(e) {
            previewTray.innerHTML = '';
            Array.from(e.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    const img = document.createElement('img');
                    img.src = ev.target.result;
                    img.style.width = '40px'; img.style.height = '40px'; img.style.objectFit = 'cover';
                    previewTray.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });

        // --- 4. MODAL TRIGGERS ---
        document.getElementById('openAddModalBtn').addEventListener('click', () => {
            document.getElementById('gearForm').reset();
            document.getElementById('editProductId').value = '';
            document.getElementById('modalTitle').innerText = "INITIATE_DEPLOYMENT";
            document.getElementById('confirmDeployBtn').innerText = "EXECUTE";
            document.querySelectorAll('.active').forEach(e => e.classList.remove('active'));
            previewTray.innerHTML = '';
            modal.show();
        });

        document.addEventListener('click', function(e) {
            if(e.target.classList.contains('edit-btn')) {
                const btn = e.target;
                document.getElementById('editProductId').value = btn.dataset.id;
                document.getElementById('productName').value = btn.dataset.name;
                document.getElementById('productCategory').value = btn.dataset.category;
                document.getElementById('productDescription').value = btn.dataset.description;
                document.getElementById('productPrice').value = btn.dataset.price;
                document.getElementById('productStock').value = btn.dataset.stock;

                // Restore Selections
                document.querySelectorAll('.active').forEach(el => el.classList.remove('active'));
                const sizes = btn.dataset.size ? btn.dataset.size.split(', ') : [];
                document.querySelectorAll('.size-btn').forEach(el => {
                    if(sizes.includes(el.innerText)) el.classList.add('active');
                });
                
                // Restore Colors (Improved Matching)
                const colors = btn.dataset.color ? btn.dataset.color.split(', ') : [];
                document.querySelectorAll('.color-dot').forEach(el => {
                    if(colors.includes(el.dataset.colorName)) el.classList.add('active');
                });
                
                document.getElementById('modalTitle').innerText = "MODIFY_PROTOCOL";
                document.getElementById('confirmDeployBtn').innerText = "UPDATE ASSET";
                modal.show();
            }
        });

        // --- 5. SUBMIT ---
        document.getElementById('confirmDeployBtn').addEventListener('click', () => {
            collectSelections();
            const formData = new FormData();
            formData.append('name', document.getElementById('productName').value);
            formData.append('category', document.getElementById('productCategory').value);
            formData.append('description', document.getElementById('productDescription').value);
            formData.append('price', document.getElementById('productPrice').value);
            formData.append('stock', document.getElementById('productStock').value);
            formData.append('size', document.getElementById('selectedSize').value);
            formData.append('color', document.getElementById('selectedColor').value);
            
            const files = fileInput.files;
            for(let i=0; i<files.length; i++) formData.append('images[]', files[i]);

            const editId = document.getElementById('editProductId').value;
            if(editId) formData.append('edit_id', editId);
            
            const url = editId ? 'edit-product.php' : 'add-product.php';
            const btn = document.getElementById('confirmDeployBtn');
            const originalText = btn.innerText;
            
            btn.innerText = "PROCESSING...";
            btn.disabled = true;

            fetch(url, { method: 'POST', body: formData })
            .then(r => r.json())
            .then(data => {
                if(data.success) location.reload();
                else alert("ERROR: " + data.error);
            })
            .finally(() => {
                btn.innerText = originalText;
                btn.disabled = false;
            });
        });

        // --- 6. DELETE ---
        document.addEventListener('click', function(e) {
            if(e.target.classList.contains('delete-btn')) {
                if(confirm("CONFIRM SCRAP?")) {
                    fetch('delete-product.php', {
                        method: 'POST',
                        body: JSON.stringify({id: e.target.dataset.id}),
                        headers: {'Content-Type': 'application/json'}
                    }).then(r => r.json()).then(d => { if(d.success) location.reload(); });
                }
            }
        });
    </script>
</body>
</html>