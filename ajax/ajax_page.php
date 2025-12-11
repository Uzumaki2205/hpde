<?php 
include "ajax_config.php";

/* Paginations */
include LIBRARIES."class/class.PaginationsAjax.php";
$table = $_GET['table'];
$type = $_GET['type'];
$pagingAjax = new PaginationsAjax();
$pagingAjax->perpage = (htmlspecialchars($_GET['perpage']) && $_GET['perpage'] > 0) ? htmlspecialchars($_GET['perpage']) : 1;
$eShow = htmlspecialchars($_GET['eShow']);
$idList = (isset($_GET['idList']) && $_GET['idList'] > 0) ? htmlspecialchars($_GET['idList']) : 0;
$p = (isset($_GET['p']) && $_GET['p'] > 0) ? htmlspecialchars($_GET['p']) : 1;
$start = ($p-1) * $pagingAjax->perpage;
$pageLink = "ajax/ajax_page.php?table=".$table."&type=".$type."&perpage=".$pagingAjax->perpage;
$tempLink = "";
$where = "";

/* Math url */
if($idList)
{
    $tempLink .= "&idList=".$idList;
    $where .= " and id_list = ".$idList;
}
$tempLink .= "&p=";
$pageLink .= $tempLink;

$select = $table=='product' ? ', gia, giamoi, giakm' : '';

/* Get data */
$sql = "select ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, id, photo, ngaytao, btn_new $select from table_$table where type='".$type."' $where and noibat>0 and hienthi>0 order by stt,id desc";

$sqlCache = $sql." limit $start, $pagingAjax->perpage";
$items = $cache->getCache($sqlCache,'result',7200);

/* Count all data */
$countItems = count($cache->getCache($sql,'result',7200));

/* Get page result */
$pagingItems = $pagingAjax->getAllPageLinks($countItems, $pageLink, $eShow);
?>
<?php if($countItems) { ?>
    <?php foreach ($items as $key => $value){
        if ($table=='product') {
            echo $func->product_show($value,'resCol'); 
        }else{
            echo $func->news_Classic($value,$type);
        }
    } ?>
    <?='<div class="pagination-ajax">'.$pagingItems.'</div>'?>
<?php } ?>
<script>
    $(document).ready(function() {
        $('.fancybox-popup').fancybox({
            transitionEffect: "fade",
            transitionDuration: 600,
            animationEffect: "fade",
            animationDuration: 600,
            arrows: true,
            infobar: false,
            toolbar: true,
            hash: false,
            hash: false,
            width: 500,
            height: 450,
        });
    });
</script>
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