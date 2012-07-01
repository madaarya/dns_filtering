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
Url : <?php echo $message['url_server']; ?>
</p>

<p>
Name : <span style="margin-left : 50px"><?php echo $message['name'] ?></span>
</p>

<p>
Email : <span style="margin-left : 50px"><?php echo $message['email'] ?></span>
</p>

<p>
Message : <span style="margin-left : 50px"><?php echo $message['message'] ?></span>
</p>

<p>
Time : <span style="margin-left : 50px"><?php echo $m->set_waktu($message['added_date']); ?></span>
</p>
