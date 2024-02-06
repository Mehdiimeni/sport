<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../class/mysql.php";
    require_once "../class/config.php";

    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();

    try {
        if (isset($_POST['table_set'], $_POST['operation'], $_POST['id'])) {
            $table_set = $_POST['table_set'];
            $operation = $_POST['operation'];
            $id = $_POST['id'];

            $stmt = $db->prepare("UPDATE $table_set SET status = ? WHERE id = ?");
            $stmt->bind_param("si", $operation, $id);
            $stmt->execute();

            echo json_encode(['status' => 'success', 'message' => 'Status Updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid or missing parameters']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}



?>