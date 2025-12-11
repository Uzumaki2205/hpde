<section id="block-header">
    <div class="container-header">
        <article class="header-top">
            <div class="container flexbox">
                <div class="box flexbox">
                    <div class="header-email">
                        <?=' <i class="fas fa-envelope"></i> E-mail: <span>'.$optsetting['email'].'</span>'?>
                    </div>
                    <?php if (count($config['website']['lang'])>1){ ?>
                    <div class="header-lang">
                        <a href="ngon-ngu/en/" title="<?=tienganh?>">EN</a>
                        <a href="ngon-ngu/vi/" title="<?=tiengviet?>">VI</a>
                    </div>
                    <?php } ?>
                    <div class="header-social">
                        <?php $func->social('social_header','20x20x1') ?>
                    </div>
                </div>
            </div>
        </article>
        <article class="header-mid">
            <div class="container">
                <div class="box flexbox">
                    <div class="header-logo">
                        <?= $func->load_photo('logo','230x90x1'); ?>
                    </div>
                    <div class="header-banner">
                        <?= $func->load_photo('banner','575x55x1'); ?>
                    </div>
                    <div class="header-hotline">
                        <p><?=hotlinehotro?>:</p>
                        <?='<span>'.$optsetting['hotline'].'</span>'?>
                    </div>
                </div>
            </div>
        </article>
        <article class="header-bot">
            <?php 
            include TEMPLATE.LAYOUT."menu.php";  
            if ($config['bonus']['responsive']){
                include TEMPLATE.LAYOUT."mmenu.php";
                include TEMPLATE.LAYOUT."toolbar.php";
            }
            ?>
        </article>
    </div>
</section>
<!-- end header -->