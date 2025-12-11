<section id="block-inProduct" class="inBody">
    <div class="container">
        <div class="container-inProduct">
            <div class="title-main">
                <?='<h2>'.((@$title_cat!='')?$title_cat:@$title_crumb).'</h2>'?>
            </div>
            <div class="inProduct-wrap flexbox">
                <div class="inProduct-aside">
                    <?php include TEMPLATE.LAYOUT.'aside.php' ?>
                </div>
                <div class="inProduct-show">
                    <?php if (isset($product) && !empty($product)){ ?>
                    <div class="inProduct-box flexbox">
                        <?php foreach ($product as $key => $value): ?>
                        <?php echo $func->product_show($value,'resCol',$thumb_product);?>
                        <?php endforeach ?>
                    </div>
                    <?php }else{ ?>
                    <div class="alert alert-warning" role="alert">
                        <?='<strong>'.khongtimthayketqua.'</strong>'?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="inProduct-page pagination-home">
                <?=(isset($paging) && $paging != '') ? $paging : ''?>
            </div>
        </div>
    </div>
</section>
<!-- end inProduct -->