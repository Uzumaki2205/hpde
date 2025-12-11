<section id="block-inNews" class="inBody">
    <div class="container">
        <div class="container-inNews">
            <div class="title-main">
                <?='<h2>'.((@$title_cat!='')?$title_cat:@$title_crumb).'</h2>'?>
            </div>
            <?php if(count($news)>0) {  ?>
            <div class="inNews-box flexbox">
                <?php if ($com=='catalogue'){ ?>
                <?php foreach ($news as $key => $value){ ?>
                <div class="newsPicture-col inCatalogue">
                    <div class="newsPicture-item flexbox">
                        <article class="newsPicture-img">
                            <a class="effect-scale img-full" data-fancybox="inCatalogue" href="<?=$config['database']['url'].UPLOAD_FILE_L.$value['file_taptin']?>" title="<?= $value['ten'.$lang] ?>">
                                <img src="<?=THUMBS?>/380x300x1/<?= UPLOAD_NEWS_L.$value['photo'] ?>" alt="<?= $value['ten'.$lang] ?>" onerror="this.src='<?=THUMBS?>/380x300x1/assets/images/noimage.png';">
                            </a>
                        </article>
                        <article class="newsPicture-text hover">
                            <?='<h3><a data-fancybox="inCatalogue" href="'.$config['database']['url'].UPLOAD_FILE_L.$value['file_taptin'].'" title="'.$value['ten'.$lang].'">'.$value['ten'.$lang].'</a> </h3>' ?>
                        </article>
                    </div>
                </div>
                <?php } ?>
                <?php } else { ?>
                <?php foreach ($news as $key => $value){echo $func->news_Classic($value,'class'); } ?>
                <?php } ?>
                <?php /*foreach ($news as $key => $value){echo $func->news_3D($value,'class'); } */?>
            </div>
            <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                <?='<strong>'.khongtimthayketqua.'</strong>'?>
            </div>
            <?php } ?>
            <?='<div class="pagination-home">'.((isset($paging) && $paging != '') ? $paging : '').' </div>'?>
        </div>
    </div>
</section>
