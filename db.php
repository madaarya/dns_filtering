<?php
require_once("config.php"); /* Configuration File */

class DB{
	
	private $link;
	
	public function __construct(){
		$this->link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
		if (mysqli_connect_errno())
		    exit();
	}
	
	public function __destruct() {
		mysqli_close($this->link);
	}
	
	public function login($username,$psw)
	{
		
		$query = "SELECT * FROM USER WHERE username='$username' AND password='$psw'";
		$r = mysqli_query($this->link,$query);
		return $r;
	}
	
	public function tambah_category($desc)
	{
		$query = "INSERT INTO REASONS_BLOCKED(pk_reasons,description) 
				  VALUES('NULL','$desc')";
		mysqli_query($this->link,$query);
	}
	
	public function tambah_url($kategori,$url)
	{
		$query = "INSERT INTO URL_BLOKED(pk_url,url_name,fk_reasons) 
				  VALUES('NULL','$url','$kategori')";
		mysqli_query($this->link,$query);
	}
	
	
	
	public function display_datalog($kategori=NULL)
	{
		if(!empty($kategori))
		{
		$query = "SELECT COUNT( * ) AS total_point, d.url_server, r.description
					FROM `DATALOG` d
					LEFT JOIN URL_BLOKED u ON u.url_name = d.url_server
					LEFT JOIN REASONS_BLOCKED r ON r.pk_reasons = u.fk_reasons
					WHERE u.fk_reasons = '$kategori'
					GROUP BY d.url_server
					ORDER BY total_point DESC";
		}
		else
		{
		$query = "SELECT COUNT( * ) AS total_point, d.url_server, r.description
					FROM `DATALOG` d
					LEFT JOIN URL_BLOKED u ON u.url_name = d.url_server
					LEFT JOIN REASONS_BLOCKED r ON r.pk_reasons = u.fk_reasons
					GROUP BY d.url_server
					ORDER BY total_point DESC";
		}
					
		$t = mysqli_query($this->link,$query);
		return $t;
	}
	
	public function display_url($kategori=NULL)
	{
		if(!empty($kategori))
		{
		$query = "SELECT u.url_name, r.description
					FROM `URL_BLOKED` u
					LEFT JOIN REASONS_BLOCKED r ON r.pk_reasons = u.fk_reasons
					WHERE u.fk_reasons = '$kategori'
					ORDER BY u.url_name DESC";
		}
		else
		{
		$query = "SELECT u.url_name, r.description
					FROM `URL_BLOKED` u
					LEFT JOIN REASONS_BLOCKED r ON r.pk_reasons = u.fk_reasons
					ORDER BY u.url_name DESC";
		}
					
		$t = mysqli_query($this->link,$query);
		return $t;
	}
	
	public function display_category()
	{
		$query = "SELECT * FROM REASONS_BLOCKED
				ORDER BY description DESC";
		$r = mysqli_query($this->link,$query);
		return $r;
	
	}
	
	public function dbNewMessage($email,$name,$message,$url){
		$email 	 	= mysqli_real_escape_string($this->link,$email);
		$name 		= mysqli_real_escape_string($this->link,$name);
		$message 	= mysqli_real_escape_string($this->link,$message);
		
		mysqli_autocommit($this->link,FALSE);
		
		$query = "INSERT INTO CONTACT(pk_contact,name,email,message,url_server) 
				  VALUES('NULL','$name','$email','$message','$url')";
		mysqli_query($this->link,$query);
		
		if(mysqli_errno($this->link))
			return -1;
		else{
			mysqli_commit($this->link);
			return 1;
		}
	}
	
	public function datalog($data){
		$ip 	 	= mysqli_real_escape_string($this->link,$data['ip']);
		$nama_komputer 	= mysqli_real_escape_string($this->link,$data['nama_komputer']);
		$browser 	= mysqli_real_escape_string($this->link,$data['browser']);
		$url_server 	= mysqli_real_escape_string($this->link,$data['url_server']);
		$waktu 		= date("Y-m-d H:i:s");
		
		mysqli_autocommit($this->link,FALSE);
		
		$query = "INSERT INTO DATALOG(pk_datalog,ip,nama_komputer,browser,url_server,waktu) 
				  VALUES('NULL','$ip','$nama_komputer','$browser','$url_server','$waktu')";
		mysqli_query($this->link,$query);
		
		if(mysqli_errno($this->link))
			return -1;
		else{
			mysqli_commit($this->link);
			return 1;
		}
	}      
};
?>
