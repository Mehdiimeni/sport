<?php

if (isset($_POST['id'], $_POST['table'])) {
    require_once "../class/mysql.php";
    require_once "../class/config.php";
    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();

    $itemId = htmlspecialchars(strip_tags($_POST['id']));
    $tableName = htmlspecialchars(strip_tags($_POST['table']));

    try {
        $stmt = $db->prepare("UPDATE " . $tableName . " SET status = 'Inactive' WHERE id = ?");
        $stmt->bind_param("i", $itemId);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Item inactivated successfully']);
    } catch (Exception $e) {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['status' => 'error', 'message' => 'Error inactivating item: ' . $e->getMessage()]);
    }
} else {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['status' => 'error', 'message' => 'Invalid request parameters']);
}



?>