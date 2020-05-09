<?php
    $rows = $acc->getList("container_laptop","","","id","desc",$trang, 20, "laptop");//var_dump($rows);
    function getMuc ($ma) {
        if ($ma == 1) {
            return 'Vali';
        }
        if ($ma == 2) {
            return 'Balo';
        }
        if ($ma == 3) {
            return 'Túi xách';
        }
        if ($ma == 4) {
            return 'Phụ kiện';
        }
    }
?>	
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-laptop">Thêm</a></h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Hoạt động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $d = 0;
                    foreach ($rows['data'] as $row) {
                        $d++;
                    ?>
                        <tr>
                            <td><?= $d ?></td>
                            
                            <td>
                                <?= $row['name']?>
                            </td>
                            <td><?= getMuc($row['category']) ?></td>
                            <td style="float: none;"><a href="index.php?page=xoa-laptop&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-laptop&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
    	
        <div class="paging">             
        	<?= $rows['paging'] ?>
		</div>
    </div>
    <p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>             