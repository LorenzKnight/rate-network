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
      $query_userInfo = "SELECT * FROM users WHERE user_id = $id";
  }
  else
  {
      $query_userInfo = "SELECT * FROM users ORDER BY user_id ASC";
  }
  $sql = pg_query($query_userInfo);
  $totalRows_userInfo = pg_num_rows($sql);
  
  $res = [
      'name'        => false,
      'surname'     => false,
      'image'       => false,
      'email'       => false,
      'rate'        => false
  ];
  
  if(!empty($totalRows_userInfo))
  {
      $row_userinfo = pg_fetch_assoc($sql);
 
      $res = [
          'name'        => $row_userinfo['name'],
          'surname'     => $row_userinfo['surname'],
          'image'       => $row_userinfo['image'],
          'email'       => $row_userinfo['email'],
          'rate'        => $row_userinfo['rate']
      ];
  }
  
  return $res;
}

function post_all_data(int $postId) : array
{
  $query_postalldata = "SELECT * FROM river WHERE r_id = $postId";
  $sql = pg_query($query_postalldata);

  $res = [
    'postId'      => false,
    'userId'      => false,
    'content'     => false,
    'mediaId'     => false,
    'status'      => false
  ];

  $row_postalldata = pg_fetch_assoc($sql);

  $res = [
    'postId'      => $row_postalldata['r_id'],
    'userId'      => $row_postalldata['user_id'],
    'content'     => $row_postalldata['content'],
    'mediaId'     => $row_postalldata['media_id'],
    'status'      => $row_postalldata['status']
  ];

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
        'postId'      => $item['r_id'],
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

  if(isset($requestData['user_id']) && !empty($requestData['user_id']))
	{
		$conditions .= " and user_id = " . $requestData['user_id']. ' ';
	}

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

  $sql = pg_query($query);
  $totalPost_rates_list = pg_num_rows($sql);

  return $totalPost_rates_list;
}

function add_comments($userId, $postId, $comment, $comment_date)
{
  $query = "INSERT INTO comments (user_id, post_id, comment, comment_date) values ($userId, $postId, '$comment', '$comment_date')";
	$sql = pg_query($query);
		
	return true;
}

function comment_in_post($rId) : array
{
  $query_postcomment = "SELECT * FROM comments WHERE post_id = $rId ORDER BY comment_id DESC";
  $sql = pg_query($query_postcomment);
  $totalRows_postcomment = pg_num_rows($sql);
  
  $res = [];
  
  if(!empty($totalRows_postcomment))
  {
      $row_postcomment = pg_fetch_all($sql);

      foreach($row_postcomment as $item)
      {
        $res [] = [
            'userId'        => $item['user_id'],
            'postId'        => $item['post_id'],
            'comment'       => $item['comment'],
            'commentDate'   => $item['comment_date']
        ];
      }
  }
  
  return $res;
}

function dbCommentsColumnNames()
{
	return array(
		"comment_id", "user_id", "post_id", "comment", "comment_date"
	);
}

function count_comments($columns = "*", $requestData = array()) : int
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
		$validColumns = dbCommentsColumnNames();

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

	$query .= "from comments ";

  //check other conditions
	$conditions = "";

  if(isset($requestData['comment_id']) && !empty($requestData['comment_id']))
	{
		$conditions .= " and comment_id = " . $requestData['comment_id']. ' ';
	}

  if(isset($requestData['post_id']) && !empty($requestData['post_id']))
	{
		$conditions .= " and post_id = " . $requestData['post_id']. ' ';
	}

  if(!empty($conditions))
	{
		$query .= " where " . substr($conditions, 5);
	}

  $sql = pg_query($query);
  $totalPost_rates_list = pg_num_rows($sql);

  return $totalPost_rates_list;
}

function add_rate(int $userId, int $stars, $postId = null)
{
  $rateBonus = $stars;
  $rateDate  = date("Y-m-d H:i:s");

  $query = "INSERT INTO rates (user_id, stars, rate_bonus, post_id, rate_date) VALUES ($userId, $stars, $rateBonus, $postId, '$rateDate')";
	$sql = pg_query($query);
		
	return true;
}

//update exemple
// function rankbooster_update($requestData = array(), $rankboosterData = array())
// {
// 	if(empty($requestData) || empty($rankboosterData))
// 	{
// 		return false;
// 	}

// 	if(!isset($rankboosterData['rid']))
// 	{
// 		return false;
// 	}

// 	if(empty($rankboosterData['rid']))
// 	{
// 		return false;
// 	}
	
// 	$validColumns = dbRankboosterColumnNames();
// 	unset($validColumns['rid']);
	
// 	//validate requestData
// 	foreach ($requestData as $keyColumn => $value) 
// 	{
// 		if(!in_array($keyColumn, $validColumns))
// 		{
// 			unset($requestData[$keyColumn]);
// 		}

// 		if(isset($rankboosterData[$keyColumn]) && $value === $rankboosterData[$keyColumn])
// 		{
// 			unset($requestData[$keyColumn]);
// 		}
// 	}
// 	if(empty($requestData))
// 	{
// 		return false;
// 	}
	
// 	$queryParams = "";
// 	foreach ($requestData as $keyColumn => $value) 
// 	{
// 		$queryParams .= $keyColumn."='".pg_escape_string($value)."',";
// 	}

// 	if(empty($queryParams))
// 	{
// 		return false;
// 	}

// 	$query = "UPDATE rankbooster SET " . substr($queryParams, 0, -1) . " WHERE rid=".$rankboosterData['rid'];
// 	// echo "Q1: $query \n";die;
// 	$sql = pg_query($query);

// 	return $sql;
// }
?>