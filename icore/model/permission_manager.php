<?php

#[AllowDynamicProperties]

class PermissionManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function hasPermission($userId, $operation, $activityId, $companyId, $unitId) {
        // اینجا کد بررسی دسترسی‌ها از دیتابیس را قرار بدهید
        // اگر دسترسی وجود داشته باشد، true برگردانید، در غیر اینصورت false

        $roleId = $this->getUserRoleId($userId);

        if (!$roleId) {
            // اگر نقش کاربر در دیتابیس وجود نداشته باشد
            return false;
        }

        $permissionOperation = $this->getPermissionOperation($roleId, $operation);
        $permissionStructure = $this->getPermissionStructure($roleId, $activityId, $companyId, $unitId);

        if ($permissionOperation && $permissionStructure) {
            return true;
        }

        return false;
    }

    private function getUserRoleId($userId) {
        // با توجه به userId، نقش کاربر را از دیتابیس بازیابی کنید
        // اینجا یک نمونه از کد می‌آید، شما باید آن را با فرآیند مدیریت کاربران خود جایگزین کنید
        $stmt = $this->db->prepare("SELECT role_id FROM user_roles WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['role_id'];
        }

        return null;
    }

    private function getPermissionOperation($roleId, $operation) {
        // با توجه به roleId و operation، دسترسی عملیات را از دیتابیس بازیابی کنید
        // اینجا یک نمونه از کد می‌آید، شما باید آن را با جزئیات مدل دیتابیس خود جایگزین کنید
        $stmt = $this->db->prepare("SELECT * FROM permissions_operation WHERE role_id = ? AND operation_id = ?");
        $stmt->bind_param("ii", $roleId, $operation);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    private function getPermissionStructure($roleId, $activityId, $companyId, $unitId) {
        // با توجه به roleId و سایر پارامترها، دسترسی ساختار را از دیتابیس بازیابی کنید
        // اینجا یک نمونه از کد می‌آید، شما باید آن را با جزئیات مدل دیتابیس خود جایگزین کنید
        $stmt = $this->db->prepare("SELECT * FROM permissions_structure WHERE role_id = ? AND activity_id = ? AND company_id = ? AND unit_id = ?");
        $stmt->bind_param("iiii", $roleId, $activityId, $companyId, $unitId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }
}
?>
