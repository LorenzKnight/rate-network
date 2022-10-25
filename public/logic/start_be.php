<?php 
require_once('connections/conexion.php');

if(!empty($_SESSION['rt_UserId']))
{
    $id = $_SESSION['rt_UserId'];
    // $id = 2;
    $user = u_all_info($id);

    $publication = post_wall_profile(); 

//    var_dump($publication);
    

    // header('Content-type: text/xml');
    // echo '<taconite><eval><![CDATA[' . "\n";
    // echo '$("#names").empty();';
    // echo '$("#names").append("'.$html.'");';
    // echo '$("#showinfo-modal").show();';
    // echo ']]></eval></taconite>';
}


?>