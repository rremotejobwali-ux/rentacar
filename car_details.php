<?php
// car_details.php
require_once 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: cars.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM cars WHERE id = :id");
$stmt->execute([':id' => $id]);
$car = $stmt->fetch();

if (!$car) {
    echo "<div style='text-align:center; padding: 4rem;'><h3>Car not found.</h3><a href='cars.php' class='btn-view'>Back to Fleet</a></div>";
    include 'includes/footer.php';
    exit;
}

$pickup_date = $_GET['pickup_date'] ?? '';
$return_date = $_GET['return_date'] ?? '';

?>

<div class="car-details-wrapper">
    <div class="car-main-content">
        <img src="<?php echo htmlspecialchars($car['image_url']); ?>" alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>" class="detail-img-large">
        
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem;">
            <div>
                <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h1>
                <div class="car-meta">
                    <span>⛽ <?php echo htmlspecialchars($car['fuel_type']); ?></span>
                    <span>📍 <?php echo htmlspecialchars($car['location']); ?></span>
                    <span>🚘 <?php echo htmlspecialchars($car['type']); ?></span>
                </div>
            </div>
            <div class="price-tag" style="font-size: 2rem;">
                $<?php echo number_format($car['price_per_day'], 0); ?> <span style="font-size: 1rem; color: var(--text-muted);">/ day</span>
            </div>
        </div>

        <div class="car-description">
            <h3 style="margin-bottom: 1rem;">About this vehicle</h3>
            <p><?php echo htmlspecialchars($car['description']); ?></p>
        </div>

        <div style="margin-top: 3rem; display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
            <div style="background: var(--background); padding: 1.5rem; border-radius: 12px; text-align: center;">
                <span style="font-size: 1.5rem;">🔒</span>
                <p style="font-weight: 600; margin-top: 0.5rem;">Secure Booking</p>
            </div>
            <div style="background: var(--background); padding: 1.5rem; border-radius: 12px; text-align: center;">
                <span style="font-size: 1.5rem;">🛠️</span>
                <p style="font-weight: 600; margin-top: 0.5rem;">24/7 Support</p>
            </div>
            <div style="background: var(--background); padding: 1.5rem; border-radius: 12px; text-align: center;">
                <span style="font-size: 1.5rem;">⭐</span>
                <p style="font-weight: 600; margin-top: 0.5rem;">Top Rated</p>
            </div>
        </div>
    </div>

    <div class="booking-sidebar">
        <h2>Reserve this Car</h2>
        <form action="process_booking.php" method="POST" class="booking-form-stack" id="bookingForm">
            <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
            <input type="hidden" id="price_per_day" value="<?php echo $car['price_per_day']; ?>">
            
            <div class="form-group">
                <label for="user_name">Full Name</label>
                <input type="text" name="user_name" id="user_name" placeholder="John Doe" value="<?php echo htmlspecialchars($_SESSION['user']['name'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="user_email">Email Address</label>
                <input type="email" name="user_email" id="user_email" placeholder="john@example.com" value="<?php echo htmlspecialchars($_SESSION['user']['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="pickup_date">Pickup Date</label>
                <input type="date" name="pickup_date" id="pickup_date" value="<?php echo htmlspecialchars($pickup_date); ?>" required min="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group">
                <label for="return_date">Return Date</label>
                <input type="date" name="return_date" id="return_date" value="<?php echo htmlspecialchars($return_date); ?>" required min="<?php echo date('Y-m-d'); ?>">
            </div>

            <div style="background: var(--background); padding: 1.5rem; border-radius: 12px; margin-top: 1rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span>Daily Rate</span>
                    <span>$<?php echo number_format($car['price_per_day'], 0); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span>Total Days</span>
                    <span id="days_count">0</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 1.25rem; color: var(--primary); padding-top: 0.5rem; border-top: 1px solid var(--border);">
                    <span>Total</span>
                    <span id="total_price_display">$0</span>
                </div>
                <input type="hidden" name="total_price" id="total_price_input" value="0">
            </div>

            <button type="submit" class="btn-confirm-booking">Confirm Booking</button>
        </form>
    </div>
</div>

<?php 
// Trigger JS calculation if dates are pre-filled
if ($pickup_date && $return_date) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            calculateTotal();
        });
    </script>";
}
?>

<?php include 'includes/footer.php'; ?>
