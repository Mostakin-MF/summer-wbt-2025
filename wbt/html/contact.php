<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <link rel="stylesheet" href="../css/contact.css" />
  <style>
    .error { 
      color: #FF0000; 
      font-size: 14px; 
      display: block;
      margin-top: 5px;
    }
    .success { 
      color: #008000; 
      font-size: 16px; 
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
      padding: 10px;
      border-radius: 5px;
      margin: 20px 0;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .required {
      color: #FF0000;
    }
    main {
    width: 80%;
    margin: 0 auto;
    background-color: #eef;
    padding: 20px;
    border-radius: 5px;
}

.contact-form {
    background: #eef;
    margin: 40px;
    border-radius: 5px;
    text-align: center;
    width: 70%;
    padding-left: 170px;
}

.form-group {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    padding: 0 180px 0 60px;
}

.form-group label {
    text-align: right;
    font-weight: bold;
    padding-right: 20px;
}

.form-group input,
.form-group select,
.form-group textarea {
    flex: 1;
    padding: 5px 10px;
    border: 1px solid #095806;
    border-radius: 5px;
}

.contact-form h1,
.contact-form h3 {
    text-align: left;
    margin-bottom: 15px;
    color: #095806;
}

.contact-form input[type="text"],
.contact-form input[type="email"] {
    width: 700px;
    padding: 8px;
    margin-top: 5px;
    border: 2px solid #1b1818;
    border-radius: 3px;
}

.contact-form .btn-group {
    text-align: center;
    margin-top: 20px;
}

.contact-form input[type="submit"],
.contact-form input[type="reset"] {
    padding: 8px 16px;
    margin: 0 5px;
    border: none;
    font-weight: bold;
    background: #215625;
    color: #fff;
    border-radius: 3px;
    cursor: pointer;
}
  </style>
</head>
<body>

<?php

session_start(); // ✅ Required for CSRF token

// Initialize variables
$fnameErr = $lnameErr = $emailErr = $fieldErr = $titleErr = "";
$fname = $lname = $email = $field = $title = "";
$skills = [];
$isValid = false;
$successMessage = "";

// Generate CSRF token if not exists
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Validation rules
$validation_rules = [
    'fname' => ['required' => true, 'min_length' => 2, 'max_length' => 50],
    'lname' => ['required' => true, 'min_length' => 2, 'max_length' => 50],
    'email' => ['required' => true, 'max_length' => 100],
    'field' => ['required' => true],
    'title' => ['required' => false, 'max_length' => 200],
];

// Allowed values
$allowed_fields = ['Data Science', 'Machine Learning', 'Language Processing'];
$allowed_skills = ['Python', 'C#', 'Java', 'SQL', 'R'];

// Run validation only on POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // CSRF Protection
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed. Please refresh the page and try again.");
    }
    
    // Validate First Name
    if (empty($_POST["fname"])) {
        $fnameErr = "First name is required";
    } else {
        $fname = sanitize_input($_POST["fname"]);
        if (!validate_name($fname)) {
            $fnameErr = "Only letters, spaces, hyphens and apostrophes allowed";
        } elseif (strlen($fname) < $validation_rules['fname']['min_length']) {
            $fnameErr = "First name must be at least " . $validation_rules['fname']['min_length'] . " characters";
        } elseif (strlen($fname) > $validation_rules['fname']['max_length']) {
            $fnameErr = "First name must not exceed " . $validation_rules['fname']['max_length'] . " characters";
        }
    }

    // Validate Last Name
    if (empty($_POST["lname"])) {
        $lnameErr = "Last name is required";
    } else {
        $lname = sanitize_input($_POST["lname"]);
        if (!validate_name($lname)) {
            $lnameErr = "Only letters, spaces, hyphens and apostrophes allowed";
        } elseif (strlen($lname) < $validation_rules['lname']['min_length']) {
            $lnameErr = "Last name must be at least " . $validation_rules['lname']['min_length'] . " characters";
        } elseif (strlen($lname) > $validation_rules['lname']['max_length']) {
            $lnameErr = "Last name must not exceed " . $validation_rules['lname']['max_length'] . " characters";
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } elseif (strlen($email) > $validation_rules['email']['max_length']) {
            $emailErr = "Email must not exceed " . $validation_rules['email']['max_length'] . " characters";
        }
    }

    // Validate Field of Interest
    if (empty($_POST["field"])) {
        $fieldErr = "Please select a field of interest";
    } else {
        $field = sanitize_input($_POST["field"]);
        if (!in_array($field, $allowed_fields)) {
            $fieldErr = "Invalid field selection";
        }
    }

    // Validate Project Title (Optional)
    if (!empty($_POST["title"])) {
        $title = sanitize_input($_POST["title"]);
        if (strlen($title) > $validation_rules['title']['max_length']) {
            $titleErr = "Project title must not exceed " . $validation_rules['title']['max_length'] . " characters";
        }
    }

    // Validate Skills (Optional)
    if (!empty($_POST["skill"]) && is_array($_POST["skill"])) {
        $skills = array_map('sanitize_input', $_POST["skill"]);
        // Validate each skill against allowed values
        foreach ($skills as $skill) {
            if (!in_array($skill, $allowed_skills)) {
                // Remove invalid skills
                $skills = array_intersect($skills, $allowed_skills);
                break;
            }
        }
        // Limit number of skills
        if (count($skills) > 5) {
            $skills = array_slice($skills, 0, 5);
        }
    }

    // Check if form is valid
    if (empty($fnameErr) && empty($lnameErr) && empty($emailErr) && empty($fieldErr) && empty($titleErr)) {
        $isValid = true;
        
        // Here you would typically:
        // 1. Save to database
        // 2. Send email notification
        // 3. Log the submission
        
        $successMessage = "Thank you! Your form has been submitted successfully. We will contact you soon.";
        
        // Optional: Clear form data after successful submission
        // Uncomment the lines below if you want to clear the form
        // $fname = $lname = $email = $field = $title = "";
        // $skills = [];
        
        // Regenerate CSRF token for security
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

// Sanitization function
function sanitize_input($data) {
    if (is_array($data)) {
        return array_map('sanitize_input', $data);
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Name validation function
function validate_name($name) {
    return preg_match("/^[a-zA-Z\s\-']+$/u", $name);
}

// Function to check if field should be marked as required
function is_required($field) {
    global $validation_rules;
    return isset($validation_rules[$field]) && $validation_rules[$field]['required'];
}
?>

<header>
  <div class="nav-container">
    <a href="../index.html" class="logo">MOSTAKIN</a>
    <nav class="nav-links">
      <a href="../html/education.html">Education</a>
      <a href="../html/experience.html">Experience</a>
      <a href="../html/project.html">Projects</a>
      <a href="../html/contact.php">Contact Me</a>
    </nav>
  </div>
</header>

<main>
  <h1>Contact me:</h1>
  <h3>
    If you are interested in working on a project with me, feel free to contact
    me by submitting this form.
  </h3>

  <?php if ($successMessage): ?>
    <div class="success"><?php echo $successMessage; ?></div>
  <?php endif; ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >  
    <!-- CSRF Token -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    
    <div class="form-group">
      <label for="fname">First name: <span class="required">*</span></label>
      <input type="text" 
             id="fname" 
             name="fname" 
             maxlength="<?php echo $validation_rules['fname']['max_length']; ?>"
             value="<?php echo htmlspecialchars($fname); ?>" 
              />
      <?php if ($fnameErr): ?>
        <span class="error"><?php echo $fnameErr; ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="lname">Last name: <span class="required">*</span></label>
      <input type="text" 
             id="lname" 
             name="lname" 
             maxlength="<?php echo $validation_rules['lname']['max_length']; ?>"
             value="<?php echo htmlspecialchars($lname); ?>" 
              />
      <?php if ($lnameErr): ?>
        <span class="error"><?php echo $lnameErr; ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="email">Email: <span class="required">*</span></label>
      <input type="email" 
             id="email" 
             name="email" 
             maxlength="<?php echo $validation_rules['email']['max_length']; ?>"
             value="<?php echo htmlspecialchars($email); ?>" 
              />
      <?php if ($emailErr): ?>
        <span class="error"><?php echo $emailErr; ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label>Field Of Interest: <span class="required">*</span></label>
      <?php foreach ($allowed_fields as $fieldOption): ?>
        <label>
          <input type="radio" 
                 name="field" 
                 value="<?php echo htmlspecialchars($fieldOption); ?>" 
                 <?php if ($field === $fieldOption) echo "checked"; ?>
                 > 
          <?php echo htmlspecialchars($fieldOption); ?>
        </label>
      <?php endforeach; ?>
      <?php if ($fieldErr): ?>
        <span class="error"><?php echo $fieldErr; ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="title">Proposed Title For the Project:</label>
      <input type="text" 
             id="title" 
             name="title" 
             maxlength="<?php echo $validation_rules['title']['max_length']; ?>"
             value="<?php echo htmlspecialchars($title); ?>" />
      <?php if ($titleErr): ?>
        <span class="error"><?php echo $titleErr; ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label>Required Skills:</label>
      <?php foreach ($allowed_skills as $skillOption): ?>
        <label>
          <input type="checkbox" 
                 name="skill[]" 
                 value="<?php echo htmlspecialchars($skillOption); ?>" 
                 <?php if (in_array($skillOption, $skills)) echo "checked"; ?>> 
          <?php echo htmlspecialchars($skillOption); ?>
        </label>
      <?php endforeach; ?>
    </div>

    <div class="btn-group">
      <input type="submit" value="Submit" />
      <input type="reset" value="Reset" onclick="return confirm('Are you sure you want to reset all fields?');" />
    </div>
  </form>

  <?php if ($isValid && $_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-top: 20px;">
      <h2>Your Submitted Data:</h2>
      <p><strong>Name:</strong> <?php echo htmlspecialchars($fname . " " . $lname); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
      <p><strong>Field:</strong> <?php echo htmlspecialchars($field); ?></p>
      <?php if ($title): ?>
        <p><strong>Project Title:</strong> <?php echo htmlspecialchars($title); ?></p>
      <?php endif; ?>
      <?php if (!empty($skills)): ?>
        <p><strong>Skills:</strong> <?php echo htmlspecialchars(implode(", ", $skills)); ?></p>
      <?php endif; ?>
      <p><em>Submission Time:</em> <?php echo date('Y-m-d H:i:s'); ?></p>
    </div>
  <?php endif; ?>
</main>

<footer>
  <div class="footer-left">
    <p>© 2025 Md. Mostakin Ali</p>
    <p>Computer Science Graduate | AIUB</p>
  </div>
  <div class="footer-right">
    <p class="footer-connect">Stay Connected with me.</p>
    <div class="footer-icons">
      <a href="#"><img src="../image/fb.png" alt="Facebook" /></a>
      <a href="#"><img src="../image/rg.png" alt="ResearchGate" /></a>
      <a href="#"><img src="../image/lkdn.jpg" alt="LinkedIn" /></a>
      <a href="#"><img src="../image/gt.png" alt="GitHub" /></a>
      <a href="#"><img src="../image/gmail.webp" alt="Gmail" /></a>
    </div>
  </div>
</footer>

</body>
</html>