<?php
include 'database.php';
session_start();

// Check if the user is an admin
if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

// Handle add room request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['room_name'])) {
    $room_name = $_POST['room_name'];
    $sql = "INSERT INTO rooms (room_name) VALUES ('$room_name')";
    $conn->query($sql);
}

// Handle delete room request
if (isset($_GET['delete'])) {
    $room_id = $_GET['delete'];
    $sql = "DELETE FROM rooms WHERE id='$room_id'";
    $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Manage Rooms</h2>
        <form action="admin_rooms.php" method="POST" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="room_name" placeholder="New Room Name" required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Add Room</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Room Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM rooms";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['room_name']}</td>
                                <td>
                                    <a href='admin_rooms.php?delete={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No rooms found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
