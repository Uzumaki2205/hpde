<section id="block-inStatic" class="inBody">
    <div class="container">
        <div class="container-inStatic">
            <div class="title-main">
                <?='<h2>'.$static['ten'.$lang].'</h2>'?>
            </div>
            <?php if (!empty($static)){ ?>
            <div class="inStatic-box">
                <?=(isset($static['noidung'.$lang]) && $static['noidung'.$lang] != '') ? htmlspecialchars_decode($static['noidung'.$lang]) : ''?>
            </div>
            <div class="share">
                <?='<b>'.chiase.':</b>'?>
                <div class="social-plugin w-clear">
                    <div class="addthis_inline_share_toolbox_qj48"></div>
                    <div class="zalo-share-button" data-href="<?=$func->getCurrentPageURL()?>" data-oaid="<?=($optsetting['oaidzalo']!='')?$optsetting['oaidzalo']:'579745863508352884'?>" data-layout="1" data-color="blue" data-customize=false></div>
                </div>
            </div>
            <?php }else{ ?>
            <div class="alert alert-warning" role="alert">
                <?='<strong>'.khongtimthayketqua.'</strong>'?>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- end inStatic -->