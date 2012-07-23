<?php
require_once("db.php");

$db = new DB;

$desc = $_POST['desc']; // tangkap inputan post
$url = $_POST['url'];
$kategori = $_POST['category'];
$id_category = $_POST['id_category'];
$id_url = $_POST['id_url'];

$id_message = $_POST['id_message'];

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

//aksi hapus category
if(isset($id_category))
{
	$db->hapus_category($id_category);
}


// aksi hapus url
if(isset($id_url))
{
	$db->hapus_url($id_url);
}


// aksi hapus message
if(isset($id_message))
{
	$db->hapus_message($id_message);
}

?>

