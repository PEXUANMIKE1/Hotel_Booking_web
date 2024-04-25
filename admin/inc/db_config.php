<?php 
  $hname = 'localhost';
  $uname = 'root';
  $pass = '';
  $db = 'hbwebsite';
  $con = mysqli_connect($hname, $uname, $pass, $db);

  if(!$con){
    die("Cannot Connect to Database".mysqli_connect_error());
  }

  function selectAll($table)
  {
    $con = $GLOBALS['con'];
    $res = mysqli_query($con,"SELECT * FROM $table");
    return $res;
  }

  function filteration($data)
  {
    foreach($data as $key => $value){
      $data[$key] = trim($value);
      $data[$key] = stripslashes($value);
      $data[$key] = htmlspecialchars($value);
      $data[$key] = strip_tags($value);
    }
    return $data;
  }

  function select($sql, $values, $datatypes)
  {
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con, $sql))
    {
      mysqli_stmt_bind_param($stmt, $datatypes,...$values);
      if(mysqli_stmt_execute($stmt))//thực thi truy vấn
      {
        $res = mysqli_stmt_get_result($stmt); //lấy kq truy vấn
        mysqli_stmt_close($stmt); //đóng truy vấn
        return $res;
      }
      else
      {
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Select");
      }
    }
    else
    {
      die("Query cannot be executed - Select");
    }
  }
  function update($sql,$values,$datatypes)
  {
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con, $sql))
    {
      mysqli_stmt_bind_param($stmt, $datatypes,...$values);
      if(mysqli_stmt_execute($stmt))//thực thi truy vấn
      {
        $res = mysqli_stmt_affected_rows($stmt); //lấy kq truy vấn
        mysqli_stmt_close($stmt); //đóng truy vấn
        return $res;
      }
      else
      {
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Update");
      }
    }
    else
    {
      die("Query cannot be executed - Update");
    }
  }

  function insert($sql,$values,$datatypes)
  {
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con, $sql))
    {
      mysqli_stmt_bind_param($stmt, $datatypes,...$values);
      if(mysqli_stmt_execute($stmt))//thực thi truy vấn
      {
        $res = mysqli_stmt_affected_rows($stmt); //lấy kq truy vấn
        mysqli_stmt_close($stmt); //đóng truy vấn
        return $res;
      }
      else
      {
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Insert");
      }
    }
    else
    {
      die("Query cannot be executed - Insert");
    }
  }

  function delete($sql,$values,$datatypes)
  {
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con, $sql))
    {
      mysqli_stmt_bind_param($stmt, $datatypes,...$values);
      if(mysqli_stmt_execute($stmt))//thực thi truy vấn
      {
        $res = mysqli_stmt_affected_rows($stmt); //lấy kq truy vấn
        mysqli_stmt_close($stmt); //đóng truy vấn
        return $res;
      }
      else
      {
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Delete");
      }
    }
    else
    {
      die("Query cannot be executed - Delete");
    }
  }
?>