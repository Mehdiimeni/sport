<?php

if (isset($_POST['id']) && isset($_POST['table'])) {
    require_once "../class/mysql.php";
    require_once "../class/config.php";

    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();

    try {
        $itemId = $_POST['id'];
        $tableName = $_POST['table'];

        $stmt = $db->prepare("DELETE FROM $tableName WHERE id = ?");
        $itemId = htmlspecialchars(strip_tags($itemId));

        // استفاده از 'i' برای نوع اطمینان حاصل کنید که شناسه به عنوان یک عدد صحیح شناخته می‌شود
        $stmt->bind_param("i", $itemId);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Item deleted successfully']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}



?>