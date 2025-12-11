<?php
$sql_list= $d->rawQuery("SELECT id, photo, ten$lang, tenkhongdau$lang, mota$lang, ngaytao, gia, giamoi FROM table_product WHERE type = 'product' AND noibat>0 AND hienthi>0   ORDER BY stt ASC"); 


$sql_start = _result_array("SELECT ten_$lang,tenkhongdau,id,photo,giacu,giamoi FROM table_product WHERE hienthi=1 AND type='product' AND noibat = 1 ORDER BY stt ASC LIMIT 0,8");
?>
<ul class="tab-list flexbox">
    <li data-idl="0" class="tab-active">
        <?='<a>'._tatca.'</a>'?>
    </li>
    <?php foreach ($sql_list as $key_list => $value_list): ?>
    <li data-idl="<?=$value_list['id']?>">
        <?='<a>'.$value_list['ten_'.$lang].'</a>'?>
    </li>
    <?php endforeach ?>
</ul>
<div id="tab-show" class="tab-show">
    <?php if (count($sql_start)>0) {  ?>
    <div class="product-box resBox flexbox">
        <?php foreach ($sql_show as $key => $value) { echo product($value,'product-col resCol',$thumb_product); } ?>
    </div>
    <?php } else { echo '<div class="notice">'._noidungdangcapnhat.'</div>';} ?>
</div>