<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Room</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Book a Room</h2>
        <form action="book_room_action.php" method="POST">
            <div class="form-group">
                <label for="room">Room</label>
                <select class="form-control" id="room" name="room" required>
                    <?php
                    include 'database.php';
                    $sql = "SELECT * FROM rooms";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='".$row['id']."'>".$row['room_name']."</option>";
                        }
                    } else {
                        echo "<option value=''>No rooms available</option>";
                    }

                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
            </div>
            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Book</button>
        </form>
    </div>
</body>
</html>
