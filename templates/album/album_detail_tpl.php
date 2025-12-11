<section id="block-inAlbum" class="inBody">
    <div class="container">
        <div class="inAlbum-contaienr">
            <div class="title-main">
                <?='<h2>'.$row_detail['ten'.$lang].'</h2>'?>
            </div>
            <div class="inAlbum-box">
                <?php if(count($hinhanhtt)>0) { ?>
                <div class="inAlbum-fotorama">
                    <div class="fotorama" data-autoplay="true" data-allowfullscreen="true" data-nav="thumbs" data-autoplay="3000" data-loop="true" data-width="100%" data-maxheight="450">
                        <?php  foreach ($hinhanhtt as $key => $value) {?>
                        <img onerror="this.src='assets/images/noimage.png';" src="<?=UPLOAD_NEWS_L.$value['photo']?>" alt="<?=$row_detail['ten'.$lang]?>" /></p>
                        <?php } ?>
                    </div>
                </div>
                <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    <?='<strong>'.khongtimthayketqua.'</strong>'?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>