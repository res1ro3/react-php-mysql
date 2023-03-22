<?php
    include "./DbConnect.php";
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Allow-Credentials: true');

    $method = $_SERVER['REQUEST_METHOD'];

    switch($method) {

        case "GET": {
            $sql = "SELECT * FROM user";
            $query = $conn -> prepare($sql);
            $query -> execute();
            $rows = $query -> fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rows);
            break;
        }

        case "POST": {
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
            break;
        }

        case "DELETE": {
            $sql = "DELETE FROM user WHERE id = :id";
            $path = explode('/', $_SERVER['REQUEST_URI']);
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $path[3]);
    
            if($stmt->execute()) {
                $response = ['status' => 1, 'message' => 'Record deleted successfully.'];
            } else {
                $response = ['status' => 0, 'message' => 'Failed to delete record.'];
            }
            echo json_encode($response);
            break;
        }

        default: {
            echo "default";
        }
    }
    
?>
