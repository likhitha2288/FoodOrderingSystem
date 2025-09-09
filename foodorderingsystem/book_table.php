<?php
include 'db_connect.php'; // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $guests = $_POST['guests'];
    $payment_method = $_POST['payment_method'];
    $items = isset($_POST['items']) ? $_POST['items'] : [];

    // Insert booking
    $query = "INSERT INTO table_booking (customer_name, email, phone, booking_date, booking_time, guests, payment_method) 
              VALUES ('$customer_name', '$email', '$phone', '$booking_date', '$booking_time', '$guests', '$payment_method')";
    
    if (mysqli_query($conn, $query)) {
        $booking_id = mysqli_insert_id($conn);

        // Insert selected menu items
        foreach ($items as $item_id) {
            $insertItem = "INSERT INTO booking_items (booking_id, item_id) VALUES ('$booking_id', '$item_id')";
            mysqli_query($conn, $insertItem);
        }

        echo "✅ Table booked successfully!";
    } else {
        echo "❌ Error: " . mysqli_error($conn);
    }
}
?>
