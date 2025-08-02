<?php
session_start();
$currentPage = "dashboard";
include "HeaderFile.php";
include "Header2.php";
?>


<html>
<head>
  <meta charset="UTF-8">
  <title>TailorEase Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
  <style>
 html, body {
  height: 100%;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
}

body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(to right, #fdfbfb, #ebedee);
  flex: 1;
}

header {
  background: linear-gradient(to right, #34495e, #2c3e50);
  color: white;
  padding: 30px;
  text-align: center;
  font-size: 1.8rem;
  flex-shrink: 0; /* prevent shrinking */
}

.dashboard {
  flex: 1 0 auto;  /* grow and fill space */
  padding: 40px 20px;
  max-width: 1200px;
  margin: auto;
  width: 100%;
  box-sizing: border-box;
}

.welcome {
  text-align: center;
  margin-bottom: 50px;
}

.features {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 30px;
}

.card {
  background: white;
  width: 250px;
  padding: 25px;
  border-radius: 15px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
  text-align: center;
  transition: transform 0.3s;
}

.card:hover {
  transform: translateY(-5px);
}

.card h3 {
  margin-top: 15px;
  color: #2c3e50;
}

.card p {
  font-size: 0.95rem;
  color: #555;
}

.icon {
  font-size: 50px;
  color: #3498db;
  display: inline-block;
  margin: 10px; /* Optional spacing */
}

.icon button {
  /* Size & Shape */
  width: 60px;
  height: 60px;
  border-radius: 50%;

  /* Icon & Text */
  font-size: 30px;
  font-weight: bold;
  line-height: 1;

  /* Colors */
  background: #4361ee;
  color: white;

  /* Borders & Effects */
  border: none;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

  /* Cursor & Interaction */
  cursor: pointer;
  transition: all 0.3s ease;

  /* Centering (optional) */
  display: flex;
  justify-content: center;
  align-items: center;
}

.icon button:hover {
  background: #3a56d4;
  transform: scale(1.05);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* ✅ Fixed Footer */
footer {
  text-align: center;
  padding: 20px;
  background: #2c3e50;
  color: white;
  font-size: 14px;
  width: 100%;
  flex-shrink: 0; /* Ensures it stays visible at bottom */
}
  </style>
</head>
<body>

  <header>
    TailorEase Tailor Dashboard
  </header>

  <div class="dashboard">
    <div class="welcome">
      <h2>Welcome,<?php echo $_SESSION['user_data']['FullName']; ?>!</h2>
      <p>Manage your customer measurements with ease.</p>
    </div>

    <div class="features">
      <div class="card">
        <div class="icon"><button onclick="goTo('NewMeasurement')">➕</button></div>
        <h3>Add Measurements</h3>
        <p>Enter new customer size details for tailoring orders.</p>
      </div>

      <div class="card">
        <div class="icon"><button onclick="goTo('Update')">✏️</button></div>
        <h3>Edit Measurements</h3>
        <p>Modify customer data whenever updates are needed.</p>
      </div>

      <div class="card">
        <div class="icon"><button onclick="goTo('DeleteCustomer')">❌</button></div>
        <h3>Delete Measurements</h3>
        <p>Remove incorrect or outdated customer records.</p>
      </div>

      <div class="card">
        <div class="icon"><button onclick="goTo('SearchCustomer')">🔍</button></div>
        <h3>Search Measurements</h3>
        <p>Quickly find specific customers using name or ID.</p>
      </div>

      <div class="card">
        <div class="icon"><button onclick="goTo('ViewCustomers')">👤</button></div>
        <h3>Display Customers</h3>
        <p>View all customer records and their measurements.</p>
      </div>
    </div>

  <footer>
    &copy; 2025 TailorEase. All rights reserved.
  </footer>

  <script>
    function goTo(page) {
      switch (page) {
      case 'home':
        window.location.href = "Home.php";
        break;
      case 'NewMeasurement':
        window.location.href = 'NewMeasurement.php';
        break;
      
      case 'Update':
        window.location.href = "Update.php";
        break;

      case 'DeleteCustomer':
        window.location.href = "DeleteCustomer.php";
        break;
      
      case 'SearchCustomer':
        window.location.href = "SearchCustomer.php";
        break;

      case 'signup':
        window.location.href = "SignUP.php";
        break;
      
      case 'ViewCustomers':
        window.location.href = "DisplayCustomers.php";
        break;
      
      case 'contactUs':
        window.location.href = "contactUs.php";
        break;

    }
    }  
  </script>

</body>
</html>
