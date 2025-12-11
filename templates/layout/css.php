<!-- Css Files -->
<?php
    $css->setCache("cached");
    $css->setCss("./assets/css/animate.min.css");
    $css->setCss("./assets/bootstrap/bootstrap.css");
    $css->setCss("./assets/fontawesome512/all.css");
    $css->setCss("./assets/fontawesome512/light.min.css");
    $css->setCss("./assets/fontawesome512/fontawesome.min.css");
    if ($config['bonus']['user']) {
        $css->setCss("./assets/datetimepicker/jquery.datetimepicker.css");
    }
    if ($config['bonus']['user']) {$css->setCss("./assets/css/login.css");}
    if ($config['bonus']['cart']) {$css->setCss("./assets/css/cart.css");}
    if ($config['bonus']['responsive']||$config['bonus']['mobile']) {
        $css->setCss("./assets/mmenu/mmenu.css");
    }
    $css->setCss("./assets/fancybox3/jquery.fancybox.css");
    $css->setCss("./assets/fancybox3/jquery.fancybox.style.css");
    // $css->setCss("./assets/photobox/photobox.css");
    if ($com=='index') {
        $css->setCss("./assets/simplyscroll/jquery.simplyscroll.css");
        $css->setCss("./assets/simplyscroll/jquery.simplyscroll-style.css");
        // $css->setCss("./assets/slick/slick.css");
        // $css->setCss("./assets/slick/slick-theme.css");
        // $css->setCss("./assets/slick/slick-style.css");
        $css->setCss("./assets/swiper/swiper-bundle.min.css");
        $css->setCss("./assets/css/ajax_paging.css");
    }
    if ($template=='album/album_detail') {
        $css->setCss("./assets/fotorama/fotorama.css");
        $css->setCss("./assets/fotorama/fotorama-style.css");
    }
    if ($template=='product/product_detail') {
        $css->setCss("./assets/magiczoomplus/magiczoomplus.css");
        $css->setCss("./assets/swiper/swiper-bundle.min.css");
    }
    
    $css->setCss("./assets/css/bonus.css");
    if ($source!='index') {
        $css->setCss("./assets/css/pagein.css"); 
    }
    $css->setCss("./assets/css/style.css");
    if ($config['bonus']['responsive']||$config['bonus']['mobile']) {
        $css->setCss("./assets/css/responsive.css"); 
    }
    
    echo $css->getCss();
?>
<!-- Background -->
<?php
    $bgbody = $d->rawQueryOne("select hienthi, options, photo from #_photo where act = ? and type = ? limit 0,1",array('photo_static','background'));

    if($bgbody['hienthi'])
    {
        $bgbodyOptions = json_decode($bgbody['options'],true)['background'];
        if($bgbodyOptions['loaihienthi']) 
        {
            echo '<style type="text/css">body{background: url('.UPLOAD_PHOTO_L.$bgbody['photo'].') '.$bgbodyOptions['repeat'].' '.$bgbodyOptions['position'].' '.$bgbodyOptions['attachment'].' ;background-size:'.$bgbodyOptions['size'].'}</style>';
        }
        else
        {
            echo ' <style type="text/css">body{background-color:#'.$bgbodyOptions['color'].'}</style>';
        }
    }
?>
<!-- Js Google Analytic -->
<?=htmlspecialchars_decode($setting['analytics'])?>
<!-- Js Head -->
<?=htmlspecialchars_decode($setting['headjs'])?>