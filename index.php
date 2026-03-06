<?php
// index.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/db.php';
include 'includes/header.php';

try {
    // Fetch featured cars (MySQL syntax RAND())
    $stmt = $pdo->query("SELECT * FROM cars ORDER BY RAND() LIMIT 3");
    $featured_cars = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "<div style='padding: 20px; color: red;'>Error fetching cars: " . $e->getMessage() . " <br> Please run <a href='setup.php'>setup.php</a> to initialize the database.</div>";
    $featured_cars = [];
}
?>

<div class="hero">
    <div class="hero-content">
        <h1>Drive Your Dreams <br> Anywhere You Go</h1>
        <p>Premium car rental service for your next adventure. Choose from our wide range of luxury, sport, and family vehicles.</p>
    </div>
</div>

<div class="search-container">
    <form action="cars.php" method="GET" class="search-form">
        <div class="form-group">
            <label for="location">Pickup Location</label>
            <input type="text" name="location" id="location" placeholder="Where do you need it?" required>
        </div>
        <div class="form-group">
            <label for="pickup_date">Pickup Date</label>
            <input type="date" name="pickup_date" id="pickup_date" required min="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="form-group">
            <label for="return_date">Return Date</label>
            <input type="date" name="return_date" id="return_date" required min="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="form-group">
            <button type="submit" class="btn-search">Search Now</button>
        </div>
    </form>
</div>

<section class="featured-cars" style="margin-top: 6rem;">
    <h2 class="section-title">Discover Our Premium Fleet</h2>
    <div class="cars-grid">
        <?php if (!empty($featured_cars)): ?>
            <?php foreach ($featured_cars as $car): ?>
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
                        <div class="car-footer">
                            <div class="price-tag">$<?php echo number_format($car['price_per_day'], 0); ?> <span>/ day</span></div>
                            <a href="car_details.php?id=<?php echo $car['id']; ?>" class="btn-view">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; width: 100%;">No cars found. Please run <a href='setup.php'>setup.php</a>.</p>
        <?php endif; ?>
    </div>
</section>

<section class="stats" style="margin-top: 6rem; background: white; padding: 4rem; border-radius: 24px; border: 1px solid var(--border); display: grid; grid-template-columns: repeat(3, 1fr); text-align: center; gap: 2rem;">
    <div>
        <h2 style="font-size: 3rem; color: var(--primary);">200+</h2>
        <p style="color: var(--text-muted); font-weight: 500;">Premium Cars</p>
    </div>
    <div>
        <h2 style="font-size: 3rem; color: var(--primary);">12k</h2>
        <p style="color: var(--text-muted); font-weight: 500;">Happy Customers</p>
    </div>
    <div>
        <h2 style="font-size: 3rem; color: var(--primary);">15</h2>
        <p style="color: var(--text-muted); font-weight: 500;">Cities Covered</p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
