<?php

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "../class/mysql.php";
    require_once "../class/config.php";

    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();

    try {
        $data = $_POST['formAddData'];
        $arrData = json_decode($data, true);

        $table_set = $arrData['table_set'];

        $unique_fields = unserialize(base64_decode($arrData['unique_fields']));
        $unique_fields = is_array($unique_fields) ? $unique_fields : [$unique_fields];

        // اگر به اینجا رسیدیم یعنی داده یکتاست، ادامه اجرا
        $insertFields = [];
        $insertValues = [];
        $types = "";

        foreach ($arrData as $field => $value) {
            // نادیده گرفتن فیلدهای ویژه
            if (!in_array($field, ['table_set', 'password', 'unique_fields'])) {
                $insertFields[] = $field;
                $insertValues[] = htmlspecialchars($field === 'password' ? md5($value) : strip_tags($value));

                // اگر نام فیلد شامل "id" باشد، نوع را به "i" تغییر دهید
                $types .= stripos($field, 'id') !== false ? 'i' : 's';
            }

            //فیلد ساختار
            if ($field === 'stracture' && !empty($value)) {
                $insertFields[] = $field;
                $insertValues[] = serialize($value);
                $types .= 's';
            }

            if (in_array($field, ['operation', 'parts']) && !empty($value)) {
                $insertFields[] = $field;
                $insertValues[] = serialize($value);
                $types .= 's';
            }
        }

        $placeholders = rtrim(str_repeat('?, ', count($insertFields)), ', ');
        $fields = implode(', ', $insertFields);

        $stmt = $db->prepare("INSERT INTO $table_set ($fields) VALUES ($placeholders)");
        $stmt->bind_param($types, ...$insertValues);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Item Inserted successfully']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

?>