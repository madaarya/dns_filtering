<?php
session_start();

if(!$_SESSION['status'])
{
header("location:adminlogin.php");
}

if(isset($_REQUEST['act']))
{
session_destroy();
header("location:adminlogin.php");
}

?>
<html>
    <head>
        <title>Administrator page</title>
        <script type="text/javascript" src="javascript/jquery-1.7.min.js"></script>
        <link rel="stylesheet" href="css/admin_style.css" type="text/css" media="screen"/>
        <script type="text/javascript">
		$(document).ready(function() {
		
		$(".content").load("list_history.php");
		
		$("#list_history").click(function(){
			$(".content").load("list_history.php");
		});
		
		$("#category").click(function(){
			$(".content").load("manage_category.php");
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
<h1>Hai <?php echo $_SESSION['nama']; ?></h1>
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
