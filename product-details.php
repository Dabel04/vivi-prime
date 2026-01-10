<?php
require_once 'db_connect.php';
$db = new Database();
$conn = $db->connect();

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) { header("Location: shop.php"); exit; }

// Fetch Gallery
$imgStmt = $conn->prepare("SELECT image_url FROM product_images WHERE product_id = ?");
$imgStmt->execute([$id]);
$gallery_images = $imgStmt->fetchAll(PDO::FETCH_COLUMN);

if (empty($gallery_images) && !empty($product['image_url'])) {
    $gallery_images[] = $product['image_url'];
}

$sizes = !empty($product['size']) ? explode(', ', $product['size']) : [];
$colors = !empty($product['color']) ? explode(', ', $product['color']) : [];

$relStmt = $conn->prepare("SELECT * FROM products WHERE category = ? AND id != ? LIMIT 4");
$relStmt->execute([$product['category'], $id]);
$related_products = $relStmt->fetchAll(PDO::FETCH_ASSOC);

include 'header.php';
?>

<main class="container py-5">
    <div class="row g-5">
        <div class="col-md-7">
            <div class="product-gallery">
                <div class="main-image-container mb-3 overflow-hidden rounded shadow-sm">
                    <img id="mainDisplay" src="<?= htmlspecialchars($gallery_images[0]) ?>" class="img-fluid w-100" alt="Main Asset">
                </div>
                <div class="thumbnail-strip d-flex gap-2 overflow-auto pb-2">
                    <?php foreach($gallery_images as $index => $img): ?>
                        <img src="<?= htmlspecialchars($img) ?>" class="thumb <?= $index === 0 ? 'active' : '' ?>" onclick="swapImage(this)" alt="Angle <?= $index + 1 ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="purchase-box sticky-top" style="top: 100px;">
                <h1 class="display-6 fw-900 text-uppercase mb-2"><?= htmlspecialchars($product['name']) ?></h1>
                <p class="text-muted mb-4 small">CLASS: <?= htmlspecialchars($product['category']) ?> // PERFORMANCE TECH</p>
                <div class="h4 fw-700 mb-4">$<?= number_format($product['price'], 2) ?></div>

                <form id="addToCartForm">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
                    <input type="hidden" name="price" value="<?= $product['price'] ?>">
                    <input type="hidden" name="image" value="<?= htmlspecialchars($gallery_images[0]) ?>">

                    <?php if(!empty($sizes)): ?>
                    <div class="mb-4">
                        <h6 class="fw-bold text-uppercase x-small mb-3">Select Size</h6>
                        <div class="d-flex gap-2 flex-wrap">
                            <?php foreach($sizes as $size): ?>
                                <button type="button" class="size-btn" onclick="selectSize(this, '<?= $size ?>')"><?= $size ?></button>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="size" id="selectedSize">
                    </div>
                    <?php else: ?>
                        <input type="hidden" name="size" id="selectedSize" value="One Size">
                    <?php endif; ?>

                    <?php if(!empty($colors)): ?>
                    <div class="mb-4">
                        <h6 class="fw-bold text-uppercase x-small mb-3">Select Color</h6>
                        <div class="d-flex gap-2">
                            <?php foreach($colors as $color): ?>
                                <div class="color-swatch-btn" style="background: <?= strtolower($color) ?>;" title="<?= $color ?>" onclick="selectColor(this, '<?= $color ?>')"></div>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="color" id="selectedColor">
                    </div>
                    <?php else: ?>
                        <input type="hidden" name="color" id="selectedColor" value="Standard">
                    <?php endif; ?>

                    <?php if($product['stock'] > 0): ?>
                        <button type="button" class="add-to-cart-btn py-3 mb-3 w-100" onclick="secureAsset()">SECURE ASSET</button>
                    <?php else: ?>
                        <button type="button" class="btn btn-secondary py-3 mb-3 w-100" disabled style="font-family: 'JetBrains Mono'; font-weight: 700; cursor: not-allowed; border-radius:0;">STOCK DEPLETED // OUT OF STOCK</button>
                    <?php endif; ?>
                </form>
                
                <div class="product-desc mt-5">
                    <h6 class="fw-bold text-uppercase x-small border-bottom pb-2">Description</h6>
                    <p class="small text-muted pt-2"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .main-image-container { height: 600px; background: #f8f8f8; }
    .main-image-container img { height: 100%; object-fit: cover; }
    .thumbnail-strip::-webkit-scrollbar { height: 4px; }
    .thumbnail-strip::-webkit-scrollbar-thumb { background: #000; }
    .thumb { width: 80px; height: 100px; object-fit: cover; cursor: pointer; opacity: 0.6; transition: 0.3s; border: 1px solid transparent; }
    .thumb:hover, .thumb.active { opacity: 1; border-color: #000; }
    .size-btn { border: 1px solid #ddd; background: #fff; padding: 10px 20px; font-size: 12px; font-weight: 700; transition: 0.2s; text-transform: uppercase; }
    .size-btn.active, .size-btn:hover { background: #000; color: #fff; border-color: #000; }
    .color-swatch-btn { width: 35px; height: 35px; border-radius: 50%; border: 1px solid #ddd; cursor: pointer; transition: 0.2s; }
    .color-swatch-btn:hover, .color-swatch-btn.active { transform: scale(1.1); border-color: #000; box-shadow: 0 0 0 2px #fff, 0 0 0 4px #000; }
    .add-to-cart-btn { background: #000; color: #fff; border: none; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; transition: 0.3s; }
    .add-to-cart-btn:hover { background: #d7263d; }
    .product-card { border: none; transition: 0.3s; }
    .product-card:hover { transform: translateY(-5px); }
    .product-img-wrapper { position: relative; height: 350px; background: #f4f4f4; margin-bottom: 15px; overflow: hidden; }
    .product-img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    .product-title { font-weight: 700; font-size: 0.9rem; text-transform: uppercase; }
    .product-price { color: #666; font-size: 0.9rem; font-family: 'JetBrains Mono', monospace; }
</style>

<script>
    function swapImage(thumb) {
        document.getElementById('mainDisplay').src = thumb.src;
        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
    }
    function selectSize(el, val) {
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('selectedSize').value = val;
    }
    function selectColor(el, val) {
        document.querySelectorAll('.color-swatch-btn').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('selectedColor').value = val;
    }
    function secureAsset() {
        const sizeInput = document.getElementById('selectedSize');
        const colorInput = document.getElementById('selectedColor');
        if(sizeInput.value === "") { alert("SYSTEM ALERT: SIZE REQUIRED."); return; }
        if(colorInput.value === "") { alert("SYSTEM ALERT: COLORWAY REQUIRED."); return; }

        const product = {
            id: document.querySelector('input[name="product_id"]').value,
            name: document.querySelector('input[name="name"]').value,
            price: document.querySelector('input[name="price"]').value,
            image: document.querySelector('input[name="image"]').value,
            size: sizeInput.value, color: colorInput.value, quantity: 1
        };

        let cart = JSON.parse(localStorage.getItem('vivi_cart')) || [];
        cart.push(product);
        localStorage.setItem('vivi_cart', JSON.stringify(cart));
        alert("ASSET SECURED.");
    }
</script>

<section class="container mb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <h2 class="section-header mb-0 mt-5 fw-bold text-uppercase">More Like This</h2>
        <a href="shop.php" class="view-all-link text-dark fw-bold" style="font-size: 0.8rem; text-decoration:none;">VIEW ALL ></a>
    </div>
    <div class="row g-4">
        <?php foreach($related_products as $p): ?>
        <div class="col-6 col-lg-3">
            <a href="product-details.php?id=<?= $p['id'] ?>" class="text-decoration-none text-dark">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                    </div>
                    <div class="product-title"><?= htmlspecialchars($p['name']) ?></div>
                    <div class="product-price">$<?= number_format($p['price'], 2) ?></div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'footer.php'; ?>