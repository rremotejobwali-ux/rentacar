<?php
// locations.php
require_once 'includes/db.php';
include 'includes/header.php';
?>

<section class="section-hero">
    <h1>Our Locations</h1>
    <p>Find us in major cities across the country. Premium service, everywhere.</p>
</section>

<div class="locations-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
    <?php
    $locations = [
        ['city' => 'New York', 'address' => '123 Manhattan Ave, NY 10001', 'image' => 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?auto=format&fit=crop&q=80&w=800'],
        ['city' => 'Los Angeles', 'address' => '456 Hollywood Blvd, CA 90028', 'image' => 'https://images.unsplash.com/photo-1534190760961-74e8c1c5c3da?auto=format&fit=crop&q=80&w=800'],
        ['city' => 'Miami', 'address' => '789 Ocean Dr, FL 33139', 'image' => 'https://images.unsplash.com/photo-1514214246283-d427a957fc9c?auto=format&fit=crop&q=80&w=800'],
        ['city' => 'Chicago', 'address' => '101 Michigan Ave, IL 60601', 'image' => 'https://images.unsplash.com/photo-1494522855154-9297ac14b55f?auto=format&fit=crop&q=80&w=800']
    ];

    foreach ($locations as $loc): ?>
        <div class="car-card" style="text-align: left;">
            <div class="car-image-container">
                <img src="<?php echo $loc['image']; ?>" alt="<?php echo $loc['city']; ?>" class="car-image">
            </div>
            <div class="car-info">
                <h3><?php echo $loc['city']; ?></h3>
                <p style="color: var(--text-muted); margin-bottom: 1rem;"><?php echo $loc['address']; ?></p>
                <a href="cars.php?location=<?php echo urlencode($loc['city']); ?>" class="btn-auth" style="display: inline-block; text-align: center; text-decoration: none;">View Fleet here</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>
