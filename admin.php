<?php
session_start(); // aktifkan fitur session



if(!$_SESSION['status']) // jika session status tidak aktif
{
header("location:adminlogin.php");
}

if(isset($_REQUEST['act'])) // jika tidak ada request aksi
{
session_destroy(); // matikan fitur session
header("location:adminlogin.php"); // arahkan ke lokasi adminlogin.php
}

?>
<html>
    <head>
        <title>Administrator page</title>
        <script type="text/javascript" src="javascript/jquery-1.7.min.js"></script>
        <link rel="stylesheet" href="css/admin_style.css" type="text/css" media="screen"/>
        <script type="text/javascript">
		$(document).ready(function() {
		
		$(".content").load("list_history.php"); // load file list_history,php, masukkan ke div content
		
		$("#list_history").click(function(){ //jika link dgn id list_history di klik maka :
			$(".content").load("list_history.php"); //// load file list_history,php, masukkan ke div content
		});
		
		$("#category").click(function(){ //jika link dgn id category di klik maka :
			$(".content").load("manage_category.php"); //load file manage_category,php, masukkan ke div content
		});
		
		$("#url").click(function(){
			$(".content").load("manage_url.php");
		});
		
		$("#message").click(function(){
			$(".content").load("manage_message.php");
		});
	});
	</script>
	
	<style>
	#pager
	{
	margin-left:20px; 
	margin-right:20px;
	
	}
	
	</style>
	
    </head>
    <body>
    <div id="core">
    <div class="core-content">
<h1>Hai <?php echo $_SESSION['nama']; //panggil data session nama ?></h1>
<br />
<span style="float:left; margin-left:50px">
<a href="#" id="list_history">History blocked</a><span id="pager">|</span> 
<a href="#" id="url">Manage url</a><span id="pager">|</span>
<a href="#" id="category">Manage category</a><span id="pager">|</span>
<a href="#" id="message">Message from user</a><span id="pager">|</span>
<a href="admin.php?act=logout" id="category" onclick="return confirm('Are you sure to logout ?')">Logout</a>
</span>

<br />
<br />

<div class="content"></div>

</div>
</div>
</body>
</html>
