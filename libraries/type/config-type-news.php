<?php
/* Dự án */
if (true) {
    $nametype = "project";
    $config['news'][$nametype]['title_main'] = "Dự án";
    $config['news'][$nametype]['dropdown'] = false;
    $config['news'][$nametype]['list'] = false;
    $config['news'][$nametype]['cat'] = false;
    $config['news'][$nametype]['item'] = false;
    $config['news'][$nametype]['sub'] = false;
    $config['news'][$nametype]['tags'] = false;
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['copy_image'] = true;
    $config['news'][$nametype]['slug'] = true;
    $config['news'][$nametype]['check'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['images'] = true;
    $config['news'][$nametype]['show_images'] = true;
    // $config['news'][$nametype]['gallery'] = array
    // (
    //     $nametype => array
    //     (
    //         "title_main_photo" => "Hình ảnh Dự án",
    //         "title_sub_photo" => "Hình ảnh",
    //         "number_photo" => 3,
    //         "images_photo" => true,
    //         "avatar_photo" => true,
    //         "tieude_photo" => true,
    //         "width_photo" => 540,
    //         "height_photo" => 540,
    //         "thumb_photo" => '100x100x1',
    //         "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
    //     ),
    //     "video" => array
    //     (
    //         "title_main_photo" => "Video Dự án",
    //         "title_sub_photo" => "Video",
    //         "number_photo" => 2,
    //         "video_photo" => true,
    //         "tieude_photo" => true
    //     ),
    //     "taptin" => array
    //     (
    //         "title_main_photo" => "Tập tin Dự án",
    //         "title_sub_photo" => "Tập tin",
    //         "number_photo" => 2,
    //         "file_photo" => true,
    //         "tieude_photo" => true,
    //         "file_type_photo" => 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS'
    //     )
    // );
    $config['news'][$nametype]['mota'] = true;
    $config['news'][$nametype]['noidung'] = true;
    $config['news'][$nametype]['noidung_cke'] = true;
    $config['news'][$nametype]['seo'] = true;
    $config['news'][$nametype]['width'] = 390;
    $config['news'][$nametype]['height'] = 280;
    $config['news'][$nametype]['thumb'] = '390x280x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['news'][$nametype]['bonus'] = false;

    /* Dự án (List) */
    $config['news'][$nametype]['title_main_list'] = "Dự án cấp 1";
    $config['news'][$nametype]['images_list'] = false;
    $config['news'][$nametype]['show_images_list'] = false;
    $config['news'][$nametype]['slug_list'] = true;
    $config['news'][$nametype]['check_list'] = array("noibat" => "Nổi bật");
    // $config['news'][$nametype]['gallery_list'] = array
    // (
    //     $nametype => array
    //     (
    //         "title_main_photo" => "Hình ảnh Dự án cấp 1",
    //         "title_sub_photo" => "Hình ảnh",
    //         "number_photo" => 2,
    //         "images_photo" => true,
    //         "avatar_photo" => true,
    //         "tieude_photo" => true,
    //         "width_photo" => 320,
    //         "height_photo" => 240,
    //         "thumb_photo" => '100x100x1',
    //         "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF',
    //     ),
    //     "video" => array
    //     (
    //         "title_main_photo" => "Video Dự án cấp 1",
    //         "title_sub_photo" => "Video",
    //         "number_photo" => 2,
    //         "video_photo" => true,
    //         "tieude_photo" => true
    //     )
    // );
    $config['news'][$nametype]['mota_list'] = true;
    $config['news'][$nametype]['mota_cke_list'] = true;
    $config['news'][$nametype]['noidung_list'] = true;
    $config['news'][$nametype]['noidung_cke_list'] = true;
    $config['news'][$nametype]['seo_list'] = true;
    $config['news'][$nametype]['width_list'] = 320;
    $config['news'][$nametype]['height_list'] = 240;
    $config['news'][$nametype]['thumb_list'] = '100x100x1';
    $config['news'][$nametype]['img_type_list'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Dự án (Cat) */
    $config['news'][$nametype]['title_main_cat'] = "Dự án cấp 2";
    $config['news'][$nametype]['images_cat'] = false;
    $config['news'][$nametype]['show_images_cat'] = false;
    $config['news'][$nametype]['slug_cat'] = true;
    // $config['news'][$nametype]['check_cat'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['mota_cat'] = true;
    $config['news'][$nametype]['mota_cke_cat'] = true;
    $config['news'][$nametype]['noidung_cat'] = true;
    $config['news'][$nametype]['noidung_cke_cat'] = true;
    $config['news'][$nametype]['seo_cat'] = true;
    $config['news'][$nametype]['width_cat'] = 320;
    $config['news'][$nametype]['height_cat'] = 240;
    $config['news'][$nametype]['thumb_cat'] = '100x100x1';
    $config['news'][$nametype]['img_type_cat'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Dự án (Item) */
    $config['news'][$nametype]['title_main_item'] = "Dự án cấp 3";
    $config['news'][$nametype]['images_item'] = true;
    $config['news'][$nametype]['show_images_item'] = true;
    $config['news'][$nametype]['slug_item'] = true;
    $config['news'][$nametype]['check_item'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['mota_item'] = true;
    $config['news'][$nametype]['mota_cke_item'] = true;
    $config['news'][$nametype]['noidung_item'] = true;
    $config['news'][$nametype]['noidung_cke_item'] = true;
    $config['news'][$nametype]['seo_item'] = true;
    $config['news'][$nametype]['width_item'] = 320;
    $config['news'][$nametype]['height_item'] = 240;
    $config['news'][$nametype]['thumb_item'] = '100x100x1';
    $config['news'][$nametype]['img_type_item'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Dự án (Sub) */
    $config['news'][$nametype]['title_main_sub'] = "Dự án cấp 4";
    $config['news'][$nametype]['images_sub'] = true;
    $config['news'][$nametype]['show_images_sub'] = true;
    $config['news'][$nametype]['slug_sub'] = true;
    $config['news'][$nametype]['check_sub'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['mota_sub'] = true;
    $config['news'][$nametype]['mota_cke_sub'] = true;
    $config['news'][$nametype]['noidung_sub'] = true;
    $config['news'][$nametype]['noidung_cke_sub'] = true;
    $config['news'][$nametype]['seo_sub'] = true;
    $config['news'][$nametype]['width_sub'] = 320;
    $config['news'][$nametype]['height_sub'] = 240;
    $config['news'][$nametype]['thumb_sub'] = '100x100x1';
    $config['news'][$nametype]['img_type_sub'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';    
}
/* Thư viện */
if (false) {
    $nametype = "album";
    $config['news'][$nametype]['title_main'] = "Thư viện";
    $config['news'][$nametype]['dropdown'] = true;
    $config['news'][$nametype]['list'] = false;
    $config['news'][$nametype]['cat'] = false;
    $config['news'][$nametype]['item'] = false;
    $config['news'][$nametype]['sub'] = false;
    $config['news'][$nametype]['tags'] = false;
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['copy_image'] = true;
    $config['news'][$nametype]['slug'] = true;
    $config['news'][$nametype]['check'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['images'] = true;
    $config['news'][$nametype]['show_images'] = true;
    $config['news'][$nametype]['gallery'] = array
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
        // "video" => array
        // (
        //     "title_main_photo" => "Video Thư viện",
        //     "title_sub_photo" => "Video",
        //     "number_photo" => 2,
        //     "video_photo" => true,
        //     "tieude_photo" => true
        // ),
        // "taptin" => array
        // (
        //     "title_main_photo" => "Tập tin Thư viện",
        //     "title_sub_photo" => "Tập tin",
        //     "number_photo" => 2,
        //     "file_photo" => true,
        //     "tieude_photo" => true,
        //     "file_type_photo" => 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS'
        // )
    );
    $config['news'][$nametype]['mota'] = false;
    $config['news'][$nametype]['noidung'] = false;
    $config['news'][$nametype]['noidung_cke'] = false;
    $config['news'][$nametype]['seo'] = true;
    $config['news'][$nametype]['width'] = 270;
    $config['news'][$nametype]['height'] = 270;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['news'][$nametype]['bonus'] = false;

    /* Thư viện (List) */
    $config['news'][$nametype]['title_main_list'] = "Thư viện cấp 1";
    $config['news'][$nametype]['images_list'] = true;
    $config['news'][$nametype]['show_images_list'] = true;
    $config['news'][$nametype]['slug_list'] = true;
    $config['news'][$nametype]['check_list'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['gallery_list'] = array
    (
        $nametype => array
        (
            "title_main_photo" => "Hình ảnh Thư viện cấp 1",
            "title_sub_photo" => "Hình ảnh",
            "number_photo" => 2,
            "images_photo" => true,
            "avatar_photo" => true,
            "tieude_photo" => true,
            "width_photo" => 320,
            "height_photo" => 240,
            "thumb_photo" => '100x100x1',
            "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF',
        ),
        "video" => array
        (
            "title_main_photo" => "Video Thư viện cấp 1",
            "title_sub_photo" => "Video",
            "number_photo" => 2,
            "video_photo" => true,
            "tieude_photo" => true
        )
    );
    $config['news'][$nametype]['mota_list'] = true;
    $config['news'][$nametype]['mota_cke_list'] = true;
    $config['news'][$nametype]['noidung_list'] = true;
    $config['news'][$nametype]['noidung_cke_list'] = true;
    $config['news'][$nametype]['seo_list'] = true;
    $config['news'][$nametype]['width_list'] = 320;
    $config['news'][$nametype]['height_list'] = 240;
    $config['news'][$nametype]['thumb_list'] = '100x100x1';
    $config['news'][$nametype]['img_type_list'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Thư viện (Cat) */
    $config['news'][$nametype]['title_main_cat'] = "Thư viện cấp 2";
    $config['news'][$nametype]['images_cat'] = true;
    $config['news'][$nametype]['show_images_cat'] = true;
    $config['news'][$nametype]['slug_cat'] = true;
    $config['news'][$nametype]['check_cat'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['mota_cat'] = true;
    $config['news'][$nametype]['mota_cke_cat'] = true;
    $config['news'][$nametype]['noidung_cat'] = true;
    $config['news'][$nametype]['noidung_cke_cat'] = true;
    $config['news'][$nametype]['seo_cat'] = true;
    $config['news'][$nametype]['width_cat'] = 320;
    $config['news'][$nametype]['height_cat'] = 240;
    $config['news'][$nametype]['thumb_cat'] = '100x100x1';
    $config['news'][$nametype]['img_type_cat'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Thư viện (Item) */
    $config['news'][$nametype]['title_main_item'] = "Thư viện cấp 3";
    $config['news'][$nametype]['images_item'] = true;
    $config['news'][$nametype]['show_images_item'] = true;
    $config['news'][$nametype]['slug_item'] = true;
    $config['news'][$nametype]['check_item'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['mota_item'] = true;
    $config['news'][$nametype]['mota_cke_item'] = true;
    $config['news'][$nametype]['noidung_item'] = true;
    $config['news'][$nametype]['noidung_cke_item'] = true;
    $config['news'][$nametype]['seo_item'] = true;
    $config['news'][$nametype]['width_item'] = 320;
    $config['news'][$nametype]['height_item'] = 240;
    $config['news'][$nametype]['thumb_item'] = '100x100x1';
    $config['news'][$nametype]['img_type_item'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Thư viện (Sub) */
    $config['news'][$nametype]['title_main_sub'] = "Thư viện cấp 4";
    $config['news'][$nametype]['images_sub'] = true;
    $config['news'][$nametype]['show_images_sub'] = true;
    $config['news'][$nametype]['slug_sub'] = true;
    $config['news'][$nametype]['check_sub'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['mota_sub'] = true;
    $config['news'][$nametype]['mota_cke_sub'] = true;
    $config['news'][$nametype]['noidung_sub'] = true;
    $config['news'][$nametype]['noidung_cke_sub'] = true;
    $config['news'][$nametype]['seo_sub'] = true;
    $config['news'][$nametype]['width_sub'] = 320;
    $config['news'][$nametype]['height_sub'] = 240;
    $config['news'][$nametype]['thumb_sub'] = '100x100x1';
    $config['news'][$nametype]['img_type_sub'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
}
/* Giới thiệu */
if (true) {
    $nametype = "introduce";
    $config['news'][$nametype]['title_main'] = "Giới thiệu";
    $config['news'][$nametype]['check'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['slug'] = true;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['images'] = true;
    $config['news'][$nametype]['show_images'] = true;
    $config['news'][$nametype]['mota'] = true;
    $config['news'][$nametype]['noidung'] = true;
    $config['news'][$nametype]['noidung_cke'] = true;
    $config['news'][$nametype]['seo'] = true;
    $config['news'][$nametype]['width'] = 320;
    $config['news'][$nametype]['height'] = 240;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['news'][$nametype]['bonus'] = false;
}

/* catalogue */
if (true) {
    $nametype = "catalogue";
    $config['news'][$nametype]['title_main'] = "Catalogue";
    // $config['news'][$nametype]['check'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['slug'] = false;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['images'] = true;
    $config['news'][$nametype]['show_images'] = true;
    $config['news'][$nametype]['mota'] = false;
    $config['news'][$nametype]['noidung'] = false;
    $config['news'][$nametype]['noidung_cke'] = false;
    $config['news'][$nametype]['seo'] = false;
    $config['news'][$nametype]['width'] = 320;
    $config['news'][$nametype]['height'] = 240;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['news'][$nametype]['bonus'] = false;
    $config['news'][$nametype]['file'] = true;
    $config['news'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';
}
/* Tin tức */
if (true) {
    $nametype = "news";
    $config['news'][$nametype]['title_main'] = "Tin tức";
    $config['news'][$nametype]['check'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['tieude'] = false;
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['slug'] = true;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['images'] = true;
    $config['news'][$nametype]['show_images'] = true;
    $config['news'][$nametype]['mota'] = true;
    $config['news'][$nametype]['noidung'] = true;
    $config['news'][$nametype]['noidung_cke'] = true;
    $config['news'][$nametype]['seo'] = true;
    $config['news'][$nametype]['width'] = 320;
    $config['news'][$nametype]['height'] = 240;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'; 
    $config['news'][$nametype]['bonus'] = false;
}
/* Tuyển dụng */
if (true) {   
    $nametype = "recruitment";
    $config['news'][$nametype]['title_main'] = "Tuyển dụng";
    $config['news'][$nametype]['check'] = array("noibat" => "Nổi bật");
    $config['news'][$nametype]['tieude'] = false;
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['slug'] = true;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['images'] = true;
    $config['news'][$nametype]['show_images'] = true;
    $config['news'][$nametype]['mota'] = true;
    $config['news'][$nametype]['noidung'] = true;
    $config['news'][$nametype]['noidung_cke'] = true;
    $config['news'][$nametype]['seo'] = true;
    $config['news'][$nametype]['width'] = 320;
    $config['news'][$nametype]['height'] = 240;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['news'][$nametype]['bonus'] = false;
}
/* Dịch vụ */
if (false) {    
    $nametype = "service";
    $config['news'][$nametype]['title_main'] = "Dịch vụ";
    $config['news'][$nametype]['check'] = array();
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['slug'] = true;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['images'] = true;
    $config['news'][$nametype]['show_images'] = true;
    $config['news'][$nametype]['mota'] = true;
    $config['news'][$nametype]['noidung'] = true;
    $config['news'][$nametype]['noidung_cke'] = true;
    $config['news'][$nametype]['seo'] = true;
    $config['news'][$nametype]['width'] = 320;
    $config['news'][$nametype]['height'] = 240;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['news'][$nametype]['bonus'] = false;
}
/* Chi nhánh */
if (true) {
    $nametype = "branch";
    $config['news'][$nametype]['title_main'] = "Chi nhánh";
    $config['news'][$nametype]['check'] = array();
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['slug'] = false;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['images'] = false;
    $config['news'][$nametype]['show_images'] = false;
    $config['news'][$nametype]['noidung'] = false;
    $config['news'][$nametype]['noidung_cke'] = false;
    $config['news'][$nametype]['seo'] = false;
    $config['news'][$nametype]['width'] = 320;
    $config['news'][$nametype]['height'] = 240;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['news'][$nametype]['bonus'] = true;
    $config['news'][$nametype]['bonus_arr'] = array(
        "address" => true,
        "address_text" => "Địa chỉ",
        "hotline" => true,
        "hotline_text" => "Hotline",
        "email" => true,
        "email_text" => "E-mail",
        "website" => true,
        "website_text" => "Website",
        "iframe" => true,
        "iframe_text" => "iframe",
    );
    
}

/* Hỗ trợ khách hàng */
if (true) {
    $nametype = "support";
    $config['news'][$nametype]['title_main'] = "Hỗ trợ khách hàng";
    $config['news'][$nametype]['check'] = array();
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['slug'] = false;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['images'] = false;
    $config['news'][$nametype]['show_images'] = false;
    $config['news'][$nametype]['noidung'] = false;
    $config['news'][$nametype]['noidung_cke'] = false;
    $config['news'][$nametype]['seo'] = false;
    $config['news'][$nametype]['width'] = 320;
    $config['news'][$nametype]['height'] = 240;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['news'][$nametype]['bonus'] = true;
    $config['news'][$nametype]['bonus_arr'] = array(
        "address" => false,
        "address_text" => "Địa chỉ",
        "hotline" => true,
        "hotline_text" => "Hotline",
        "email" => true,
        "email_text" => "E-mail",
        "website" => false,
        "website_text" => "Website",
        "iframe" => false,
        "iframe_text" => "iframe",
    );
    
}
/* Chính sách */
if (true) {
    $nametype = "policy";
    $config['news'][$nametype]['title_main'] = "Chính sách";
    $config['news'][$nametype]['check'] = array();
    $config['news'][$nametype]['view'] = true;
    $config['news'][$nametype]['slug'] = true;
    $config['news'][$nametype]['copy'] = true;
    $config['news'][$nametype]['images'] = false;
    $config['news'][$nametype]['show_images'] = false;
    $config['news'][$nametype]['noidung'] = true;
    $config['news'][$nametype]['noidung_cke'] = true;
    $config['news'][$nametype]['seo'] = true;
    $config['news'][$nametype]['width'] = 320;
    $config['news'][$nametype]['height'] = 240;
    $config['news'][$nametype]['thumb'] = '100x100x1';
    $config['news'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['news'][$nametype]['bonus'] = false;
}
/* Hình thức thanh toán */
if (false) {
    $nametype = "method_payment";
    $config['news'][$nametype]['title_main'] = "Hình thức thanh toán";
    $config['news'][$nametype]['check'] = array();
    $config['news'][$nametype]['mota'] = true;
}
/* Quản lý mục (Không cấp) */
if(isset($config['news']))
{
    foreach($config['news'] as $key => $value)
    {
        if(!isset($value['dropdown']) || (isset($value['dropdown']) && $value['dropdown'] == false))
        { 
            $config['shownews'] = 1;
            break;
        }
    }
}
?>