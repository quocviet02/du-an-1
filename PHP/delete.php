<?php
 require_once 'connection.php';
 $idsp = $_GET['ids']; 
 $sql = "DELETE FROM home WHERE id = $idsp";
 $stmt = $conn->prepare($sql);
 $stmt->execute();
 header('location:index.php');
 die;

?>
