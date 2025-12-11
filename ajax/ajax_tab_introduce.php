<?php
include "ajax_config.php";

$id 	= $_GET['id'];

$ajax_tab = $d->rawQuery("SELECT ten$lang,mota$lang,tenkhongdauvi, tenkhongdauen, id FROM table_news WHERE type='introduce' AND id = $id AND noibat>0 AND hienthi>0  ORDER BY stt ASC");
?>
<?php if (count($ajax_tab)>0) {  ?>
<?php foreach ($ajax_tab as $key => $value) {  ?>
<?='<h3>'.$value['ten'.$lang].'</h3>' ?>
<?='<p>'.$value['mota'.$lang].'</p>' ?>
<?='<a href="'.$value[$sluglang].'" title="'.$value['ten'.$lang].'">'.xemthem.'__</a>' ?>
<?php } } else { echo '<div class="notice">Nội dung đang cập nhật</div>';} ?>