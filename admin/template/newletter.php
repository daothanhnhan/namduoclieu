<?php 
$newletter = $action->getList('newsletter','','','id','desc',$trang,20,'newletter');//var_dump($rows_lien_he);die();
?>
<div class="container">
  <h2>Bảng nhận tin.</h2>      
  <a href="/admin/template/excel/xls.php" style="float: right;">EXCEL</a>      
  <table class="table">
    <thead>
      <tr>
      	<th>STT</th>
        <th>Email</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $d = 0; 
    foreach ($newletter['data'] as $item) { 
        $d++;
        ?>
      <tr>
        <td><?php echo $d; ?></td>
        <td><?php echo $item['email']; ?></td>
        <td><?php echo $item['date']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php
    echo $newletter['paging'];
?> 
</div>
