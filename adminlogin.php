<?php
session_start();
require_once("db.php"); // ambil fungsi2 yg ada di file db.php

$db = new DB; // inisialisasi objek dr class DB

// tangkap input login
$username = $_POST['username']; 
$psw = sha1($_POST['password']);
$t = $_POST['login'];

	if($t) 
	{	
    	$cek = $db->login($username,$psw);
    		if(mysqli_num_rows($cek) == 1) // jika query menghasilkan 1
    		{
			$c = mysqli_fetch_array($cek); // pisahkan array
			$_SESSION['userid'] = $c['userid']; // set session
			$_SESSION['nama'] = $c['nama'];
			$_SESSION['level'] = $c['level'];
			$_SESSION['status'] = TRUE;
			if($c['level']== "admin") // jika level yg loginnya admin
			{
			    header("location:admin.php");
			}
			else 
			{
			    echo "maaf anda bukan admin";
			}
    		}
    		else
    		{
    			echo "login gagal";
    		}
	}
?>


<html>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
    </head>
    <body>
        <div id="contact">
        <form action="adminlogin.php" method="POST">
        	<p>
                    <label>Username</label>
                    <input name="username" maxlength="120" type="text" autocomplete="off"/>
                </p>
                <p>
                    <label>Password</label>
                    <input name="password" maxlength="120" type="password" autocomplete="off"/>
                    <input type="hidden" value="yes" name="login" />
                </p>
                <p>
                	<input type="submit" value="Login"  />
                </p>
           </form>
        </div>
    </body>
</html>    

