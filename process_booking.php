<?php
// process_booking.php
require_once 'includes/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = $_POST['car_id'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $pickup_date = $_POST['pickup_date'];
    $return_date = $_POST['return_date'];
    $total_price = $_POST['total_price'];

    // Basic validation
    if (empty($user_name) || empty($user_email) || empty($pickup_date) || empty($return_date)) {
        die("<div class='container' style='padding:4rem; text-align:center;'><h2>Error</h2><p>Please fill all fields.</p><a href='javascript:history.back()' class='btn-view'>Go Back</a></div>");
    }

    $user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

    try {
        $stmt = $pdo->prepare("INSERT INTO bookings (user_id, car_id, user_name, user_email, pickup_date, return_date, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $car_id, $user_name, $user_email, $pickup_date, $return_date, $total_price]);

        $booking_id = $pdo->lastInsertId();
        
        // Fetch car details for the confirmation
        $stmtCar = $pdo->prepare("SELECT brand, model FROM cars WHERE id = ?");
        $stmtCar->execute([$car_id]);
        $car = $stmtCar->fetch();
        ?>
        
        <div style="max-width: 600px; margin: 4rem auto; background: white; padding: 3rem; border-radius: 24px; border: 1px solid var(--border); text-align: center; box-shadow: var(--shadow-lg);">
            <div style="font-size: 4rem; color: #10b981; margin-bottom: 1.5rem;">✅</div>
            <h2 style="font-size: 2rem; margin-bottom: 1rem;">Booking Confirmed!</h2>
            <p style="color: var(--text-muted); margin-bottom: 2rem;">Your ride is ready, <?php echo htmlspecialchars($user_name); ?>. We've sent the details to <strong><?php echo htmlspecialchars($user_email); ?></strong>.</p>
            
            <div style="background: var(--background); padding: 1.5rem; border-radius: 16px; margin-bottom: 2rem; text-align: left;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                    <span style="color: var(--text-muted);">Vehicle</span>
                    <span style="font-weight: 600;"><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                    <span style="color: var(--text-muted);">Dates</span>
                    <span style="font-weight: 600;"><?php echo htmlspecialchars($pickup_date); ?> to <?php echo htmlspecialchars($return_date); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 1.25rem; color: var(--primary); padding-top: 0.75rem; border-top: 1px solid var(--border);">
                    <span>Total Paid</span>
                    <span>$<?php echo number_format($total_price, 0); ?></span>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: center;">
                <a href="index.php" class="btn-view" style="color: var(--primary); font-weight: 700;">Back to Home</a>
                <a href="#" onclick="window.print()" class="btn-view" style="background: var(--primary); color: white; border-color: var(--primary);">Download Receipt</a>
            </div>
        </div>

        <?php

    } catch (PDOException $e) {
        die("<div class='container' style='padding:4rem; text-align:center;'><h2>Error</h2><p>Error processing booking: " . $e->getMessage() . "</p></div>");
    }
} else {
    header("Location: index.php");
}

include 'includes/footer.php';
?>
