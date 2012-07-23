
<div class="isi">
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

.prev
{
list-style: none; 
float: left; 
margin-right: 16px; 
padding:5px; 
border:solid 1px #dddddd;
color:#0063DC;
text-decoration : none;
} 

.prev:hover
{ 
color:#FF0084; 
cursor: pointer;
}



</style>
<?php

$name = $_GET['name_url'];

$per_page = 100; 
$db = new DB;

//Calculating no of pages
$sql = $db->display_detail_datalog_all($name);
$count = mysqli_num_rows($sql);
$pages = ceil($count/$per_page);
?>
<div style="display:none" id="jml_halaman" class="<?php echo $pages; ?>"></div>
<div style="display:none" id="nama" class="<?php echo $name; ?>"></div>


<p>Menu manage Url blocked</p>
<script type="text/javascript">
$(document).ready(function() {
	
	var page = 1;
	
	var nama = $("#nama").attr("class");
	
	$("#pagination li:first")
	.css({'color' : '#FF0084'}).css({'border' : 'none'});
	Display_Load();
	
	$("#content").load("data_detail_datalog.php", "page="+page+"&name="+nama);

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
	
	$("#last")
	.css({'color' : '#0063DC'})
	.css({'border' : 'solid 1px #dddddd'});
	
	$("#first")
	.css({'color' : '#0063DC'})
	.css({'border' : 'solid 1px #dddddd'});
	

	$(this)
	.css({'color' : '#FF0084'})
	.css({'border' : 'none'});
	//Loading Data
	var pageNum = this.id;
	$("#content").load("data_detail_datalog.php", "page="+pageNum+"&name="+nama);
	});
	
	// first function
	$("#first").click(function(){
	
	$("#first")
	.css({'border' : 'none'})
	.css({'color' : '#FF0084'});

	$("#pagination li")
	.css({'color' : '#0063DC'})
	.css({'border' : 'solid 1px #dddddd'});
	
	$("#last")
	.css({'color' : '#0063DC'})
	.css({'border' : 'solid 1px #dddddd'});
	
	$("#prev").hide();
	$("#next").show();
	
	var first = 'first';
	$("#content").load("data_detail_datalog.php", "page="+first+"&name="+nama);
	});

	//last function
	$("#last").click(function(){
	
	$("#last")
	.css({'border' : 'none'})
	.css({'color' : '#FF0084'});

	$("#first")
	.css({'color' : '#0063DC'})
	.css({'border' : 'solid 1px #dddddd'});

	$("#pagination li")
	.css({'color' : '#0063DC'})
	.css({'border' : 'solid 1px #dddddd'});
	
		$("#next").hide();
	var last = 'last';
	$("#content").load("data_detail_datalog.php", "page="+last+"&name="+nama);
	});
	
	
	// next function
	$("#next").click(function(){
	
	var next = 'next';
	var nilai = $("#paging").attr("class");
	var jml_halaman = $("#jml_halaman").attr("class");
	var new_page = $("#paging2").val();
	//alert(new_page);
	//alert(new_page);
	/*$.ajax({
					type:"POST",
					url: "mada.php",
					data: "nilai="+nilai,
					success:function(pesan){
						$("#hasil").html(pesan);
						
					}											
			});
	*/
		/*var hasil = $("#hasil").text();
		if(hasil == '')
		{
			$("#first").show();
			$("#prev").show();
		}*/
		
		if(new_page == jml_halaman)
		{
		$("#next").hide();
		}
		else
		{
		$("#content").load("data_detail_datalog.php", "page="+next+"&name="+nama+"&nilai="+nilai);
			
		}
	
		$("#prev").show();
		$("#first").show();
	
	
	});
	
	
	// prev function
	$("#prev").click(function(){
	
	var prev = 'prev';
	var nilai = $("#paging").attr("class");
	var jml_halaman = $("#jml_halaman").attr("class");
	var jml = jml_halaman - 1;
	var new_page = $("#paging2").val();
	/*
	$.ajax({
					type:"POST",
					url: "mada.php",
					data: "nilai="+nilai,
					success:function(pesan){
						$("#hasil").html(pesan);
						
					}											
			});*/
	$("#next").show();		
	if(new_page == 1)
		{
		$("#prev").hide();
		}
	else{
		$("#content").load("data_detail_datalog.php", "page="+prev+"&name="+nama+"&nilai="+nilai);
		}
	
	//alert(hasil);
		/*if(hasil == '')
		{
			$("#first").show();
			$("#prev").show();
		}*/
	
	});
	
});
</script>


<div id="loading"></div>

<div id="content"></div>
<p id="hasil"></p>
<ul id="pagination">
<a class="prev" style="display:none" href="#" id="first">First</a>
<a class="prev" style="display:none" href="#" id="prev">Prev</a>
<?php
//Pagination Numbers

/*for($i=1; $i<=$pages; $i++)
{
echo '<li class"paging" id="'.$i.'">'.$i.'</li>';
}
*/
?>
<a class="prev" href="#" id="next">Next</a>
<a class="prev" href="#" id="last">Last</a>

</ul>

</div>
