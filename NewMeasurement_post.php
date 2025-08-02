<html>
    <body>
        <?php
             session_start();
            $host = "127.0.0.1"; // localhost\
            // $port = "3306";
            $username = "root";
            $password = "";
            $database = "TailorEase";

            $connection = new mysqli($host, $username, $password, $database);
            if($connection->connect_error){
                die("Connection Failed: ".$connection->connect_error);
            }
            $TailorID = $_POST["TailorID"];
            $CustomerName = $_POST["name"];
            $Phone = $_POST["phone"];
            $Length = $_POST["length"];
            $Sleeves = $_POST["sleeves"];
            $Shoulder_Depth = $_POST["ShoulderDepth"];
            $Neck = $_POST["neck"];
            $Chest = $_POST["chest"];
            $Hem_Width = $_POST["HemWidth"];
            $Hem_Type = $_POST["HemType"];
            $front_Pocket = $_POST["frontPocket"];
            $side_Pocket = $_POST["sidePocket"];
            $Shalwar_Length = $_POST["ShalwarLength"];
            $Ankle_Width = $_POST["AnkleWidth"];
            $Trouser_Pocket = $_POST["TrouserPocket"];
            $Neck_Type = $_POST["NeckType"];
            $Sleeves_Type = $_POST["SleevesType"];
            $pleat = $_POST["Pleat"];
            $date = $_POST["Date"];
            $Dress_Type = $_POST["DressType"];
           
            


            $sql = "INSERT INTO Customers  VALUES(NULL,'$TailorID','$CustomerName','$Phone','$Length','$Sleeves','$Shoulder_Depth','$Neck', '$Chest','$Hem_Width','$Shalwar_Length','$Ankle_Width','$front_Pocket','$side_Pocket','$Trouser_Pocket','$Neck_Type','$Sleeves_Type','$pleat','$date','$Hem_Type','$Dress_Type')"; 
            echo $sql;

             $db_response = $connection->query($sql);

            //  if($db_response->num_rows > 0){
            //     $user_id = 0;
            //     while($row = $db_response->fetch_assoc()){
            //         $_SESSION["user_id"] = $user_id = $row["CustomerID"];
            //         $_SESSION["user_name"] = $row["CustomerName"];
            //         $_SESSION["customer_data"] = $row;
        // }
    // }     
             if($db_response === true){
                $last_inserted_id = mysqli_insert_id($connection);
                echo "Record inserted with ID:".$last_inserted_id;
             }else{
                echo "Record not inserted";
             }


            
        ?>
    </body>
</html>
