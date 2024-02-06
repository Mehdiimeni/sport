<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../class/mysql.php";
    require_once "../class/config.php";
    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();

    if (isset($_POST['tableId']) && isset($_POST['tableName'])) {
        $id = $_POST['tableId'];
        $tableName = $_POST['tableName'];

        try {
            $stmt = $db->prepare("SELECT * FROM $tableName WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $activityData = $result->fetch_assoc();
                $activityData['table_set'] = $tableName;
                echo json_encode($activityData);
            } else {
                echo json_encode(['error' => 'Failed to execute query.']);
            }

            $stmt->close();
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }

    } else {
        http_response_code(405);
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    }
}


?>