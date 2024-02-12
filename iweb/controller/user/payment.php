<?php
///controller/user/payment.php
$encoded_data = $_GET['data'];
$decoded_data = base64_decode($encoded_data);
$data = json_decode($decoded_data, true);

var_dump($data );
var_dump($_POST);

?>