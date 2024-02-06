<?php
class RBAC
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function checkPermission($userId, $permission, $type)
    {
        $userDetails = $this->getUserDetails($userId);

        if ($userDetails) {
            $rbac_id = $userDetails["rbac_id"];

            if ($userDetails["all_rbac"])
                return true;

            switch ($type) {
                case 'S':
                    return $this->checkPermissionStructure($rbac_id, $permission);
                case 'P':
                    return $this->checkPermissionPart($rbac_id, $permission);
                case 'O':
                    return $this->checkPermissionOperation($rbac_id, $permission);
                default:
                    return false;
            }
        } else {
            return false;
        }
    }

    private function checkPermissionStructure($rbac_id, $permission)
    {
        $structure = $this->getPermissionData('permissions_structure', 'structure', $rbac_id);
        return $this->checkPermissionInData($structure, $permission);
    }

    private function checkPermissionPart($rbac_id, $permission)
    {
        $parts = $this->getPermissionData('permissions_operation', 'parts', $rbac_id);
        return $this->checkPermissionInData($parts, $permission);
    }

    private function checkPermissionOperation($rbac_id, $permission)
    {
        $operation = $this->getPermissionData('permissions_operation', 'operation', $rbac_id);
        return $this->checkPermissionInData($operation, $permission);
    }

    public function getRbacInfoByOperationName($operationName)
    {
        $sqlQuery = "SELECT id FROM operations WHERE operations.operation_name = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bind_param("s", $operationName);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        $operationsResult = $result->fetch_assoc();
        if ($result->num_rows > 0) {

            $operationId = $operationsResult['id'];


            $sqlQuery = "select operation,rbac_id from permissions_operation";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();

            $arrRbacId = array();
            while ($permissionsOperations = $result->fetch_assoc()) {


                if ($this->checkPermissionInData($permissionsOperations['operation'], $operationId)) {
                    $arrRbacId[] = $permissionsOperations['rbac_id'];
                }
            }

            $placeholders = implode(",", array_fill(0, count($arrRbacId), "?"));

            $sqlQuery = "SELECT id, rbac_name FROM rbac WHERE id IN ($placeholders)";

            $stmt = $this->conn->prepare($sqlQuery);

            // bind parameters
            $types = str_repeat('i', count($arrRbacId));  // 'i' represents integer
            $stmt->bind_param($types, ...$arrRbacId);

            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();

            return $result;

        } else {
            return null;
        }


    }


    public function getUsersByOperationName($operationName)
    {
        $sqlQuery = "SELECT id FROM operations WHERE operations.operation_name = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bind_param("s", $operationName);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        $operationsResult = $result->fetch_assoc();
        if ($result->num_rows > 0) {

            $operationId = $operationsResult['id'];


            $sqlQuery = "select operation,rbac_id from permissions_operation";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();

            $arrRbacId = array();
            while ($permissionsOperations = $result->fetch_assoc()) {



                if ($this->checkPermissionInData($permissionsOperations['operation'], $operationId)) {
                    $arrRbacId[] = $permissionsOperations['rbac_id'];
                }
            }

            $placeholders = implode(",", array_fill(0, count($arrRbacId), "?"));

            $sqlQuery = "SELECT id, name FROM users WHERE rbac_id IN ($placeholders)";

            $stmt = $this->conn->prepare($sqlQuery);

            // bind parameters
            $types = str_repeat('i', count($arrRbacId));  // 'i' represents integer
            $stmt->bind_param($types, ...$arrRbacId);

            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();

            return $result;

        } else {
            return null;
        }


    }

    public function getAdminsByOperationName($operationName)
    {
        $sqlQuery = "SELECT id FROM operations WHERE operations.operation_name = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bind_param("s", $operationName);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        $operationsResult = $result->fetch_assoc();
        if ($result->num_rows > 0) {

            $operationId = $operationsResult['id'];


            $sqlQuery = "select operation,rbac_id from permissions_operation";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();

            $arrRbacId = array();
            while ($permissionsOperations = $result->fetch_assoc()) {



                if ($this->checkPermissionInData($permissionsOperations['operation'], $operationId)) {
                    $arrRbacId[] = $permissionsOperations['rbac_id'];
                }
            }

            $placeholders = implode(",", array_fill(0, count($arrRbacId), "?"));

            $sqlQuery = "SELECT id, name FROM admins WHERE rbac_id IN ($placeholders)";

            $stmt = $this->conn->prepare($sqlQuery);

            // bind parameters
            $types = str_repeat('i', count($arrRbacId));  // 'i' represents integer
            $stmt->bind_param($types, ...$arrRbacId);

            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();

            return $result;

        } else {
            return null;
        }


    }

    public function checkPermissionOperationByName($operation_name, $type = 'a')
    {
        if ($type == 'u') {
            $userDetails = $this->getUserDetails($_SESSION['user_id']);
            if ($userDetails["all_rbac"])
                return true;
        }

        if ($type == 'a') {
            $adminDetails = $this->getAdminDetails($_SESSION['admin_id']);
            if ($adminDetails["all_rbac"])
                return true;
        }

        $sqlQuery = "SELECT id FROM operations WHERE operation_name = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bind_param("s", $operation_name);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        $operationsResult = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            $operationId = $operationsResult['id'];


            return $this->checkPermissionOperation($_SESSION["rbac_id"], $operationId);


        } else {
            return null;
        }

    }

    public function checkPermissionPartByName($parts_caption, $type = 'a')
    {

        if ($type == 'u') {
            $userDetails = $this->getUserDetails($_SESSION['user_id']);
            if ($userDetails["all_rbac"])
                return true;
        }

        if ($type == 'a') {
            $adminDetails = $this->getAdminDetails($_SESSION['admin_id']);
            if ($adminDetails["all_rbac"])
                return true;
        }

        $sqlQuery = "SELECT id FROM users_subparts WHERE users_subparts_caption = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bind_param("s", $parts_caption);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        $partsResult = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            $partsId = $partsResult['id'];
            return $this->checkPermissionPart($_SESSION["rbac_id"], $partsId);


        } else {
            return null;
        }

    }

    private function checkPermissionInData($serializedData, $permission)
    {

        if ($serializedData != null) {
            $decodedData = unserialize($serializedData);
            if (is_array($decodedData)) {
                return in_array($permission, $decodedData);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    private function getPermissionData($table, $field, $rbac_id)
    {
        $sqlQuery = "SELECT $field FROM $table WHERE rbac_id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bind_param("i", $rbac_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        $arrResult = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            return $arrResult[$field];
        } else {
            return null;
        }
    }





    public function getUserDetails($userId)
    {
        if (isset($_SESSION['userDetails']) && @$_SESSION['userDetails']['id'] == $userId) {
            return $_SESSION['userDetails'];
        }

        $sqlQuery = "SELECT u.status, u.rbac_id, r.all_rbac, u.unit_id, u.role 
        FROM users u 
        JOIN rbac r ON u.rbac_id = r.id 
        WHERE u.id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();


        $arrResult = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            if ($arrResult['status'] === 'Active') {
                $_SESSION['userDetails'] = $arrResult;
                return $arrResult;
            } else {
                return false;
            }
        } else {
            return null;
        }
    }

    public function getAdminDetails($adminId)
    {
        if (isset($_SESSION['adminDetails']) && @$_SESSION['adminDetails']['id'] == $adminId) {
            return $_SESSION['adminDetails'];
        }

        $sqlQuery = "SELECT u.status, u.rbac_id, r.all_rbac, u.unit_id, u.role 
        FROM admins u 
        JOIN rbac r ON u.rbac_id = r.id 
        WHERE u.id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bind_param("i", $adminId);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();


        $arrResult = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            if ($arrResult['status'] === 'Active') {
                $_SESSION['adminDetails'] = $arrResult;
                return $arrResult;
            } else {
                return false;
            }
        } else {
            return null;
        }
    }
}
?>