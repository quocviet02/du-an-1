<?php
require_once 'connection.php';
$sql = 'SELECT*FROM home ';
$stmt= $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <table border="1">
        <tr>
            <th>ID sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Gía sản phẩm</th>
            <th>Mô tả</th>
            <th>chức năng</th>
        </tr>
        <?php foreach($result as $i):?>
        <tr>
            <th><?=$i['id']?></th>
            <th><?=$i['name_product']?></th>
            <th><img src="image/<?=$i['image_product']?>" alt="" width="300px" height="300px"></th>
            <th><?=$i['price_product']?></th>
            <th><?=$i['description_product']?></th>
           <th>
            <a onclick="return prompt('bạn có chắc chắn muốn sửa không!')" href="edit.php?ids=<?=$i['id']?>">sửa</a>
            <a onclick="return alert('bạn có chắc chắn muốn xóa')" href="delete.php?ids=<?=$i['id']?>">xóa</a>
           </th>
        </tr>
        <?php endforeach?>
        <a href="add.php">thêm</a>
    </table>
</body>
</html>