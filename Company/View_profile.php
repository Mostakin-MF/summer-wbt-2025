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

    header nav a {
      margin: 0 5px;
    }

    main {
      display: flex;
    }

    nav.main {
      width: 20%;
      padding: 20px;
      border-right: 3px solid black;
    }

    nav.main ul {
      padding-left: 10px 0px;
    }

    article {
      flex: 1;
      padding: 20px;
    }

    footer {
      text-align: center;
      border-top: 3px solid #000000;
      margin-top: 20px;
      font-size: 14px;
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
        Loggid in as 
        <a href="">Bob</a> |
        <a href="">Log Out</a>
      </nav>
    </header>

    <main>
      <nav class="main">
        Account:
        <hr>
        <ul>
          <li><a href="#">Dashboard</a></li>
          <li><a href="#">View Profile</a></li>
          <li><a href="#">Edit Profile</a></li>
          <li><a href="#">Change Profile Picture</a></li>
          <li><a href="#">Change Password</a></li>
          <li><a href="#">Log Out</a></li>

        </ul>
      </nav>

      <article>
        <fieldset>
        <legend><b>Profile</b></legend>
          <label for="name">Name :    Bob</label> <br> <hr>

          <label for="email">Email :   bob@email.com</label> <br><hr>

          <label>Gender :  Male</label>
          <br><hr>

          <label for="dob">Date of Birth : 22/07/2000</label>
          <br><hr>
          <a href=""> Edit Profile</a>
      </fieldset>
    </article>
    </main>

    <footer>
      <p>Copyright © <span id="year"></span></p>
    </footer>
  </div>

  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>
