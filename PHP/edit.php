<?php
require_once 'connection.php';
$id = $_GET['ids'];
$err=[
    'ten_sp'=>'',
    'anh_sp'=>'',
    'gia_sp'=>'',
    'mota_sp'=>''
];
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $idsp=$_POST['ids'];
    $ten_sp=$_POST['name_product'];
    $img = $_FILES['image_product'];
    $gia_sp = $_POST['price_product'];
    $old_img = $_POST['old_img'];
    $mota = $_POST['description_product'];


    
    if ($ten_sp==''|| strlen($ten_sp)<=7 ) {
         $err['ten_sp']='Bạn phải nhập tên và số lượng ký tự phải lớn 7';
    }
    if ($img['size']<0) {
         $err['anh_sp']='bạn phải thêm ảnh';
    }
    if ($gia_sp=='' || $gia_sp<=0) {
         $err['gia_sp']='bạn chưa nhập giá lớn hơn 0 đồng';

    }
    if ($mota=='') {
         $err['mota_sp']='chưa nhập mô tả';
    }
    if (!array_filter($err)) {
        if ($img['size']>0) {
            $anh=$img['name'];
            move_uploaded_file($img['tmp_name'],"image/".$anh);
            
        }
        else {
            $anh = $old_img ;
        }
       
      
        $sql="UPDATE home SET name_product='$ten_sp', image_product='$anh',price_product='$gia_sp',description_product='$mota' WHERE id='$id'";
        $stmt = $conn->prepare($sql);
        $stmt ->execute();
        $message="Sửa dữ liệu thành công";
        header('location:index.php');

    }
}
$sql="SELECT *FROM home WHERE id='$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$sanpham =$stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($sanpham);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Cập nhật sách</h1>
    <a href="index.php">trang chủ</a>
     <?= isset( $message) ? $message : '' ?> <!-- điều kiện trong isset, sau dấu hỏi là câu lệnh chạy -->
     
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="ids" >
        <label for="">Tên</label>
        <input type="text" name='name_product' value="<?=$sanpham['name_product']?>">
        <?php
         echo $err['ten_sp'];
        ?>
        <br>
        <label for="">ảnh</label>
       
        <input type="file" name="image_product" >
        <input type="hidden" value="<?=$sanpham['image_product']?>" name="old_img">
        <img src="image/<?=$sanpham['image_product']?>" alt="">

      
        
        <?=$err['anh_sp']?>
        <br>
        <label for="">giá</label>
        <input type="number" name='price_product'  value="<?=$sanpham['price_product']?>">
        <?=$err['gia_sp']?>
        <br>
        <label for="">mô tả</label>
        <textarea name="description_product" id="" cols="30" rows="10" ><?=$sanpham['description_product']?></textarea>
       <?php
        echo $err['mota_sp'];
       ?>
        
        
        <br>
        <button type="submit">sửa sản phẩm</button>
    </form>
</body>
</html>