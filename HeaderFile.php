<html>
    <head>
        <title>TailorEase</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #e0eafc, #cfdef3);
      color:rgba(64, 80, 44, 0.79);
    }

    header {
      background: linear-gradient(to right, #34495e, #2c3e50);
      color: white;
      text-align: center;
      padding: 40px 20px;
      box-shadow: 0 4px 10px rgba(8, 161, 16, 0.27);
    }

    header h1 {
      font-size: 2.8rem;
      margin-bottom: 10px;
    }

    header p {
      font-size: 1.2rem;
    }

    nav {
      display: flex;
      justify-content: center;
      background:rgba(26, 188, 66, 0.73);
      padding: 15px 0;
      box-shadow: 0 2px 6px rgba(170, 89, 13, 0.1);
    }

    nav button {
      background: white;
      color:rgb(26, 188, 48);
      border: none;
      padding: 10px 20px;
      margin: 0 15px;
      border-radius: 30px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
      font-size: 16px;
    }

    nav button:hover {
      background:rgb(43, 22, 160);  
      color: white;
      transform: scale(1.05);
    }

    .hero {
      text-align: center;
      padding: 50px 20px;
    }

    .hero h2 {
      font-size: 2rem;
      margin-bottom: 30px;
    }

    .gallery {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .gallery img {
      width: 250px;
      height: 250px;
      object-fit: cover;
      border-radius: 20px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s;
    }

    .gallery img:hover {
      transform: scale(1.05);
    }

    footer {
      text-align: center;
      padding: 20px;
      background: #2c3e50;
      color: white;
      font-size: 14px;
      margin-top: 40px;
    }

    @media (max-width: 720x1612px) {
      .gallery img {
        width: 90%;
        height: auto;
      }

      nav {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>
    </head>
    <body>

  <header>
    <h1>TailorEase</h1>
    <p>Your Personal Tailoring Companion</p>
  </header>

  <nav>
  <button onclick="goTo('home')">Home</button>

  <?php if (isset($_SESSION["User_logged_in"]) && $_SESSION["User_logged_in"] === "Yes" && (!isset($currentPage) || $currentPage !== "dashboard")): ?>
  <button onclick="goTo('dashboard')">Dashboard</button>
  <button onclick="goTo('contact')">Contact Us</button>
<?php elseif (!isset($_SESSION["User_logged_in"]) || $_SESSION["User_logged_in"] !== "Yes"): ?>
  <button onclick="goTo('signin')">Sign In</button>
  <button onclick="goTo('contact')">Contact Us</button>
<?php endif; ?>


  <button onclick="goTo('signup')">Sign Up</button>
  <!-- <button onclick="goTo('contact')">Contact Us</button> -->

  <?php
     if (isset($_SESSION["User_logged_in"]) && $_SESSION["User_logged_in"] === "Yes" && isset($currentPage) && $currentPage === "dashboard"):
  ?>
    <form action="Sign_out.php" method="post" style="display: inline;">
        <button type="submit" style="background: crimson; color: white; border: none; padding: 10px 20px; border-radius: 30px; cursor: pointer;">
            Sign Out
        </button>
    </form>
<?php endif; ?>

    <?php
     if (!isset($currentPage) && $currentPage != "contactUs"):
    ?>
       <button onclick="goTo('contact')">Contact Us</button>
  <?php endif; ?>
    
    <?php
        if (!isset($currentPage) && $currentPage == "contactUs"):
    ?>
      <button onclick="goTo('signup')">Sign Up</button> 
  <?php endif; ?>
  </nav>


   <script>
       function goTo(page) {
           switch (page) {
              case 'home':
                window.location.href = "Home.php";
                break;
              case 'signin':
                window.location.href = "SignIn.php";
                break;
              case 'signup':
                window.location.href = "SignUp.php";
                break;
              case 'dashboard':
                window.location.href = "dashBoard.php";
                break;
              case 'contact':
                alert("Contact us at: tailorease@example.com");
                break;
            }
          }
</script>

</body>
</html>
