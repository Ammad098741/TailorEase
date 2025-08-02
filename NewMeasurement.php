<?php
        session_start();
        $currentPage = "NewMeasurement";
        include 'HeaderFile.php';
         
?>
<head>
  <meta charset="UTF-8">
  <title>Add New Customers</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #e3ebfd;
      margin: 0;
      /* padding: 40px 20px; */
      color: #333;
    }

    .form-header {
  text-align: center;
  margin-bottom: 30px;
  background-color:rgb(7, 143, 7);
  padding: 16px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.form-header p {
  margin: 0;
  font-size: 24px;
  font-weight: bold;
  color: white;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  letter-spacing: 0.5px;
}


    form {
      background-color: #fff;
      max-width: 750px;
      margin: auto;
      padding: 30px 40px;
      border-radius: 16px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #333;
      font-size: 15px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    select {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      background-color: #f9f9f9;
      transition: all 0.3s;
      box-sizing: border-box;
    }

    input:focus, select:focus {
      border-color:rgb(10, 235, 21);
      background-color: #fff;
      outline: none;
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .radio-group {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .radio-option {
      display: flex;
      align-items: center;
      font-weight: 500;
      color: #444;
    }

    .radio-option input[type="radio"] {
      margin-right: 6px;
      accent-color:rgb(48, 245, 74);
    }

    input[type="submit"] {
      background-color:rgba(29, 243, 22, 0.99);
      color: white;
      padding: 12px 0;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      width: 100%;
      transition: background-color 0.3s ease;
      margin-top: 10px;
    }

    input[type="submit"]:hover {
      background-color:rgb(13, 129, 29);
    }

    input[type="reset"] {
      background-color:rgba(243, 22, 22, 0.99);
      color: white;
      padding: 12px 0;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      width: 100%;
      transition: background-color 0.3s ease;
      margin-top: 10px;
    }

     input[type="reset"]:hover {
      background-color:rgb(129, 30, 13);
    }


    ::placeholder {
      color: #999;
    }

    br {
      display: none;
    }
  </style>
</head>

<br>
<body>
<div style="margin-top: 40px;">   
  <form method="post" action="/MyProject/NewMeasurement_post.php">
    <div class="form-header"><p>Add New Customer</p></div><br> 
    <label>Tailor ID (درزی کی شناخت):</label>
    <input type="number" name="TailorID" placeholder="Tailor ID" required min="1">

    <label>Customer Name (کسٹمر کا نام):</label>
    <input type="text" name="name" placeholder="Customer Name" required pattern = "[A-Za-z\s]+" title="Only alphabets allowed">

    <label>Phone (فون نمبر):</label>
    <input type="text" name="phone" placeholder="Phone" requeired pattern = "\d{11}"  title ="Only 11 digits allowed">

    <label>Length (لمبائی):</label>
    <input type="number" name="length" placeholder="Length" step="0.001" required min="10" max="100">

    <label>Sleeves (آستین):</label>
    <input type="number" name="sleeves" placeholder="Sleeves" step="0.001" required min="5" max="10">

    <label>Shoulder Depth (تیرا):</label>
    <input type="number" name="ShoulderDepth" placeholder="Shoulder Depth" step="0.001" required min="10" max="50">

    <label>Neck (گردن):</label>
    <input type="number" name="neck" placeholder="Neck" step="0.01" required min="6" max = "20">

    <label>Chest (چھاتی):</label>
    <input type="number" name="chest" placeholder="Chest" step="0.01" required min="10" max = "50">

    <label>Hem (گھیرا):</label>
    <input type="number" name="HemWidth" placeholder="Hem Width" step="0.01" required min="10" max = "50">

    <label>Hem Type (دامن کی قسم):</label>
    <div class="radio-group">
      <div class="radio-option">
        <input type="radio" name="HemType" value="straight hem">
        <label>Straight Hem (سیدھا دامن)</label>
      </div>
      <div class="radio-option">
        <input type="radio" name="HemType" value="rounded hem" >
        <label>Rounded Hem (گول دامن)</label>
      </div>
    </div>

    <label>Front Pocket (سامنے کی جیب):</label>
    <input type="number" name="frontPocket" placeholder="Front Pocket" required min="0" max = "2">

    <label>Side Pockets (سائیڈ جیب):</label>
    <input type="number" name="sidePocket" placeholder="Side Pockets" required min="0" max = "2">

    <label>Shalwar Length (شلوار کی لمبائی):</label>
    <input type="number" name="ShalwarLength" placeholder="Shalwar Length" step="0.01" required min="10" max = "50">

    <label>Ankle Width (پانچہ):</label>
    <input type="number" name="AnkleWidth" placeholder="Ankle Width" step="0.01" required min = "5" max = "10">

    <label>Trouser Pocket (شلوار جیب):</label>
    <div class="radio-group">
      <div class="radio-option">
        <input type="radio" name="TrouserPocket" value="Yes">
        <label>Yes (ہاں)</label>
      </div>
      <div class="radio-option">
        <input type="radio" name="TrouserPocket" value="No">
        <label>No (نہیں)</label>
      </div>
    </div>

    <label>Neck Type (گردن کی قسم):</label>
    <select name="NeckType">
      <option value="Band">Band (بین)</option>
      <option value="Collar">Collar (کالر)</option>
    </select>

    <label>Sleeves Type (آستین قسم):</label>
    <select name="SleevesType">
      <option value="Straight Sleeves">Straight Sleeves (سادہ آستین)</option>
      <option value="Cuff">Cuff Sleeves (کف آستین)</option>
    </select>

    <label>Pleat (پلیٹ):</label>
    <div class="radio-group">
      <div class="radio-option">
        <input type="radio" name="Pleat" value="Yes">
        <label>Yes (ہاں)</label>
      </div>
      <div class="radio-option">
        <input type="radio" name="Pleat" value="No">
        <label>No (نہیں)</label>
      </div>
    </div>

    <label>Date (تاریخ):</label>
    <input type="date" name="Date">

    <label>Dress Type (کپڑوں کی قسم):</label>
    <select name="DressType">
      <option value="Shalwar Kameez">Shalwar Kameez (شلوار قمیض)</option>
      <option value="Kurta Pajama">Kurta Pajama (کرتا پاجامہ)</option>
      <option value="Sherwani">Sherwani (شیروانی)</option>
      <option value="Waistcoat">Waistcoat (ویسٹ کوٹ)</option>
    </select>

    <input type="submit" value="Submit">
    <input class="undo" type="reset" value="Reset">
  </form>   
</div>  

    <footer>
    &copy; 2025 TailorEase. Beta Version.
  </footer>
</body>
</html>
