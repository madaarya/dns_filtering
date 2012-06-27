<?php
require_once("db.php");

$db = new DB;

$desc = $_POST['desc'];
$url = $_POST['url'];
$kategori = $_POST['category'];

// aksi tambah kategori
if(isset($desc))
{
	if(!empty($desc))
	{
		$db->tambah_category($desc);
		echo "1"; 
	}
	else
	{
		echo "-1";
	}
}


//aksi tambah url server
if(isset($url))
{
	if(!empty($kategori) and !empty($url))
	{
		$db->tambah_url($kategori,$url);
		echo "1"; 
	}
	else
	{
		echo "-1";
	}
}



?>

