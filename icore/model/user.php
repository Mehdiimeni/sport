<?php

#[AllowDynamicProperties]
class User
{

	private $userTable = 'users';
	private $cardRegisterTable = 'card_register';
	private $userPositionTable = 'user_position';
	private $provincesTable = 'organization_provinces';
	private $federationsTable = 'organization_federations';
	private $userAchievementTable = 'user_achievement';
	private $fileTable = 'file_manage';
	private $companyTable = 'company_profiles';
	private $unitTable = 'units';
	private $userLogTable = 'user_log';
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}


	public function user_log($action)
	{

		$sqlQuery = "INSERT INTO " . $this->userLogTable . "(`user_id`, `action`) VALUES (?,?)";
		$stmt = $this->conn->prepare($sqlQuery);

		$action = htmlspecialchars(strip_tags($action));

		$stmt->bind_param("is", $_SESSION["user_id"], $action);

		if ($stmt->execute()) {
			return true;
		}
	}


	public function getPosition()
    {

        $user_id = $_SESSION["user_id"];
        $sqlWhere = "   user_id = " . $user_id;

        $stmt = $this->conn->prepare("SELECT *
            FROM " . $this->userPositionTable . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }


	public function getPositionById($id)
    {
        $sql = "SELECT * FROM $this->userPositionTable WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

	public function getAchievementById($id)
	{
		$sql = "SELECT ua.*, op.provinces_name, of.federations_name 
				FROM $this->userAchievementTable ua 
				LEFT JOIN organization_provinces op ON ua.provinces_id = op.id
				LEFT JOIN organization_federations of ON ua.federations_id = of.id
				WHERE ua.id = ?";
	
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
	
		$result = $stmt->get_result();
		$stmt->close();
	
		return $result;
	}
	


	public function getProvinceActive()
    {

        $sqlWhere = " 1 ";

        $stmt = $this->conn->prepare("SELECT *
            FROM " . $this->provincesTable . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }

	public function getFederationActive()
    {

        $sqlWhere = " 1 ";

        $stmt = $this->conn->prepare("SELECT *
            FROM " . $this->federationsTable . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }


	

	public function getAchievement()
    {

        $user_id = $_SESSION["user_id"];
        $sqlWhere = "   user_id = " . $user_id;

        $stmt = $this->conn->prepare("SELECT *
            FROM " . $this->userAchievementTable . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }


	public function login()
	{
		if ($this->email && $this->password) {

			$sqlQuery = "
				SELECT user.*, unit.unit_name as user_unit, unit.id as unit_id, company.company_name as user_company , company.id as  company_id FROM " . $this->userTable . " user
				left join " . $this->unitTable . " unit on user.unit_id = unit.id
				 join " . $this->companyTable . " company on unit.company_id = company.id
				WHERE user.email = ? AND user.password = ?";

			$stmt = $this->conn->prepare($sqlQuery);
			$password = md5($this->password);

			$stmt->bind_param("ss", $this->email, $password);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows > 0) {
				$user = $result->fetch_assoc();
				$_SESSION["user_id"] = $user['id'];
				$_SESSION["role"] = $user['role'];
				$_SESSION["mobile"] = $user['mobile'];
				$_SESSION["name"] = $user['name'];
				$_SESSION["email"] = $user['email'];
				$_SESSION["user_company"] = $user['user_company'];
				$_SESSION["user_unit"] = $user['user_unit'];
				$_SESSION["unit_id"] = $user['unit_id'];
				$_SESSION["company_id"] = $user['company_id'];


				// profile image 

				$sqlQuery2 = "SELECT file_name,file_path FROM file_manage WHERE  part_name = 'user_profile' AND part_id = " . $_SESSION["user_id"] . " AND  user_id = " . $_SESSION["user_id"];

				$stmt2 = $this->conn->prepare($sqlQuery2);
				$stmt2->execute();
				$result2 = $stmt2->get_result();
				if ($result2->num_rows > 0) {
					$imege_profile = $result2->fetch_assoc();
					$_SESSION["profile_image_name"] = $imege_profile['file_name'];
					$_SESSION["profile_image_path"] = $imege_profile['file_path'];
				} else {

					$_SESSION["profile_image_name"] = "avatar-1.jpg";
					$_SESSION["profile_image_path"] = "./itheme/panel/images/users/";

				}
				$this->user_log('login');
				return 1;

			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	public function register()
	{
		if ($this->email && $this->password && $this->name && $this->mobile) {
			// بررسی تکراری نبودن ایمیل و شماره موبایل
			// بررسی تکراری نبودن ایمیل و موبایل
			$sql = "SELECT COUNT(*) AS count FROM $this->userTable  WHERE email = ? OR mobile = ?";
			$stmt = $this->conn->prepare($sql);

			$stmt->bind_param("ss", $this->email, $this->mobile);
			$stmt->execute();
			$result = $stmt->get_result();
			$reply = $result->fetch_assoc();

			if ($reply['count'] > 0) {
				// اگر کاربر با ایمیل یا شماره موبایل تکراری وجود داشته باشد، انتقال به مرحله بعدی امکان پذیر نیست

				return 0;
			}

			// ایجاد یک کاربر جدید
			$sql = "INSERT INTO $this->userTable  (email, password, name, mobile, role, status, unit_id, rbac_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $this->conn->prepare($sql);
			$this->email = htmlspecialchars(strip_tags($this->email));
			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->mobile = htmlspecialchars(strip_tags($this->mobile));
			$password = md5($this->password);
			$role = 'member';
			$status = 'Active';
			$unit_id = 2;
			$rbac_id = 3;

			$stmt->bind_param("ssssssii", $this->email, $password, $this->name, $this->mobile, $role, $status, $unit_id, $rbac_id);

			$stmt->execute();
			// ارسال ایمیل تأیید ثبت‌نام یا اجرای دیگر فعالیت‌های مرتبط

			// با موفقیت ثبت‌نام شد
			return ($this->login());
		} else {
			// اگر هر یک از فیلدها پر نشده بود، امکان ثبت‌نام وجود ندارد
			return 0;
		}
	}


	public function card_register()
	{

		$sql = "SELECT COUNT(*) AS count FROM $this->cardRegisterTable where user_id = ?";
		$stmt = $this->conn->prepare($sql);

		$stmt->bind_param("i", $_SESSION["user_id"]);
		$stmt->execute();
		$result = $stmt->get_result();
		$reply = $result->fetch_assoc();

		if ($reply['count'] > 0) {
			// اگر کاربر با ایمیل یا شماره موبایل تکراری وجود داشته باشد، انتقال به مرحله بعدی امکان پذیر نیست

			return 1;
		} else {
			// اگر هر یک از فیلدها پر نشده بود، امکان ثبت‌نام وجود ندارد
			return 0;
		}
	}



	function getTopPerforming()
	{

		$sqlQuery = "
		SELECT
    u.id,
    u.name,
    units.unit_name,
    cp.company_name,
    COUNT(ul.id) AS login_count
FROM
    users u
LEFT JOIN (
    SELECT
        created_by AS user_id,
        COUNT(*) AS reply_count
    FROM
        ticket_replies
    GROUP BY
        created_by
) tr ON u.id = tr.user_id
LEFT JOIN units ON u.unit_id = units.id
LEFT JOIN company_profiles cp ON units.company_id = cp.id
LEFT JOIN user_log ul ON u.id = ul.user_id AND ul.action = 'login'
WHERE
    units.id IS NOT NULL
GROUP BY
    u.id,
    u.name,
    units.id,
    units.unit_name
ORDER BY
login_count DESC
LIMIT 15;
";

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}


	function getLastLoginUsers()
	{
		$sqlQuery = "
		SELECT
		u.id AS user_id,
		u.name AS name,
		ul.login_time AS last_login_time,
		units.unit_name,
		cp.company_name
	FROM
		users u
	LEFT JOIN (
		SELECT
			user_id,
			MAX(timestamp) AS login_time
		FROM
			user_log
		WHERE
			action = 'login' 
		GROUP BY
			user_id
	) ul ON u.id = ul.user_id
	LEFT JOIN units ON u.unit_id = units.id
	LEFT JOIN company_profiles cp ON units.company_id = cp.id
	ORDER BY
		ul.login_time DESC
	LIMIT 14
	
";

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	public function isAdmin()
	{
		if ($_SESSION["role"] == 'admin') {
			return 1;
		} else {
			return 0;
		}
	}

	public function loggedIn()
	{
		if (isset($_SESSION["user_id"]) and !empty($_SESSION["user_id"])) {
			return 1;
		} else {
			return 0;
		}
	}


	public function getUsers()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->userTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}

	public function getUserImageById($id)
	{
		$sqlQuery = "SELECT users.name, users.email, users.mobile, file_manage.file_name, file_manage.file_path
					 FROM " . $this->userTable . " AS users
					 LEFT JOIN " . $this->fileTable . " AS file_manage ON users.id = file_manage.user_id
					 WHERE users.id = ? AND file_manage.part_name = 'user_profile'";

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		} else {
			return null;
		}
	}



	public function getUsersById($id)
	{
		$sqlQuery = "SELECT *
        FROM " . $this->userTable . " WHERE id = ? ";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		} else {
			return null;
		}

	}

	public function getUnitNameById($id)
	{


		$sqlQuery = "SELECT unit_name,company_id FROM " . $this->unitTable . " WHERE id = ?";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		} else {
			return null;
		}

	}



}
?>