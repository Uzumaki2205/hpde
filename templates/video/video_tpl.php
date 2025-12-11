<section id="block-inVideo" class="inBody">
    <div class="container">
        <div class="inVideo-contaienr">
            <div class="title-main">
                <?='<h2>'.@$title_crumb.'</h2>'?>
            </div>
            <?php if(isset($video) && count($video) > 0) { ?>
            <div class="inVideo-box flexbox">
                <?php foreach ($video as $key => $value){ ?>
                <div class="inVideo-col">
                    <div class="inVideo-item">
                        <figure class="inVideo-img">
                            <img onerror="this.src='<?=THUMBS?>/480x360x2/assets/images/noimage.png';" src="https://img.youtube.com/vi/<?=$func->getYoutube($value['link_video'])?>/0.jpg" alt="<?=$value['ten'.$lang]?>" />
                            <figcaption>
                                <?='<h3>'.$value['ten'.$lang].'</h3>'?>
                            </figcaption>
                            <a class="video text-decoration-none" data-fancybox="inVideo" data-src="<?=$value['link_video']?>" title="<?=$value['ten'.$lang]?>"></a>
                        </figure>
                    </div>
                </div>
                <?php } } else { ?>
                <div class="alert alert-warning" role="alert">
                    <?='<strong>'.khongtimthayketqua.'</strong>'?>
                </div>
                <?php } ?>
                <div class="pagination-home">
                    <?=(isset($paging) && $paging != '') ? $paging : ''?>
                </div>
            </div>
        </div>
    </div>
</section>