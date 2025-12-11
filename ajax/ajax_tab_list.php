<?php
include "ajax_config.php";

$type 	= $_GET['type'];
$table 	= $_GET['table'];
$limit 	= $_GET['limit'];
$thumb 	= $_GET['thumb'];
$idl 	= $_GET['idl'];
$idc 	= $_GET['idc'];
if ($idc!='0') {
	$check = " AND id_list='".$idl."' AND id_cat='".$idc."'";
}else{
	$check = " AND id_list='".$idl."'";
}
$select = ($table=='product') ? 'gia,giamoi' : 'ngaytao'; 

$ajax_tab = $d->rawQuery("SELECT ten$lang,mota$lang,tenkhongdau$lang,id,photo,$select FROM table_$table WHERE type='$type' AND noibat>0 AND hienthi>0  $check ORDER BY stt ASC LIMIT $limit");
?>
<?php if (count($ajax_tab)>0) {  ?>
<div class="product-box resBox flexbox">
    <?php foreach ($ajax_tab as $key => $value) { 
    	if ($table=='product') {
        	echo $func->product_show($value,'resCol',$thumb); 
     	}else{
     		echo $func->news_Classic($value,'',$thumb); 
     	}
    } ?>
</div>
<?php } else { echo '<div class="notice">Nội dung đang cập nhật</div>';} ?>