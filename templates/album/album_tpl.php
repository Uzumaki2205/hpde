<section id="block-inAlbum" class="inBody">
    <div class="container">
        <div class="inAlbum-contaienr">
            <div class="title-main">
                <?='<h2>'.$title_crumb.'</h2>'?>
            </div>
            <?php if(count($news)>0 || count($gallery)>0) {  ?>
            <?php if ($com=='gallery'){ ?>
            <div class="inGallery-box flexbox">
                <?php foreach ($gallery as $key => $value): ?>
                <div class="inGallery-col">
                    <div class="inGallery-item">
                        <figure class="inGallery-img img-full effect-scale">
                            <a data-fancybox="inGallery" href="<?= UPLOAD_NEWS_L.$value['photo'] ?>" title="<?= $value['ten'.$lang] ?>">
                                <img src="<?=THUMBS?>/380x475x1/<?= UPLOAD_NEWS_L.$value['photo'] ?>" alt="<?= $value['ten'.$lang] ?>">
                            </a>
                        </figure>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <?php } else { ?>
            <div class="inAlbum-box flexbox">
                <?php foreach ($news as $key => $value){echo $func->news_Picture($value,'class'); } ?>
            </div>
            <?php } } else { ?>
            <div class="alert alert-warning" role="alert">
                <?='<strong>'.khongtimthayketqua.'</strong>'?>
            </div>
            <?php } ?>
            <div class="clear"></div>
            <div class="pagination-home">
                <?=(isset($paging) && $paging != '') ? $paging : ''?>
            </div>
        </div>
    </div>
</section>