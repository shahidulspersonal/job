<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

// Connect to database
$mysqli = new mysqli('localhost', 'root', '', 'jobmaker');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Prepare and bind SQL statement
$stmt = $mysqli->prepare("INSERT INTO jsinfo (id, fname,lname,gender,phn, address, nid) VALUES (?, ?, ?, ?,?,?,?)");
$stmt->bind_param("issssss", $id,$fname,$lname,$gender, $phn, $address, $nid);

// Validate form inputs and execute statement
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION["id"];
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $gender = trim($_POST["gender"]);
    $phn = trim($_POST["phn"]);
    $address = trim($_POST["address"]);
    $nid = trim($_POST["nid"]);

    // Validate inputs
    if (empty($fname)|| empty($lname)|| empty($gender)||empty($phn) || empty($address) || empty($nid)) {
        echo "Please fill in all fields.";
    } else {
        // Execute statement and display success message
        if ($stmt->execute()) {
            echo "Data inserted successfully.";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
    }
}

// Close statement and connection
$stmt->close();
$mysqli->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Insert Data</title>
    <link rel="stylesheet" href="css/jsdata.css">

</head>
<body class="bgb">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div>

          <h1 style="font-size:40px;color:white; text-align: center;">Personal Information</h1>
          <table class="tclass">
              <td>
                  <labe for="fname">First name:</label>
              </td>
              <td><input type="text" name="fname" placeholder="Enter your First Name"></td>
              <tr>
                  <td><label for="lname">Last name:</label></td>
                  <td><input type="text" name="lname" placeholder="Enter your Last Name"></td>
              </tr>
              <tr>
                  <td>
                      <label style="margin-right: 8px;" for="gender">Gender:</label>
                  </td>
                  <td>
                      <input style="cursor: pointer;" type="radio" id="male" name="gender" value="Male">
                      <label for="male">Male</label>

                      <input style="cursor: pointer" type="radio" id="female" name="gender" value="Female">
                      <label for="female">Female</label>

                      <input style="cursor: pointer;" type="radio" id="others" name="gender" value="Others">
                      <label style="cursor: pointer" for="others">Others</label>
                  </td>

              </tr>



              <tr>
                  <td><label for="phone number">Phone Number:</label></td>
                  <td><input type="text" name="phn" placeholder="Enter your Phone Number"></td>
              </tr>

              <tr>
                  <td><label for="address">Address:</label></td>
                  <td><input type="text" name="address" placeholder="Enter your Address"></td>
              </tr>
              <br>
              <tr>
                  <td><label for="nid no">NID No:</label></td>
                  <td><input type="text" name="nid" placeholder="Enter your NID No"></td>
              </tr>
              <tr>
                  <td>
                      <input type="submit" value="Insert Data" class="submit">
                  </td>

              </tr>

      </div>


  </form>

</body>
</html>
