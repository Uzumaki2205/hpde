<section id="block-menu">
    <div class="container">
        <nav class="container-menu">
            <ul class="menu-main flexbox">
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
                include TEMPLATE.LAYOUT."search.php";
                ?>
            </ul>
        </nav>
    </div>
</section>
<!-- end menu -->