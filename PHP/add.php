<?php
require_once 'connection.php';
    $err=[
        'ten_sp'=>'',
        'anh_sp'=>'',
        'gia_sp'=>'',
        'mota_sp'=>''
    ];
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $name = $_POST['ten_sp'];
        $img = $_FILES['anh_sp'];
        $gia = $_POST['gia_sp'];
        $mota = $_POST['mota_sp'];
        if ($name==''||strlen($name)<=7 ) {
        $err['ten_sp']='bạn phải nhập tên và lớn hơn 7';
      }
      if ($img['size']<=0) {
        $err['anh_sp']='bạn phải nhập ảnh';
      }
      if ($gia =='') {
        $err['gia_sp']='bạn phải nhập giá';
      }
      if ($mota =='') {
        $err['mota_sp']='bạn phải nhập mô tả';
      }
      if (!array_filter($err)) {
        if ($img['size']>0) {
            $anh=$img['name'];
            move_uploaded_file($img['tmp_name'],"image/".$anh);
            
        }else {
            $anh = $old
        }
        // var_dump($anh);
        $sql="INSERT INTO home (name_product,image_product,price_product,description_product)VALUES('$name','$anh','$gia','$mota')";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        header('location:index.php');
        
        die;
        
      }
      
    }
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
<!-- <?php if(array_filter($err)):?>
    <div>
    <?php
                echo $err['ten_sp']."<br>".$err['anh_sp']."<br>".$err['gia_sp']."<br>".$err['mota_sp'];
            ?>
        </div>
    <?php endif?> -->

    <form action="add.php" method="post" enctype="multipart/form-data">
    <label for="" >Tên sản phẩm</label>
    <input type="text" name="ten_sp" value="<?=$name??''?>">
        <?php
            echo $err['ten_sp']
        ?>
    <br>
    <label for="">Ảnh sản phẩm</label>
    <input type="file" name="anh_sp">
            <?php
                echo $err['anh_sp'];
            ?>
    <br>
    <label for="">Giá sản phẩm</label>
    <input type="number" name="gia_sp">
            <?php
                echo $err['gia_sp'];
            ?>
    <br>
    <label for="">Mô tả sản phẩm</label>
    <textarea name="mota_sp" id="" cols="30" rows="10"></textarea>
            <?php
                echo $err['mota_sp'];
            ?>
    <br>
    <!-- <label for="">Danh mục sản phẩm</label>
   <select name="" id="" disabled="disabled">
    <option value=""></option>
   </select>
    <br> -->
    <button name="btn"type="submit">thêm</button>
    </form>
    
</body>
</html>