<?php
    session_start();
    $currentPage = "signup";
    include 'HeaderFile.php'; 
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <style>
       body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    /* padding: 20px; */
    background: linear-gradient(to right,rgb(165, 168, 170), #cfdef3);
}


h1 {
    text-align: center;
    color:rgb(255, 255, 255);
    margin-bottom: 30px;
    font-size: 36px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}

.form {
    max-width: 600px;
    margin: 0 auto;
    padding: 25px 30px;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
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


.label {
    display: block;
    margin-top: 15px;
    margin-bottom: 5px;
    font-weight: 600;
    color: #34495e;
}

.my_input,
#address,
select,
.image,
.range {
    width: 97%;
    padding: 10px;
    border: 1px solid #bdc3c7;
    border-radius: 8px;
    box-sizing: border-box;
    background-color: #f9f9f9;
    transition: all 0.3s ease-in-out;
}

.my_input:focus,
#address:focus,
select:focus {
    border-color:rgb(28, 202, 12);
    outline: none;
    background-color: #fff;
}

#Application,
#Reset {
    width: 45%;
    padding: 10px;
    margin-top: 20px;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s ease;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
}

#Application {
    background: linear-gradient(to right,rgb(16, 214, 65),rgb(117, 231, 9));
    border: none;
    color: white;
}

#Reset {
    background: linear-gradient(to right, #f85032, #e73827);
    border: none;
    color: white;
}

#Application:hover {
    background: linear-gradient(to right,rgb(84, 179, 60),rgb(65, 185, 41));
}

#Reset:hover {
    background: linear-gradient(to right,rgba(226, 16, 16, 0.84),rgb(233, 143, 83));
}

.checkbox,
#radio {
    accent-color: #2ecc71;
}

    </style>
</head>
<body>
    
    <div style="margin-top: 40px;">
    <form class = "form" method = "post" action = "/MyProject/SignUp_post.php" enctype="multipart/form-data">
       <div class="form-header"><p>SignUp</p></div><br> 
        
        <label class="label">Full Name:</label><br/>
        <input type="text" class="my_input" name="FullName" required pattern = "[A-Za-z\s]+" title="Only alphabets allowed"/>
        <br/>
        <br/>

        <label class="label">Email:</label><br/>
        <input type="email" class="my_input" name="Email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Enter a valid Email ID (e.g., example@mail.com)" />

        <br/>

        <label class="label">Password:</label><br/>
        <input type="password" name="Password" class="my_input" title="Password must be at least 8 characters and include one uppercase letter, one lowercase letter, one number, and one special character." />

        <br/>

        <label for="dob" class="label">Date of Birth:</label><br/>
        <input type="date" class="my_input" name="dob"/>
        <br/>

        <label class="label">Age:</label><br/>
        <input type="number" min="10" max="100" class="my_input" name="Age" required pattern="[0-9]+" title="Enter a valid age (e.g., 18, 25, 30, etc.)" />
        <br/>

        <label class="label">Gender:</label><br/>
        <select name="Gender" id="gender">
            <option value>select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <br/>


        <label for="address" class="label">Address:</label><br/>
        <textarea name="Address" id="address" required maxlength="200" cols="30" rows="3" placeholder="Enter your address"></textarea>
        <br/>

        <label for="Phone" class="label">Phone Number:</label><br/>
        <input type="tel" class="my_input" name="Phone" required pattern="\d{11}"  title ="Only 11 digits allowed"/>
        <br/>

        <label for="img" class="label">Profile Picture:</label><br/>
        <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp" required class="Image" name="profile_pic"/>
        <br/>

        <label for="terms and conditions" class="label"><input type="checkbox" id="radio" required/>I accept to the term and conditions</label><br/>
        <button type="Submit" id="Application">SignUp</button>
        <button type="reset" id="Reset">Reset</button>
    </form>
    </div>


   <footer>
    &copy; 2025 TailorEase. Beta Version.
  </footer>  

</body>
</html>