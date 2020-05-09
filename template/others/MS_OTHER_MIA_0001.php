<?php 
      function listBrandFooter () {
            global $conn_vn;
            $sql = "SELECT * FROM brand";
            $result = mysqli_query($conn_vn, $sql);
            $thuong_hieu_name = array();
            $thuong_hieu_id = array();
            while ($row = mysqli_fetch_assoc($result)) {
                  if (!in_array($row['name'], $thuong_hieu_name)) {
                        $thuong_hieu_name[] = $row['name'];
                        $thuong_hieu_id[] = $row['id'];
                  } else {
                        $key = array_search($row['name'], $thuong_hieu_name);
                        $thuong_hieu_id[$key] .= "-".$row['id'];
                  }
            }
            $thuong_hieu = array();
            foreach ($thuong_hieu_name as $key => $item) {
                  $thuong_hieu[] = array(
                        'name' => $thuong_hieu_name[$key],
                        'id'   => $thuong_hieu_id[$key]
                  );
            }
            return $thuong_hieu;
      }
      $list_brand_footer = listBrandFooter();
?>
<div class="gb-thuonghieu_mia">
    <div class="container">
        <h3>Thương hiệu</h3>
        <ul>
            <?php foreach ($list_brand_footer as $item) { ?>
            <li><a href="/brand/1/<?= $item['id'] ?>"><?= $item['name'] ?></a></li>
            <?php } ?>
        </ul>
    </div>
</div>