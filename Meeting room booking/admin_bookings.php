<?php
include 'database.php';
session_start();

// Check if the user is an admin
if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

// Handle delete booking request
if (isset($_GET['delete'])) {
    $booking_id = $_GET['delete'];
    $sql = "DELETE FROM bookings WHERE id='$booking_id'";
    $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Manage Bookings</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Room</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT bookings.id, users.username, rooms.room_name, bookings.start_time, bookings.end_time 
                        FROM bookings 
                        JOIN users ON bookings.user_id = users.id 
                        JOIN rooms ON bookings.room_id = rooms.id";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['room_name']}</td>
                                <td>{$row['start_time']}</td>
                                <td>{$row['end_time']}</td>
                                <td>
                                    <a href='admin_bookings.php?delete={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No bookings found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
