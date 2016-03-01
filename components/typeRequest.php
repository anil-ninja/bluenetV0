<?php
  $user_id = $_SESSION['user_id'];
  $sql = mysqli_query($db_handle, "SELECT count( * ) AS cnt, requirements FROM service_request
                                                    WHERE remarks LIKE '%demand%' GROUP BY requirements ;");
  while ($sqlRow = mysqli_fetch_array($sql)) {
    $requirements = $sqlRow['requirements'];
    $cnt = $sqlRow['cnt'];
  }
  $sql2 = mysqli_query($db_handle, "SELECT count( * ) AS cnt, requirements FROM service_request WHERE id NOT IN 
                                              (SELECT id FROM service_request WHERE remarks LIKE '%demand%') GROUP BY requirements;");
  while ($sql2Row = mysqli_fetch_array($sql2)) {
    $requirements2 = $sql2Row['requirements'];
    $cnt = $sql2Row['cnt'];
  }
?>