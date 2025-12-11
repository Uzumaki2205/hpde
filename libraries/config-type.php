<?php
/* Config type - Group */
    // $config['group'] = array(
    //     "Group Sản Phẩm" => array(
    //         "product" => array("san-pham"),
    //         "static" => array("gioi-thieu-san-pham"),
    //         "photo" => array("slide-product"),
    //         "photo_static" => array("watermark")
    //     ),
    //     "Group Tin Tức" => array(
    //         "news" => array("tin-tuc"),
    //         "photo_static" => array("watermark-news")
    //     )
    // );

/* Config type - Product */
require_once LIBRARIES.'type/config-type-product.php';

/* Config type - News */
require_once LIBRARIES.'type/config-type-news.php';

/* Config type - Static */
if (false) {
    /* Giới thiệu */
    $nametype = "about_us";
    $config['static'][$nametype]['title_main'] = "Về chúng tôi";
    $config['static'][$nametype]['images'] = true;
    $config['static'][$nametype]['file'] = false;
    $config['static'][$nametype]['tieude'] = true;
    $config['static'][$nametype]['mota'] = true;
    $config['static'][$nametype]['mota_cke'] = false;
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = false;
    $config['static'][$nametype]['seo'] = true;
    $config['static'][$nametype]['width'] = 300;
    $config['static'][$nametype]['height'] = 200;
    $config['static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['static'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';
}

if (false) {
    /* Giới thiệu sản phẩm */
    $nametype = "about_product";
    $config['static'][$nametype]['title_main'] = "Giới thiệu sản phẩm";
    $config['static'][$nametype]['images'] = true;
    $config['static'][$nametype]['file'] = true;
    $config['static'][$nametype]['tieude'] = true;
    $config['static'][$nametype]['mota'] = true;
    $config['static'][$nametype]['mota_cke'] = false;
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;
    $config['static'][$nametype]['seo'] = true;
    $config['static'][$nametype]['width'] = 300;
    $config['static'][$nametype]['height'] = 200;
    $config['static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['static'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';
} 
if (true) {
    /* Bảng giá */
    $nametype = "table_price";
    $config['static'][$nametype]['title_main'] = "Bảng giá";
    $config['static'][$nametype]['images'] = false;
    $config['static'][$nametype]['file'] = false;
    $config['static'][$nametype]['tieude'] = true;
    $config['static'][$nametype]['mota'] = false;
    $config['static'][$nametype]['mota_cke'] = false;
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;
    $config['static'][$nametype]['seo'] = true;
    $config['static'][$nametype]['width'] = 300;
    $config['static'][$nametype]['height'] = 200;
    $config['static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['static'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';
} 

if (false) {
    /* Gallery */
    $nametype = "gallery";
    $config['static'][$nametype]['title_main'] = "Thư viện hình ảnh";
    $config['static'][$nametype]['images'] = false;
    $config['static'][$nametype]['file'] = false;
    $config['static'][$nametype]['tieude'] = true;
    $config['static'][$nametype]['mota'] = false;
    $config['static'][$nametype]['mota_cke'] = false;
    $config['static'][$nametype]['noidung'] = false;
    $config['static'][$nametype]['noidung_cke'] = false;
    $config['static'][$nametype]['seo'] = true;
    $config['static'][$nametype]['width'] = 300;
    $config['static'][$nametype]['height'] = 200;
    $config['static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['static'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';
    $config['static'][$nametype]['gallery'] = array
    (
        $nametype => array
        (
            "title_main_photo" => "Hình ảnh Thư viện",
            "title_sub_photo" => "Hình ảnh",
            "number_photo" => 3,
            "images_photo" => true,
            "avatar_photo" => true,
            "tieude_photo" => true,
            "width_photo" => 540,
            "height_photo" => 540,
            "thumb_photo" => '100x100x1',
            "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
        ),
    );
} 

if (true) {
    /* Liên hệ */
    $nametype = "contact";
    $config['static'][$nametype]['title_main'] = "Liên hệ";
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;
}

if (false) {
    /* Footer */
    $nametype = "footer";
    $config['static'][$nametype]['title_main'] = "Footer";
    $config['static'][$nametype]['tieude'] = true;
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;
}

/* Config type - Photo */
if (false) {
    /* full option photo_static*/
    $nametype = "type";
    $config['photo']['photo_static'][$nametype]['title_main']   = "name";
    $config['photo']['photo_static'][$nametype]['tieude']       = true;
    $config['photo']['photo_static'][$nametype]['images']       = true;
    $config['photo']['photo_static'][$nametype]['background']   = true;
    $config['photo']['photo_static'][$nametype]['mota']         = true;
    $config['photo']['photo_static'][$nametype]['mota_cke']     = true;
    $config['photo']['photo_static'][$nametype]['noidung']      = true;
    $config['photo']['photo_static'][$nametype]['noidung_cke']  = true;
    $config['photo']['photo_static'][$nametype]['watermark']    = true;
    $config['photo']['photo_static'][$nametype]['watermark-advanced'] = true;
    $config['photo']['photo_static'][$nametype]['width']        = 100;
    $config['photo']['photo_static'][$nametype]['height']       = 100;
    $config['photo']['photo_static'][$nametype]['thumb']        = '100x100x1';
    $config['photo']['photo_static'][$nametype]['img_type']     = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}

// =======================//
if (false) {
    /* Background */
    $nametype = "background";
    $config['photo']['photo_static'][$nametype]['title_main']   = "Background";
    $config['photo']['photo_static'][$nametype]['images']       = true;
    $config['photo']['photo_static'][$nametype]['background']   = true;
    $config['photo']['photo_static'][$nametype]['width']        = 900;
    $config['photo']['photo_static'][$nametype]['height']       = 300;
    $config['photo']['photo_static'][$nametype]['thumb']        = '900x300x1';
    $config['photo']['photo_static'][$nametype]['img_type']     = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (true) {
    /* Favicon */
    $nametype = "favicon";
    $config['photo']['photo_static'][$nametype]['title_main']   = "Favicon";
    $config['photo']['photo_static'][$nametype]['images']       = true;
    $config['photo']['photo_static'][$nametype]['mota']         = false;
    $config['photo']['photo_static'][$nametype]['width']        = 48;
    $config['photo']['photo_static'][$nametype]['height']       = 48;
    $config['photo']['photo_static'][$nametype]['thumb']        = '48x48x1';
    $config['photo']['photo_static'][$nametype]['img_type']     = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (true) {
    /* Logo */
    $nametype = "logo";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Logo";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 230;
    $config['photo']['photo_static'][$nametype]['height'] = 90;
    $config['photo']['photo_static'][$nametype]['thumb'] = '230x90x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}

if (true) {
    /* Banner */
    $nametype = "banner";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Banner";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 575;
    $config['photo']['photo_static'][$nametype]['height'] = 55;
    $config['photo']['photo_static'][$nametype]['thumb'] = '575x55x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (true) {
    /* Watermark */
    $nametype = "watermark";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Watermark";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['watermark'] = true;
    $config['photo']['photo_static'][$nametype]['watermark-advanced'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 50;
    $config['photo']['photo_static'][$nametype]['height'] = 50;
    $config['photo']['photo_static'][$nametype]['thumb'] = '50x50x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.png|.PNG|.Png';
    $config['photo']['photo_static'][$nametype]['mota'] = false;
}
if (false) {
    /* Watermark tin tức */
    $nametype = "watermark-news";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Watermark tin tức";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['watermark'] = true;
    $config['photo']['photo_static'][$nametype]['watermark-advanced'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 50;
    $config['photo']['photo_static'][$nametype]['height'] = 50;
    $config['photo']['photo_static'][$nametype]['thumb'] = '50x50x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.png|.PNG|.Png';
}
if (false) {
    /* Video */
    $nametype = "video";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Video";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['video'] = true;
    $config['photo']['photo_static'][$nametype]['tieude'] = true;
    $config['photo']['photo_static'][$nametype]['mota'] = true;
    $config['photo']['photo_static'][$nametype]['noidung'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 250;
    $config['photo']['photo_static'][$nametype]['height'] = 150;
    $config['photo']['photo_static'][$nametype]['thumb'] = '250x150x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (false) {
    /* Popup */
    $nametype = "popup";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Popup";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['tieude'] = true;
    $config['photo']['photo_static'][$nametype]['link'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 800;
    $config['photo']['photo_static'][$nametype]['height'] = 530;
    $config['photo']['photo_static'][$nametype]['thumb'] = '800x530x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
// =================================================================================//
if (false) {
    /* full option man_photo */
    $nametype = "type";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "name";
    $config['photo']['man_photo'][$nametype]['number_photo']    = 2;
    $config['photo']['man_photo'][$nametype]['images_photo']    = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo']    = true;
    $config['photo']['man_photo'][$nametype]['link_photo']      = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo']    = true;
    $config['photo']['man_photo'][$nametype]['mota_photo']      = true;
    $config['photo']['man_photo'][$nametype]['mota_cke_photo']  = true;
    $config['photo']['man_photo'][$nametype]['noidung_photo']   = true;
    $config['photo']['man_photo'][$nametype]['noidung_cke_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo']     = 1366;
    $config['photo']['man_photo'][$nametype]['height_photo']    = 600;
    $config['photo']['man_photo'][$nametype]['thumb_photo']     = '200x100x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo']  = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
// =======================//
if (true) {
    /* Slideshow */
    $nametype = "slide";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Slideshow";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 1;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
    $config['photo']['man_photo'][$nametype]['mota_photo']  = false;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 1366;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 485;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '1366x485x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (true) {
    /* Link chi tiết sản phẩm */
    $nametype = "product_detail";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Link chi tiết sản phẩm";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 1;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = false;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
    $config['photo']['man_photo'][$nametype]['mota_photo']  = false;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 780;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 580;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '780x580x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (false) {
    /* Slideshow product */
    $nametype = "slide_product";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Slideshow sản phẩm";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 2;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 1366;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 600;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '200x100x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (false) {
    /* Video */
    $nametype = "video";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Video";
    $config['photo']['man_photo'][$nametype]['check_photo'] = array("noibat" => "Nổi bật");
    $config['photo']['man_photo'][$nametype]['number_photo'] = 2;
    $config['photo']['man_photo'][$nametype]['video_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
}
if (true) {
    /* Mạng xã hội */
    $nametype = "social_header";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Mạng xã hội Header";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 1;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 20;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 20;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '20x20x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (true) {
    /* Mạng xã hội 1 */
    $nametype = "social_body";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Mạng xã hội Body";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 1;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 30;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 30;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '30x30x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (true) {
    /* Mạng xã hội 2 */
    $nametype = "social_footer";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Mạng xã hội Footer";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 1;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 35;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 35;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '35x35x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}

if (true) {
    /* Quảng cáo */
    $nametype = "ads";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Quảng cáo";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 1;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 270;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 380;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '270x380x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (false) {
    /* Đối tác */
    $nametype = "partner";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Đối tác";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 1;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 175;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 95;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '175x95x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}

/* Config type - Tags */
if (true) {
    /* Tags Sản phẩm */
    $nametype = "product";
    $config['tags'][$nametype]['title_main'] = "Tags sản phẩm";
    $config['tags'][$nametype]['slug'] = true;
    $config['tags'][$nametype]['images'] = false;
    $config['tags'][$nametype]['show_images'] = false;
    // $config['tags'][$nametype]['check'] = array("noibat" => "Nổi bật");
    $config['tags'][$nametype]['seo'] = true;
    $config['tags'][$nametype]['width'] = 300;
    $config['tags'][$nametype]['height'] = 200;
    $config['tags'][$nametype]['thumb'] = '100x100x1';
    $config['tags'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (false) {
    /* Tags tin tức */
    $nametype = "tin-tuc";
    $config['tags'][$nametype]['title_main'] = "Tags tin tức";
    $config['tags'][$nametype]['slug'] = true;
    $config['tags'][$nametype]['images'] = true;
    $config['tags'][$nametype]['show_images'] = true;
    $config['tags'][$nametype]['check'] = array("noibat" => "Nổi bật");
    $config['tags'][$nametype]['seo'] = true;
    $config['tags'][$nametype]['width'] = 300;
    $config['tags'][$nametype]['height'] = 200;
    $config['tags'][$nametype]['thumb'] = '100x100x1';
    $config['tags'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
if (true) {
    /* Đăng ký nhận tin */
    $nametype = "mail";
    $config['newsletter'][$nametype]['title_main'] = "Đăng ký nhận tin";
    $config['newsletter'][$nametype]['ten'] = true;
    $config['newsletter'][$nametype]['email'] = true;
    $config['newsletter'][$nametype]['dienthoai'] = true;
    $config['newsletter'][$nametype]['file'] = false;
    $config['newsletter'][$nametype]['guiemail'] = true;
    $config['newsletter'][$nametype]['diachi'] = false;
    $config['newsletter'][$nametype]['chude'] = false;
    $config['newsletter'][$nametype]['noidung'] = false;
    $config['newsletter'][$nametype]['ghichu'] = false;
    $config['newsletter'][$nametype]['tinhtrang'] = array("1" => "Đã xem", "2" => "Đã liên hệ", "3" => "Đã thông báo");
    $config['newsletter'][$nametype]['showten'] = true;
    $config['newsletter'][$nametype]['showdienthoai'] = true;
    $config['newsletter'][$nametype]['showngaytao'] = true;
    $config['newsletter'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';
}

if (true) {
    /* Title */
    $nametype = "title";
    $config['title']['man_photo'][$nametype]['title_main_photo'] = "Tiêu đề";
    $config['title']['man_photo'][$nametype]['setting']         = false;
    $config['title']['man_photo'][$nametype]['count']           = array(1,2,3);
    $config['title']['man_photo'][$nametype]['tieude_photo']    = true;
    $config['title']['man_photo'][$nametype]['mota_photo']      = true;
    $config['title']['man_photo'][$nametype]['noidung_photo']   = false;
    $config['title']['man_photo'][$nametype]['link_photo']      = false;
    $config['title']['man_photo'][$nametype]['link_text']       = 'Tiêu đề phụ';
    $config['title']['man_photo'][$nametype]['number_photo']    = 1;
    $config['title']['man_photo'][$nametype]['images_photo']    = false;
    $config['title']['man_photo'][$nametype]['avatar_photo']    = false;
    $config['title']['man_photo'][$nametype]['mota_cke_photo']  = false;
    $config['title']['man_photo'][$nametype]['noidung_cke_photo'] = false;
    $config['title']['man_photo'][$nametype]['width_photo']     = 1366;
    $config['title']['man_photo'][$nametype]['height_photo']    = 600;
    $config['title']['man_photo'][$nametype]['thumb_photo']     = '200x100x1';
    $config['title']['man_photo'][$nametype]['img_type_photo']  = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
    switch($id){
        case '1': $config['title']['man_photo'][$nametype]['mota_photo']  = false; break;
        case '2': $config['title']['man_photo'][$nametype]['mota_photo']  = false; break;
        case '3': $config['title']['man_photo'][$nametype]['mota_photo']  = false; break;
        case '4': $config['title']['man_photo'][$nametype]['mota_photo']  = false; break;
        case '5': $config['title']['man_photo'][$nametype]['mota_photo']  = false; break;
        case '6': $config['title']['man_photo'][$nametype]['mota_photo']  = false; break;
        case '7': $config['title']['man_photo'][$nametype]['mota_photo']  = false; break;
        case '8': $config['title']['man_photo'][$nametype]['mota_photo']  = false; break;
        case '9': $config['title']['man_photo'][$nametype]['mota_photo']  = false; break;
    }
}

/* Setting */
$config['setting']['diachi'] = true;
$config['setting']['dienthoai'] = true;
$config['setting']['hotline'] = true;
$config['setting']['zalo'] = true;
$config['setting']['oaidzalo'] = true;
$config['setting']['email'] = true;
$config['setting']['website'] = true;
$config['setting']['fanpage'] = true;
$config['setting']['page_product'] = true;
$config['setting']['toado'] = false;
$config['setting']['toado_iframe'] = true;

/* Seo page */
$config['seopage']['page'] = array(
    "introduce" => "Giới thiệu",
    "product" => "Sản phẩm",
    "catalogue" => "Catalogue",
    "project" => "Dự án",
    "news" => "Tin tức",
    "recruitment" => "Tuyển dụng",
    "contact" => "Liên hệ"
);
$config['seopage']['width'] = 300;
$config['seopage']['height'] = 200;
$config['seopage']['thumb'] = '300x200x1';
$config['seopage']['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


if (false) {
    /* Quản lý import */
    $config['import']['images'] = true;
    $config['import']['thumb'] = '100x100x1';
    $config['import']['img_type'] = ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF";

    /* Quản lý export */
    $config['export']['category'] = true;
}
if (false) {
    /* Quản lý tài khoản */
    $config['user']['active'] = true;
    $config['user']['admin'] = true;
    $config['user']['visitor'] = true;
}
if (false) {
    /* Quản lý phân quyền */
    $config['permission'] = true;
}
if (false) {
    /* Quản lý địa điểm */
    $config['places']['active'] = true;
    $config['places']['placesship'] = true;
}
if (false) {
    /* Quản lý giỏ hàng */
    $config['order']['active'] = true;
    $config['order']['search'] = true;
    $config['order']['excel'] = true;
    $config['order']['word'] = true;
    $config['order']['excelall'] = true;
    $config['order']['wordall'] = true;
    $config['order']['thumb'] = '100x100x1';
}
if (false) {
    /* Quản lý thông báo đẩy */
    $config['onesignal'] = true;
}
?>