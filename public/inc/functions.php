<?php 
function comprobaremailunico($email)
{
	$query_ConsultaFuncion = "SELECT email FROM users WHERE email = $email";
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = pg_query($query_ConsultaFuncion);
	$totalRows_ConsultaFuncion = pg_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion==0)
    {
        return true;
    }
		
    return false;
	
	pg_free_result($ConsultaFuncion);
}

function u_all_info($id = null) : array
{
  if(!empty($id))
  {
      $query_postwall = "SELECT * FROM users WHERE user_id = $id";
  }
  else
  {
      $query_postwall = "SELECT * FROM users ORDER BY user_id ASC";
  }
  $sql = pg_query($query_postwall);
  $totalRows_infouser = pg_num_rows($sql);
  
  $res = [
      'name'        => false,
      'surname'     => false,
      'image'       => false,
      'email'       => false,
      'rate'        => false
  ];
  
  if(!empty($totalRows_infouser))
  {
      $row_infouser = pg_fetch_assoc($sql);
 
      $res = [
          'name'        => $row_infouser['name'],
          'surname'     => $row_infouser['surname'],
          'image'       => $row_infouser['image'],
          'email'       => $row_infouser['email'],
          'rate'        => $row_infouser['rate']
      ];
  }
  
  return $res;
}

function post_wall_profile($userId = null) : array
{
  if(!empty($userId))
  {
    $query_postwall = "SELECT * FROM river WHERE user_id = $userId";
  }
  else
  {
    $query_postwall = "SELECT * FROM river ORDER BY r_id DESC";
  }

  $sql = pg_query($query_postwall);
  $totalRows_postwall = pg_num_rows($sql);

  $res = [];

  if(!empty($totalRows_postwall))
  {
    $row_postwall = pg_fetch_all($sql);

    foreach($row_postwall as $item)
    {
      $res [] = [
        'userId'       => $item['user_id'],
        'content'       => $item['content'],
        'mediaId'      => $item['media_id'],
        'status'        => $item['status']
      ];
    }
  }

  return $res;
}

?>