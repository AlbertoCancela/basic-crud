<?php
class QueryHandler {
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=uhipocrates.mx;dbname=querydummies;charset=utf8mb4";
            $this->pdo = new PDO($dsn, 'dummyTest', 'PSW12?34?56?', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }

    public function executeQuery($query, $params = []) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            // Si la consulta es SELECT, devolver los resultados
            if (stripos(trim($query), 'SELECT') === 0) {
                return $stmt->fetchAll();
            }
            if (stripos(trim($query), 'INSERT') === 0) {
                return $this->pdo->lastInsertId(); // Devuelve el ID insertado
            }
    
            return true;
        } catch (PDOException $e) {
            return "Error en la consulta: " . $e->getMessage();
        }
    }
}


// Uso de la clase
// $host = 'uhipocrates.mx';
// $dbname = 'querydummies';
// $user = 'dummyTest';
// $password = 'PSW12?34?56?';

// $queryHandler = new QueryHandler();

// // Ejemplo de SELECT
// $result = $queryHandler->executeQuery("SELECT * FROM USERS WHERE ID = ?",[2]);  
// print_r($result);
?>
