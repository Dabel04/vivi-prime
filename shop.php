<?php
require_once 'db_connect.php';
$db = new Database();
$conn = $db->connect();

// --- 1. CAPTURE & FILTER LOGIC ---
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$sort = $_GET['sort'] ?? 'newest';

$sql = "SELECT * FROM products WHERE 1=1";
$params = [];

if (!empty($search)) {
    $sql .= " AND (name LIKE ? OR description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if (!empty($category)) {
    $sql .= " AND category = ?";
    $params[] = $category;
}

switch ($sort) {
    case 'price_asc':  $sql .= " ORDER BY price ASC"; break;
    case 'price_desc': $sql .= " ORDER BY price DESC"; break;
    case 'oldest':     $sql .= " ORDER BY created_at ASC"; break;
    default:           $sql .= " ORDER BY created_at DESC";
}

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $products = [];
}

// Fetch Categories
$catStmt = $conn->query("SELECT DISTINCT category FROM products WHERE category IS NOT NULL AND category != ''");
$categories = $catStmt->fetchAll(PDO::FETCH_COLUMN);

// --- INCLUDE HEADER ---
include 'header.php'; 
?>

<style>
    /* Theme Engine Variables */
    :root {
        --color-primary: #0a0a0a;       
        --color-accent: #d7263d;        
        --color-bg: #f9f9f9;            
        --color-card-bg: #ffffff;       
        --color-border: #eeeeee;        
        --color-border-hover: #000000;  
        --color-text-muted: #888888;    
        --font-main: 'Montserrat', sans-serif;
        --font-code: 'JetBrains Mono', monospace;
        --radius-none: 0px;             
        --spacing-unit: 20px;
        --transition-speed: 0.3s;
    }

    body { background-color: var(--color-bg); font-family: var(--font-main); }
    .filter-sidebar { background: var(--color-card-bg); padding: 30px; border: 1px solid var(--color-border); height: 100%; }
    .filter-title { font-family: var(--font-code); font-weight: 700; text-transform: uppercase; font-size: 0.85rem; margin-bottom: 15px; border-bottom: 2px solid var(--color-primary); padding-bottom: 10px; }
    .cat-link { display: block; color: #666; text-decoration: none; padding: 8px 0; font-size: 0.9rem; transition: 0.3s; text-transform: uppercase; font-weight: 500; }
    .cat-link:hover, .cat-link.active { color: var(--color-accent); font-weight: 800; padding-left: 5px; border-left: 3px solid var(--color-accent); }
    .theme-input { border-radius: 0; border: 1px solid #ccc; padding: 10px; font-family: var(--font-code); font-size: 0.8rem; background: var(--color-card-bg); width: 100%; }
    .product-card { background: var(--color-card-bg); border: 1px solid var(--color-border); transition: 0.3s; position: relative; overflow: hidden; height: 100%; }
    .product-card:hover { border-color: #000; box-shadow: 10px 10px 0px rgba(0,0,0,0.05); transform: translateY(-5px); }
    .product-img { width: 100%; height: 320px; object-fit: cover; background: #f4f4f4; transition: 0.3s; }
    .product-card:hover .product-img { transform: scale(1.03); }
    .card-details { padding: 20px; }
    .product-cat { font-family: var(--font-code); font-size: 0.65rem; color: #888; text-transform: uppercase; letter-spacing: 1px; }
    .product-title { font-weight: 800; font-size: 0.95rem; text-transform: uppercase; margin: 0 0 10px 0; }
    .product-price { font-family: var(--font-code); font-weight: 700; color: var(--color-accent); font-size: 1.1rem; }
    
    /* Quick Actions */
    .quick-actions { position: absolute; bottom: 0; left: 0; width: 100%; background: rgba(255,255,255,0.95); padding: 15px; transform: translateY(100%); transition: 0.3s; border-top: 1px solid #eee; }
    .product-card:hover .quick-actions { transform: translateY(0); }
    .btn-view { width: 100%; background: #000; color: white; border: none; padding: 12px; font-family: var(--font-code); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; }
    .btn-view:hover { background: var(--color-accent); }

    /* Modal */
    .modal-content { border-radius: 0; border: 2px solid #000; box-shadow: 20px 20px 0 rgba(0,0,0,0.1); }
    .opt-btn { border: 1px solid #ddd; padding: 10px 15px; cursor: pointer; font-family: var(--font-code); font-size: 0.75rem; font-weight: 700; background: white; text-transform: uppercase; transition: 0.2s; }
    .opt-btn:hover, .opt-btn.active { background: #000; color: white; border-color: #000; }
    .color-opt { width: 35px; height: 35px; border-radius: 50%; border: 2px solid transparent; cursor: pointer; transition: 0.2s; }
    .color-opt.active { border-color: #000; transform: scale(1.1); box-shadow: 0 0 0 2px #fff, 0 0 0 4px #000; }
    .btn-modal-add { background: #000; color: white; width: 100%; padding: 15px; text-transform: uppercase; font-weight: 800; border: none; font-family: var(--font-code); letter-spacing: 1px; transition: 0.2s; margin-top: 10px; }
    .btn-modal-add:hover { background: var(--color-accent); }

    /* --- SOLD OUT STYLING --- */
    .product-card.sold-out { opacity: 0.7; pointer-events: none; }
    .sold-out-overlay { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-10deg); border: 3px solid var(--color-primary); background: rgba(255, 255, 255, 0.9); padding: 10px 20px; z-index: 10; }
    .sold-out-overlay span { font-family: var(--font-code); font-weight: 900; color: var(--color-primary); font-size: 1.2rem; letter-spacing: 2px; text-transform: uppercase; }
</style>

<div class="container-fluid py-5 px-lg-5">
    <div class="row g-5">
        
        <div class="col-lg-3 col-xl-2">
            <div class="filter-sidebar sticky-top" style="top: 100px; z-index: 90;">
                <div class="mb-5">
                    <div class="filter-title">Search Protocols</div>
                    <form action="shop.php" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="theme-input form-control" placeholder="KEYWORD..." value="<?= htmlspecialchars($search) ?>">
                            <button class="btn btn-dark" style="border-radius:0;"><i class="bi bi-search"></i></button>
                        </div>
                        <?php if($category): ?><input type="hidden" name="category" value="<?= $category ?>"><?php endif; ?>
                        <?php if($sort): ?><input type="hidden" name="sort" value="<?= $sort ?>"><?php endif; ?>
                    </form>
                </div>
                <div class="mb-5">
                    <div class="filter-title">Asset Class</div>
                    <a href="shop.php" class="cat-link <?= $category == '' ? 'active' : '' ?>">ALL ASSETS</a>
                    <?php foreach($categories as $cat): ?>
                        <a href="shop.php?category=<?= urlencode($cat) ?>&sort=<?= $sort ?>&search=<?= $search ?>" class="cat-link <?= $category == $cat ? 'active' : '' ?>"><?= htmlspecialchars($cat) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-xl-10">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <span class="font-mono small fw-bold text-secondary"><?= count($products) ?> ASSETS DETECTED</span>
                <form action="shop.php" method="GET" id="sortForm" class="d-flex align-items-center gap-2">
                    <label class="font-mono small fw-bold">SORT:</label>
                    <select name="sort" class="theme-input" onchange="document.getElementById('sortForm').submit()" style="cursor:pointer; width:auto;">
                        <option value="newest" <?= $sort == 'newest' ? 'selected' : '' ?>>NEWEST DEPLOYMENT</option>
                        <option value="price_asc" <?= $sort == 'price_asc' ? 'selected' : '' ?>>PRICE: LOW TO HIGH</option>
                        <option value="price_desc" <?= $sort == 'price_desc' ? 'selected' : '' ?>>PRICE: HIGH TO LOW</option>
                    </select>
                    <?php if($category): ?><input type="hidden" name="category" value="<?= $category ?>"><?php endif; ?>
                    <?php if($search): ?><input type="hidden" name="search" value="<?= $search ?>"><?php endif; ?>
                </form>
            </div>

            <div class="row g-4">
                <?php if (empty($products)): ?>
                    <div class="col-12 text-center py-5">
                        <div class="bi bi-slash-circle fs-1 text-secondary mb-3"></div>
                        <p class="font-mono fw-bold">NO MATCHING ASSETS FOUND.</p>
                        <a href="shop.php" class="btn btn-outline-dark" style="border-radius:0; font-family:'JetBrains Mono';">RESET FILTERS</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <?php $is_sold_out = $product['stock'] <= 0; ?>
                        <div class="col-md-4 col-lg-3">
                            <div class="product-card <?= $is_sold_out ? 'sold-out' : '' ?>">
                                <a href="<?= $is_sold_out ? '#' : 'product-details.php?id=' . $product['id'] ?>">
                                    <img src="<?= htmlspecialchars($product['image_url']) ?>" class="product-img" alt="Asset">
                                    
                                    <?php if($is_sold_out): ?>
                                        <div class="sold-out-overlay"><span>DEPLETED</span></div>
                                    <?php endif; ?>
                                </a>
                                
                                <div class="card-details">
                                    <div class="product-cat"><?= htmlspecialchars($product['category']) ?></div>
                                    <div class="product-title" style="<?= $is_sold_out ? 'text-decoration: line-through; opacity: 0.5;' : '' ?>">
                                        <?= htmlspecialchars($product['name']) ?>
                                    </div>
                                    <div class="product-price">$<?= number_format($product['price'], 2) ?></div>
                                </div>
                                
                                <?php if(!$is_sold_out): ?>
                                <div class="quick-actions">
                                    <button class="btn-view" 
                                        onclick="openQuickView(this)"
                                        data-id="<?= $product['id'] ?>"
                                        data-name="<?= htmlspecialchars($product['name']) ?>"
                                        data-price="<?= $product['price'] ?>"
                                        data-img="<?= htmlspecialchars($product['image_url']) ?>"
                                        data-sizes="<?= htmlspecialchars($product['size']) ?>"
                                        data-colors="<?= htmlspecialchars($product['color']) ?>"
                                        data-desc="<?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...">
                                        QUICK CONFIGURE
                                    </button>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quickViewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-mono fw-bold">ASSET CONFIGURATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img id="modalImg" src="" style="width:100%; height:100%; object-fit:cover; min-height:400px; border-right:1px solid #eee;">
                    </div>
                    <div class="col-md-7 p-4 d-flex flex-column justify-content-center">
                        <h4 id="modalName" class="fw-black text-uppercase mb-2" style="font-weight:900;"></h4>
                        <h3 id="modalPrice" class="font-mono fw-bold text-danger mb-3"></h3>
                        <p id="modalDesc" class="text-secondary small mb-4" style="line-height:1.6;"></p>
                        
                        <form id="modalForm">
                            <input type="hidden" id="modalId">
                            <input type="hidden" id="modalRealName">
                            <input type="hidden" id="modalRealPrice">
                            <input type="hidden" id="modalRealImg">
                            <div class="mb-3">
                                <label class="d-block font-mono small fw-bold mb-2">SIZE MATRIX</label>
                                <div id="modalSizes" class="d-flex gap-2 flex-wrap"></div>
                                <input type="hidden" id="modalSelectedSize">
                            </div>
                            <div class="mb-4">
                                <label class="d-block font-mono small fw-bold mb-2">COLORWAY</label>
                                <div id="modalColors" class="d-flex gap-2"></div>
                                <input type="hidden" id="modalSelectedColor">
                            </div>
                            <button type="button" class="btn-modal-add add-to-cart-btn" onclick="addModalToCart()">CONFIRM & SECURE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    const quickViewModal = new bootstrap.Modal(document.getElementById('quickViewModal'));

    function openQuickView(btn) {
        document.getElementById('modalId').value = btn.dataset.id;
        document.getElementById('modalRealName').value = btn.dataset.name;
        document.getElementById('modalRealPrice').value = btn.dataset.price;
        document.getElementById('modalRealImg').value = btn.dataset.img;
        
        document.getElementById('modalImg').src = btn.dataset.img;
        document.getElementById('modalName').innerText = btn.dataset.name;
        document.getElementById('modalPrice').innerText = '$' + parseFloat(btn.dataset.price).toFixed(2);
        document.getElementById('modalDesc').innerText = btn.dataset.desc;

        const sizeContainer = document.getElementById('modalSizes');
        sizeContainer.innerHTML = '';
        document.getElementById('modalSelectedSize').value = '';
        if (btn.dataset.sizes) {
            btn.dataset.sizes.split(', ').forEach(s => {
                const el = document.createElement('div');
                el.className = 'opt-btn'; el.innerText = s;
                el.onclick = function() {
                    document.querySelectorAll('#modalSizes .opt-btn').forEach(b => b.classList.remove('active'));
                    el.classList.add('active');
                    document.getElementById('modalSelectedSize').value = s;
                };
                sizeContainer.appendChild(el);
            });
        } else {
            sizeContainer.innerHTML = '<span class="small text-muted font-mono">ONE SIZE</span>';
            document.getElementById('modalSelectedSize').value = 'One Size';
        }

        const colorContainer = document.getElementById('modalColors');
        colorContainer.innerHTML = '';
        document.getElementById('modalSelectedColor').value = '';
        if (btn.dataset.colors) {
            btn.dataset.colors.split(', ').forEach(c => {
                const el = document.createElement('div');
                el.className = 'color-opt';
                el.style.backgroundColor = c.toLowerCase(); el.title = c;
                el.onclick = function() {
                    document.querySelectorAll('#modalColors .color-opt').forEach(b => b.classList.remove('active'));
                    el.classList.add('active');
                    document.getElementById('modalSelectedColor').value = c;
                };
                colorContainer.appendChild(el);
            });
        } else {
            colorContainer.innerHTML = '<span class="small text-muted font-mono">STANDARD</span>';
            document.getElementById('modalSelectedColor').value = 'Standard';
        }
        quickViewModal.show();
    }

    function addModalToCart() {
        const size = document.getElementById('modalSelectedSize').value;
        const color = document.getElementById('modalSelectedColor').value;
        if(!size) { alert("SYSTEM ALERT: SIZE REQUIRED."); return; }
        if(!color) { alert("SYSTEM ALERT: COLORWAY REQUIRED."); return; }

        const product = {
            id: document.getElementById('modalId').value,
            name: document.getElementById('modalRealName').value,
            price: document.getElementById('modalRealPrice').value,
            image: document.getElementById('modalRealImg').value,
            size: size, color: color, quantity: 1
        };

        let cart = JSON.parse(localStorage.getItem('vivi_cart')) || [];
        cart.push(product);
        localStorage.setItem('vivi_cart', JSON.stringify(cart));
        quickViewModal.hide();
        alert("ASSET SECURED IN SUPPLY CART.");
    }
</script>