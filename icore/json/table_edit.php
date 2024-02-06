<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../class/mysql.php";
    require_once "../class/config.php";

    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();

    try {
        $data = $_POST['formEditData'];
        $arrData = json_decode($data, true);

        $table_set = $arrData['table_set'];
        $unique_fields = unserialize(base64_decode($arrData['unique_fields']));
        $unique_fields = is_array($unique_fields) ? $unique_fields : array($unique_fields);

        $id = $arrData['id'];

        // تابع برای چک کردن یکتا بودن فیلدها
        function checkUniqueFields($db, $table_set, $unique_fields, $uniqueValues, $id)
        {
            $placeholdersArray = array_fill(0, count($unique_fields), '?');
            $placeholders = implode(' AND ', $placeholdersArray);

            $stmt = $db->prepare("SELECT COUNT(*) as count FROM $table_set WHERE $placeholders AND id != ?");
            $uniqueValues[] = $id;
            $stmt->bind_param(str_repeat('s', count($unique_fields) + 1), ...$uniqueValues);

            $stmt->execute();
            $result = $stmt->get_result();
            $count = $result->fetch_assoc()['count'];
            return $count == 0;
        }

        // اطلاعات مورد نیاز برای چک یکتا بودن را جمع‌آوری کنید
        $uniqueValues = [];
        foreach ($unique_fields as $field) {
            $uniqueValues[] = @$arrData[$field];
        }

        // چک یکتا بودن
        if (!checkUniqueFields($db, $table_set, $unique_fields, $uniqueValues, $id)) {
            echo json_encode(['status' => 'error', 'message' => 'Duplicate data. Please wait and try again.']);
            exit;
        }

        // اگر به اینجا رسیدیم یعنی داده یکتاست، ادامه اجرا
        $updateFields = [];
        $updateValues = [];
        $types = "";

        foreach ($arrData as $field => $value) {
            // فیلد پسورد
            if ($field == 'password' && !empty($value)) {
                $updateFields[] = "$field = ?";
                $updateValues[] = md5(htmlspecialchars(strip_tags($value)));
                $types .= 's';
            }

            // فیلد ساختار
            if (in_array($field, ['stracture', 'operation', 'parts']) && !empty($value)) {
                $updateFields[] = "$field = ?";
                $updateValues[] = serialize(htmlspecialchars($value));
                $types .= 's';
            }

            // نادیده گرفتن فیلدهای ویژه
            if ($field !== 'table_set' && $field !== 'password' && $field !== 'unique_fields' &&
                !in_array($field, ['stracture', 'operation', 'parts'])) {

                $updateFields[] = "$field = ?";
                $updateValues[] = htmlspecialchars(strip_tags($value));

                // اگر نام فیلد شامل "id" باشد، نوع را به "i" تغییر دهید
                $types .= stripos($field, 'id') !== false ? 'i' : 's';
            }
        }

        // اگر هیچ فیلدی برای بروزرسانی نداشته باشیم، اجرای برنامه را متوقف کنیم
        if (empty($updateFields)) {
            echo json_encode(['status' => 'error', 'message' => 'No fields to update.']);
            exit;
        }

        $updateFields = implode(', ', $updateFields);

        $stmt = $db->prepare("UPDATE $table_set SET $updateFields WHERE id = ?");
        $updateValues[] = $id;
        $stmt->bind_param($types . 'i', ...$updateValues);

        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Item Updated successfully']);

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}


?>