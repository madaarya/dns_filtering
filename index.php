<?php
require_once("db.php");
require_once("myclass.php");
$db = new DB;
$m = new mada;
$browser = $m->get_browser();

$data['nama_komputer'] = gethostname();
// kalo output ga sesuai harapan gunakan yang di bawah
//$data['nama_komputer'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);

$data['browser'] = $browser['name'];
$data['url_server'] = $_SERVER['SERVER_NAME'];
$data['ip'] = $_SERVER['REMOTE_ADDR'];

$cek = $db->datalog($data);
$url = base64_encode($data['url_server']);

if($cek == 'iklan') //jika kategori url yang di panggil, arahkan ke blank page
	{
		header("location:blank.php");
	}
	else
	{
		header("location:response.php?url=$url");
	}

?>
