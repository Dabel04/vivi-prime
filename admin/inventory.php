<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>44:11 // INVENTORY ASSETS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=JetBrains+Mono&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-red: #d7263d;
            --primary-navy: #02182b;
            --bg-light: #f4f7f9;
            --text-primary: #111111;
            --text-secondary: #6B7280;
            --border-color: #E5E7EB;
        }

        body { font-family: 'Montserrat', sans-serif; background-color: var(--bg-light); color: var(--text-primary); }

        /* --- Sidebar --- */
        .sidebar { width: 260px; height: 100vh; background: var(--primary-navy); position: fixed; top: 0; left: 0; padding: 30px 20px; z-index: 1000; color: white; }
        .sidebar-brand { font-size: 1.8rem; font-weight: 900; letter-spacing: -1.5px; color: white; text-decoration: none; margin-bottom: 50px; display: block; text-align: center; font-style: italic; }
        .nav-item { display: flex; align-items: center; padding: 14px 18px; color: rgba(255,255,255,0.6); text-decoration: none; border-radius: 10px; margin-bottom: 6px; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; transition: 0.3s; }
        .nav-item:hover { color: white; background: rgba(255,255,255,0.08); }
        .nav-item.active { background: var(--primary-red); color: white; box-shadow: 0 8px 20px rgba(215, 38, 61, 0.35); }
        .nav-item i { margin-right: 12px; font-size: 1.2rem; }

        /* --- Main Content --- */
        .main-content { margin-left: 260px; padding: 40px; }
        .page-title { font-weight: 900; text-transform: uppercase; font-style: italic; letter-spacing: -1px; }

        /* --- Multi-Image Drop Zone --- */
        .drop-zone {
            width: 100%;
            min-height: 220px;
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
            background: #FAFAFA;
            padding: 15px;
            position: relative;
        }
        .drop-zone:hover { border-color: var(--primary-red); background: #fef2f2; }
        
        /* Preview Grid */
        #previewTray {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            width: 100%;
            margin-top: 10px;
        }
        .thumb-wrapper {
            position: relative;
            width: 100%;
            aspect-ratio: 1/1;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }
        .thumb-wrapper img { width: 100%; height: 100%; object-fit: cover; }

        /* Original Inputs & Selectors */
        .size-btn { padding: 8px 12px; border: 1px solid var(--border-color); border-radius: 6px; background: white; font-weight: 800; font-size: 0.75rem; cursor: pointer; transition: 0.2s; }
        .size-btn.active { background: var(--primary-navy); color: white; border-color: var(--primary-navy); }

        .color-dot { width: 28px; height: 28px; border-radius: 50%; display: inline-block; margin-right: 10px; border: 3px solid transparent; cursor: pointer; transition: 0.2s; }
        .color-dot.active { border-color: var(--primary-red); transform: scale(1.1); }

        .btn-black { background: var(--primary-navy); color: white; font-weight: 800; font-size: 0.8rem; border-radius: 8px; padding: 12px 24px; border: none; text-transform: uppercase; }
        .btn-black:hover { background: var(--primary-red); }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body>

   <nav class="sidebar">
        <a href="admin-dashboard.html" class="sidebar-brand">44:11<span style="color:var(--primary-red)">.</span></a>
        <div class="nav-links">
            <a href="admin-dashboard.html" class="nav-item"><i class="bi bi-grid-1x2-fill"></i> Command Center</a>
            <a href="inventory.html" class="nav-item active"><i class="bi bi-stack"></i> Inventory</a>
            <a href="#" class="nav-item"><i class="bi bi-lightning-fill"></i> Logistics</a>
            <a href="#" class="nav-item"><i class="bi bi-person-badge-fill"></i> The Roster</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h1 class="page-title mb-0">Asset Inventory</h1>
                <p class="text-secondary small fw-bold">Manage and deploy performance gear</p>
            </div>
            <button class="btn btn-black" data-bs-toggle="modal" data-bs-target="#addGearModal">
                <i class="bi bi-plus-lg me-2"></i> Deploy New Gear
            </button>
        </div>

        <div id="inventoryList" class="row g-4">
            <div class="col-12 text-center p-5 text-secondary border rounded-4 bg-white">
                <div class="spinner-border text-danger mb-3" role="status"></div>
                <p class="small fw-bold text-uppercase">Syncing with Mainframe...</p>
            </div>
        </div>
    </main>

    <div class="modal fade" id="addGearModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-black italic text-uppercase">Deploy New Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="gearForm">
                        <div class="row g-4">
                            <div class="col-md-5">
                                <label class="fw-bold small text-uppercase mb-2 d-block">Visual Assets (Drop Multiple)</label>
                                <div class="drop-zone" id="dropZone" onclick="document.getElementById('fileInput').click()">
                                    <div id="dropContent" class="text-center">
                                        <i class="bi bi-images fs-1 text-navy"></i>
                                        <span class="fw-bold small d-block mt-2">CLICK OR DRAG IMAGES</span>
                                        <small class="opacity-50">Upload 1-10 photos</small>
                                    </div>
                                    <div id="previewTray"></div>
                                    <input type="file" id="fileInput" hidden accept="image/*" multiple>
                                </div>
                                <button type="button" class="btn btn-link btn-sm text-danger text-decoration-none fw-bold mt-2 p-0" id="clearBtn" style="display:none" onclick="resetImages()">
                                    <i class="bi bi-x-circle me-1"></i> RESET IMAGES
                                </button>
                            </div>

                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="fw-bold small text-uppercase mb-2 d-block">Asset Name</label>
                                    <input type="text" id="productName" class="form-control fw-bold py-2" placeholder="e.g. THERMO-SHIELD JACKET" required>
                                </div>

                                <div class="mb-3">
                                    <label class="fw-bold small text-uppercase mb-2 d-block">Category</label>
                                    <select id="productCategory" class="form-select fw-bold py-2">
                                        <option value="General">Select Category...</option>
                                        <option value="Tops">Tops / Upper Body</option>
                                        <option value="Bottoms">Bottoms / Leggings</option>
                                        <option value="Accessories">Accessories</option>
                                        <option value="Sets">Full Sets</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="fw-bold small text-uppercase mb-2 d-block">Description</label>
                                    <textarea id="productDescription" class="form-control fw-bold" rows="3" placeholder="Brief product details..."></textarea>
                                </div>

                                <div class="row g-3">
                                    <div class="col-6">
                                        <label class="fw-bold small text-uppercase mb-2 d-block">Unit Price ($)</label>
                                        <input type="number" id="productPrice" class="form-control fw-bold font-mono py-2" placeholder="0.00" step="0.01">
                                    </div>
                                    <div class="col-6">
                                        <label class="fw-bold small text-uppercase mb-2 d-block">Batch Quantity</label>
                                        <input type="number" id="productStock" class="form-control fw-bold py-2" placeholder="100">
                                    </div>
                                </div>
                                
                                <input type="hidden" id="selectedSize" value="M">
                                <input type="hidden" id="selectedColor" value="Black">
                            </div>

                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="fw-bold small text-uppercase mb-3 d-block">Size Matrix</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <div class="size-btn">XS</div><div class="size-btn">S</div>
                                            <div class="size-btn active">M</div><div class="size-btn">L</div>
                                            <div class="size-btn">XL</div><div class="size-btn">XXL</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-bold small text-uppercase mb-3 d-block">Colorways</label>
                                        <div class="d-flex align-items-center">
                                            <span class="color-dot active" style="background: #000;"></span>
                                            <span class="color-dot" style="background: #fff; border: 1px solid #ddd;"></span>
                                            <span class="color-dot" style="background: #d7263d;"></span>
                                            <span class="color-dot" style="background: #02182b;"></span>
                                            <span class="color-dot" style="background: #6c757d;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">ABORT</button>
                    <button type="button" id="confirmDeployBtn" class="btn btn-black px-5">CONFIRM DEPLOYMENT</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const fileInput = document.getElementById('fileInput');
        const previewTray = document.getElementById('previewTray');
        const dropContent = document.getElementById('dropContent');
        const clearBtn = document.getElementById('clearBtn');
        const dropZone = document.getElementById('dropZone');

        // MULTI-IMAGE LOGIC
        fileInput.addEventListener('change', function(e) {
            handleFiles(e.target.files);
        });

        // DRAG & DROP SUPPORT
        dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('bg-light'); });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('bg-light'));
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('bg-light');
            handleFiles(e.dataTransfer.files);
        });

        function handleFiles(files) {
            const fileList = Array.from(files);
            if(fileList.length > 0) {
                dropContent.style.display = 'none'; // Hide text
                clearBtn.style.display = 'block';   // Show Reset link
                previewTray.innerHTML = '';         // Clear existing previews
            }

            fileList.forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'thumb-wrapper';
                    wrapper.innerHTML = `<img src="${e.target.result}">`;
                    previewTray.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        }

        function resetImages() {
            fileInput.value = '';
            previewTray.innerHTML = '';
            dropContent.style.display = 'block';
            clearBtn.style.display = 'none';
        }

        // --- UPDATED SELECTION LOGIC ---
        // Updates the hidden inputs when buttons are clicked
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.parentElement.querySelectorAll('.size-btn').forEach(sib => sib.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('selectedSize').value = this.innerText;
            });
        });

        document.querySelectorAll('.color-dot').forEach(btn => {
            btn.addEventListener('click', function() {
                this.parentElement.querySelectorAll('.color-dot').forEach(sib => sib.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('selectedColor').value = this.style.backgroundColor;
            });
        });

        // --- DEPLOYMENT LOGIC (Ready for PHP) ---
        const deployBtn = document.getElementById('confirmDeployBtn');

        deployBtn.addEventListener('click', () => {
            // 1. Gather all data
            const formData = new FormData();
            formData.append('name', document.getElementById('productName').value);
            formData.append('category', document.getElementById('productCategory').value);
            formData.append('description', document.getElementById('productDescription').value);
            formData.append('price', document.getElementById('productPrice').value);
            formData.append('stock', document.getElementById('productStock').value);
            formData.append('size', document.getElementById('selectedSize').value);
            formData.append('color', document.getElementById('selectedColor').value);

            // 2. Append Images
            const files = fileInput.files;
            for (let i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }

            // 3. UI Feedback
            const originalText = deployBtn.innerText;
            deployBtn.innerText = "UPLOADING...";
            deployBtn.disabled = true;

            // 4. Send to Backend
            fetch('http://localhost/shop-api/add-product.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert("Asset Deployed Successfully!");
                    document.querySelector('.btn-close').click(); // Close Modal
                    document.getElementById('gearForm').reset();  // Clear Form
                    resetImages();                                // Clear Images
                    // Optional: Refresh the list here
                } else {
                    alert("Error: " + (data.error || "Unknown error"));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Connection Failed. Is the PHP server running?");
            })
            .finally(() => {
                deployBtn.innerText = originalText;
                deployBtn.disabled = false;
            });
        });
    </script>
</body>
</html>