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
        'rId'         => $item['r_id'],
        'userId'      => $item['user_id'],
        'content'     => $item['content'],
        'mediaId'     => $item['media_id'],
        'status'      => $item['status']
      ];
    }
  }

  return $res;
}

function dbRatesColumnNames()
{
	return array(
		"rate_id", "stars", "rate_bonus", "user_id", "to_user_id", "post_id", "comment_id", "rate_date"
	);
}

function rate_in_post($columns = "*", $requestData = array(), array $options = []) : array
{
  if(empty($columns))
	{
		$columns = "*";
	}

	if($columns != "*" && !is_array($columns))
	{
		$columns = "*";
	}

	$queryColumnNames = "*";
	if(is_array($columns))
	{
		$queryColumnNames = "";
		$validColumns = dbRatesColumnNames();

		foreach ($columns as $column) 
		{
			if(in_array($column, $validColumns))
			{
				$queryColumnNames .= $column.",";
			}
		}

		if(empty($queryColumnNames))
		{
			return null;
		}
		
		$queryColumnNames = substr($queryColumnNames, 0, -1);
	}

  $query = "select $queryColumnNames ";

  if(isset($options['count_query']) && $options['count_query'])
	{
		$query = "select count(*) ";
	}

	$query .= "from rates ";

  //check other conditions
	$conditions = "";

  if(isset($requestData['post_id']) && !empty($requestData['post_id']))
	{
		$conditions .= " and post_id = " . $requestData['post_id']. ' ';
	}

  if(!empty($conditions))
	{
		$query .= " where " . substr($conditions, 5);
	}

  //set order
  if(!isset($options['count_query']))
  {
    $query .= "order by ";
    if(isset($options['order']))
    {
      $query .= $options['order'];
    } 
    else
    {
      $query .= "rate_id asc";
    }
  }

  //set limit
  if(isset($options['limit']) && !empty($options['limit']))
  {
    $query .= " limit " . intval($options['limit']);
  }

  if(isset($options['echo_query']) && $options['echo_query'])
  {
    echo "Q: ".$query."<br>\t\n";
  }

  $sql = pg_query($query);
  $totalPost_rates_list = pg_num_rows($sql);

  $res = [];

  if(!empty($totalPost_rates_list))
  {
    $row_postRates_list = pg_fetch_all($sql);

    foreach($row_postRates_list as $item)
    {
      $res [] = [
        'rateId'      => $item['rate_id'],
        'stars'       => $item['stars'],
        'rateBonus'   => $item['rate_bonus'],
        'userId'      => $item['user_id'],
        'postId'      => $item['post_id'],
        'commentId'   => $item['comment_id'],
        'rateDate'    => $item['rate_date']
      ];
    }
  }

  return $res;
}

function count_rates($columns = "*", $requestData = array()) : int
{
  if(empty($columns))
	{
		$columns = "*";
	}

	if($columns != "*" && !is_array($columns))
	{
		$columns = "*";
	}

	$queryColumnNames = "*";
	if(is_array($columns))
	{
		$queryColumnNames = "";
		$validColumns = dbRatesColumnNames();

		foreach ($columns as $column) 
		{
			if(in_array($column, $validColumns))
			{
				$queryColumnNames .= $column.",";
			}
		}

		if(empty($queryColumnNames))
		{
			return null;
		}
		
		$queryColumnNames = substr($queryColumnNames, 0, -1);
	}

  $query = "select $queryColumnNames ";

  if(isset($options['count_query']) && $options['count_query'])
	{
		$query = "select count(*) ";
	}

	$query .= "from rates ";

  //check other conditions
	$conditions = "";

  if(isset($requestData['post_id']) && !empty($requestData['post_id']))
	{
		$conditions .= " and post_id = " . $requestData['post_id']. ' ';
	}

  if(isset($requestData['comment_id']) && !empty($requestData['comment_id']))
	{
		$conditions .= " and comment_id = " . $requestData['comment_id']. ' ';
	}

  if(isset($requestData['to_user_id']) && !empty($requestData['to_user_id']))
	{
		$conditions .= " and to_user_id = " . $requestData['to_user_id']. ' ';
	}

  if(!empty($conditions))
	{
		$query .= " where " . substr($conditions, 5);
	}

  // $query = "SELECT * FROM rates WHERE post_id = $postId";
  $sql = pg_query($query);
  $totalPost_rates_list = pg_num_rows($sql);

  return $totalPost_rates_list;
}
?>