<?php 
$slide_ind = $d->rawQuery("select ten$lang, slogan$lang, mota$lang, photo, link from #_photo where type = 'slide' and hienthi > 0 order by stt,id desc");
$slide_thumb = $config['setting']['slide_thumb'];
?>
<?php if (!empty($slide_ind )){ ?>
<section id="block-slide">
    <div class="container-slide slide-swiper">
        <div class="slide-box swiper-wrapper">
            <?php foreach ($slide_ind as $key => $value){ ?>
            <div class="swiper-slide">
                <figure class="slide-img">
                    <img onerror="this.src='<?=THUMBS?>/<?=$slide_thumb?>/assets/images/noimage.png';" src="<?=THUMBS?>/<?=$slide_thumb?>/<?=UPLOAD_PHOTO_L.$value['photo']?>" alt="<?=$value['ten'.$lang]?>" title="<?=$value['ten'.$lang]?>" />
                    <figcaption class="slide-text">
                        <?='<h3>'.$value['ten'.$lang].'</h3>'?>
                        <?='<article>'.$value['mota'.$lang].'</article>'?>
                        <button>
                            <a href="<?=$value['link']?>" target="_blank" title="<?=$value['ten'.$lang]?>"> Xem thêm</a>
                        </button>
                    </figcaption>
                    <a href="<?=$value['link']?>" target="_blank" title="<?=$value['ten'.$lang]?>"></a>
                </figure>
            </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination slide-pagination"></div>
        <div class="swiper-button-prev slide-button-prev"></div>
        <div class="swiper-button-next slide-button-next"></div>
</section>
<?php } ?>
<!-- end slide -->