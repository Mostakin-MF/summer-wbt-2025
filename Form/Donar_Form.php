<?php
$f_name = $l_name = $company = $address_1 = $address_2 = $city ="";
$state = $country = $email = $gender = $zip_c = $amount = $phone = "";
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["f_name"]) || empty($_POST["l_name"])) {
        $errors[] = "First and Last name are required.";
    } else {
        $f_name = test_input($_POST["f_name"]);
        $l_name = test_input($_POST["l_name"]);
    }

    if (empty($_POST["address_1"])) {
        $errors[] = "Address 1 is required.";
    } else {
        $address_1 = test_input($_POST["address_1"]);
    }

    if (empty($_POST["city"])) {
        $errors[] = "City is required.";
    } else {
        $city = test_input($_POST["city"]);
    }

    if (empty($_POST["zip_c"])) {
        $errors[] = "Zip Code is required.";
    } elseif (!preg_match("/^[0-9]{4}$/", $_POST["zip_c"])) {
        $errors[] = "Zip Code must be exactly 4 digits.";
    } else {
        $zip_c = test_input($_POST["zip_c"]);
    }

    if (empty($_POST["state"])) {
        $errors[] = "State is required.";
    } else {
        $state = test_input($_POST["state"]);
    }

    if (empty($_POST["country"])) {
        $errors[] = "Country is required.";
    } else {
        $country = test_input($_POST["country"]);
    }

    if (empty($_POST["email"])) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["amount"])) {
        $errors[] = "Amount is required.";
    } else {
        $amount = test_input($_POST["amount"]);
    }
    if($amount == "Other"){
      if(empty($_POST["Other_amount"])){
          $errors[] = "Please the Other Amount.";
      } else {
        $amount = test_input($_POST["Other_amount"]);
      }
    }

    if (!empty($_POST["phone"])) {
      if (!preg_match("/^[0-9]{11}$/", $_POST["phone"])) {
          $errors[] = "Phone number must contain only digits and be 11 characters long.";
      } else {
          $phone = test_input($_POST["phone"]);
      }
    }

    $company = !empty($_POST["company"]) ? test_input($_POST["company"]) : "";
    $address_2 = !empty($_POST["address_2"]) ? test_input($_POST["address_2"]) : "";

    if (empty($errors)) {
        $success = "Form submitted successfully!";
    }
}

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Class Task Form</title>
    <link rel="stylesheet" href="./css/style.css" />
    <style>
      .error {
      color: red;
      }

      .success {
        color: green;
      }

