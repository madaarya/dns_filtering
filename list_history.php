<?php
require_once("db.php");
?>

<style>
li
{ 
list-style: none; 
float: left; 
margin-right: 16px; 
padding:5px; 
border:solid 1px #dddddd;
color:#0063DC; 
}

li:hover
{ 
color:#FF0084; 
cursor: pointer; 
}

</style>
<div class="isi">
<?php
$per_page = 5; 
$db = new DB;

//$kat = $_POST['kategori'];

//Calculating no of pages
$sql = $db->display_datalog_all();
$count = mysqli_num_rows($sql);
$pages = ceil($count/$per_page);
?>

<p>Menu manage Url blocked</p>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#pagination li:first")
	.css({'color' : '#FF0084'}).css({'border' : 'none'});
	Display_Load();
	
	
	$("#content").load("data_list.php?page=1", Hide_Load());

	function Display_Load()
	{
	$("#loading").fadeIn(600,0);
	}
	
	function Hide_Load()
	{
	$("#loading").fadeOut('slow');
	};
	
	$("#pagination li").click(function(){
	Display_Load();
	//CSS Styles
	$("#pagination li")
	.css({'border' : 'solid #dddddd 1px'})
	.css({'color' : '#0063DC'});

	$(this)
	.css({'color' : '#FF0084'})
	.css({'border' : 'none'});
	//Loading Data
	var pageNum = this.id;
	
	$("#content").load("data_list.php?page=" + pageNum, Hide_Load());
	});



});
</script>


<div id="loading"></div>
<div id="content"></div>
<ul id="pagination">
<?php
//Pagination Numbers
for($i=1; $i<=$pages; $i++)
{
echo '<li id="'.$i.'">'.$i.'</li>';
}
?>
</ul>


</div>
