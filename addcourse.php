<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobmaker";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (mysqli_query($conn, $sql)) {
    echo "Table add_course created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>

<!-- Bootstrap form to add courses -->
<div class="container">
  <h2>Add Course</h2>
  <form action="add_course.php" method="post">
    <div class="form-group">
      <label for="course_name">Course Name:</label>
      <input type="text" class="form-control" id="course_name" name="course_name" required>
    </div>
    <div class="form-group">
      <label for="course_description">Course Description:</label>
      <textarea class="form-control" id="course_description" name="course_description" rows="3" required></textarea>
    </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <input type="text" class="form-control" id="image" name="image" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
