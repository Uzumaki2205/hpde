<?php 
$aside_product_detail = $d->rawQuery("SELECT ten$lang, id, photo FROM table_photo WHERE type = 'product_detail' AND hienthi = 1 ORDER BY stt ASC");  
$aside_ads = $d->rawQuery("SELECT ten$lang, id, photo, link FROM table_photo WHERE type = 'ads' AND hienthi = 1 ORDER BY stt ASC");  
?>
<div id="block-aside">
    <aside class="aside-product-detail">
        <?php foreach ($aside_product_detail as $key => $value): ?>
        <div class="aside-product-item">
            <h3>
                <?= '<a class="fancybox" href="'.UPLOAD_PHOTO_L.$value['photo'].'" tite="'.$value['ten'.$lang].'">'.$value['ten'.$lang].'</a>' ?>
            </h3>
        </div>
        <?php endforeach ?>
    </aside>
    <aside class="aside-ads">
        <div class="container-aside">
            <div class="ads-box">
                <?php foreach ($aside_ads as $key => $value): ?>
                <figure class="ads-item">
                    <img src="<?=THUMBS?>/270x380x1/<?= UPLOAD_PHOTO_L.$value['photo'] ?>" alt="<?= $value['ten'.$lang] ?>" onerror="this.src='<?=THUMBS?>/270x380x1/assets/images/noimage.png';">
                    <a href="<?=$value['link']?>" title="<?=$value['ten'.$lang]?>"></a>
                </figure>
                <?php endforeach ?>
            </div>
        </div>
    </aside>
</div>