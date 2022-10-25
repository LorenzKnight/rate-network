<?php 
require_once('connections/conexion.php');

$user_id = $_SESSION['rt_UserId'];

// $user = u_all_info($user_id);

$publication = post_wall_profile(); 

// header('Content-type: text/xml');
// echo '<taconite><eval><![CDATA[' . "\n";
// echo '$("#names").empty();';
// echo '$("#names").append("'.$html.'");';
// echo '$("#showinfo-modal").show();';
// echo ']]></eval></taconite>';
?>