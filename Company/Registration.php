<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <style>
body {
      width: 70%;
      margin: 10px auto;
    }
 .container {
      border: 3px solid #000000;
      background: #fff;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 3px solid #000000;
      padding: 10px 20px;
    }

    .logo {
      font-size: 20px;
      font-weight: bold;
    }

    .x-logo {
      color: green;
      font-size: 24px;
    }

    nav a {
      margin: 0 5px;
    }
    footer {
      text-align: center;
      border-top: 3px solid #000000;
      margin-top: 20px;
      font-size: 14px;
    }

fieldset {
  margin: 20px auto;
  padding: 20px;
  width: 40%;
  border: 1.5px solid #000000ff;
}
input[type=text],
input[type=password],
input[type=email]
{
  width: 220px;
}
legend {
  font-size: 18px;
  font-weight: bold;
}

label {
  display: inline-block;
  width: 150px;
}
  </style>
</head>
<body>
  <div class="container">
    <header>
      <div class="logo">
        <span class="x-logo">X</span>Company
      </div>
      <nav>
        <a href="./Publice_Home.php">Home</a> |
        <a href="./Login.php">Login</a> |
        <a href="./Registration.php">Registration</a>
      </nav>
    </header>

    <main>
      <fieldset>
        <legend><b>REGISTRATION</b></legend>
        <form action="#" method="post">
          <label for="name">Name :</label>
          <input type="text" id="name" name="name"> <br> <hr>

          <label for="email">Email :</label>
          <input type="email" id="email" name="email"><br><hr>

          <label for="username">User Name :</label>
          <input type="text" id="username" name="username"><br><hr>

          <label for="password">Password :</label>
          <input type="password" id="password" name="password"><br><hr>

          <label for="confirmpassword">Confirm Password :</label>
          <input type="password" id="confirmpassword" name="confirmpassword"><br><hr>

          <label>Gender :</label>
          <input type="radio" name="gender" value="Male"> Male
          <input type="radio" name="gender" value="Female"> Female
          <input type="radio" name="gender" value="Other"> Other
          <br><br>

          <label for="dob">Date of Birth :</label>
          <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy">
          <br><br>

          <input type="submit" value="Submit">
          <input type="reset" value="Reset">
        </form>
      </fieldset>
    </main>

    <footer>
      <p>Copyright © 2017</p>
    </footer>
  </div>
</body>
</html>
