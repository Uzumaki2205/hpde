<?php 
$footer = $d->rawQueryOne("select noidung$lang from #_static where type = ? limit 0,1",array('footer'));
$policy = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, photo from #_news where type = ? and hienthi > 0 order by stt,id desc",array('policy'));
$branch_footer = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, photo, bonus from #_news where type = ? and hienthi > 0 order by stt,id desc limit 0,2",array('branch'));
$tags_product = $d->rawQuery("SELECT ten$lang, tenkhongdau$lang, id FROM table_tags WHERE type = 'product' AND hienthi>0 ORDER BY stt,id DESC");
?>
<section id="block-footer">
    <div class="footer-top">
        <div class="container">
            <div class="box flexbox">
                <div class="footer-company flexbox">
                    <?php foreach ($branch_footer as $key => $value): 
                        $bonus_branch = (isset($value['bonus']) && $value['bonus'] != '') ? json_decode($value['bonus'],true) : null;
                    ?>
                    <div class="branch-col">
                        <div class="branch-title  <?php if ($key==0){echo 'footer-title';}?>">
                            <?='<h2>'.$value['ten'.$lang].'</h2>'?>
                        </div>
                        <ul class="branch-box">
                            <?='<li><i class="fas fa-map-marker-alt"></i> '.diachi.': '.((isset($bonus_branch['address']) && $bonus_branch['address'] != '') ? $bonus_branch['address'] : '').'</li>'?>
                            <?='<li><i class="fal fa-envelope"></i> Tel: '.((isset($bonus_branch['email']) && $bonus_branch['email'] != '') ? $bonus_branch['email'] : '').'</li>'?>
                            <?='<li><i class="fas fa-phone-alt"></i> Email: '.((isset($bonus_branch['hotline']) && $bonus_branch['hotline'] != '') ? $bonus_branch['hotline'] : '').'</li>'?>
                            <?='<li><i class="fas fa-globe-americas"></i> Website: '.((isset($bonus_branch['website']) && $bonus_branch['website'] != '') ? $bonus_branch['website'] : '').'</li>'?>
                        </ul>
                        <a data-fancybox="branch" data-src="#branch-<?=$value['id']?>" href="javascript:;" title="<?=$value['ten'.$lang]?>"><i class="fas fa-map-marker-alt"></i>
                            <?=xembando?></a>
                        <div id="branch-<?=$value['id']?>" class="branch-iframe">
                            <?= ((isset($bonus_branch['iframe']) && $bonus_branch['iframe'] != '') ? $bonus_branch['iframe'] : '') ?>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <div class="footer-facebook">
                    <?=$addons->setAddons('fanpage-facebook', 'fanpage-facebook', 10);?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-mid">
        <div class="footer-mail">
            <div class="container">
                <div class="flexbox">
                    <div class="footer-social flexbox">
                        <?='<h2>'.mangxahoi.'</h2>'?>
                        <?php $func->social('social_footer','35x35x1') ?>
                    </div>
                    <div class="mail-box flexbox">
                        <div class="mail-title">
                            <?='<h2>'.dangkynhanbaogia.'</h2>'?>
                        </div>
                        <form method="POST" class="mail-form flexbox" autocomplete="off" action="newsletter" enctype="multipart/form-data">
                            <input type="text" name="mail_ten" class="mail_ten" placeholder="<?=hoten?>">
                            <input type="email" name="mail_email" class="mail_email" required placeholder="Email">
                            <input type="text" name="mail_dienthoai" class="mail_dienthoai" placeholder="<?=sodienthoai?>">
                            <input type="hidden" name="mail_type" value="mail">
                            <input type="hidden" name="recaptcha_response_mail" id="recaptchaResponse_mail">
                            <button type="submit" class="mail-btn">
                                <?=gui?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-policy">
            <div class="container">
                <div class="flexbox">
                    <div class="mail-title">
                        <?='<h2>'.chinhsachkhachhang.'</h2>'?>
                    </div>
                    <ul class="policy-box flexbox">
                        <?php foreach($policy as $key => $value) { ?>
                        <?='<li><a href="'.$value[$sluglang].'" title="'.$value['ten'.$lang].'">'.$value['ten'.$lang].'</a></li>'?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-tag">
            <div class="container">
                <div class="container-tags">
                    <?php if (!empty($tags_product)){ ?>
                    <div class="tags-box flexbox">
                        <div class="tags-title">
                            <h2>Tags Seo:</h2>
                        </div>
                        <?php foreach ($tags_product as $key => $value){ ?>
                        <div class="tags-col">
                            <div class="tags-item">
                                <article class="tags-text">
                                    <?='<h3><a href="'.$value['tenkhongdau'.$lang].'" title="'.$value['ten'.$lang].'">'.$value['ten'.$lang].'</a> <span>/</span> </h3> ' ?>
                                </article>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- end tags -->
        </div>
    </div>
    <div class="footer-bot">
        <div class="container">
            <div class="box flexbox">
                <div class="copyright">
                    <?='<p>2020 Copyright <span>'.$setting['ten'.$lang].'</span>. Design by Nina.vn</p>'?>
                </div>
                <div class="counter flexbox">
                    <?='<p>'.dangonline.': <span>'.$online.'</span></p>'?>
                    <?='<p>'.homnay.': <span>'.$counter['today'].'</span></p>'?>
                    <?='<p>'.trongthang.': <span>'.$counter['month'].'</span></p>'?>
                    <?='<p>'.tongtruycap.': <span>'.$counter['total'].'</span></p>'?>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="popup-contact">
    <div class="popup-container">
        <div class="popup-box">
            <div class="popup-title">
                <?='<h2>'.dangkybaogia.'</h2>'?>
            </div>
            <form class="validation-contact popup-contact flexbox" novalidate method="post" action="lien-he" enctype="multipart/form-data">
                <div class="input-contact">
                    <input type="text" class="form-control" id="ten" name="ten" placeholder="<?=hoten?>" required />
                    <div class="invalid-feedback">
                        <?=vuilongnhaphoten?>
                    </div>
                </div>
                <div class="input-contact">
                    <input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="<?=sodienthoai?>" required />
                    <div class="invalid-feedback">
                        <?=vuilongnhapsodienthoai?>
                    </div>
                </div>
                <div class="input-contact">
                    <input type="text" class="form-control" id="diachi" name="diachi" placeholder="<?=diachi?>" required />
                    <div class="invalid-feedback">
                        <?=vuilongnhapdiachi?>
                    </div>
                </div>
                <div class="input-contact">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                    <div class="invalid-feedback">
                        <?=vuilongnhapdiachiemail?>
                    </div>
                </div>
                <div class="input-contact input-contact-full">
                    <input type="text" class="form-control" id="tieude" name="tieude" placeholder="<?=chude?>" required />
                    <div class="invalid-feedback">
                        <?=vuilongnhapchude?>
                    </div>
                </div>
                <div class="input-contact input-contact-full">
                    <textarea class="form-control" id="noidung" name="noidung" placeholder="<?=noidung?>" required /></textarea>
                    <div class="invalid-feedback">
                        <?=vuilongnhapnoidung?>
                    </div>
                </div>
                <div class="popup-btn">
                    <input type="submit" class="btn btn-primary" name="submit-contact" value="<?=gui?>" disabled />
                    <input type="reset" class="btn btn-secondary" value="<?=nhaplai?>" />
                    <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
                </div>
            </form>
        </div>
    </div>
</div>