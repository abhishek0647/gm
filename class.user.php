<?php

error_reporting(0);

require_once 'dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($uname,$email,$upass,$code, $establishmentName, $contactPerson, $mobNumber)
	{
		try
		{	
			echo "test";						
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO tbl_users(userName,userEmail,userPass,tokenCode, establishmentName, contactPerson, mobNumber) VALUES(:user_name, :user_mail, :user_pass, :active_code, :establishment_name, :contact_person, :mobile_number)");

			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->bindparam(":establishment_name", $establishmentName);
			$stmt->bindparam(":contact_person", $contactPerson);
			$stmt->bindparam(":mobile_number", $mobNumber);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function placeOrder($uid, $unitPrice, $quantity, $vatAmount, $finalprice, $firstname, $lastname, $tperson, $contactNum, $addr1, $addr2, $city, $pincode) {

		try {
			$stmt = $this->conn->prepare("INSERT INTO tbl_orders(uid, unitPrice, quantity, vatAmount, finalprice, firstname, lastname, tperson, contactNum, addr1, addr2, city, pincode) VALUES(:user_id, :unit_price, :quantity, :vat_amount, :final_price, :first_name, :last_name, :contact_person_order, :contact_number, :addr_line_1, :addr_line_2, :city, :pincode)");

			$stmt->bindparam(":user_id",$uid);
			$stmt->bindparam(":unit_price", $unitPrice);
			$stmt->bindparam(":quantity", $quantity);
			$stmt->bindparam(":vat_amount", $vatAmount);
			$stmt->bindparam(":final_price", $finalprice);
			$stmt->bindparam(":first_name", $finalprice);
			$stmt->bindparam(":last_name", $lastname);
			$stmt->bindparam(":contact_person_order", $tperson);
			$stmt->bindparam(":contact_number", $contactNum);
			$stmt->bindparam(":addr_line_1", $addr1);
			$stmt->bindparam(":addr_line_2", $addr2);
			$stmt->bindparam(":city", $city);
			$stmt->bindparam(":pincode", $pincode);
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $ex) {
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['userID'];
						return true;
					}
					else
					{
						header("Location: login.php?error");
						exit;
					}
				}
				else
				{
					header("Location: login.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: login.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="your_gmail_id_here@gmail.com";  
		$mail->Password="your_gmail_password_here";            
		$mail->SetFrom('your_gmail_id_here@gmail.com','GasMarket.in');
		$mail->AddReplyTo("your_gmail_id_here@gmail.com","GasMarket.in");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}	
}