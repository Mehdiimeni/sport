<?php
///controller/admin/logout.php
$_SESSION["admin_id"] = '';
session_destroy();
echo "<script>window.location.replace('./login');</script>";
exit;