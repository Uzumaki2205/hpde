<?php 
$aside_list = $d->rawQuery("SELECT ten$lang, tenkhongdauvi, tenkhongdauen, id FROM table_product_list WHERE type = 'product' AND hienthi = 1 ORDER BY stt ASC");  
$aside_support = $d->rawQuery("SELECT ten$lang, bonus, id FROM table_news WHERE type = 'support' AND hienthi = 1 ORDER BY stt ASC");  
?>
<div id="block-aside">
    <aside class="aside-product">
        <div class="container-aside">
            <div class="aside-title">
                <h2><?=danhmucsanpham?></h2>
            </div>
            <div class="aside-box">
                <ul class="aside-list">
                    <?php foreach ($aside_list as $key_list => $value_list): ?>
                    <li>
                        <a href="<?=$value_list[$sluglang]?>" title="<?= $value_list['ten'.$lang] ?>">
                            <?= $value_list['ten'.$lang] ?>
                        </a>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </aside>
    <aside class="aside-support">
        <div class="container-aside">
            <div class="aside-title">
                <h2><?=hotrokhachhang?></h2>
            </div>
            <div class="support-box">
                <?php foreach ($aside_support as $key => $value):
                $bonus_support = (isset($value['bonus']) && $value['bonus'] != '') ? json_decode($value['bonus'],true) : null;
             ?>
                <div class="support-item">
                    <?= '<h3>'.$value['ten'.$lang].'</h3>' ?>
                    <?= '<p>Hotline: <span>'.$bonus_support['hotline'].'</span></p>' ?>
                    <?= '<p>E-mail <span>'.$bonus_support['email'].'</span></p>' ?>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </aside>
</div>