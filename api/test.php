<?php

    $method = $_SERVER['REQUEST_METHOD'];
    switch($method) {
        case 'read': {
            $sql = "SELECT * FROM user";
            $query = $conn -> prepare($sql);
            // $query -> execute(array(':id'=>1));
            $query -> execute();
    
            // $rows = $query -> fetchAll();
            $rows = $query -> fetchAll(PDO::FETCH_ASSOC);
            // print_r($rows)
            // $rows = $query -> fetch(PDO::FETCH_ASSOC);
            // $rows = $query -> rowCount();
    
            // foreach($rows as $row) {
            //     echo "id: " . $row["id"] . ".) name: ". $row["name"];
            // }
            
            echo json_encode($rows);
        }

        case 'POST': {
            // $_POST = json_decode(file_get_contents("php://input"),true);
            // $sql = "INSERT INTO users(id, name, email, mobile, created_at) VALUES(null, :name, :email, :mobile, :created_at)";
            // echo $sql;

            $user = json_decode( file_get_contents('php://input') );
            $sql = "INSERT INTO user(id, name, email, mobile, created_at) VALUES(null, :name, :email, :mobile, :created_at)";
            $stmt = $conn->prepare($sql);
            $created_at = date('Y-m-d');
            $stmt->bindParam(':name', $user->name);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':mobile', $user->mobile);
            $stmt->bindParam(':created_at', $created_at);

            if($stmt->execute()) {
                $response = ['status' => 1, 'message' => 'Record created successfully.'];
            } else {
                $response = ['status' => 0, 'message' => 'Failed to create record.'];
            }
            echo json_encode($response);

            // $name = $_POST['name'];
            // $email = $_POST['email'];
            // $mobile = $_POST['mobile'];

            // $sql = "INSERT INTO `user` (`id`, `name`, `email`, `mobile`, `created_at`, `updated_at`) VALUES ('4', 'jay', 'jay@gmail.com', '09486562938', current_timestamp(), current_timestamp());";
            // $query = $conn -> prepare($sql);
            // $query -> execute();
            // echo $mobile 
            break;
        }
    }