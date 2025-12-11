<?php
$sql_list= _result_array("SELECT ten_$lang,tenkhongdau,id FROM table_product_list WHERE hienthi=1 AND noibat = 1 AND type='product' ORDER BY stt,id DESC");
?>
<?php foreach ($sql_list as $key_list => $value_list): 
 $sql_show= _result_array("SELECT ten_$lang,tenkhongdau,id,photo,giacu FROM table_product WHERE hienthi=1 AND noibat = 1 AND type='product' AND id_list = '".$value_list['id']."' ORDER BY stt,id DESC");
 $sql_cat= _result_array("SELECT ten_$lang,tenkhongdau,id FROM table_product_cat WHERE hienthi=1 AND noibat = 1 AND type='product' AND id_list = '".$value_list['id']."' ORDER BY stt,id DESC");  ?>
<div class="container-splist">
    <div class="container">
        <div class="title-main">
            <?= '<h2>'.$value_list['ten_'.$lang].'</h2>' ?>
        </div>
        <article class="splist-box">
            <ul class="tab-list tab-list<?= $value_list['id']?> flexbox">
                <li data-idl="<?= $value_list['id'] ?>" data-idc="0" class="tab-active">
                    <?='<a>'._tatca.'</a>'?>
                </li>
                <?php foreach ($sql_cat as $key_cat => $value_cat):?>
                <li data-idl="<?= $value_list['id'] ?>" data-idc="<?=$value_cat['id']?>">
                    <?='<a>'.$value_cat['ten_'.$lang].' </a>'?>
                </li>
                <?php endforeach ?>
            </ul>
            <div id="tab-show--<?= $value_list['id']?>" class="tab-show">
                <?php if (count($sql_show)>0) {  ?>
                <div class="product-box resBox flexbox">
                    <?php foreach ($sql_show as $key => $value) { echo product($value,'product-col resCol',$thumb_product); } ?>
                </div>
                <?php } else { echo '<div class="notice">'._noidungdangcapnhat.'</div>';} ?>
            </div>
        </article>
    </div>
</div>
<?php endforeach ?>