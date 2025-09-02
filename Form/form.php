<?php
$errors = [];
$success = "";
$roll_no = $first_name = $last_name = $father_name = "";
$mobile = $email = $password = $gender = $city = $address = "";
$dob_d = $dob_m = $dob_y = "";
$nnn = "+91";
$department = [];
$course = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function clean($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $roll_no = clean($_POST['roll_no']);
    $first_name = clean($_POST['first_name']);
    $last_name = clean($_POST['last_name']);
    $father_name = clean($_POST['father_name']);
    $dob_m = $_POST['dob_m'];
    $dob_d = $_POST['dob_d'];
    $dob_y = $_POST['dob_y'];
    $mobile = clean($_POST['mobile']);
    $email = clean($_POST['email']);
    $password = clean($_POST['password']);
    $gender = $_POST['gender'] ?? '';
    $department = $_POST['department'] ?? [];
    $course = $_POST['course'];
    $city = clean($_POST['city']);
    $address = clean($_POST['address']);

    if (empty($roll_no)) $errors[] = "Roll number is required.";
    if (empty($first_name) || empty($last_name)) $errors[] = "Full name is required.";
    if (empty($father_name)) $errors[] = "Father's name is required.";
    if (empty($dob_d) || empty($dob_m) || empty($dob_y)) {
        $errors[] = "Date of birth is required.";
    } elseif (!checkdate((int)$dob_m, (int)$dob_d, (int)$dob_y)) {
        $errors[] = "Invalid date of birth.";
    }
    if (!preg_match("/^[0-9]{10}$/", $mobile)) $errors[] = "Valid mobile number is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if (empty($gender)) $errors[] = "Gender is required.";
    if (empty($department)) $errors[] = "Select at least one department.";
    if (empty($course)) $errors[] = "Select a course.";
    if (empty($city)) $errors[] = "City is required.";
    if (empty($address)) $errors[] = "Address is required.";

    if (!empty($_FILES['photo']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir);
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $errors[] = "Error uploading photo.";
        }
    }

    if (count($errors) === 0) {
        $success = "Registration successful! Welcome, $first_name $last_name.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Registration Form</title>
  <style>
    body {
      background-color: #fdd;
      font-family: "Times New Roman", Times, serif;
    }

    h1 {
      text-align: center;
      font-weight: bold;
    }

    form {
      width: 500px;
      margin: 20px auto;
      padding: 20px;
      border-radius: 10px;
    }

    table {
      width: 100%;
    }

    td {
      padding: 8px;
    }

    td:first-child {
      width: 30%;
    }

    input, select, textarea {
      width: 90%;
    }

    .error {
      color: red;
      font-size: 14px;
    }

    .success {
      color: green;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
    }

    button {
      margin: 10px auto;
      display: block;
    }

  </style>
</head>
<body>
  <h1>Student Registration Form</h1>

  <?php if (!empty($errors)): ?>
    <div class="error">
      <ul>
        <?php foreach ($errors as $error) echo "<li>$error</li>"; ?>
      </ul>
    </div>
  <?php endif; ?>

  <?php if (!empty($success)): ?>
    <div class="success"><?php echo $success; ?></div>
  <?php endif; ?>

  <form action="" method="POST" enctype="multipart/form-data">
    <table>
      <tr>
        <td>Roll No:</td>
        <td><input type="text" name="roll_no" value="<?php echo $roll_no; ?>"></td>
      </tr>
      <tr>
        <td>Student Name:</td>
        <td>
          <input type="text" name="first_name" placeholder="First Name" style = "width: 42%" value="<?php echo $first_name; ?>"> -
          <input type="text" name="last_name" placeholder="Last Name" style = "width: 42%" value="<?php echo $last_name; ?>">
        </td>
      </tr>
      <tr>
        <td>Father's Name:</td>
        <td><input type="text" name="father_name" value="<?php echo $father_name; ?>"></td>
      </tr>
      <tr>
        <td>Date of Birth:</td>
        <td><input type="text" name="dob_d" style="width: 12%" placeholder="Day" value="<?php echo $dob_d; ?>"> -
        <input type="text" name="dob_m" style="width: 15%" placeholder="Month" value="<?php echo $dob_m; ?>"> -
        <input type="text" name="dob_y" style="width: 20%" placeholder="Year" value="<?php echo $dob_y; ?>">
      (DD-MM-YYYY)</td>
      </tr>
      <tr>
        <td>Mobile No:</td>
        <td>
        <input type="text" name="" style="width: 9%" value="<?php echo $nnn; ?>"> -
        <input type="text" name="mobile" style="width: 75%" value="<?php echo $mobile; ?>"></td>
      </tr>
      <tr>
        <td>Email Id:</td>
        <td><input type="email" name="email" value="<?php echo $email; ?>"></td>
      </tr>
      <tr>
        <td>Password:</td>
        <td><input type="password" name="password"></td>
      </tr>
      <tr>
        <td>Gender:</td>
        <td>
          <input type="radio" name="gender" value="Male" style = "width: 5%" <?php if($gender=="Male") echo "checked"; ?>> Male
          <input type="radio" name="gender" value="Female" style = "width: 5%" <?php if($gender=="Female") echo "checked"; ?>> Female
        </td>
      </tr>
      <tr>
        <td>Department:</td>
        <td>
          <?php
          $departments = ["CSE","IT","ECE","Civil","Mech"];
          foreach ($departments as $dep) {
              $checked = in_array($dep, $department) ? "checked" : "";
              echo "<input type='checkbox' style = 'width: 5%' name='department[]' value='$dep' $checked> $dep ";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td>Course:</td>
        <td>
          <select name="course">
            <option value="">-------- Select Current Course --------</option>
            <option value="B.Tech" <?php if($course=="B.Tech") echo "selected"; ?>>B.Tech</option>
            <option value="M.Tech" <?php if($course=="M.Tech") echo "selected"; ?>>M.Tech</option>
            <option value="Diploma" <?php if($course=="Diploma") echo "selected"; ?>>Diploma</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Student Photo:</td>
        <td><input type="file" name="photo"></td>
      </tr>
      <tr>
        <td>City:</td>
        <td><input type="text" name="city" value="<?php echo $city; ?>"></td>
      </tr>
      <tr>
        <td>Address:</td>
        <td><textarea name="address"><?php echo $address; ?></textarea></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center;">
          <button type="submit">Register</button>
        </td>
      </tr>
    </table>
  </form>
</body>
</html>
