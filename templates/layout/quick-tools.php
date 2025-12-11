<?php if ($config['bonus']['cart']){ ?>
<?php if($com!='gio-hang') { ?>
<a class="cart-fixed text-decoration-none" href="gio-hang" title="Giỏ hàng">
    <i class="fas fa-shopping-bag"></i>
    <span class="count-cart">
        <?=(isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0?></span>
</a>
<?php } ?>
<?php } ?>
<?=$addons->setAddons('messages-facebook', 'messages-facebook', 10);?>
<a class="btn-zalo btn-frame text-decoration-none" target="_blank" href="https://zalo.me/<?=preg_replace('/[^0-9]/','',$optsetting['zalo']);?>">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i><img src="assets/images/zl.png" alt="Zalo"></i>
</a>
<a class="btn-phone btn-frame text-decoration-none" href="tel:<?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?>">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i><img src="assets/images/hl.png" alt="Hotline"></i>
</a>