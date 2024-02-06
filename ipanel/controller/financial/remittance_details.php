<?php
///controller/financial/remittance_details.php
$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$financial = new Financial($db);
$comment = new Comment($db);
$rbac = new RBAC($db);
$structure = new Structure($db);

$remittance_id = $_GET['remittance_id'];

$part_name = 'remittance';
$comment->part_name = $part_name;
$comment->part_id = $remittance_id;

$remittanceDetail = $financial->getRemittanceById($remittance_id)->fetch_assoc();
$userProfile = $user->getUserImageById($remittanceDetail['user_id']);

function getValue($fieldName, $remittanceDetail)
{
    return isset($remittanceDetail[$fieldName]) ? $remittanceDetail[$fieldName] : '';
}


$allComments = $comment->getCommentPart();


$uploadDir = './irepository/financial/';
$fileManager = new FileManager($db, $uploadDir);

$dbHandler = new DatabaseHandler($db);

$allFileData = $fileManager->getFileManageByPart($remittance_id, $part_name);



$allFileInfo = array();
if ($allFileData && $allFileData->num_rows > 0) {
    while ($fileData = $allFileData->fetch_assoc()) {
        $allFileInfo[] = $fileManager->getFileInfoFromPath($fileData['file_path'] . $fileData['file_name'], $fileData['file_path'], $fileData['file_title']);
    }
}


if (isset($_GET['file']) && !empty($_GET['file'])) {
    $fileManager->fileDownload($_GET['file']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // forward
    if (isset($_POST['forward'])) {

        $table_set = 'forwards';

        $receiver_rbac_id = $_POST['receiver_rbac_id'];
        $arrreceiver_person_id_a = $_POST['receiver_person_id_a'];
        $arrreceiver_person_id_u = $_POST['receiver_person_id_u'];
        $forwards_description = $_POST['forwards_description'];
        $sender_signature = isset($_POST['sender_signature']) && !empty($_POST['sender_signature']) ? 1 : 0;

        $sender_person_id = $_SESSION['admin_id'];
        $sender_rbac_id = $_SESSION['rbac_id'];
        $sender_type = 'a';
        $section_element_id = $_POST['section_element_id'];
        $section_part_name = $_POST['section_part_name'];


        if ($receiver_rbac_id != '') {
            $arrData = [
                'receiver_rbac_id' => $receiver_rbac_id,
                'forwards_description' => $forwards_description,
                'sender_signature' => $sender_signature,
                'sender_person_id' => $sender_person_id,
                'sender_rbac_id' => $sender_rbac_id,
                'sender_type' => $sender_type,
                'section_element_id' => $section_element_id,
                'section_part_name' => $section_part_name,

            ];

            $dbHandler->insertData($table_set, $arrData);


        }

        foreach ($arrreceiver_person_id_a as $receiver_person_id_a) {
            $arrData = [
                'receiver_person_id' => $receiver_person_id_a,
                'receiver_type' => 'a',
                'forwards_description' => $forwards_description,
                'sender_signature' => $sender_signature,
                'sender_person_id' => $sender_person_id,
                'sender_rbac_id' => $sender_rbac_id,
                'sender_type' => $sender_type,
                'section_element_id' => $section_element_id,
                'section_part_name' => $section_part_name,

            ];

            $dbHandler->insertData($table_set, $arrData);
        }

        foreach ($arrreceiver_person_id_u as $receiver_person_id_u) {
            $arrData = [
                'receiver_person_id' => $receiver_person_id_a,
                'receiver_type' => 'u',
                'forwards_description' => $forwards_description,
                'sender_signature' => $sender_signature,
                'sender_person_id' => $sender_person_id,
                'sender_rbac_id' => $sender_rbac_id,
                'sender_type' => $sender_type,
                'section_element_id' => $section_element_id,
                'section_part_name' => $section_part_name,

            ];

            $dbHandler->insertData($table_set, $arrData);
        }

        echo <<<HTML
    <script>

window.location.replace('remittance?remittance_id='+$remittance_id); 
    </script>
HTML;

    }




    if (isset($_FILES['attach_file'])) {
        $uploadedFile = $fileManager->uploadFile($_FILES['attach_file']);
        $file_title = $_POST['file_title'];

        $table_set = 'file_manage';
        $arrData = [
            'file_name' => $uploadedFile,
            'file_path' => $uploadDir,
            'file_title' => $file_title,
            'admin_id' => $_SESSION['admin_id'],
            'part_id' => $remittanceDetail['id'],
            'part_name' => $part_name

        ];

        $unique_fields = [
            ''
        ];


        $dbHandler->insertData($table_set, $arrData);

        echo <<<HTML
    <script>

window.location.replace('remittance?remittance_id='+$remittance_id); 
    </script>
HTML;

    }



    if (isset($_POST['comment_text']) && !empty($_POST['comment_text'])) {

        $comment_text = $_POST['comment_text'];
        $parent_id = $_POST['parent_id'] ?? null;

        $dbHandler = new DatabaseHandler($db);


        $table_set = 'comments';

        $arrData = [
            'comment_text' => $comment_text,
            'part_name' => $part_name,
            'part_id' => $remittance_id,
            'admin_id' => $_SESSION['admin_id']
        ];

        if ($parent_id != null)
            $arrData['parent_id'] = $parent_id;

        if (isset($_POST['local']) && !empty($_POST['local']))
            $arrData['company_id'] = $structure->getCompanyByUnitId($_SESSION['unit_id']);

        $unique_fields = [];


        $insertResult = $dbHandler->insertData($table_set, $arrData);
        $message = $insertResult['message'];
        $insert_id = $insertResult['insert_id'];

        echo <<<HTML
    <script>
        alert('$message');
        if ('$message' === 'Data inserted successfully.') {
            window.location.replace ('remittance?remittance_id='+$remittance_id); 
        }
    </script>
HTML;
    }

}