</style>
  </head>

  <body>


  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <p><span class="red_star">*</span> - Denotes Required Infromation</p>
      <p><strong> > 1 Donation </strong> > 2 Confirmation > Thank You!</p>

      <h2>Donar Infromation</h2>

      <?php if (!empty($errors)): ?>
  <div class="error">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?php echo $error; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>


      <div class="form-group">
        <label for="">First name<span class="red_star">*</span></label>
        <input type="text" name="f_name" value="<?php echo $f_name;?>"/>
      </div>

      <div class="form-group">
        <label for="">Last Name<span class="red_star">*</span> </label>
        <input type="text" name="l_name" value="<?php echo $l_name;?>"/>
      </div>

      <div class="form-group">
        <label for="">Company </label>
        <input type="text" name="comapany" value="<?php echo $company;?>"/>
      </div>

      <div class="form-group">
        <label for="">Address 1<span class="red_star">*</span> </label>
        <input type="text" name="address_1" value="<?php echo $address_1;?>"/>
      </div>

      <div class="form-group">
        <label for="">Address 2 </label>
        <input type="text" name="address_2" value="<?php echo $address_2;?>"/>
      </div>

      <div class="form-group">
        <label for="">City<span class="red_star">*</span> </label>
        <input type="text" name="city" value="<?php echo $city;?>"/>
      </div>

      <div class="form-group">
        <label for="">State<span class="red_star">*</span> </label>
        <select name="state">
  <option value="">Select a State</option>
  <option value="Dhaka" <?php if($state=="Dhaka") echo "selected"; ?>>Dhaka</option>
  <option value="Rajshahi" <?php if($state=="Rajshahi") echo "selected"; ?>>Rajshahi</option>
      </select>
      </div>

      <div class="form-group">
        <label for="">Zip Code<span class="red_star">*</span> </label>
        <input type="text" name="zip_c" value="<?php echo $zip_c;?>"/>
      </div>
      <div class="form-group">
        <label for="">Country<span class="red_star">*</span> </label>
        <select name="country">
  <option value="">Select a Country</option>
  <option value="Bangladesh" <?php if($country=="Bangladesh") echo "selected"; ?>>Bangladesh</option>
  <option value="India" <?php if($country=="India") echo "selected"; ?>>India</option>
  <option value="Nepal" <?php if($country=="Nepal") echo "selected"; ?>>Nepal</option>
  <option value="Myanmar" <?php if($country=="Myanmar") echo "selected"; ?>>Myanmar</option>
        </select>

      </div>
      <div class="form-group">
        <label for="">Phone </label>
        <input type="number" name="phone" id="" value="<?php echo $phone;?>"/>
      </div>
      <div class="form-group">
        <label for="">Fax </label>
        <input type="" name="Fax"/>
      </div>
      <div class="form-group">
        <label for="">Eamil<span class="red_star">*</span> </label>
        <input type="email" name="email" id="" value="<?php echo $email;?>"/>
      </div>
      <div class="form-group" id="don-am">
        <label for="">Donation Ammount<span class="red_star">*</span>
           Check a button or type in your amount 
        </label>
        <input type="radio" name="amount" value="None"/>None
        <input type="radio" name="amount" value="50"/>$50
        <input type="radio" name="amount" value="75"/>$75
        <input type="radio" name="amount" value="100"/>$100
        <input type="radio" name="amount" value="250"/>$250
        <input type="radio" name="amount" value="Other"/>Other
      </div>
      <div class="form-group">
        <label>Other Amount $</label>
        <input type="text" name="Other_amount" value="<?php echo $amount;?>"/>
      </div>
      <div class="form-group">
        <label for="">Recuring Donation </label>
        <input type="checkbox" style="width: 30px" /> I am interested in giving
        on a regular basis.
      </div>

      <div class="form-group">
        <label>Monthly Credit Card $</label>
        <input type="text" style="width: 50px" />
         - For -   
        <input type="text" style="width: 50px" /> - Months
      </div>

      <h2>Honorarium and Memorial Donation Infromation</h2>
      <div class="form-group">
        <label for="">I would like to make this donation</label>
        <input type="radio" name="honor" style="width: 50px" /> To Honor <br />
        <input type="radio" name="honor" style="width: 50px" /> In Memory of
      </div>
      <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="hon_name"/>
      </div>
      <div class="form-group">
        <label for="">Acknowledge Donation to </label>
        <input type="text" name="acknowledge"/>
      </div>
      <div class="form-group">
        <label for="">Address</label>
        <input type="text" name="hon_address"/>
      </div>
      <div class="form-group">
        <label for="">City</label>
        <input type="text" name="hon_city"/>
      </div>
      <div class="form-group">
        <label for="">State</label>
        <select name="hon_state">
          <option>Select a State</option>
          <option value="Dhaka" name="hon_state" >Dhaka</option>
          <option value="Rajshahi" name="hon_state" >Rajshahi</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Zip</label>
        <input type="text" name="hon_zip"/>
      </div>

      <h2>Additional Information</h2>
      <p>
        Please enter your name, company or organization as you would like it to
        appear in our publication:
      </p>

      <div class="form-group">
        <label>Name</label>
        <input type="text" name="add_address"/>
      </div>

      <input type="checkbox" name="gift_option"/> I would like my gift to remain anonymous. <br />
      <input type="checkbox" name="gift_option"/> My employer offers a matching gift program. I
      will mail the matching gift form. <br />
      <input type="checkbox" name="gift_option"/> Please save the cost of acknowledging this gift
      by not mailing a thank you letter. <br /><br />

      <div class="form-group">
        <label>Comments</label>
        <textarea name="comment"
          placeholder="Please type any questions or feedback here"
        ></textarea>
      </div>

      <div class="form-group">
        <label>How may we contact you?</label>
        <div class="small">
          <input type="checkbox" name="contact" /> E-mail <br />
          <input type="checkbox" name="contact" /> Postal Mail <br />
          <input type="checkbox" name="contact" /> Telephone <br />
          <input type="checkbox" name="contact" /> Fax
        </div>
      </div>

      <div class="form-group">
        <label>I would like to receive newsletters and event info by:</label>
        <div class="small">
          <input type="checkbox" name="news"/> E-mail <br />
          <input type="checkbox" name="news"/> Postal Mail
        </div>
      </div>
      <input type="checkbox" name="confirm"/> I would like information about volunteering.
      <br />
      <br />
      <div class="form-group">
        <button type="reset">Reset</button><br />
        <button type="submit">Continue</button>
      </div>
      <p>
        Donate online with confidence. You are on a secure server. <br />
        If you have any problems or questions, please contact support.
      </p>
    </form>
  </body>
</html>
