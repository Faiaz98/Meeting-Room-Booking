<?php
include 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $room_id = $_POST['room'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Check for availability
    $sql = "SELECT * FROM bookings WHERE room_id='$room_id' AND (
                (start_time <= '$start_time' AND end_time >= '$start_time') OR
                (start_time <= '$end_time' AND end_time >= '$end_time') OR
                ('$start_time' <= start_time AND '$end_time' >= end_time)
            )";

    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // If available, insert the booking
        $sql = "INSERT INTO bookings (user_id, room_id, start_time, end_time) VALUES ('$user_id', '$room_id', '$start_time', '$end_time')";
        if ($conn->query($sql) === TRUE) {
            echo "Room booked successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "The room is not available at the selected time.";
    }

    $conn->close();
}
?>
