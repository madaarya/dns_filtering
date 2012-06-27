<?php
session_start();
require_once("db.php");

$data['ip'] = $_SERVER['REMOTE_ADDR'];

$data['nama_komputer'] = gethostname();
// kalo uotput ga sesuai harapan gunakan yang di bawah
//$data['nama_komputer'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);

$data['browser'] = $_SERVER['HTTP_USER_AGENT'];
$data['url_server'] = $_SERVER['SERVER_NAME'];
//$data['waktu'] = $_SESSION['waktu'];

$db = new DB;

$db->datalog($data);

$url = $data['url_server'];

header("location:response.php?url=$url");
?>

