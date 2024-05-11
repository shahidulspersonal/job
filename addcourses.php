
<?php
  // Check if the form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the course title and description
    $title = $_POST["title"];
    $description = $_POST["description"];

    // Get the course image file
    $image = $_FILES["image"];
    $image_name = $image["name"];
    $image_tmp_name = $image["tmp_name"];
    $image_size = $image["size"];
    $image_error = $image["error"];



    // Check if there was an error with the image file
    if ($image_error !== UPLOAD_ERR_OK) {
      echo "There was an error uploading the course image. Please try again.";
      exit();
    }




    // Set the upload directory for the course image and file
    $upload_dir = "uploads/";

    // Move the course image to the upload directory
    $image_dest_path = $upload_dir . $image_name;
    move_uploaded_file($image_tmp_name, $image_dest_path);

    // Move the course file to the upload directory
    $file_dest_path = $upload_dir . $file_name;
    move_uploaded_file($file_tmp_name, $file_dest_path);

    // Add the course information to the database
    // You would need to replace the database credentials with your own
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jobmaker";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Escape special characters in the course title and description
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);

    // Insert the course information into the database
    $sql = "INSERT INTO course (course_name, course_description, image) VALUES ('$course_name', '$course_description', '$image')";

    if ($conn->query($sql) === TRUE) {
      echo "Course uploaded successfully.";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
  }
?>









<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Upload a Course</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Upload a Course</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Course Title</label>
        <input type="text" class="form-control" id="title" name="course_name" required>
      </div>
      <div class="form-group">
        <label for="description">Course Description</label>
        <textarea class="form-control" id="description" name="course_description" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="image">Course Image</label>
        <input type="file" class="form-control-file" id="image" name="image" required>
      </div>

      <button type="submit" class="btn btn-primary">Upload</button>
    </form>
  </div>

  <!-- Bootstrap JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
