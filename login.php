<?php
require("config/db_connection.php");
session_start();

extract($_POST);

if (isset($_POST['username']) && isset($_POST['password'])) {
    $check_user = mysqli_query($conn, "SELECT * FROM users WHERE username='" . $username . "' AND password = '" . $password . "'");
    if (mysqli_num_rows($check_user) > 0) {
        while ($row = mysqli_fetch_assoc($check_user)) {
            $id = $row["user_id"];
            $username = $row["username"];
            $name = $row["name"];
            $email = $row["email"];
            $password = $row["password"];
            $role = $row["role"];
            $status = $row["status"];
            
            if ($status === 'inactive') {
                echo 'inactive';
            } else {

                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $password;
                $_SESSION["role"] = $role;

                $old_password = "NXS123";
                
                if($old_password == $password){
                    echo "defaultPassword";
                }else{
                    if ($role == "receptionist") {
                        echo "receptionist";
                    } elseif ($role == "admin") {
                        echo "admin";
                    } else {
                        echo "error";
                    }
                }
            }

        }
    } else {
        echo '0';
    }
}
?>