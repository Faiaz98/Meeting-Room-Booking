<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">My Bookings</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'database.php';
                session_start();
                $user_id = $_SESSION['user_id'];

                $sql = "SELECT rooms.room_name, bookings.start_time, bookings.end_time 
                        FROM bookings 
                        JOIN rooms ON bookings.room_id = rooms.id 
                        WHERE bookings.user_id='$user_id'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row['room_name']."</td><td>".$row['start_time']."</td><td>".$row['end_time']."</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No bookings found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
