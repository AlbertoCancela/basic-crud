<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
include '../../model/queryHandler.php';
$object = new QueryHandler();

if ($data) {

    $typeQuery = $data['typeQuery'];
    switch($typeQuery){
        case 'SEARCH':
            $id = $data['userID'];
            $sql = "SELECT u.*, cd.PHONE_NUMBER, cd.EMAIL , ad.USER_DATA 
                    FROM USERS u INNER JOIN CONTACT_DATA cd ON (u.ID = cd.USER_ID ) 
                    INNER JOIN ADDITIONAL_DATA ad ON (u.ID = ad.USER_ID)
                    WHERE u.ID = ?";
            $response = $object->executeQuery($sql, [$id]);
            echo json_encode($response[0]);
            break;
        case 'INSERT':
            $name = $data['name'];
            $lastName = $data['lastName'];
            $phoneNumber = $data['phoneNumber'];
            $email = $data['email'];
            $userData = $data['additionalData'];
            try {
                $sql = "INSERT INTO USERS (NAME, LAST_NAME) VALUES (?, ?)";
                $id = $object->executeQuery($sql, [$name, $lastName]);
        
                if (!$id) {
                    throw new Exception("Error al insertar en USERS");
                }
        
                $sql = "INSERT INTO CONTACT_DATA (USER_ID, PHONE_NUMBER, EMAIL) VALUES (?, ?, ?)";
                $contactId = $object->executeQuery($sql, [$id, $phoneNumber, $email]);
        
                $sql = "INSERT INTO ADDITIONAL_DATA (USER_ID, USER_DATA) VALUES (?, ?)";
                $additionalId = $object->executeQuery($sql, [$id, $userData]);
                
        
                echo json_encode(["success" => true, "userID" => $id]);
        
            } catch (Exception $e) {
                // $object->pdo->rollBack();
                echo json_encode(["success" => false, "error" => $e->getMessage()]);
            }
            break;
        case 'UPDATE':
            try{
                $id = $data['userID'];
                $name = $data['name'];
                $lastName = $data['lastName'];
                $phoneNumber = $data['phoneNumber'];
                $email = $data['email'];
                $userData = $data['additionalData'];

                $sql = "UPDATE USERS u
                        JOIN CONTACT_DATA c ON u.ID = c.USER_ID
                        JOIN ADDITIONAL_DATA a ON u.ID = a.USER_ID
                        SET 
                            u.NAME = ?,
                            u.LAST_NAME = ?,
                            c.PHONE_NUMBER = ?,
                            c.EMAIL = ?,
                            a.USER_DATA = ?
                        WHERE u.ID = ?;";
                $response = $object-> executeQuery($sql, [$name, $lastName, $phoneNumber, $email, $userData, $id]);
                echo json_encode($response);
            }catch (Exception $e){
                // $object->pdo->rollBack();
                echo json_encode(["success" => false, "error" => $e->getMessage()]);
            }
            break;
        case 'DELETE':
            $id = $data['userID'];
            $sql = "DELETE FROM USERS WHERE ID = ?";
            $response = $object->executeQuery($sql, [$id]);
            echo json_encode($response);
            break;
    }
} else {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Error al procesar los datos."]);
}
