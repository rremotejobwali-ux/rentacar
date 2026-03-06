-- sql/database.sql
-- Create Database if not exists (Optional, depending on your environment)
-- CREATE DATABASE IF NOT EXISTS rsk2_11;
-- USE rsk2_11;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS cars;
SET FOREIGN_KEY_CHECKS = 1;

-- Table structure for table `users`
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- Table structure for table `cars`
CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL, -- SUV, Sedan, Sport, etc.
    price_per_day DECIMAL(10,2) NOT NULL,
    fuel_type VARCHAR(50) NOT NULL,
    image_url TEXT,
    description TEXT,
    location VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Table structure for table `bookings`
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    car_id INT NOT NULL,
    user_name VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    pickup_date DATE NOT NULL,
    return_date DATE NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE
) ENGINE=InnoDB;


-- Insert premium dummy data for cars
INSERT INTO cars (brand, model, type, price_per_day, fuel_type, image_url, description, location) VALUES
('Toyota', 'Camry', 'Sedan', 55.00, 'Hybrid', 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?auto=format&fit=crop&q=80&w=800', 'Elegant, fuel-efficient, and smooth. The perfect companion for city drives and highway cruises alike.', 'New York'),
('Honda', 'CR-V', 'SUV', 80.00, 'Hybrid', 'https://images.unsplash.com/photo-1594502184342-2e12f877aa73?auto=format&fit=crop&q=80&w=800', 'Spacious, safe, and ready for adventure. Ideal for family trips with plenty of cargo space.', 'Los Angeles'),
('Ford', 'Mustang', 'Sport', 145.00, 'Petrol', 'https://images.unsplash.com/photo-1584345604481-03bd4c15895a?auto=format&fit=crop&q=80&w=800', 'The iconic American muscle. Experience raw power and a sound that turns heads on every corner.', 'Miami'),
('Tesla', 'Model 3', 'Electric', 95.00, 'Electric', 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?auto=format&fit=crop&q=80&w=800', 'Step into the future. Minimalist design paired with Ludicrous acceleration and zero emissions.', 'San Francisco'),
('BMW', 'X5', 'Luxury', 180.00, 'Diesel', 'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=800', 'The ultimate driving machine. Luxury meets performance in this sophisticated premium SUV.', 'Chicago'),
('Porsche', '911', 'Sport', 250.00, 'Petrol', 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=800', 'Timeless design and unparalleled performance. The gold standard of sports cars.', 'Las Vegas'),
('Mercedes-Benz', 'S-Class', 'Luxury', 220.00, 'Petrol', 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&q=80&w=800', 'First-class travel on four wheels. Unmatched comfort and cutting-edge technology.', 'New York'),
('Jeep', 'Wrangler', 'Off-Road', 110.00, 'Petrol', 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&q=80&w=800', 'Go anywhere, do anything. The legend of off-roading is ready for your next rugged adventure.', 'Denver');
