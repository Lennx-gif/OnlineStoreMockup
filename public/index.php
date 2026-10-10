<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/src/bootstrap.php';
require_once dirname(__DIR__) . '/src/catalog.php';

$rawQuery = $_GET['q'] ?? '';
$rawCategory = $_GET['category'] ?? '';
$rawSort = $_GET['sort'] ?? 'newest';
$query = is_string($rawQuery) ? trim($rawQuery) : '';
$category = is_string($rawCategory) ? trim($rawCategory) : '';
$sort = is_string($rawSort) ? $rawSort : 'newest';
$requestedPage = input_int($_GET['page'] ?? 1);
$page = max(1, $requestedPage === false ? 1 : $requestedPage);
$perPage = 8;

$categories = db()->query('SELECT DISTINCT category FROM products WHERE is_active = 1 ORDER BY category')
    ->fetchAll(PDO::FETCH_COLUMN);
$conditions = ['is_active = 1'];
$parameters = [];
if ($query !== '') {
    $conditions[] = '(name LIKE ? OR description LIKE ?)';
    $parameters[] = '%' . $query . '%';
    $parameters[] = '%' . $query . '%';
}
if ($category !== '' && in_array($category, $categories, true)) {
    $conditions[] = 'category = ?';
    $parameters[] = $category;
}
$where = implode(' AND ', $conditions);
$countStatement = db()->prepare("SELECT COUNT(*) FROM products WHERE $where");
$countStatement->execute($parameters);
$totalProducts = (int) $countStatement->fetchColumn();
$totalPages = max(1, (int) ceil($totalProducts / $perPage));
$page = min($page, $totalPages);
$orderBy = match ($sort) {
    'price_asc' => 'price ASC, id DESC',
    'price_desc' => 'price DESC, id DESC',
    default => 'created_at DESC, id DESC',
};
$statement = db()->prepare(
    "SELECT id, name, description, price, stock, image, category "
    . "FROM products WHERE $where ORDER BY $orderBy LIMIT ? OFFSET ?"
);
foreach ($parameters as $index => $value) {
    $statement->bindValue($index + 1, $value);
}
$statement->bindValue(count($parameters) + 1, $perPage, PDO::PARAM_INT);
$statement->bindValue(count($parameters) + 2, ($page - 1) * $perPage, PDO::PARAM_INT);
$statement->execute();
$products = $statement->fetchAll();
$pageTitle = 'Shop';
$activePage = 'shop';
require dirname(__DIR__) . '/src/views/header.php';
?>
<section class="hero">
    <div class="hero-copy">
        <p class="eyebrow">Curated for everyday</p>
        <h1>Tech and study gear<br>for everyday use.</h1>
        <p>Browse the catalogue, add items to your cart, and check out in a few steps.</p>
        <div class="hero-actions">
            <a class="button button-primary" href="#catalogue">Shop all products</a>
            <a class="button button-light" href="<?= h(url('cart.php')) ?>">View cart</a>
        </div>
    </div>
    <div class="hero-art" aria-hidden="true">
        <div class="hero-orbit orbit-one"></div><div class="hero-orbit orbit-two"></div>
        <div class="hero-device"><span>MS</span><i></i><i></i><i></i></div>
        <div class="hero-spark spark-one">✳</div><div class="hero-spark spark-two">✦</div>
        <div class="hero-caption">Good tools.<br>Better days.</div>
    </div>
</section>

<section class="catalogue" id="catalogue">
    <div class="section-heading">
        <div><p class="eyebrow">Find your next favourite</p><h2>Shop the collection</h2></div>
        <span class="muted"><?= $totalProducts ?> products</span>
    </div>
    <form class="catalogue-controls" action="<?= h(url()) ?>" method="get">
        <label class="visually-hidden" for="category">Filter by category</label>
        <select id="category" name="category">
            <option value="">All categories</option>
            <?php foreach ($categories as $categoryOption): ?>
                <option value="<?= h($categoryOption) ?>" <?= $category === $categoryOption ? 'selected' : '' ?>>
                    <?= h($categoryOption) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label class="visually-hidden" for="sort">Sort products</label>
        <select id="sort" name="sort">
            <option value="newest" <?= $sort === 'newest' ? 'selected' : '' ?>>Newest</option>
            <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Price: low to high</option>
            <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Price: high to low</option>
        </select>
        <?php if ($query !== ''): ?><input type="hidden" name="q" value="<?= h($query) ?>"><?php endif; ?>
        <button class="button button-outline button-small">Apply filters</button>
    </form>
    <?php if ($products): ?>
        <div class="product-grid">
            <?php foreach ($products as $product): require dirname(__DIR__) . '/src/views/product_card.php'; endforeach; ?>
        </div>
        <?php if ($totalPages > 1): ?>
            <nav class="pagination" aria-label="Product pages">
                <?php for ($number = 1; $number <= $totalPages; $number++): ?>
                    <a class="<?= $page === $number ? 'current' : '' ?>"
                       href="<?= h(url('?' . http_build_query(array_merge($_GET, ['page' => $number])))) ?>"
                       <?= $page === $number ? 'aria-current="page"' : '' ?>><?= $number ?></a>
                <?php endfor; ?>
            </nav>
        <?php endif; ?>
    <?php else: ?>
        <div class="empty-state"><h3>No products found</h3><p>Try a different search or category.</p><a href="<?= h(url()) ?>">Clear filters</a></div>
    <?php endif; ?>
</section>
<?php require dirname(__DIR__) . '/src/views/footer.php'; ?>
