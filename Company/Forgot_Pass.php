<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Public Home</title>
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

    main {
      height: 40vh;
    }

    footer {
      text-align: center;
      border-top: 3px solid #000000;
      margin-top: 20px;
      font-size: 14px;
    }

    fieldset{
        width: 40%;
        margin: 50px auto;
        border: 1.5px solid black;
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
        <legend> <b>Forgot Password </b> </legend>
      <form action="" method="post">
        <br>

        Enter Email : 
        <input type="email" name="" id=""> <br> <br>
<hr>
        <input type="button" value="Submit"> 
      </form>
      </fieldset>
    </main>

    <footer>
      <p>Copyright © 2017</p>
    </footer>
  </div>
</body>

</html>