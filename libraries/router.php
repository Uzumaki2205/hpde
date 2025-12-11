<?php
	/* Check HTTP */
	$func->checkHTTP($http,$config['arrayDomainSSL'],$config_base,$config_url);

	/* Validate URL */
	$func->checkUrl($config['website']['index']);

	/* Check login */
    $func->checkLogin();
	if ($config['bonus']['mobile']){
		/* Mobile detect */
	    $deviceType = ($detect->isMobile() || $detect->isTablet()) ? 'mobile' : 'computer';
	    if($deviceType == 'computer') define('TEMPLATE','./templates/');
	    else define('TEMPLATE','./templates-mobile/');
	 }else{
	 	define('TEMPLATE','./templates/');
	 }

    /* Watermark */
    $wtmPro = $d->rawQueryOne("select hienthi, photo, options from #_photo where type = ? and act = ? limit 0,1",array('watermark','photo_static'));
	$wtmNews = $d->rawQueryOne("select hienthi, photo, options from #_photo where type = ? and act = ? limit 0,1",array('watermark-news','photo_static'));

    /* Router */
    $router->setBasePath($config['database']['url']);
    $router->map('GET',array('admin/','admin'), function(){
		global $func, $config;
		$func->redirect($config['database']['url']."admin/index.php");
		exit;
	});
	$router->map('GET',array('admin','admin'), function(){
		global $func, $config;
		$func->redirect($config['database']['url']."admin/index.php");
		exit;
	});
    $router->map('GET|POST', '', 'index', 'home');
    $router->map('GET|POST', 'index.php', 'index', 'index');
    $router->map('GET|POST', 'sitemap.xml', 'sitemap', 'sitemap');
    $router->map('GET|POST', '[a:com]', 'allpage', 'show');
    $router->map('GET|POST', '[a:com]/[a:lang]/', 'allpagelang', 'lang');
    $router->map('GET|POST', '[a:com]/[a:action]', 'account', 'account');
    $router->map('GET', THUMBS.'/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
        global $func;
        $func->createThumb($w,$h,$z,$src,null,THUMBS);
    },'thumb');
    $router->map('GET', WATERMARK.'/product/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
        global $func, $wtmPro;
        $func->createThumb($w,$h,$z,$src,$wtmPro,"product");
    },'watermark');
    $router->map('GET', WATERMARK.'/news/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
        global $func, $wtmNews;
        $func->createThumb($w,$h,$z,$src,$wtmNews,"news");
    },'watermarkNews');
    $match = $router->match();
	if(is_array($match))
	{
		if(is_callable($match['target']))
		{
			call_user_func_array($match['target'], $match['params']); 
		}
		else
		{
			$com = (isset($match['params']['com'])) ? htmlspecialchars($match['params']['com']) : htmlspecialchars($match['target']);
			$get_page = isset($_GET['p']) ? htmlspecialchars($_GET['p']) : 1;
		}
	}
	else
	{
		header('HTTP/1.0 404 Not Found', true, 404);
		include("404.php");
		exit;
	}

    /* Setting */
    $sqlCache = "select * from #_setting";
    $setting = $cache->getCache($sqlCache,'fetch',7200);
    $optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'],true) : null;
    /* Lang */
    if(isset($match['params']['lang']) && $match['params']['lang'] != '') $_SESSION['lang'] = $match['params']['lang'];
    else if(!isset($_SESSION['lang']) && !isset($match['params']['lang'])) $_SESSION['lang'] = $optsetting['lang_default'];
    $lang = $_SESSION['lang'];

    /* Slug lang */
    $sluglang = 'tenkhongdauvi';

    $thumb_product = $config['setting']['product_thumb'];
    
    /* SEO Lang */
    $seolang = "vi";

    /* Require datas */
    require_once LIBRARIES."lang/lang$lang.php";
    require_once SOURCES."allpage.php";

	/* Tối ưu link */
	$requick = array(
		/* Sản phẩm */
		array("tbl"=>"product_list","field"=>"idl","source"=>"product","com"=>"san-pham","type"=>"product"),
		array("tbl"=>"product_cat","field"=>"idc","source"=>"product","com"=>"san-pham","type"=>"product"),
		// array("tbl"=>"product_item","field"=>"idi","source"=>"product","com"=>"san-pham","type"=>"product"),
		// array("tbl"=>"product_sub","field"=>"ids","source"=>"product","com"=>"san-pham","type"=>"product"),
		// array("tbl"=>"product_brand","field"=>"idb","source"=>"product","com"=>"thuong-hieu","type"=>"product"),
		array("tbl"=>"product","field"=>"id","source"=>"product","com"=>"san-pham","type"=>"product",'menu'=>true),
		
		/* Tags */
		array("tbl"=>"tags","tbltag"=>"product","field"=>"id","source"=>"tags","com"=>"tags","type"=>"product",'menu'=>true),
		// array("tbl"=>"tags","tbltag"=>"news","field"=>"id","source"=>"tags","com"=>"tags-tin-tuc","type"=>"news",'menu'=>true),

		/* Thư viện ảnh */
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"album","type"=>"album",'menu'=>true),

		/* Video */
		array("tbl"=>"photo","field"=>"id","source"=>"video","com"=>"video","type"=>"video",'menu'=>true),

		/* Tin tức */
		array("tbl"=>"news_list","field"=>"idl","source"=>"news","com"=>"tin-tuc","type"=>"news"),
		array("tbl"=>"news_cat","field"=>"idc","source"=>"news","com"=>"tin-tuc","type"=>"news"),
		// array("tbl"=>"news_item","field"=>"idi","source"=>"news","com"=>"tin-tuc","type"=>"news"),
		// array("tbl"=>"news_sub","field"=>"ids","source"=>"news","com"=>"tin-tuc","type"=>"news"),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"tin-tuc","type"=>"news",'menu'=>true),

		/* Bài viết */
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"gioi-thieu","type"=>"introduce",'menu'=>true),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"dich-vu","type"=>"service",'menu'=>true),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"du-an","type"=>"project",'menu'=>true),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"tuyen-dung","type"=>"recruitment",'menu'=>true),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"chinh-sach","type"=>"policy",'menu'=>false),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"catalogue","type"=>"catalogue",'menu'=>true),

		/* Trang tĩnh */
		array("tbl"=>"static","field"=>"id","source"=>"static","com"=>"bang-gia","type"=>"table_price",'menu'=>true),
		// array("tbl"=>"static","field"=>"id","source"=>"static","com"=>"ve-chung-toi","type"=>"about_us",'menu'=>true),
		array("tbl"=>"gallery","field"=>"id","source"=>"news","com"=>"gallery","type"=>"gallery",'menu'=>false),

		/* Liên hệ */
		array("tbl"=>"","field"=>"id","source"=>"","com"=>"lien-he","type"=>"contact",'menu'=>true),
	);

	/* Find data */
	if($com != 'tim-kiem' && $com != 'account' && $com != 'sitemap')
	{
		foreach($requick as $key => $value)
		{
			$url_tbl = (isset($value['tbl']) && $value['tbl'] != '') ? $value['tbl'] : '';
			$url_tbltag = (isset($value['tbltag']) && $value['tbltag'] != '') ? $value['tbltag'] : '';
			$url_type = (isset($value['type']) && $value['type'] != '') ? $value['type'] : '';
			$url_field = (isset($value['field']) && $value['field'] != '') ? $value['field'] : '';
			$url_com = (isset($value['com']) && $value['com'] != '') ? $value['com'] : '';
			
			if($url_tbl!='' && $url_tbl!='static' && $url_tbl!='photo')
			{
				$row = $d->rawQueryOne("select id from #_$url_tbl where $sluglang = ? and type = ? and hienthi > 0 limit 0,1",array($com,$url_type));
				
				if($row['id'])
				{
					$_GET[$url_field] = $row['id'];
					$com = $url_com;
					break;
				}
			}
		}
	}

	/* Switch coms */
	
	switch($com)
	{
		case 'lien-he':
			$source = "contact";
			$template = "contact/contact";
			$seo->setSeo('type','object');
			$title_crumb = lienhe;
			break;

		case 've-chung-toi':
			$source = "static";
			$template = "static/static";
			$type = 'about_us';
			$seo->setSeo('type','article');
			$title_crumb = vechungtoi;
			break;

		case 'bang-gia':
			$source = "static";
			$template = "static/static";
			$type = 'table_price';
			$seo->setSeo('type','article');
			$title_crumb = banggia;
			break;

		case 'gioi-thieu':
			$source = "news";
			$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'introduce';
			$title_crumb = gioithieu;
			break;

		case 'tin-tuc':
			$source = "news";
			$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'news';
			$title_crumb = tintuc;
			break;

		case 'catalogue':
			$source = "news";
			$template = "news/news";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'catalogue';
			$title_crumb = catalogue;
			break;

		case 'dich-vu':
			$source = "news";
			$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'service';
			$title_crumb = dichvu;
			break;

		case 'du-an':
			$source = "news";
			$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'project';
			$title_crumb = duan;
			break;

		case 'tuyen-dung':
			$source = "news";
			$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'recruitment';
			$title_crumb = tuyendung;
			break;

		case 'chinh-sach':
			$source = "news";
			$template = isset($_GET['id']) ? "news/news_detail" : "";
			$seo->setSeo('type','article');
			$type = 'policy';
			$title_crumb = null;
			break;

		// case 'thuong-hieu':
		// 	$source = "product";
		// 	$template = "product/product";
		// 	$seo->setSeo('type','object');
		// 	$type = 'product';
		// 	$title_crumb = null;
		// 	break;

		case 'san-pham':
			$source = "product";
			$template = isset($_GET['id']) ? "product/product_detail" : "product/product";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'product';
			$title_crumb = sanpham;
			break;

		case 'tim-kiem':
			$source = "search";
			$template = "product/product";
			$seo->setSeo('type','object');
			$title_crumb = timkiem;
			break;

		case 'tags':
			$source = "tags";
			$template = "product/product";
			$type = $url_type;
			$table = $url_tbltag;
			$seo->setSeo('type','object');
			$title_crumb = null;
			break;

		// case 'tags-tin-tuc':
		// 	$source = "tags";
		// 	$template = "news/news";
		// 	$type = $url_type;
		// 	$table = $url_tbltag;
		// 	$seo->setSeo('type','object');
		// 	$title_crumb = null;
		// 	break;

		case 'album':
			$source = "news";
			$template = isset($_GET['id']) ? "album/album_detail" : "album/album";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'album';
			$title_crumb = thuvienanh;
			break;

		case 'gallery':
			$source = "news";
			$template = "album/album";
			$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
			$type = 'gallery';
			$title_crumb = thuvienanh;
			break;
		
		case 'video':
			$source = "video";
			$template = "video/video";
			$type = 'video';
			$seo->setSeo('type','object');
			$title_crumb = "Video";
			break;
			
		case 'newsletter':
			$source = "newsletter";
			break;

		// case 'gio-hang':
		// 	$source = "order";
		// 	$template = 'order/order';
		// 	$title_crumb = giohang;
		// 	$seo->setSeo('type','object');
		// 	break;

		// case 'account':
		// 	$source = "user";
		// 	break;

		case 'ngon-ngu':
			if(isset($lang))
			{
				switch($lang)
				{
					case 'vi':
						$_SESSION['lang'] = 'vi';
						break;
					case 'en':
						$_SESSION['lang'] = 'en';
						break;
					default:
						$_SESSION['lang'] = 'vi';
						break;
				}
			}
			$func->redirect($_SERVER['HTTP_REFERER']);
			break;

		case 'sitemap':
			include_once LIBRARIES."sitemap.php";
			exit();
			
		case '':
		case 'index':
			$source = "index";
			$template ="index/index";
			$seo->setSeo('type','website');
			break;

		default: 
			header('HTTP/1.0 404 Not Found', true, 404);
			include("404.php");
			exit();
	}

	/* Include sources */
	if($source!='') include SOURCES.$source.".php";
	if($template=='')
	{
		header('HTTP/1.0 404 Not Found', true, 404);
		include("404.php");
		exit();
	}
?>