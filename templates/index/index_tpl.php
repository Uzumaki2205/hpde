<?php 
$plist_ind = $d->rawQuery("SELECT id, photo, ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, ngaytao FROM table_product_list WHERE type = 'product' AND hienthi>0 ORDER BY stt,id ASC LIMIT 0,3");
?>
<?php if (!empty($plist_ind)){ ?>
<section id="block-plist">
    <div class="container-plist">
        <div class="plist-box flexbox">
            <?php foreach ($plist_ind as $key => $value){ ?>
            <div class="plist-col">
                <div class="plist-item">
                    <figure class="plist-img">
                        <span class="effect-scale img-full">
                            <img src="<?=WATERMARK?>/product/460x300x1/<?= UPLOAD_PRODUCT_L.$value['photo'] ?>" alt="<?= $value['ten'.$lang] ?>" onerror="this.src='<?=THUMBS?>/460x300x1/assets/images/noimage.png';">
                        </span>
                        <figcaption class="plist-text hover">
                            <?='<h3>'.$value['ten'.$lang].'</h3>' ?>
                        </figcaption>
                        <a href="<?= $value[$sluglang] ?>" title="<?= $value['ten'.$lang] ?>"> </a>
                    </figure>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
<!-- end plist -->
<?php 
$ptop_ind = $d->rawQuery("SELECT id, photo, ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, ngaytao, gia, giamoi, btn_new FROM table_product WHERE type = 'product' AND noibat>0 AND hienthi>0   ORDER BY stt ASC"); 
?>
<?php if (!empty($ptop_ind)){ ?>
<section id="block-ptop">
    <div class="container">
        <div class="container-ptop swiper-container ptop-swiper">
            <div class="ptop-box swiper-wrapper">
                <?php foreach ($ptop_ind as $key => $value){ 
                echo $func->product_show($value,'swiper-slide ptop-col',$thumb_product); 
                } ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!-- end product -->
<?php 
$product_list = $d->rawQuery("SELECT id, photo, ten$lang, tenkhongdauvi, tenkhongdauen FROM table_product_list WHERE type = 'product' AND noibat>0 AND hienthi>0   ORDER BY stt ASC"); 
$title_pagelist = $d->rawQueryOne("SELECT ten$lang, mota$lang, hienthi FROM table_title WHERE type = 'title' AND id='6'");
?>
<section id="block-pagelist">
    <?php foreach($product_list as $key_list => $value_list) { ?>
    <div class="container-pagelist">
        <div class="container">
            <div class="title-main">
                <?='<h2>'.$value_list['ten'.$lang].'</h2>'?>
            </div>
            <div class="pagelist-paging flexbox pagelist-<?=$value_list['id']?>" data-list="<?=$value_list['id']?>"></div>
        </div>
    </div>
    <?php } ?>
</section>
<!-- end pagelist -->
<?php 
$project_ind = $d->rawQuery("SELECT id, photo, ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, ngaytao FROM table_news WHERE type = 'project' AND noibat>0 AND hienthi>0 ORDER BY stt,id DESC LIMIT 0,6");
$title_project = $d->rawQueryOne("SELECT ten$lang, mota$lang, hienthi FROM table_title WHERE type = 'title' AND id='1'");
?>
<?php if ($title_project['hienthi']){ ?>
<section id="block-project">
    <div class="container">
        <div class="container-project">
            <div class="title-main">
                <?='<h2>'.$title_project['ten'.$lang].'</h2>'?>
            </div>
            <?php if (!empty($project_ind)){ ?>
            <div class="project-box flexbox">
                <?php foreach ($project_ind as $key => $value){ ?>
                <div class="project-col">
                    <div class="project-item">
                        <article class="project-img">
                            <a class="effect-scale img-full" href="<?= $value[$sluglang] ?>" title="<?= $value['ten'.$lang] ?>">
                                <img src="<?=THUMBS?>/390x280x1/<?= UPLOAD_NEWS_L.$value['photo'] ?>" alt="<?= $value['ten'.$lang] ?>" onerror="this.src='<?=THUMBS?>/390x280x1/assets/images/noimage.png';">
                            </a>
                        </article>
                        <article class="project-text hover">
                            <?='<h3><a href="'.$value[$sluglang].'" title="'.$value['ten'.$lang].'">'.$value['ten'.$lang].'</a> </h3>' ?>
                        </article>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="btn-main">
                <a href="du-an" title="<?=xemtatca?>"><?=xemtatca?></a>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
<!-- end project -->
<?php 
$introduce_ind = $d->rawQuery("SELECT id, photo, ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, ngaytao FROM table_news WHERE type = 'introduce' AND noibat>0 AND hienthi>0 ORDER BY stt,id DESC");
$title_introduce = $d->rawQueryOne("SELECT ten$lang, mota$lang, hienthi FROM table_title WHERE type = 'title' AND id='2'");
?>
<?php if ($title_introduce['hienthi']){ ?>
<section id="block-introduce">
    <div class="container">
        <div class="container-introduce">
            <?php if (!empty($introduce_ind)){ ?>
            <div class="introduce-box flexbox">
                <div class="introduce-show">
                    <div class="introduce-title">
                        <?='<h2>'.$title_introduce['ten'.$lang].'</h2>'?>
                    </div>
                    <div class="introduce-result">
                        <?='<h3>'.$introduce_ind[0]['ten'.$lang].'</h3>' ?>
                        <?='<p>'.$introduce_ind[0]['mota'.$lang].'</p>' ?>
                        <?='<a href="'.$introduce_ind[0][$sluglang].'" title="'.$introduce_ind[0]['ten'.$lang].'">'.xemthem.'__</a>' ?>
                    </div>
                </div>
                <div class="introduce-tab">
                    <div class="introduce-bg">
                        <?php foreach ($introduce_ind as $key => $value){ ?>
                        <div class="introduce-item <?php if($key==0){echo 'tab-active';}?>" data-id="<?=$value['id']?>">
                            <article class="introduce-text">
                                <?='<h3>'.$value['ten'.$lang].'</h3>' ?>
                            </article>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
<!-- end introduce -->
<?php 
$news_ind = $d->rawQuery("SELECT id, photo, ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, ngaytao FROM table_news WHERE type = 'news' AND noibat>0 AND hienthi>0 ORDER BY stt,id DESC");
$title_news = $d->rawQueryOne("SELECT ten$lang, mota$lang, hienthi FROM table_title WHERE type = 'title' AND id='3'");
?>
<?php if ($title_news['hienthi']){ ?>
<section id="block-news">
    <div class="container">
        <div class="container-news">
            <div class="title-main">
                <?='<h2>'.$title_news['ten'.$lang].'</h2>'?>
            </div>
            <?php if (!empty($news_ind)){ ?>
            <div class="swiper-container news-swiper">
                <div class="news-box swiper-wrapper">
                    <?php foreach ($news_ind as $key => $value){ ?>
                    <div class="news-col swiper-slide">
                        <div class="news-item">
                            <article class="news-img">
                                <a class="effect-scale img-full" href="<?= $value[$sluglang] ?>" title="<?= $value['ten'.$lang] ?>">
                                    <img src="<?=THUMBS?>/375x240x1/<?= UPLOAD_NEWS_L.$value['photo'] ?>" alt="<?= $value['ten'.$lang] ?>" onerror="this.src='<?=THUMBS?>/375x240x1/assets/images/noimage.png';">
                                </a>
                            </article>
                            <article class="news-text hover">
                                <h3 class="flexbox">
                                    <?='<p> <b>'.date('d',$value['ngaytao']).'</b> <span>'.thang.' '.$func->change_month($value['ngaytao']).'</span> </p>' ?>
                                    <?='<a href="'.$value[$sluglang].'" title="'.$value['ten'.$lang].'">'.$value['ten'.$lang].'</a> ' ?>
                                </h3>
                                <?='<article>'.$value['mota'.$lang].'</article>' ?>
                                <button>
                                    <a href="<?= $value[$sluglang] ?>" title="<?= $value['ten'.$lang] ?>"><?=xemthem?> <i class="fal fa-angle-double-right"></i></a>
                                </button>
                            </article>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>
<!-- end news -->