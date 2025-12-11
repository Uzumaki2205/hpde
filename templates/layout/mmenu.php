<section id="block-mmenu">
    <div class="container">
        <div class="mmenu-box">
            <div class="mmenu-show flexbox">
                <div class="mmenu-nav">
                    <a href="#menu"><span></span></a>
                </div>
                <div class="mmenu-search">
                    <form action="" method="get" name="frm_search_rp" id="frm_search_rp" onsubmit="return false;">
                        <input type="text" id="search_input" name="keyword_rp" onkeypress="doEnter_rp(event)" value="<?=nhaptukhoatimkiem?>" onblur="if(this.value=='') this.value='<?=nhaptukhoatimkiem?>'" onfocus="if(this.value =='<?=nhaptukhoatimkiem?>') this.value=''" />
                        <div class="mmenu-icon">
                            <a href="javascript:void(0);" id="tnSearch_rp" name="searchAct">
                                <i class="fa fa-search" id="tnSearch_rp" aria-hidden="true" name="searchAct" alt="<?=nhaptukhoatimkiem?>"></i></a>
                        </div>
                    </form>
                </div>
            </div>
            <nav id="menu">
                <ul class="main-menu-m">
                    <?php 
                    $func->menu_item('home',trangchu); 
                    $func->menu_item('gioi-thieu',gioithieu); 
                    $func->menu_item('san-pham',sanpham,'1','product','product'); 
                    $func->menu_item('bang-gia',banggia); 
                    $func->menu_item('catalogue',catalogue); 
                    $func->menu_item('du-an',duan); 
                    $func->menu_item('tin-tuc',tintuc); 
                    $func->menu_item('tuyen-dung',tuyendung); 
                    $func->menu_item('lien-he',lienhe);
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</section>
<!-- end mmenu -->