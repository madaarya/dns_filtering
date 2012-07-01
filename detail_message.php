<?php
require_once("db.php");
require_once("myclass.php");
$m = new mada;
$db = new DB;

$id_message = $_GET['id_message'];

$data = $db->display_detail_message($id_message);
$message = $data->fetch_array();
?>
<p>
Url &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span style="margin-left : 50px"><?php echo $message['url_server']; ?></span>
</p>

<p>
<span style="float:left">Name &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:</span><span style="margin-left : 50px"><?php echo $message['name'] ?></span>
</p>

<p>
<span style="float:left">Email</span> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;: <span style="margin-left : 50px"><?php echo $message['email'] ?></span>
</p>

<p>
<span style="float:left">Message &nbsp;: </span><span style="margin-left : 50px"><?php echo $message['message'] ?></span>
</p>

<p>
<span style="float:left">Time&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;: </span><span style="margin-left : 50px"><?php echo $m->set_waktu($message['added_date']); ?></span>
</p>
