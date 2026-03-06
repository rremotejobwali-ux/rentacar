<?php
// cars.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/db.php';
include 'includes/header.php';

try {
    // Build Query
    $sql = "SELECT * FROM cars WHERE 1=1";
    $params = [];

    // Search Filter
    if (!empty($_GET['location'])) {
        $sql .= " AND (location LIKE :location OR brand LIKE :location OR model LIKE :location OR type LIKE :location)";
        $params[':location'] = '%' . $_GET['location'] . '%';
    }

    // Generic Query Search
    if (!empty($_GET['q'])) {
        $sql .= " AND (brand LIKE :q OR model LIKE :q OR description LIKE :q OR type LIKE :q)";
        $params[':q'] = '%' . $_GET['q'] . '%';
    }

    // Side Filters
    if (!empty($_GET['type'])) {
        $sql .= " AND type = :type";
        $params[':type'] = $_GET['type'];
    }
    if (!empty($_GET['brand'])) {
        $sql .= " AND brand = :brand";
        $params[':brand'] = $_GET['brand'];
    }
    if (!empty($_GET['fuel_type'])) {
        $sql .= " AND fuel_type = :fuel_type";
        $params[':fuel_type'] = $_GET['fuel_type'];
    }

    // Sorting
    $sort_order = "price_per_day ASC"; // Default
    if (!empty($_GET['sort'])) {
        if ($_GET['sort'] == 'price_desc') $sort_order = "price_per_day DESC";
        if ($_GET['sort'] == 'random') $sort_order = "RAND()";
    }
    $sql .= " ORDER BY $sort_order";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $cars = $stmt->fetchAll();

    // Fetch filter options for sidebar
    $types = $pdo->query("SELECT DISTINCT type FROM cars")->fetchAll(PDO::FETCH_COLUMN);
    $brands = $pdo->query("SELECT DISTINCT brand FROM cars")->fetchAll(PDO::FETCH_COLUMN);
    $fuels = $pdo->query("SELECT DISTINCT fuel_type FROM cars")->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "<div style='padding: 20px; color: red;'>Error loading fleet: " . $e->getMessage() . "</div>";
    $cars = [];
    $types = $brands = $fuels = [];
}
?>

<div class="listings-container" style="display: flex; gap: 2rem; align-items: flex-start;">
    <aside class="filters-sidebar" style="width: 300px; position: sticky; top: 6rem; background: white; padding: 2rem; border-radius: 20px; border: 1px solid var(--border); box-shadow: var(--shadow-sm);">
        <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">Filter Results</h3>
        <form action="cars.php" method="GET">
            <!-- Preserve search params -->
            <div class="filter-group" style="margin-bottom: 1.5rem;">
                <label for="q" style="font-weight: 600; font-size: 0.875rem; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">Keyword Search</label>
                <input type="text" name="q" value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>" placeholder="Brand, model..." style="width: 100%; padding: 0.75rem; border-radius: 10px; border: 1px solid var(--border); background: var(--background);">
            </div>
            
            <div class="filter-group" style="margin-bottom: 1.5rem;">
                <label for="sort" style="font-weight: 600; font-size: 0.875rem; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">Sort By</label>
                <select name="sort" onchange="this.form.submit()" style="width: 100%; padding: 0.75rem; border-radius: 10px; border: 1px solid var(--border); background: var(--background);">
                    <option value="price_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : ''; ?>>Price: Low to High</option>
                    <option value="price_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : ''; ?>>Price: High to Low</option>
                </select>
            </div>

            <div class="filter-group" style="margin-bottom: 1.5rem;">
                <label for="type" style="font-weight: 600; font-size: 0.875rem; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">Car Type</label>
                <select name="type" onchange="this.form.submit()" style="width: 100%; padding: 0.75rem; border-radius: 10px; border: 1px solid var(--border); background: var(--background);">
                    <option value="">All Types</option>
                    <?php if ($types): foreach($types as $type): ?>
                        <option value="<?php echo htmlspecialchars($type); ?>" <?php echo (isset($_GET['type']) && $_GET['type'] == $type) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($type); ?>
                        </option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

            <div class="filter-group" style="margin-bottom: 1.5rem;">
                <label for="brand" style="font-weight: 600; font-size: 0.875rem; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">Brand</label>
                <select name="brand" onchange="this.form.submit()" style="width: 100%; padding: 0.75rem; border-radius: 10px; border: 1px solid var(--border); background: var(--background);">
                    <option value="">All Brands</option>
                    <?php if ($brands): foreach($brands as $brand): ?>
                        <option value="<?php echo htmlspecialchars($brand); ?>" <?php echo (isset($_GET['brand']) && $_GET['brand'] == $brand) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($brand); ?>
                        </option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

             <div class="filter-group" style="margin-bottom: 1.5rem;">
                <label for="fuel_type" style="font-weight: 600; font-size: 0.875rem; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">Fuel Type</label>
                <select name="fuel_type" onchange="this.form.submit()" style="width: 100%; padding: 0.75rem; border-radius: 10px; border: 1px solid var(--border); background: var(--background);">
                    <option value="">All Fuel Types</option>
                    <?php if ($fuels): foreach($fuels as $fuel): ?>
                        <option value="<?php echo htmlspecialchars($fuel); ?>" <?php echo (isset($_GET['fuel_type']) && $_GET['fuel_type'] == $fuel) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($fuel); ?>
                        </option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

            <a href="cars.php" class="btn-view" style="display: block; text-align: center; margin-top: 1rem; color: var(--text-muted);">Reset All Filters</a>
        </form>
    </aside>

    <div style="flex: 1;">
        <div class="cars-grid">
            <?php if (!empty($cars)): ?>
                <?php foreach ($cars as $car): ?>
                    <div class="car-card">
                        <div class="car-image-container">
                            <img src="<?php echo htmlspecialchars($car['image_url']); ?>" alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>" class="car-image">
                            <span class="car-tag"><?php echo htmlspecialchars($car['type']); ?></span>
                        </div>
                        <div class="car-info">
                            <h3><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h3>
                            <div class="car-meta">
                                <span>⛽ <?php echo htmlspecialchars($car['fuel_type']); ?></span>
                                <span>📍 <?php echo htmlspecialchars($car['location']); ?></span>
                            </div>
                            <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1.5rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <?php echo htmlspecialchars($car['description']); ?>
                            </p>
                            <div class="car-footer">
                                <div class="price-tag">$<?php echo number_format($car['price_per_day'], 0); ?> <span>/ day</span></div>
                                <a href="car_details.php?id=<?php echo $car['id']; ?><?php echo !empty($_GET['pickup_date']) ? '&pickup_date='.$_GET['pickup_date'] : ''; ?><?php echo !empty($_GET['return_date']) ? '&return_date='.$_GET['return_date'] : ''; ?>" class="btn-view">Book Now</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 4rem; background: white; border-radius: 20px; border: 1px solid var(--border); width: 100%;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">No Cars Found</h3>
                    <p style="color: var(--text-muted);">Try adjusting your filters or location to find more results.</p>
                    <a href="cars.php" class="btn-view" style="margin-top: 2rem; display: inline-block;">View All Cars</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
