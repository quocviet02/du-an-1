<?php
    try {
        $conn = new PDO("mysql:host=localhost;dbname=basic_1;charset=utf8","root","");
        $conn ->setAttribute(PDO::ATTR_AUTOCOMMIT,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo"Lỗi kết nối ".$e->getMessage();
    }
  
?>