<html>
    <body>
        <?php
            $host = "127.0.0.1"; // localhost\
            // $port = "3306";
            $username = "root";
            $password = "";
            $database = "TailorEase";

            $connection = new mysqli($host, $username, $password, $database);
            if($connection->connect_error){
                die("Connection Failed: ".$connection->connect_error);
            }
            $name = $_POST["FullName"];
            $email = $_POST["Email"];
            $password = $_POST["Password"];
            $dateofbirth = $_POST["dob"];
            $Age = $_POST["Age"];
            $gender = $_POST["Gender"];
            $Address = $_POST["Address"];
            $Phone = $_POST["Phone"];
           
            // File Upload
            $file_name = $_FILES["profile_pic"]["name"]; // returns the name of the uploded file
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION); // returns .png or .jpg
            
            $temporary_path = $_FILES["profile_pic"]["tmp_name"]; // returns the temporary path of the file
            $permanent_path = "uploads_pics/dp_".time().".".$file_extension; // dp_12748392311.jpg

            // move the uploaded file from temporary folder to uploads 
            move_uploaded_file($temporary_path, $permanent_path);


            $sql = "INSERT INTO Users VALUES(NULL, '$name', '$email', '$password','$dateofbirth',$Age,'$gender', '$Address', $Phone, '$permanent_path','')"; 
            echo $sql;

             $db_response = $connection->query($sql);
            
             if($db_response === true){
                echo "Record inserted";
             }else{
                echo "Record not inserted";
             }


            
        ?>
    </body>
</html>
