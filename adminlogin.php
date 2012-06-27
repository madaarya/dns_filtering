<?php
session_start();
require_once("db.php"); 

$db = new DB;

$username = $_POST['username'];
$psw = sha1($_POST['password']);
$t = $_POST['login'];

	if($t) 
	{	
    	$cek = $db->login($username,$psw);
    		if(mysqli_num_rows($cek) == 1)
    		{
			$c = mysqli_fetch_array($cek);
			$_SESSION['userid'] = $c['userid'];
			$_SESSION['nama'] = $c['nama'];
			$_SESSION['level'] = $c['level'];
			$_SESSION['status'] = TRUE;
			if($c['level']== "admin")
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

