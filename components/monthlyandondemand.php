<?php
  $user_id = $_SESSION['user_id'];
  $sql = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(id) AS cnt FROM 
                                                      service_request WHERE remarks LIKE '%demand%' GROUP BY DATE(date);");
  while ($sqlRow = mysqli_fetch_array($sql)) {
    $date = $sqlRow['date'];
  	$OnDemand = $sqlRow['cnt'];
  }
  $sql2 = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(id) AS cnt FROM service_request WHERE id NOT IN 
  														(SELECT id FROM service_request WHERE remarks LIKE '%demand%') GROUP BY DATE(date);");
  while ($sql2Row = mysqli_fetch_array($sql2)) {
    $date2 = $sql2Row['date'];
    $monthly = $sql2Row['cnt'];
  }
?>