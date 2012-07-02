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
	
	public function hapus_category($id_category)
	{
		$query = "DELETE FROM REASONS_BLOCKED WHERE pk_reasons='$id_category'";
		mysqli_query($this->link,$query);
	}
	
	
	public function tambah_url($kategori,$url)
	{
		$query = "INSERT INTO URL_BLOKED(pk_url,url_name,fk_reasons) 
				  VALUES('NULL','$url','$kategori')";
		mysqli_query($this->link,$query);
	}
	
	public function hapus_url($id_url)
	{
		$query = "DELETE FROM URL_BLOKED WHERE pk_url='$id_url'";
		mysqli_query($this->link,$query);
	}
	
	
	
	public function display_datalog($per_page,$start,$kategori=NULL)
	{
		if(!empty($kategori))
		{
		$query = "SELECT COUNT( * ) AS total_point, d.url_server, r.description
					FROM `DATALOG` d
					LEFT JOIN URL_BLOKED u ON u.url_name = d.url_server
					LEFT JOIN REASONS_BLOCKED r ON r.pk_reasons = u.fk_reasons
					WHERE u.fk_reasons = '$kategori'
					GROUP BY d.url_server
					ORDER BY total_point DESC
					LIMIT $start,$per_page";
		}
		else
		{
		$query = "SELECT COUNT( * ) AS total_point, d.url_server, r.description
					FROM `DATALOG` d
					LEFT JOIN URL_BLOKED u ON u.url_name = d.url_server
					LEFT JOIN REASONS_BLOCKED r ON r.pk_reasons = u.fk_reasons
					GROUP BY d.url_server
					ORDER BY total_point DESC
					LIMIT $start,$per_page";
		}
					
		$t = mysqli_query($this->link,$query);
		return $t;
	}
	
	public function display_datalog_all()
	{
		$query = "SELECT COUNT( * ) AS total_point, d.url_server, r.description
					FROM `DATALOG` d
					LEFT JOIN URL_BLOKED u ON u.url_name = d.url_server
					LEFT JOIN REASONS_BLOCKED r ON r.pk_reasons = u.fk_reasons
					GROUP BY d.url_server
					ORDER BY total_point DESC";
		$t = mysqli_query($this->link,$query);
		return $t;
	}
	
	public function display_message($per_page,$start)
	{
		$query = "SELECT pk_contact,name,email, LEFT(message,15) as pesan, added_date,status FROM CONTACT ORDER BY status ASC,added_date DESC 
		LIMIT $start,$per_page";
		$t = mysqli_query($this->link,$query);
		return $t;
	}
	
	public function display_message_all()
	{
		$query = "SELECT * FROM CONTACT ORDER BY status DESC";
		$t = mysqli_query($this->link,$query);
		return $t;
	}
	
	public function display_detail_message($id_message)
	{
		$query_one = "UPDATE CONTACT set STATUS='1' where pk_contact='$id_message'";
		mysqli_query($this->link,$query_one);
		
		$query = "SELECT * FROM CONTACT WHERE pk_contact = '$id_message'";
		$t = mysqli_query($this->link,$query);
		return $t;
	}
	
	public function hapus_message($id_message)
	{
		$query = "DELETE FROM CONTACT WHERE pk_contact='$id_message'";
		mysqli_query($this->link,$query);
	}
	
	public function display_detail_datalog_all($name)
	{
		$query = "SELECT * FROM DATALOG WHERE url_server = '$name' ORDER BY waktu DESC";
		$t = mysqli_query($this->link,$query);
		return $t;
	}
	
	public function display_detail_datalog($per_page,$start,$name)
	{
		$query = "SELECT * FROM DATALOG WHERE url_server = '$name' ORDER BY waktu DESC
		LIMIT $start,$per_page";
		$t = mysqli_query($this->link,$query);
		return $t;
	}
	
	
	
	public function display_url_all($kat=NULL)
	{
		if(empty($kat))
		{
			$query = "SELECT * FROM URL_BLOKED";
		}
		else
		{
			$query = "SELECT * FROM URL_BLOKED WHERE fk_reasons = '$kat'";
		}
		
		$r = mysqli_query($this->link,$query);
		return $r;
	}
	
	public function display_url($per_page,$start,$kat=NULL)
	{
		if(!empty($kat))
		{
		$query = "SELECT u.url_name, r.description, u.pk_url
					FROM `URL_BLOKED` u
					LEFT JOIN REASONS_BLOCKED r ON r.pk_reasons = u.fk_reasons
					WHERE u.fk_reasons = '$kat'
					ORDER BY u.url_name DESC
					LIMIT $start,$per_page ";
		}
		else
		{
		$query = "SELECT u.url_name, r.description, u.pk_url
					FROM `URL_BLOKED` u
					LEFT JOIN REASONS_BLOCKED r ON r.pk_reasons = u.fk_reasons
					ORDER BY u.url_name DESC
					LIMIT $start,$per_page ";
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
	
	
	public function datalog($data){
		$ip 	 	= mysqli_real_escape_string($this->link,$data['ip']);
		$nama_komputer 	= mysqli_real_escape_string($this->link,$data['nama_komputer']);
		$browser 	= mysqli_real_escape_string($this->link,$data['browser']);
		$url_server 	= mysqli_real_escape_string($this->link,$data['url_server']);
		$waktu 		= date("Y-m-d H:i:s");
		
		$query = "INSERT INTO DATALOG(pk_datalog,ip,nama_komputer,browser,url_server,waktu) 
				VALUES('NULL','$ip','$nama_komputer','$browser','$url_server','$waktu')";
		mysqli_query($this->link,$query);
		
		$query = "SELECT r.description
				FROM `URL_BLOKED` u
				LEFT JOIN REASONS_BLOCKED r ON r.pk_reasons = u.fk_reasons
		 WHERE u.url_name = '$url_server'";
		$m = mysqli_query($this->link,$query);
		
		$r = $m->fetch_array();
		$tipe =  $r['description'];
		return $tipe;
	}
	
	public function dbNewMessage($email,$name,$message,$url){
		$email 	 	= mysqli_real_escape_string($this->link,$email);
		$name 		= mysqli_real_escape_string($this->link,$name);
		$message 	= mysqli_real_escape_string($this->link,$message);
		$url 	= mysqli_real_escape_string($this->link,$url);
		$stat		= 0; //berarti belum di baca
		$waktu 		= date("Y-m-d H:i:s");	
		
		mysqli_autocommit($this->link,FALSE);
		
		$query = "INSERT INTO CONTACT(pk_contact,name,email,message,added_date,url_server,status) 
				  VALUES('NULL','$name','$email','$message','$waktu','$url','$stat')";
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
