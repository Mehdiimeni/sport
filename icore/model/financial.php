<?php

#[AllowDynamicProperties]
class Financial
{
    private $userRemitTable = 'remittance_data';
    private $scheduleTable = 'schedule';
    private $userRemitF1Table = 'remittance_form1';
    private $userRemitF2Table = 'remittance_form2';
    private $userRemitF3Table = 'remittance_form3';
    private $userRemitF4Table = 'remittance_form4';
    private $forwardsTable = 'forwards';
    private $userTable = 'users';
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function returnFakeData()
    {
        $this->fakeTotal = 747;
    }

    function getUserIdFromSession()
    {
        if (isset($_SESSION["user_id"])) {
            return $_SESSION["user_id"];
        } elseif (isset($_SESSION["admin_id"])) {
            return $_SESSION["admin_id"];
        } else {
            return 0;
        }
    }


    function generateSqlWhereFromSession()
    {
        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
            return "user_id = " . $user_id;
        } elseif (isset($_SESSION["admin_id"])) {
            return " 1 ";
        } else {
            return null;
        }
    }

    public function getTotalRemittance()
    {
        $sqlWhere = '';

        $sqlWhere = $this->generateSqlWhereFromSession();

        $stmt = $this->conn->prepare("SELECT count(*) AS total
            FROM " . $this->userRemitTable . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        $reply = $result->fetch_assoc();
        return $reply['total'];

    }

    public function getTotalForm1()
    {
        $sqlWhere = '';

        $sqlWhere = $this->generateSqlWhereFromSession();

        $stmt = $this->conn->prepare("SELECT count(*) AS total
            FROM " . $this->userRemitF1Table . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        $reply = $result->fetch_assoc();
        return $reply['total'];

    }

    public function getTotalForm2()
    {
        $sqlWhere = '';

        $sqlWhere = $this->generateSqlWhereFromSession();

        $stmt = $this->conn->prepare("SELECT count(*) AS total
            FROM " . $this->userRemitF2Table . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        $reply = $result->fetch_assoc();
        return $reply['total'];

    }

    public function getTotalForm3()
    {
        $sqlWhere = '';

        $sqlWhere = $this->generateSqlWhereFromSession();

        $stmt = $this->conn->prepare("SELECT count(*) AS total
            FROM " . $this->userRemitF3Table . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        $reply = $result->fetch_assoc();
        return $reply['total'];

    }

    public function getTotalForm4()
    {
        $sqlWhere = '';

        $sqlWhere = $this->generateSqlWhereFromSession();

        $stmt = $this->conn->prepare("SELECT count(*) AS total
            FROM " . $this->userRemitF4Table . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        $reply = $result->fetch_assoc();
        return $reply['total'];

    }

    public function getRemittance()
    {

        $user_id = $_SESSION["user_id"];
        $sqlWhere = "   user_id = " . $user_id;

        $stmt = $this->conn->prepare("SELECT *
            FROM " . $this->userRemitTable . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }

    public function getRemittanceForm1()
    {

        $user_id = $_SESSION["user_id"];
        $sqlWhere = "   user_id = " . $user_id;

        $stmt = $this->conn->prepare("SELECT *
            FROM " . $this->userRemitF1Table . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }

    public function getRemittanceForm2()
    {

        $user_id = $_SESSION["user_id"];
        $sqlWhere = "   user_id = " . $user_id;

        $stmt = $this->conn->prepare("SELECT *
            FROM " . $this->userRemitF2Table . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }

    public function getRemittanceForm3()
    {

        $user_id = $_SESSION["user_id"];
        $sqlWhere = "   user_id = " . $user_id;

        $stmt = $this->conn->prepare("SELECT *
            FROM " . $this->userRemitF3Table . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }

    public function getRemittanceForm4()
    {

        $user_id = $_SESSION["user_id"];
        $sqlWhere = "   user_id = " . $user_id;

        $stmt = $this->conn->prepare("SELECT *
            FROM " . $this->userRemitF4Table . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }

    public function getRemittanceForm4Active()
    {

        $user_id = $_SESSION["user_id"];
        $sqlWhere = " status = 'Acepted' and  user_id = " . $user_id;

        $stmt = $this->conn->prepare("SELECT *
            FROM " . $this->userRemitF4Table . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }

    public function getForwardsAdmin($tableName, $receiver_person_id, $receiver_rbac_id, $receiver_type, $receiver_part_name, $isEntry, $role = '')
    {
        $joinType = $isEntry ? "!=" : "=";

        if ($role == '' or $role != 'all') {
            $sqlQuery = "SELECT t.* 
                     FROM $this->forwardsTable f
                     JOIN $tableName t ON f.section_element_id $joinType t.id
                     WHERE (f.receiver_person_id = ? OR f.receiver_rbac_id = ?) 
                     AND f.receiver_type = ? 
                     AND f.receiver_part_name = ?";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bind_param("iiss", $receiver_person_id, $receiver_rbac_id, $receiver_type, $receiver_part_name);
        } else {
            $sqlQuery = "SELECT t.* 
             FROM $this->forwardsTable f
             RIGHT JOIN $tableName t ON f.section_element_id $joinType t.id
             GROUP BY t.id";
            $stmt = $this->conn->prepare($sqlQuery);

        }



        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getSchedule($section_part_name, $section_element_id)
    {
        $sqlQuery = "SELECT * FROM $this->scheduleTable WHERE section_part_name =? AND section_element_id =? ORDER BY date_time ASC";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bind_param("si", $section_part_name, $section_element_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getRemittanceById($id)
    {
        $sql = "SELECT * FROM $this->userRemitTable WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getRemittanceF1ById($id)
    {
        $sql = "SELECT * FROM $this->userRemitF1Table WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getRemittanceF2ById($id)
    {
        $sql = "SELECT * FROM $this->userRemitF2Table WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getRemittanceF3ById($id)
    {
        $sql = "SELECT * FROM $this->userRemitF3Table WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getRemittanceF4ById($id)
    {
        $sql = "SELECT * FROM $this->userRemitF4Table WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();


        return $result;
    }

    public function getRemittanceByUserId($user_id)
    {
        $sqlWhere = "   user_id = " . $user_id;
        $stmt = $this->conn->prepare("SELECT *
            FROM " . $this->userRemitTable . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }

}

?>