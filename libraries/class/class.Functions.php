<?php
class Functions {
	private $d;
	private $hash;
	function __construct($d)
	{
		$this->d = $d;
	}
	/* Check URL */
	public function checkURL($index=false)
	{
		global $config_base;
		$url = '';
		$urls = array('index','index.html','trang-chu','trang-chu.html');
		if(array_key_exists('REDIRECT_URL', $_SERVER))
		{
			$root = str_replace("/index.php", "", $_SERVER['PHP_SELF']);
			$url = str_replace($root."/", "", $_SERVER['REDIRECT_URL']);
		}
		else
		{
			$url = explode("/", $_SERVER['REQUEST_URI']);
			$url = $url[count($url)-1];
			if(strpos($url, "?"))
			{
				$url = explode("?", $url);
				$url = $url[0];
			}
		}
		if($index) array_push($urls,"index.php");
		else if(array_search('index.php', $urls)) $urls = array_diff($urls, ["index.php"]);
		if(in_array($url, $urls)) $this->redirect($config_base,301);
	}
	/* Check HTTP */
	public function checkHTTP($http, $arrayDomain, &$config_base, $config_url)
	{
		if(count($arrayDomain) == 0 && $http == 'https://')
		{
			$config_base = 'http://'.$config_url;
		}
	}
	/* Create sitemap */
	public function createSitemap($com='', $type='', $field='', $table='', $time='', $changefreq='', $priority='', $lang='vi', $orderby='', $menu=true)
	{
		global $config_base;
		$urlsm = '';
		$sitemap = null;
		if($type != '' && $table != 'photo')
		{
			$sitemap = $this->d->rawQuery("select tenkhongdau$lang, ngaytao from #_$table where type = ? order by $orderby desc",array($type));
		}
		if($menu == true && $field == 'id')
		{
			$urlsm = $config_base.$com;
			echo '<url>';
			echo '<loc>'.$urlsm.'</loc>';
			echo '<lastmod>'.date('c',time()).'</lastmod>';
			echo '<changefreq>'.$changefreq.'</changefreq>';
			echo '<priority>'.$priority.'</priority>';
			echo '</url>';
		}
		if($sitemap)
		{
			foreach($sitemap as $value)
			{
				$urlsm = $config_base.$value['tenkhongdau'.$lang];
				echo '<url>';
				echo '<loc>'.$urlsm.'</loc>';
				echo '<lastmod>'.date('c',$value['ngaytao']).'</lastmod>';
				echo '<changefreq>'.$changefreq.'</changefreq>';
				echo '<priority>'.$priority.'</priority>';
				echo '</url>';
			}
		}
	}
	/* Kiểm tra dữ liệu nhập vào */
	public function cleanInput($input='')
	{
		$output = '';
		if($input != '')
		{
			$search = array(
					'@<script[^>]*?>.*?</script>@si', // Loại bỏ javascript
'@<[\/\!]*?[^ <>]*?>@si', // Loại bỏ HTML tags
    '@<style[^>]*?>.*?</style>@siU', // Loại bỏ style tags
    '@
        <![\s\S]*?--[ \t\n\r]*>@'         // Loại bỏ multi-line comments
    );
			$output = preg_replace($search, '', $input);
		}
		return $output;
	}
	/* Kiểm tra dữ liệu nhập vào */
	public function sanitize($input='')
	{
		if(is_array($input))
		{
			foreach($input as $var=>$val)
			{
				$output[$var] = $this->sanitize($val);
			}
		}
		else
		{
			if(get_magic_quotes_gpc())
			{
				$input = stripslashes($input);
			}
			$input  = $this->cleanInput($input);
			$output = addslashes($input);
		}
		return $output;
	}
	/* Kiểm tra đăng nhập */
	public function check_login()
	{
		global $login_admin;
		$token = (isset($_SESSION[$login_admin]['token'])) ? $_SESSION[$login_admin]['token'] : '';
		$row = $this->d->rawQuery("select quyen from #_user where quyen = ? and hienthi>0",array($token));
		if(count($row) == 1 && $row[0]['quyen'] != '')
		{
			return true;
		}
		else
		{
			$_SESSION[$login_admin] = NULL;
			session_unset();
			return false;
		}
	}
	/* Mã hóa mật khẩu admin */
	public function encrypt_password($secret='', $str='', $salt='')
	{
		return md5($secret.$str.$salt);
	}
	/* Kiểm tra phân quyền menu */
	public function check_access($com='', $act='', $type='', $array=null, $case='', $dropdown=null)
	{
		$str = $com;
		if($act) $str .= '_'.$act;
		if($case == 'phrase-1')
		{
			if($type!='') $str .= '_'.$type;
			if(!in_array($str, $_SESSION['list_quyen'])) return true;
			else return false;
		}
		else if($case == 'phrase-2')
		{
			$count = 0;
			if($array)
			{
				if($dropdown == false)
				{
					foreach($array as $key => $value)
					{
						if(isset($value['dropdown']) && $value['dropdown'] == true)
						{
							unset($array[$key]);
						}
					}
				}
				foreach($array as $key => $value)
				{
					if(!in_array($str."_".$key, $_SESSION['list_quyen'])) $count++;
				}
				if($count == count($array)) return true;
			}
			else return false;
		}
		return false;
	}
	/* Kiểm tra phân quyền */
	public function check_permission()
	{
		global $config, $login_admin;
		if((isset($_SESSION[$login_admin]['username']) && $_SESSION[$login_admin]['username'] == 'admin') || (isset($config['website']['debug-developer']) && $config['website']['debug-developer'] == true)) return false;
		else return true;
	}
	/* Lấy tình trạng nhận tin */
	public function get_status_newsletter($tinhtrang=0, $type='')
	{
		global $config;
		$loai = '';
		if(isset($config['newsletter'][$type]['tinhtrang']) && count($config['newsletter'][$type]['tinhtrang']) > 0)
		{
			foreach($config['newsletter'][$type]['tinhtrang'] as $key => $value)
			{
				if($key == $tinhtrang)
				{
					$loai = $value;
					break;
				}
			}
		}
		if($loai == '') $loai="Đang chờ duyệt...";
		return $loai;
	}
	/* Lấy hình thức thanh toán */
	public function get_payments($id=0)
	{
		if($id)
		{
			$row = $this->d->rawQueryOne("select tenvi from #_news where id = ? limit 0,1",array($id));
			return $row['tenvi'];
		}
		else
		{
			return false;
		}
	}
	/* Lấy màu cart */
	public function get_color_cart($id=0)
	{
		if($id)
		{
			$row = $this->d->rawQueryOne("select mau, loaihienthi, photo, tenvi from #_product_mau where id = ? limit 0,1",array($id));
			return $row;
		}
		else
		{
			return false;
		}
	}
	/* Lấy places */
	public function get_places($table='', $id=0)
	{
		if($table && $id)
		{
			$row = $this->d->rawQueryOne("select ten from #_$table where id = ? limit 0,1",array($id));
			return $row['ten'];
		}
		else
		{
			return false;
		}
	}
	/* Join ID */
	public function joinID($array=null, $column=null)
	{
		$str = '';
		if($array && $column)
		{
			foreach($array as $k => $v)
			{
				if(isset($v[$column]) && $v[$column])
				{
					$str .= $v[$column].',';
				}
			}
			if($str)
			{
				$str = rtrim($str,',');
			}
		}
		return $str;
	}
	/* Format money */
	public function format_money($price=0, $unit='đ', $html=false)
	{
		$str = '';
		if($price)
		{
			$str .= number_format($price, 0, ',', '.');
			if($unit != '')
			{
				if($html)
				{
					$str .= '<span>'.$unit.'</span>';
				}
				else
				{
					$str .= $unit;
				}
			}
		}
		return $str;
	}
	/* Check recaptcha */
	public function checkRecaptcha($response='')
	{
		global $config;
		$result = null;
		$active = $config['googleAPI']['recaptcha']['active'];
		if($active == true && $response != '')
		{
			$recaptcha = file_get_contents($config['googleAPI']['recaptcha']['urlapi'].'?secret='.$config['googleAPI']['recaptcha']['secretkey'].'&response='.$response);
			$recaptcha = json_decode($recaptcha);
			$result['score'] = $recaptcha->score;
			$result['action'] = $recaptcha->action;
		}
		else if(!$active)
		{
			$result['test'] = true;
		}
		return $result;
	}
	/* Login */
	public function checkLogin()
	{
		global $d, $config_base, $login_member;
		if(isset($_SESSION[$login_member]) || isset($_COOKIE['login_member_id']))
		{
			$flag = true;
			$iduser = (isset($_COOKIE['login_member_id']) && $_COOKIE['login_member_id'] > 0) ? $_COOKIE['login_member_id'] : $_SESSION[$login_member]['id'];
			if($iduser)
			{
				$row = $this->d->rawQueryOne("select login_session, id, username, dienthoai, diachi, email, ten from #_member where id = ? and hienthi > 0",array($iduser));
				if($row['id'])
				{
					$login_session = (isset($_COOKIE['login_member_session']) && $_COOKIE['login_member_session'] > 0) ? $_COOKIE['login_member_session'] : $_SESSION[$login_member]['login_session'];
					if($login_session == $row['login_session'])
					{
						$_SESSION[$login_member]['active'] = true;
						$_SESSION[$login_member]['id'] = $row['id'];
						$_SESSION[$login_member]['username'] = $row['username'];
						$_SESSION[$login_member]['dienthoai'] = $row['dienthoai'];
						$_SESSION[$login_member]['diachi'] = $row['diachi'];
						$_SESSION[$login_member]['email'] = $row['email'];
						$_SESSION[$login_member]['ten'] = $row['ten'];
					}
					else $flag = false;
				}
				else $flag = false;
				if(!$flag)
				{
					unset($_SESSION[$login_member]);
					setcookie('login_member_id',"",-1,'/');
					setcookie('login_member_session',"",-1,'/');
					$this->transfer("Tài khoản của bạn đã hết hạn đăng nhập hoặc đã đăng nhập trên thiết bị khác", $config_base, false);
				}
			}
		}
	}
	/* Lấy youtube */
	public function getYoutube($url='') 
	{
		if($url != '')
		{
			$parts = parse_url($url);
			if(isset($parts['query'])) 
			{
				parse_str($parts['query'], $qs);
				if(isset($qs['v'])) return $qs['v'];
				else if($qs['vi']) return $qs['vi'];
			}
			if(isset($parts['path']))
			{
				$path = explode('/', trim($parts['path'], '/'));
				return $path[count($path) - 1];
			}
		}
		return false;
	}
	/* Template gallery */
	public function galleryFiler($stt=1, $id=0, $photo='', $name='', $folder='', $col='')
	{
		$str = '';
		$str .= '<li class="jFiler-item my-jFiler-item my-jFiler-item-'.$id.' '.$col.'" data-id="'.$id.'">';
		$str .= '<div class="jFiler-item-container">';
		$str .= '<div class="jFiler-item-inner">';
		$str .= '<div class="jFiler-item-thumb">';
		$str .= '<div class="jFiler-item-thumb-image">';
		$str .= '<img src="../upload/'.$folder.'/'.$photo.'" alt="'.$name.'"><i class="fas fa-arrows-alt"></i>';
		$str .= '</div>';
		$str .= '</div>';
		$str .= '<div class="jFiler-item-assets jFiler-row">';
		$str .= '<ul class="list-inline pull-right d-flex align-items-center justify-content-between">';
		$str .= '<li class="ml-1">';
		$str .= '<a class="icon-jfi-trash jFiler-item-trash-action my-jFiler-item-trash" data-id="'.$id.'" data-folder="'.$folder.'"></a>';
		$str .= '</li>';
		$str .= '<li class="mr-1">';
		$str .= '<div class="custom-control custom-checkbox d-inline-block align-middle text-md">';
		$str .= '<input type="checkbox" class="custom-control-input filer-checkbox" id="filer-checkbox-'.$id.'" value="'.$id.'">';
		$str .= '<label for="filer-checkbox-'.$id.'" class="custom-control-label font-weight-normal">Chọn</label>';
		$str .= '</div>';
		$str .= '</li>';
		$str .= '</ul>';
		$str .= '</div>';
		$str .= '<input type="number" class="form-control form-control-sm my-jFiler-item-info rounded mb-1" value="'.$stt.'" placeholder="Số thứ tự" data-info="stt" data-id="'.$id.'"/>';
		$str .= '<input type="text" class="form-control form-control-sm my-jFiler-item-info rounded" value="'.$name.'" placeholder="Tiêu đề" data-info="tieude" data-id="'.$id.'"/>';
		$str .= '</div>';
		$str .= '</div>';
		$str .= '</li>';
		return $str;
	}
	/* Delete gallery */
	public function deleteGallery()
	{
		$row = $this->d->rawQuery("select id, com, photo from #_gallery where hash != '' and ngaytao < ".(time()-3*3600));
		$array = array("product" => UPLOAD_PRODUCT, "news" => UPLOAD_NEWS);
		if($row)
		{
			foreach($row as $item)
			{
				@unlink($array[$item['com']].$item['photo']);
				$this->d->rawQuery("delete from #_gallery where id = ".$item['id']);
			}
		}
	}
	/* Generate hash */
	public function generateHash()
	{
		if(!$this->hash)
		{
			$this->hash = $this->stringRandom(10);
		}
		return $this->hash;
	}
	/* Lấy date */
	public function make_date($time=0, $dot='.', $lang='vi', $f=false)
	{
		$str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y",$time) : date("m{$dot}d{$dot}Y",$time);
		if($f == true)
		{
			$thu['vi'] = array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy');
			$thu['en'] = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
			$str = $thu[$lang][date('w',$time)].', '.$str;
		}
		return $str;
	}
	/* Alert */
	public function alert($notify='')
	{
		echo '<script language="javascript">alert("'.$notify.'")</script>';
	}
	/* Delete file */
	public function delete_file($file='')
	{
		return @unlink($file);
	}
	/* Transfer */
	public function transfer($msg='', $page='', $stt=true)
	{
		global $config_base;
		$basehref = $config_base;
		$showtext = $msg;
		$page_transfer = $page;
		$stt = $stt;
		include("./templates/layout/transfer.php");
		exit();
	}
	/* Redirect */
	public function redirect($url='', $response=null)
	{
		header("location:$url", true, $response);
		exit();
	}
	/* Dump */
	public function dump($value='', $exit=false)
	{
		echo "<pre>";	
		print_r($value);
		echo "</pre>";
		if($exit) exit();
	}
	/* Pagination */
	public function pagination($totalq=0, $per_page=10, $page=1, $url='?')
	{
		$urlpos = strpos($url, "?");
		$url = ($urlpos) ? $url."&" : $url."?";
		$total = $totalq;
		$adjacents = "2";
		$firstlabel = "First";
		$prevlabel = "Prev";
		$nextlabel = "Next";
		$lastlabel = "Last";
		$page = ($page == 0 ? 1 : $page);
		$start = ($page - 1) * $per_page;
		$prev = $page - 1;
		$next = $page + 1;
		$lastpage = ceil($total/$per_page);
		$lpm1 = $lastpage - 1;
		$pagination = "";
		if($lastpage > 1)
		{
			$pagination .= "<ul class='pagination justify-content-center mb-0'>";
			$pagination .= "<li class='page-item'><a class='page-link'>Page {$page} / {$lastpage}</a></li>";
			if($page > 1)
			{
				$pagination.= "<li class='page-item'><a class='page-link' href='{$this->getCurrentPageURL()}'>{$firstlabel}</a></li>";
				$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p={$prev}'>{$prevlabel}</a></li>";
			}
			if($lastpage < 7 + ($adjacents * 2))
			{
				for($counter = 1; $counter <= $lastpage; $counter++)
				{
					if($counter == $page) $pagination.= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
					else $pagination.= "<li class='page-item'><a class='page-link' href='{$url}p={$counter}'>{$counter}</a></li>";
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))
			{
				if($page < 1 + ($adjacents * 2))
				{
					for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if($counter == $page) $pagination.= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
						else $pagination.= "<li class='page-item'><a class='page-link' href='{$url}p={$counter}'>{$counter}</a></li>";
					}
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p=1'>...</a></li>";
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p={$lpm1}'>{$lpm1}</a></li>";
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p={$lastpage}'>{$lastpage}</a></li>";
				}
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p=1'>1</a></li>";
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p=2'>2</a></li>";
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p=1'>...</a></li>";
					for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if($counter == $page) $pagination.= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
						else $pagination.= "<li class='page-item'><a class='page-link' href='{$url}p={$counter}'>{$counter}</a></li>";
					}
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p=1'>...</a></li>";
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p={$lpm1}'>{$lpm1}</a></li>";
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p={$lastpage}'>{$lastpage}</a></li>";
				}
				else
				{
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p=1'>1</a></li>";
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p=2'>2</a></li>";
					$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p=1'>...</a></li>";
					for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if($counter == $page) $pagination.= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
						else $pagination.= "<li class='page-item'><a class='page-link' href='{$url}p={$counter}'>{$counter}</a></li>";
					}
				}
			}
			if($page < $counter - 1)
			{
				$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p={$next}'>{$nextlabel}</a></li>";
				$pagination.= "<li class='page-item'><a class='page-link' href='{$url}p=$lastpage'>{$lastlabel}</a></li>";
			}
			$pagination.= "</ul>";
		}
		return $pagination;
	}
	/* UTF8 convert */
	public function utf8convert($str='')
	{
		if($str != '')
		{
			$utf8 = array(
				'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
				'd'=>'đ|Đ',
				'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
				'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
				'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
				'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
				'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
				''=>'`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\“|\”|\:|\;|_',
			);
			foreach($utf8 as $ascii => $uni)
			{
				$str = preg_replace("/($uni)/i",$ascii,$str);
			}
		}
		return $str;
	}
	/* Change title */
	public function changeTitle($text='')
	{
		if($text != '')
		{
			$text = strtolower($this->utf8convert($text));
			$text = preg_replace("/[^a-z0-9-\s]/", "",$text);
			$text = preg_replace('/([\s]+)/', '-', $text);
			$text = str_replace(array('%20', ' '), '-', $text);
			$text = preg_replace("/\-\-\-\-\-/","-",$text);
			$text = preg_replace("/\-\-\-\-/","-",$text);
			$text = preg_replace("/\-\-\-/","-",$text);
			$text = preg_replace("/\-\-/","-",$text);
			$text = '@'.$text.'@';
			$text = preg_replace('/\@\-|\-\@|\@/', '', $text);	
		}
		return $text;
	}
	/* Lấy IP */
	public function getRealIPAddress()
	{
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	/* Lấy getPageURL */
	public function getPageURL()
	{
		$pageURL = 'http';
		if(array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") $pageURL .= "s";
		$pageURL .= "://";
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		return $pageURL;
	}
	/* Lấy getCurrentPageURL */
	public function getCurrentPageURL() 
	{
		$pageURL = 'http';
		if(array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") $pageURL .= "s";
		$pageURL .= "://";
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$urlpos = strpos($pageURL, "?p");
		$pageURL = ($urlpos) ? explode("?p=", $pageURL) : explode("&p=", $pageURL);
		return $pageURL[0];
	}
	/* Lấy getCurrentPageURL Cano */
	public function getCurrentPageURL_CANO()
	{
		$pageURL = 'http';
		if(array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") $pageURL .= "s";
		$pageURL .= "://";
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pageURL = str_replace("amp/", "", $pageURL);
		$urlpos = strpos($pageURL, "?p");
		$pageURL = ($urlpos) ? explode("?p=", $pageURL) : explode("&p=", $pageURL);
		$pageURL = explode("?", $pageURL[0]);
		$pageURL = explode("#", $pageURL[0]);
		$pageURL = explode("index", $pageURL[0]);
		return $pageURL[0];
	}
	/* Copy image */
	public function copyImg($photo='', $constant='')
	{
		$str = '';
		if($photo != '' && $constant != '')
		{
			$rand = rand(1000,9999);
			$name = pathinfo($photo, PATHINFO_FILENAME);
			$ext = pathinfo($photo, PATHINFO_EXTENSION);
			$photo_new = $name.'-'.$rand.'.'.$ext;
			$oldpath = '../../upload/'.$constant.'/'.$photo;
			$newpath = '../../upload/'.$constant.'/'.$photo_new;
			if(file_exists($oldpath))
			{
				if(copy($oldpath,$newpath))
				{
					$str = $photo_new;
				}
			}
		}
		return $str;
	}
	/* Get Img size */
	public function getImgSize($photo='', $patch='')
	{
		$x = (file_exists($patch)) ? getimagesize($patch) : null;
		return array("p"=>$photo,"w"=>$x[0],"h"=>$x[1],"m"=>$x['mime']);
	}
	/* Upload name */
	public function uploadName($name='')
	{
		$result = '';
		if($name != '')
		{
			$rand = rand(1000,9999);
			$ten_anh = pathinfo($name, PATHINFO_FILENAME);
			$result = $this->changeTitle($ten_anh)."-".$rand;
		}
		return $result;
	}
	/* Resize images */
	public function smartResizeImage($file='', $string=null, $width=0, $height=0, $proportional=false, $output='file', $delete_original=true, $use_linux_commands=false, $quality=100, $grayscale=false)
	{
		if($height <= 0 && $width <= 0) return false;
		if($file === null && $string === null) return false;
		$info = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
		$image = '';
		$final_width = 0;
		$final_height = 0;
		list($width_old, $height_old) = $info;
		$cropHeight = $cropWidth = 0;
		if($proportional)
		{
			if($width == 0) $factor = $height / $height_old;
			elseif($height == 0) $factor = $width / $width_old;
			else $factor = min($width / $width_old, $height / $height_old);
			$final_width = round($width_old * $factor);
			$final_height = round($height_old * $factor);
		}
		else
		{
			$final_width = ($width <= 0) ? $width_old : $width;
			$final_height = ($height <= 0) ? $height_old : $height;
			$widthX = $width_old / $width;
			$heightX = $height_old / $height;
			$x = min($widthX, $heightX);
			$cropWidth = ($width_old - $width * $x) / 2;
			$cropHeight = ($height_old - $height * $x) / 2;
		}
		switch($info[2])
		{
			case IMAGETYPE_JPEG:
			$file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);
			break;
			case IMAGETYPE_GIF:
			$file !== null ? $image = imagecreatefromgif($file) : $image = imagecreatefromstring($string);
			break;
			case IMAGETYPE_PNG:
			$file !== null ? $image = imagecreatefrompng($file) : $image = imagecreatefromstring($string);
			break;
			default:
			return false;
		}
		if($grayscale)
		{
			imagefilter($image, IMG_FILTER_GRAYSCALE);
		}
		$image_resized = imagecreatetruecolor($final_width, $final_height);
		if(($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG))
		{
			$transparency = imagecolortransparent($image);
			$palletsize = imagecolorstotal($image);
			if($transparency >= 0 && $transparency < $palletsize)
			{
				$transparent_color = imagecolorsforindex($image, $transparency);
				$transparency = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
				imagefill($image_resized, 0, 0, $transparency);
				imagecolortransparent($image_resized, $transparency);
			}
			elseif($info[2] == IMAGETYPE_PNG)
			{
				imagealphablending($image_resized, false);
				$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
				imagefill($image_resized, 0, 0, $color);
				imagesavealpha($image_resized, true);
			}
		}
		imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
		if($delete_original)
		{
			if($use_linux_commands) exec('rm ' . $file);
			else @unlink($file);
		}
		switch(strtolower($output))
		{
			case 'browser':
			$mime = image_type_to_mime_type($info[2]);
			header("Content-type: $mime");
			$output = NULL;
			break;
			case 'file':
			$output = $file;
			break;
			case 'return':
			return $image_resized;
			break;
			default:
			break;
		}
		switch($info[2])
		{
			case IMAGETYPE_GIF:
			imagegif($image_resized, $output);
			break;
			case IMAGETYPE_JPEG:
			imagejpeg($image_resized, $output, $quality);
			break;
			case IMAGETYPE_PNG:
			$quality = 9 - (int)((0.9 * $quality) / 10.0);
			imagepng($image_resized, $output, $quality);
			break;
			default:
			return false;
		}
		return true;
	}
	function correctImageOrientation($filename) {
		ini_set('memory_limit', '512M');
		if (function_exists('exif_read_data')) {
			$exif = exif_read_data($filename);

			if($exif && isset($exif['Orientation'])) {
				$orientation = $exif['Orientation'];
				if($orientation != 1){
					$img = imagecreatefromjpeg($filename);

					$deg = 0;

					switch ($orientation) {
						case 3:
						$image = imagerotate($img, 180, 0);
						break;

						case 6:
						$image = imagerotate($img, -90, 0);
						break;

						case 8:
						$image = imagerotate($img, 90, 0);
						break;
					}
			       	// then rewrite the rotated image back to the disk as $filename
					imagejpeg($image, $filename, 90);
		     	} // if there is some rotation necessary
		   	} // if have the exif orientation info
		} // if function exists      
	}
/* Upload images */
public function uploadImage($file='', $extension='', $folder='', $newname='')
{
	global $config;
	if(isset($_FILES[$file]) && !$_FILES[$file]['error'])
	{
		$postMaxSize = ini_get('post_max_size');
		$MaxSize = explode('M', $postMaxSize);
		$MaxSize = $MaxSize[0];
		if($_FILES[$file]['size'] > $MaxSize*1048576)
		{
			$this->alert('Dung lượng file không được vượt quá '.$postMaxSize);
			return false;
		}
		$ext = explode('.', $_FILES[$file]['name']);
		$ext = strtolower($ext[count($ext)-1]);
		$name = basename($_FILES[$file]['name'], '.'.$ext);
		if(strpos($extension, $ext)===false)
		{
			$this->alert('Chỉ hỗ trợ upload file dạng '.$extension);
			return false;
		}
		if($newname=='' && file_exists($folder.$_FILES[$file]['name']))
			for($i=0; $i<100; $i++)
			{
				if(!file_exists($folder.$name.$i.'.'.$ext))
				{
					$_FILES[$file]['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
			else
			{
				$_FILES[$file]['name'] = $newname.'.'.$ext;
			}
			if(!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	
			{
				if(!move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	
				{
					return false;
				}
			}

			// $this->correctImageOrientation($folder.$_FILES[$file]['name']);

			/* Resize image if width origin > config max width */
			$array = getimagesize($folder.$_FILES[$file]['name']);
			list($image_w, $image_h) = $array;
			$maxWidth = $config['website']['upload']['max-width'];
			$maxHeight = $config['website']['upload']['max-height'];

			if($image_w > $maxWidth) $this->smartResizeImage($folder.$_FILES[$file]['name'],null,$maxWidth,$maxHeight,true);
			return $_FILES[$file]['name'];
		}
		return false;
	}
	/* Delete folder */
	public function removeDir($dirname='')
	{
		if(is_dir($dirname)) $dir_handle = opendir($dirname);
		if(!isset($dir_handle) || $dir_handle == false) return false;
		while($file = readdir($dir_handle))
		{
			if($file != "." && $file != "..")
			{
				if(!is_dir($dirname."/".$file)) unlink($dirname."/".$file);
				else $this->removeDir($dirname.'/'.$file);
			}
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}
	/* Remove Sub folder */
	public function RemoveEmptySubFolders($path='')
	{
		$empty = true;
		foreach(glob($path.DIRECTORY_SEPARATOR."*") as $file)
		{
			if(is_dir($file))
			{
				if(!$this->RemoveEmptySubFolders($file)) $empty = false;
			}
			else
			{
				$empty = false;
			}
		}
		if($empty)
		{
			if(is_dir($path))
			{
				rmdir($path);
			}
		}
		return $empty;
	}
	/* Remove files from dir in x seconds */
	public function RemoveFilesFromDirInXSeconds($dir='', $seconds=3600)
	{
		$files = glob(rtrim($dir, '/')."/*");
		$now = time();
		if($files)
		{
			foreach($files as $file)
			{
				if(is_file($file))
				{
					if($now - filemtime($file) >= $seconds)
					{
						unlink($file);
					}
				}
				else
				{
					$this->RemoveFilesFromDirInXSeconds($file,$seconds);
				}
			}
		}
	}
	/* Filter opacity */
	public function filterOpacity($img='', $opacity=80)
	{
		return true;
			/*
			if(!isset($opacity) || $img == '') return false;
			$opacity /= 100;
			$w = imagesx($img);
			$h = imagesy($img);
			imagealphablending($img, false);
			$minalpha = 127;
			for($x = 0; $x < $w; $x++)
			{
				for($y = 0; $y < $h; $y++)
				{
					$alpha = (imagecolorat($img, $x, $y) >> 24) & 0xFF;
					if($alpha < $minalpha) $minalpha = $alpha;
				}
			}
			for($x = 0; $x < $w; $x++)
			{
				for($y = 0; $y < $h; $y++)
				{
					$colorxy = imagecolorat($img, $x, $y);
					$alpha = ($colorxy >> 24) & 0xFF;
					if($minalpha !== 127) $alpha = 127 + 127 * $opacity * ($alpha - 127) / (127 - $minalpha);
					else $alpha += 127 * $opacity;
					$alphacolorxy = imagecolorallocatealpha($img, ($colorxy >> 16) & 0xFF, ($colorxy >> 8) & 0xFF, $colorxy & 0xFF, $alpha);
					if(!imagesetpixel($img, $x, $y, $alphacolorxy)) return false;
				}
			}
			return true;
			*/
		}
		/* Create thumb */
		public function createThumb($width_thumb=0, $height_thumb=0, $zoom_crop='1', $src='', $watermark=null, $path=THUMBS, $preview=false, $args=array(), $quality=100)
		{
			$t = 3600*24*3;
			$this->RemoveFilesFromDirInXSeconds(UPLOAD_TEMP_L, 1);
			if($watermark != null)
			{
				$this->RemoveFilesFromDirInXSeconds(WATERMARK.'/'.$path."/", $t);
				$this->RemoveEmptySubFolders(WATERMARK.'/'.$path."/");
			}
			else
			{
				$this->RemoveFilesFromDirInXSeconds($path."/", $t);
				$this->RemoveEmptySubFolders($path."/");
			}

			$src = str_replace("%20"," ",$src);
			if(!file_exists($src)) die("NO IMAGE $src");

			$image_url = $src;
			$origin_x = 0;
			$origin_y = 0;
			$new_width = $width_thumb;
			$new_height = $height_thumb;

			if($new_width < 10 && $new_height < 10)
			{
				header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
				die("Width and height larger than 10px");
			}
			if($new_width > 2000 || $new_height > 2000)
			{
				header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
				die("Width and height less than 2000px");
			}

			$array = getimagesize($image_url);
			if($array) list($image_w, $image_h) = $array;
			else die("NO IMAGE $image_url");

			$width = $image_w;
			$height = $image_h;

			if($new_height && !$new_width) $new_width = $width * ($new_height / $height);
			else if($new_width && !$new_height) $new_height = $height * ($new_width / $width);

			$image_ext = explode('.', $image_url);
			$image_ext = trim(strtolower(end($image_ext)));
			$image_name = explode('/', $image_url);
			$image_name = trim(strtolower(end($image_name)));

			switch(strtoupper($image_ext))
			{
				case 'JPG':
				case 'JPEG':
				$image = imagecreatefromjpeg($image_url);
				$func='imagejpeg';
				$mime_type = 'jpeg';
				break;

				case 'PNG':
				$image = imagecreatefrompng($image_url);
				$func='imagepng';
				$mime_type = 'png';
				break;

				case 'GIF':
				$image = imagecreatefromgif($image_url);
				$func='imagegif';
				$mime_type = 'png';
				break;

				default: die("UNKNOWN IMAGE TYPE: $image_url");
			}
			$_new_width = $new_width;
			$_new_height = $new_height;
			if($zoom_crop == 3)
			{
				$final_height = $height * ($new_width / $width);
				if($final_height > $new_height) $new_width = $width * ($new_height / $height);
				else $new_height = $final_height;
			}

			$canvas = imagecreatetruecolor($new_width, $new_height);
			imagealphablending($canvas, false);
			$color = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
			imagefill ($canvas, 0, 0, $color);

			if($zoom_crop == 2)
			{
				$final_height = $height * ($new_width / $width);
				if($final_height > $new_height)
				{
					$origin_x = $new_width / 2;
					$new_width = $width * ($new_height / $height);
					$origin_x = round($origin_x - ($new_width / 2));
				}
				else
				{
					$origin_y = $new_height / 2;
					$new_height = $final_height;
					$origin_y = round($origin_y - ($new_height / 2));
				}
			}

			imagesavealpha($canvas, true);

			if($zoom_crop > 0)
			{
				$align = '';
				$src_x = $src_y = 0;
				$src_w = $width;
				$src_h = $height;

				$cmp_x = $width / $new_width;
				$cmp_y = $height / $new_height;

				if($cmp_x > $cmp_y)
				{
					$src_w = round($width / $cmp_x * $cmp_y);
					$src_x = round(($width - ($width / $cmp_x * $cmp_y)) / 2);
				}
				else if($cmp_y > $cmp_x)
				{
					$src_h = round($height / $cmp_y * $cmp_x);
					$src_y = round(($height - ($height / $cmp_y * $cmp_x)) / 2);
				}

				if($align)
				{
					if(strpos($align, 't') !== false)
					{
						$src_y = 0;
					}
					if(strpos($align, 'b') !== false)
					{
						$src_y = $height - $src_h;
					}
					if(strpos($align, 'l') !== false)
					{
						$src_x = 0;
					}
					if(strpos($align, 'r') !== false)
					{
						$src_x = $width - $src_w;
					}
				}

				imagecopyresampled($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);
			}
			else
			{
				imagecopyresampled($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			}

			if($preview)
			{
				$watermark = array();
				$watermark['hienthi'] = 1;
				$options = $args;
				$overlay_url = $args['watermark'];
			}

			$upload_dir = '';
			$folder_old = str_replace($image_name, '', $image_url);

			if(isset($watermark['hienthi']) && $watermark['hienthi'] > 0)
			{
				$upload_dir = WATERMARK.'/'.$path.'/'.$width_thumb.'x'.$height_thumb.'x'.$zoom_crop.'/'.$folder_old;
			}
			else
			{
				if($watermark != null) $upload_dir = WATERMARK.'/'.$path.'/'.$width_thumb.'x'.$height_thumb.'x'.$zoom_crop.'/'.$folder_old;
				else $upload_dir = $path.'/'.$width_thumb.'x'.$height_thumb.'x'.$zoom_crop.'/'.$folder_old;
			}

			if(!file_exists($upload_dir)) if(!mkdir($upload_dir, 0777, true)) die('Failed to create folders...');

			if(isset($watermark['hienthi']) && $watermark['hienthi'] > 0)
			{
				$options = (isset($options))?$options:json_decode($watermark['options'],true)['watermark'];
				$per_scale = $options['per'];
				$per_small_scale = $options['small_per'];
				$max_width_w = $options['max'];
				$min_width_w = $options['min'];
				$opacity = @$options['opacity'];
				$overlay_url = (isset($overlay_url))?$overlay_url:UPLOAD_PHOTO_L.$watermark['photo'];
				$overlay_ext = explode('.', $overlay_url);
				$overlay_ext = trim(strtolower(end($overlay_ext)));

				switch(strtoupper($overlay_ext))
				{
					case 'JPG':
					case 'JPEG':
					$overlay_image = imagecreatefromjpeg($overlay_url);
					break;

					case 'PNG':
					$overlay_image = imagecreatefrompng($overlay_url);
					break;

					case 'GIF':
					$overlay_image = imagecreatefromgif($overlay_url);
					break;

					default: die("UNKNOWN IMAGE TYPE: $overlay_url");
				}

				$this->filterOpacity($overlay_image,$opacity);
				$overlay_width = imagesx($overlay_image);
				$overlay_height = imagesy($overlay_image);
				$overlay_padding = 5;
				imagealphablending($canvas, true);








				if(min($_new_width,$_new_height) <= 300) $per_scale = $per_small_scale;

				$oz = max($overlay_width,$overlay_height);

				if($overlay_width > $overlay_height)
				{
					$scale = $_new_width/$oz;
				}
				else
				{
					$scale = $_new_height/$oz;
				}

				if($_new_height > $_new_width)
				{
					$scale = $_new_height/$oz;
				}
				$new_overlay_width = (floor($overlay_width*$scale) - $overlay_padding*2)/$per_scale;
				$new_overlay_height = (floor($overlay_height*$scale) - $overlay_padding*2)/$per_scale;
				$scale_w = $new_overlay_width/$new_overlay_height;
				$scale_h = $new_overlay_height/$new_overlay_width;
				$new_overlay_height = $new_overlay_width/$scale_w;

				if($new_overlay_height > $_new_height)
				{
					$new_overlay_height = $_new_height / $per_scale;
					$new_overlay_width = $new_overlay_height * $scale_w;
				}
				if($new_overlay_width > $_new_width)
				{
					$new_overlay_width = $_new_width/$per_scale;
					$new_overlay_height = $new_overlay_width * $scale_h;
				}
				if(($_new_width / $new_overlay_width) < $per_scale)
				{
					$new_overlay_width = $_new_width/$per_scale;
					$new_overlay_height = $new_overlay_width * $scale_h;
				}
				if($_new_height < $_new_width && ($_new_height / $new_overlay_height) < $per_scale)
				{
					$new_overlay_height = $_new_height/$per_scale;
					$new_overlay_width = $new_overlay_height / $scale_h;
				}
				if($new_overlay_width > $max_width_w && $new_overlay_width)
				{
					$new_overlay_width = $max_width_w;
					$new_overlay_height = $new_overlay_width * $scale_h;
				}
				if($new_overlay_width < $min_width_w && $_new_width <= $min_width_w*3)
				{
					$new_overlay_width = $min_width_w;
					$new_overlay_height = $new_overlay_width * $scale_h;
				}
				$new_overlay_width = round($new_overlay_width);
				$new_overlay_height = round($new_overlay_height);

				switch($options['position'])
				{
					case 1:
					$khoancachx = $overlay_padding;
					$khoancachy = $overlay_padding;
					break;

					case 2:
					$khoancachx = abs($_new_width - $new_overlay_width)/2;
					$khoancachy = $overlay_padding;
					break;

					case 3:
					$khoancachx = abs($_new_width - $new_overlay_width) - $overlay_padding;
					$khoancachy = $overlay_padding;
					break;

					case 4:
					$khoancachx = abs($_new_width - $new_overlay_width) - $overlay_padding;
					$khoancachy = abs($_new_height - $new_overlay_height)/2;
					break;

					case 5:
					$khoancachx = abs($_new_width - $new_overlay_width) - $overlay_padding;
					$khoancachy = abs($_new_height - $new_overlay_height) - $overlay_padding;
					break;

					case 6:
					$khoancachx = abs($_new_width - $new_overlay_width)/2;
					$khoancachy = abs($_new_height - $new_overlay_height) - $overlay_padding;
					break;

					case 7:
					$khoancachx = $overlay_padding;
					$khoancachy = abs($_new_height - $new_overlay_height) - $overlay_padding;
					break;

					case 8:
					$khoancachx = $overlay_padding;
					$khoancachy = abs($_new_height - $new_overlay_height)/2;
					break;

					case 9:
					$khoancachx = abs($_new_width - $new_overlay_width)/2;
					$khoancachy = abs($_new_height - $new_overlay_height)/2;
					break;

					default:
					$khoancachx = $overlay_padding;
					$khoancachy = $overlay_padding;
					break;
				}

				$overlay_new_image = imagecreatetruecolor($new_overlay_width, $new_overlay_height);
				imagealphablending($overlay_new_image, false);
				imagesavealpha($overlay_new_image, true);
				imagecopyresampled($overlay_new_image, $overlay_image, 0, 0, 0, 0, $new_overlay_width, $new_overlay_height, $overlay_width, $overlay_height);
				imagecopy($canvas, $overlay_new_image, $khoancachx, $khoancachy, 0, 0, $new_overlay_width, $new_overlay_height);
				imagealphablending($canvas, false);
				imagesavealpha($canvas, true);
			}

			if($preview)
			{
				$upload_dir = '';
				$this->RemoveEmptySubFolders(WATERMARK.'/'.$path."/");
			}

			if($upload_dir)
			{
				if($func == 'imagejpeg') $func($canvas, $upload_dir.$image_name,100);
				else $func($canvas, $upload_dir.$image_name,floor($quality * 0.09));
			}

			header('Content-Type: image/' . $mime_type);
			if($func=='imagejpeg') $func($canvas, NULL,100);
			else $func($canvas, NULL,floor($quality * 0.09));

			imagedestroy($canvas);
		}
		/* String random */
		public function stringRandom($sokytu=10)
		{
			$str = '';
			if($sokytu > 0)
			{
				$chuoi = 'ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789';
				for($i=0; $i<$sokytu; $i++)
				{
					$vitri = mt_rand( 0 ,strlen($chuoi) );
					$str= $str . substr($chuoi,$vitri,1 );
				}
			}
			return $str;
		}
		/* Digital random */
		public function digitalRandom($min=1, $max=10, $num=10)
		{
			$result = '';
			if($num > 0)
			{
				for($i=0; $i<$num; $i++)
				{
					$result .= rand($min,$max);
				}
			}
			return $result;	
		}
		/* Get permission */
		public function get_permission($id_permission=0)
		{
			$row = $this->d->rawQuery("select * from #_permission_group where hienthi>0 order by stt,id desc");
			$str = '<select id="id_nhomquyen" name="data[id_nhomquyen]" class="form-control select2"><option value="0">Nhóm quyền</option>';
			foreach($row as $v)
			{
				if($v["id"] == (int)@$id_permission) $selected = "selected";
				else $selected = "";
				$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["ten"].'</option>';			
			}
			$str .= '</select>';
			return $str;
		}
		/* Get status order */
		public function orderStatus($status=0)
		{
			$row = $this->d->rawQuery("select * from #_status order by id");
			$str = '<select id="tinhtrang" name="data[tinhtrang]" class="form-control text-sm"><option value="0">Chọn tình trạng</option>';
			foreach($row as $v)
			{
				if(isset($_REQUEST['tinhtrang']) && ($v["id"] == (int)$_REQUEST['tinhtrang']) || ($v["id"] == $status)) $selected = "selected";
				else $selected = "";
				$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["trangthai"].'</option>';
			}
			$str .= '</select>';
			return $str;
		}
		/* Get payments order */
		function orderPayments()
		{
			$row = $this->d->rawQuery("select * from #_news where type='hinh-thuc-thanh-toan' order by stt,id desc");
			$str = '<select id="httt" name="httt" class="form-control text-sm"><option value="0">Chọn hình thức thanh toán</option>';
			foreach($row as $v)
			{
				if(isset($_REQUEST['httt']) && ($v["id"] == (int)$_REQUEST['httt'])) $selected = "selected";
				else $selected = "";
				$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';
			}
			$str .= '</select>';
			return $str;
		}
		/* Get tags */
		public function get_tags($id=0, $element='', $table='', $type='')
		{
			if($id)
			{
				$temps = $this->d->rawQueryOne("select id_tags from #_".$table." where id = ? and type = ? limit 0,1",array($id,$type));
				$arr_tags = explode(',', $temps['id_tags']);
				for($i=0;$i<count($arr_tags);$i++) $temp[$i]=$arr_tags[$i];
			}
		$row_tags = $this->d->rawQuery("select tenvi, id from #_tags where type = ? order by stt,id desc",array($type));
		$str = '<select id="'.$element.'" name="'.$element.'[]" class="select multiselect" multiple="multiple" >';
		for($i=0;$i<count($row_tags);$i++)
		{
			if(isset($temp) && count($temp) > 0)
			{
				if(in_array($row_tags[$i]['id'],$temp)) $selected = 'selected="selected"';
				else $selected = '';
			}
			else
			{
				$selected = '';
			}
			$str .= '<option value="'.$row_tags[$i]["id"].'" '.$selected.' /> '.$row_tags[$i]["tenvi"].'</option>';
		}
		$str .= '</select>';
		return $str;
	}
	/* Get category by ajax */
	public function get_ajax_category($table='', $level='', $type='', $title_select='Chọn danh mục', $class_select='select-category')
	{
		$where = '';
		$params = array($type);
		$id_parent = 'id_'.$level;
		$data_level = '';
		$data_type = 'data-type="'.$type.'"';
		$data_table = '';
		$data_child = '';
		if($level == 'list')
		{
			$data_level = 'data-level="0"';
			$data_table = 'data-table="#_'.$table.'_cat"';
			$data_child = 'data-child="id_cat"';
		}
		else if($level == 'cat')
		{
			$data_level = 'data-level="1"';
			$data_table = 'data-table="#_'.$table.'_item"';
			$data_child = 'data-child="id_item"';
			$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']) : 0;
			$where .= ' and id_list = ?';
			array_push($params, $idlist);
		}
		else if($level == 'item')
		{
			$data_level = 'data-level="2"';
			$data_table = 'data-table="#_'.$table.'_sub"';
			$data_child = 'data-child="id_sub"';
			$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']) : 0;
			$where .= ' and id_list = ?';
			array_push($params, $idlist);
			$idcat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']) : 0;
			$where .= ' and id_cat = ?';
			array_push($params, $idcat);
		}
		else if($level == 'sub')
		{
			$data_level = '';
			$data_type = '';
			$class_select = '';
			$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']) : 0;
			$where .= ' and id_list = ?';
			array_push($params, $idlist);
			$idcat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']) : 0;
			$where .= ' and id_cat = ?';
			array_push($params, $idcat);
			$iditem = (isset($_REQUEST['id_item'])) ? htmlspecialchars($_REQUEST['id_item']) : 0;
			$where .= ' and id_item = ?';
			array_push($params, $iditem);
		}
		else if($level == 'brand')
		{
			$data_level = '';
			$data_type = '';
			$class_select = '';
		}
		$rows = $this->d->rawQuery("select tenvi, id from #_".$table."_".$level." where type = ? ".$where." order by stt,id desc",$params);
		$str = '<select id="'.$id_parent.'" name="data['.$id_parent.']" '.$data_level.' '.$data_type.' '.$data_table.' '.$data_child.' class="form-control select2 '.$class_select.'"><option value="0">'.$title_select.'</option>';
		foreach($rows as $v)
		{
			if(isset($_REQUEST[$id_parent]) && ($v["id"] == (int)$_REQUEST[$id_parent])) $selected = "selected";
			else $selected = "";
			$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';
		}
		$str .= '</select>';
		return $str;
	}
	/* Get category by link */
	public function get_link_category($table='', $level='', $type='', $title_select='Chọn danh mục')
	{
		$where = '';
		$params = array($type);
		$id_parent = 'id_'.$level;
		if($level == 'cat')
		{
			$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']) : 0;
			$where .= ' and id_list = ?';
			array_push($params, $idlist);
		}
		else if($level == 'item')
		{
			$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']) : 0;
			$where .= ' and id_list = ?';
			array_push($params, $idlist);
			$idcat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']) : 0;
			$where .= ' and id_cat = ?';
			array_push($params, $idcat);
		}
		else if($level == 'sub')
		{
			$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']) : 0;
			$where .= ' and id_list = ?';
			array_push($params, $idlist);
			$idcat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']) : 0;
			$where .= ' and id_cat = ?';
			array_push($params, $idcat);
			$iditem = (isset($_REQUEST['id_item'])) ? htmlspecialchars($_REQUEST['id_item']) : 0;
			$where .= ' and id_item = ?';
			array_push($params, $iditem);
		}
		$rows = $this->d->rawQuery("select tenvi, id from #_".$table."_".$level." where type = ? ".$where." order by stt,id desc",$params);
		$str = '<select id="'.$id_parent.'" name="'.$id_parent.'" onchange="onchange_category($(this))" class="form-control filer-category select2"><option value="0">'.$title_select.'</option>';
		foreach($rows as $v)
		{
			if(isset($_REQUEST[$id_parent]) && ($v["id"] == (int)$_REQUEST[$id_parent])) $selected = "selected";
			else $selected = "";
			$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';
		}
		$str .= '</select>';
		return $str;
	}
	/* Get place by ajax */	public function get_ajax_place($table='', $title_select='Chọn danh mục')
	{
		$where = '';
		$params = array('0');
		$id_parent = 'id_'.$table;
		$data_level = '';
		$data_table = '';
		$data_child = '';
		if($table == 'city')
		{
			$data_level = 'data-level="0"';
			$data_table = 'data-table="#_district"';
			$data_child = 'data-child="id_district"';
		}
		else if($table == 'district')
		{
			$data_level = 'data-level="1"';
			$data_table = 'data-table="#_wards"';
			$data_child = 'data-child="id_wards"';
			$idcity = (isset($_REQUEST['id_city'])) ? htmlspecialchars($_REQUEST['id_city']) : 0;
			$where .= ' and id_city = ?';
			array_push($params, $idcity);
		}
		else if($table == 'wards')
		{
			$data_level = '';
			$data_table = '';
			$data_child = '';
			$idcity = (isset($_REQUEST['id_city'])) ? htmlspecialchars($_REQUEST['id_city']) : 0;
			$where .= ' and id_city = ?';
			array_push($params, $idcity);
			$iddistrict = (isset($_REQUEST['id_district'])) ? htmlspecialchars($_REQUEST['id_district']) : 0;
			$where .= ' and id_district = ?';
			array_push($params, $iddistrict);
		}
		$rows = $this->d->rawQuery("select ten, id from #_".$table." where id <> ? ".$where." order by id asc",$params);
		$str = '<select id="'.$id_parent.'" name="data['.$id_parent.']" '.$data_level.' '.$data_table.' '.$data_child.' class="form-control select2 select-place"><option value="0">'.$title_select.'</option>';
		foreach($rows as $v)
		{
			if(isset($_REQUEST[$id_parent]) && ($v["id"] == (int)$_REQUEST[$id_parent])) $selected = "selected";
			else $selected = "";
			$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["ten"].'</option>';
		}
		$str .= '</select>';
		return $str;
	}
	/* Get place by link */
	public function get_link_place($table='', $title_select='Chọn danh mục')
	{
		$where = '';
		$params = array('0');
		$id_parent = 'id_'.$table;
		if($table == 'district')
		{
			$idcity = (isset($_REQUEST['id_city'])) ? htmlspecialchars($_REQUEST['id_city']) : 0;
			$where .= ' and id_city = ?';
			array_push($params, $idcity);
		}
		else if($table == 'wards')
		{
			$idcity = (isset($_REQUEST['id_city'])) ? htmlspecialchars($_REQUEST['id_city']) : 0;
			$where .= ' and id_city = ?';
			array_push($params, $idcity);
			$iddistrict = (isset($_REQUEST['id_district'])) ? htmlspecialchars($_REQUEST['id_district']) : 0;
			$where .= ' and id_district = ?';
			array_push($params, $iddistrict);
		}
		$rows = $this->d->rawQuery("select ten, id from #_".$table." where id <> ? ".$where." order by id asc",$params);
		$str = '<select id="'.$id_parent.'" name="'.$id_parent.'" onchange="onchange_category($(this))" class="form-control filer-category select2"><option value="0">'.$title_select.'</option>';
		foreach($rows as $v)
		{
			if(isset($_REQUEST[$id_parent]) && ($v["id"] == (int)$_REQUEST[$id_parent])) $selected = "selected";
			else $selected = "";
			$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["ten"].'</option>';
		}
		$str .= '</select>';
		return $str;
	}

	// ==================================update================================================

	public	function catchuoi($chuoi='',$gioihan=''){
	// nếu độ dài chuỗi nhỏ hơn hay bằng vị trí cắt
	// thì không thay đổi chuỗi ban đầu
		if(strlen($chuoi)<=$gioihan)
		{
			return $chuoi;
		} else{
			/*
			so sánh vị trí cắt
			với kí tự khoảng trắng đầu tiên trong chuỗi ban đầu tính từ vị trí cắt
			nếu vị trí khoảng trắng lớn hơn
			thì cắt chuỗi tại vị trí khoảng trắng đó
			*/
			if(strpos($chuoi," ",$gioihan) > $gioihan){
				$new_gioihan=strpos($chuoi," ",$gioihan);
				$new_chuoi = substr($chuoi,0,$new_gioihan)."...";
				return $new_chuoi;
			}
			// trường hợp còn lại không ảnh hưởng tới kết quả
			$new_chuoi = substr($chuoi,0,$gioihan)."...";
			return $new_chuoi;
		}
	}
		// Function get ID video của youtube 
	public function getIDyoutube($urlYoutube){
		parse_str( parse_url( $urlYoutube, PHP_URL_QUERY ), $ar );
		return $ar['v'];
	}
	public function getImgYoutube($urlYoutube){
		return $ImgYoutube="https://img.youtube.com/vi/".$this->getIDyoutube($urlYoutube)."/0.jpg";
	}
	public function format_price($_price="" ,$_unit=""){
		$format_price = '';
		if($_price>0){
			$format_price = number_format($_price,0,",",".").$_unit;
		}
		return $format_price;
	}

	public function return_price($_price_old="", $_price_new="", $_unit=""){
		$price_old = $this->format_price($_price_old,'<u>'.$_unit.'</u>');
		$price_new = $this->format_price($_price_new,'<u>'.$_unit.'</u>');
		if ($_price_new>0 && $_price_old >0 && $_price_old>$_price_new) {
			return $return_price = '<a class="fancybox-popup" href="#popup-contact">
			<span class="price-new">'.$price_new.'</span>
			<span class="price-old"> - <del>'.$price_old.'</del></span><a>
			';
		}
		elseif(($_price_new == $_price_old && $_price_old != 0) || ($_price_new==0 && $_price_old>0))
			{ return $return_price = '<a class="fancybox-popup" href="#popup-contact"><span class="price-new">'.$price_old.'</span></a>';	}
		elseif($_price_new==0 && $_price_old==0)
			{ return $return_price = '<a class="fancybox-popup" href="#popup-contact">'.lienhe.'</a>';}
		else
			{ return $return_price='Nhập giá lỗi';}
	}

	public function menu_item($_com='',$_name='',$_level='',$_table='',$_type=''){
		global $com,$source,$config_base; 
		$class= '';
		if($_com == 'home' ) {
			if ($source=='index') { $class= ' class="active"'; }
			$_com = $config_base;
		}else{
			if ($com==$_com) {$class= ' class="active"';}
		}
		echo  '<li'.$class.'><a href="'.$_com.'" title="'.$_name.'">'.$_name.'</a>';
		if ($_level!='') { 
			echo $this->menu_show($_level,$_table,$_type);
		}
		echo '</li>';
	}

	public function menu_show($_level='',$_table='',$_type='',$_com=''){
		global $d,$lang,$str,$sluglang;
		if ($_level==0) {
			$sql='';
			$sql = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_".$_table." where type='".$_type."' and hienthi > 0 order by stt,id desc");
			if(!empty($sql)){
				$str='';
				$str.='<ul class="menu-list">';
				foreach ($sql as $key => $value) {
					$str.='<li><a href="'.$value[$sluglang].'">'.$value["ten$lang"].'</a></li>';
				}
				$str.='</ul>';
				echo $str;
			}
		}
		if ($_level>=1){
			$sql_list = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_".$_table."_list where type='".$_type."' and hienthi > 0 order by stt,id desc");
			if(!empty($sql_list)){
				$str='';
				$str.='
				<ul class="menu-list">';
				foreach ($sql_list as $key_list => $value_list) {
					$str.='
					<li><a href="'.$value_list[$sluglang].'">'.$value_list["ten$lang"].'</a>';
					if ($_level>=2){
						$sql_cat= $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_".$_table."_cat where id_list = ".$value_list['id']." and type='".$_type."' and hienthi > 0 order by stt,id desc");
						if(!empty($sql_cat)){
							$str.='
							<ul class="menu-cat">';
							foreach ($sql_cat as $key_cat => $value_cat) {
								$str.='
								<li><a href="'.$value_cat[$sluglang].'">'.$value_cat["ten$lang"].'</a>';
								if ($_level>=3){
									$sql_item= $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_".$_table."_item where id_cat = ".$value_cat['id']." and type='".$_type."' and hienthi > 0 order by stt,id desc");
									if(!empty($sql_item)){
										$str.='
										<ul class="menu-item">';
										foreach ($sql_item as $key_item => $value_item) {
											$str.='
											<li><a href="'.$value_item[$sluglang].'">'.$value_item["ten$lang"].'</a>';
											if ($_level>=4){
												$sql_sub= $d->rawQuery("select ten$lang, tenkhongdau$lang, id from #_".$_table."_sub where id_item = ".$value_item['id']." and type='".$_type."' and hienthi > 0 order by stt,id desc");
												if(!empty($sql_sub)){
													$str.='
													<ul class="menu-sub">';
													foreach ($sql_sub as $key_sub => $value_sub) {
														$str.='
														<li><a href="'.$value_sub[$sluglang].'">'.$value_sub["ten$lang"].'</a></li>';
													}
													$str.='</ul>';
												}
											}
											$str.='</li>';
										}
										$str.='</ul>';
									}
								}
								$str.='</li>';
							}
							$str.='
							</ul>';
						}
					}
					$str.='
					</li>';
				}
				$str.='
				</ul>';		
				echo $str;
			}
		}
	}

	public function social($_type='',$_thumb='',$_class=''){
		global $d,$lang;
		$social = $d->rawQuery("SELECT ten$lang, photo, link FROM table_photo WHERE type='".$_type."' AND hienthi > 0 ORDER BY stt,id DESC");
		foreach ($social as $key => $value) {
			echo '<a class="'.$_class.'"href="'.$value['link'].'" target="_blank" title="'.$value['ten'.$lang].'">
			<img src="'.THUMBS.'/'.$_thumb.'/'.UPLOAD_PHOTO_L.$value['photo'].'" alt="'.$value['ten'.$lang].'" onerror="this.src=&#39;'.THUMBS.'/'.$_thumb.'/assets/images/noimage.png&#39;'.'">
			</a>';
		}
	}

	public function news_Classic($_value='', $_class='', $_thumb='200x150x1'){
		global $lang,$sluglang;

		return $news_Picture = '
		<div class="newsClassic-col '.$_class.'" >
		<div class="newsClassic-item flexbox">
		<figure class="newsClassic-img effect-scale img-full">
		<a href="'.$_value[$sluglang].'" title="'.$_value['ten'.$lang].'">
		<img src="'.THUMBS.'/'.$_thumb.'/'.UPLOAD_NEWS_L.$_value['photo'].
		'" alt="'.$_value['ten'.$lang].'" onerror="this.src=&#39;'.THUMBS.'/'.$_thumb.'/assets/images/noimage.png&#39;'.'">
		</a>
		</figure>
		<article class="newsClassic-text hover">
		<h3><a href="'.$_value[$sluglang].'" title="'.$_value['ten'.$lang].'">'.$_value['ten'.$lang].'</a> </h3>
		<p>Ngày Đăng: <span> '.date('d/m/Y',$_value['ngaytao']).'</span></p>
		<article>'.$this->catchuoi($_value['mota'.$lang],200).'</article>
		<a href="'.$_value[$sluglang].'" title="Xem thêm"> Xem thêm </a>
		</article>
		</div>
		</div>
		';
	}

	public function news_Picture($_value='', $_class='', $_thumb='380x300x1'){
		global $lang;

		return $news_Picture = '
		<div class="newsPicture-col '.$_class.'" >
		<div class="newsPicture-item">
		<figure class="newsPicture-img effect-scale img-full">
		<a href="'.$_value['tenkhongdau'.$lang].'" title="'.$_value['ten'.$lang].'">
		<img src="'.THUMBS.'/'.$_thumb.'/'.UPLOAD_NEWS_L.$_value['photo'].
		'" alt="'.$_value['ten'.$lang].'" onerror="this.src=&#39;'.THUMBS.'/'.$_thumb.'/assets/images/noimage.png&#39;'.'">
		</a>
		</figure>
		<article class="newsPicture-text hover">
		<h3><a href="'.$_value['tenkhongdau'.$lang].'" title="'.$_value['ten'.$lang].'">'.$_value['ten'.$lang].'</a> </h3>
		<article>'.$this->catchuoi($_value['mota'.$lang],100).'</article>
		</article>
		</div>
		</div>
		';
	}

	public function news_3D($_value='', $_class=''){
		global $lang;

		return $news_3D = '
		<div class="flipper-col '.$_class.'">
		<div class="flipper-item">
		<div class="flipper-front" stye="background-image: url('.UPLOAD_NEWS_L.$_value['photo'].');">
		<div class="inner">
		<h3>'.$this->catchuoi($_value['ten'.$lang],80).'</h3>
		</div>
		</div>
		<div class="flipper-back" stye="background-image: url('.UPLOAD_NEWS_L.$_value['photo'].');">
		<div class="inner">
		<h3>'.$this->catchuoi($_value['ten'.$lang],80).'</h3>
		<p>'.$this->catchuoi($_value['mota'.$lang],200).'</p>
		<a href="'.$_value['tenkhongdau'.$lang].'" title="Xem thêm" class="xt">
		Xem thêm <i class="fa fa-angle-right" aria-hidden="true"></i>
		</a>
		</div>
		</div>
		</div>
		</div> 
		';
	}

	public function product_show($_value='', $_class='', $_thumb='300x350x1'){
		global $lang,$optsetting,$sluglang;
		
		$btn_new = ($_value['btn_new'] > 0) ? '<figcaption class="product-new"> New </figcaption>' : '';
		return $product_show = '
		<div class="product-col '.$_class.'">
			<div class="product-item">
				<figure class="product-img effect-scale img-full itemhover">
					<a href="'.$_value[$sluglang].'" title="'.$_value['ten'.$lang].'">
					<img src="'.WATERMARK.'/product/'.$_thumb.'/'.UPLOAD_PRODUCT_L.$_value['photo'].'" alt="'.$_value['ten'.$lang].'" onerror="this.src=&#39;'.THUMBS.'/'.$_thumb.'/assets/images/noimage.png&#39;'.'"> </a>
					'.$btn_new.'
					<div class="item-top"></div>
					<div class="item-right"></div>
					<div class="item-bot"></div>
					<div class="item-left"></div>
				</figure>
				<article class="product-text hover">
					<h3><a href="'.$_value[$sluglang].'" title="'.$_value['ten'.$lang].'">'.$_value['ten'.$lang].'</a> </h3>
					<p class="price">'.gia.': '.$this->return_price($_value['gia'],$_value['giamoi'],'đ').'</p>
				</article>
			</div>
		</div>';
	}

	public function load_tab($_table='', $_type='', $_limit='', $_thumb=''){
		global $d,$lang,$startActive;
		    // sql
		$select = '';
		$select = ($_table=='product') ? 'gia,giamoi' : 'ngaytao'; 
		$sql_list= $d->rawQuery("SELECT ten$lang,tenkhongdau$lang,id,photo FROM table_".$_table."_list WHERE noibat>0 AND type='".$_type."' AND hienthi>0 ORDER BY stt,id DESC");
		$sql_start = $d->rawQuery("SELECT id,ten$lang,mota$lang,tenkhongdau$lang,photo,".$select." FROM table_".$_table." WHERE noibat>0 AND type='".$_type."' AND hienthi>0 ORDER BY stt ASC LIMIT $_limit");
		$load_tab = '';
		$load_tab .='<ul class="tab-title flexbox">';
		$load_tab .='<li data-idl="0" data-type="'.$_type.'" data-table="'.$_table.'" data-limit="'.$_limit.'" data-thumb="'.$_thumb.'" class="tab-active"> <h2>Tất cả</h2> </li>';
		foreach ($sql_list as $key_list => $value_list){
		        //$startActive = ($key_list==0) ? 'class="tab-active"' : '';
			$load_tab .= '<li data-idl="'.$value_list['id'].'" data-type="'.$_type.'" data-table="'.$_table.'" data-limit="'.$_limit.'" data-thumb="'.$_thumb.'" '.$startActive.'> <h2>'.$value_list['ten'.$lang].'</h2> </li>';
		}
		$load_tab .= '</ul>';
		$load_tab .= '<div id="tab-show-'.$_type.'" class="tab-show">';
		if (count($sql_start)>0) { 
			$load_tab .= '<div class="product-box resBox flexbox">';
			foreach ($sql_start as $key => $value) { 
				if ($_table=='product') {
					$load_tab .= $this->product_show($value,'resCol',$_thumb); 
				}else{
					$load_tab .= $this->news_Classic($value,'',$_thumb); 
				}
			}
			$load_tab .= '</div>';
		} else { 
			$load_tab .= '<div class="notice">Nội dung đang cập nhật</div>';
		}
		$load_tab .= '</div>';
		return $load_tab;
	}
	public function load_tab_list($_table='', $_type='', $_limit='', $_thumb=''){
		global $d,$lang,$startActive;
		    // sql
		$select = '';
		$load_tab_list = '';
		$select = ($_table=='product') ? 'gia,giamoi' : 'ngaytao'; 
		$sql_list = $d->rawQuery("SELECT ten$lang,tenkhongdau$lang,id,photo FROM table_".$_table."_list WHERE noibat>0 AND type='".$_type."' AND hienthi>0 ORDER BY stt,id DESC");
		foreach ($sql_list as $key_list => $value_list){
			$sql_cat = $d->rawQuery("SELECT id,ten$lang,tenkhongdau$lang,photo FROM table_".$_table."_cat WHERE noibat>0 AND type='".$_type."' AND id_list = '".$value_list['id']."' AND hienthi>0 ORDER BY stt ASC");
			$sql_start = $d->rawQuery("SELECT id,ten$lang,mota$lang,tenkhongdau$lang,photo,".$select." FROM table_".$_table." WHERE noibat>0 AND type='".$_type."' AND id_list = '".$value_list['id']."' AND hienthi>0 ORDER BY stt ASC LIMIT $_limit");
			$load_tab_list .= '
			<div class="container-sptablist"> 
			<div class="container">
			<div class="title-main">
			<h2>'.$value_list['ten'.$lang].'</h2>
			</div>
			<article class="splist-box">';
			$load_tab_list .='<ul class="tab-title flexbox">';
			$load_tab_list .='<li data-idl="'.$value_list['id'].'" data-idc="0" data-type="'.$_type.'" data-table="'.$_table.'" data-limit="'.$_limit.'" data-thumb="'.$_thumb.'" class="tab-active"> <h2>Tất cả</h2> </li>';
			foreach ($sql_cat as $key_cat => $value_cat){
					        //$startActive = ($key_cat==0) ? 'class="tab-active"' : '';
				$load_tab_list .= '<li data-idl="'.$value_list['id'].'" data-idc="'.$value_cat['id'].'" data-type="'.$_type.'" data-table="'.$_table.'" data-limit="'.$_limit.'" data-thumb="'.$_thumb.'" '.$startActive.'> <h2>'.$value_cat['ten'.$lang].'</h2> </li>';
			}
			$load_tab_list .= '</ul>';
			$load_tab_list .= '<div id="tab-show-'.$_type.'-'.$value_list['id'].'" class="tab-show">';
			if (count($sql_start)>0) { 
				$load_tab_list .= '<div class="product-box resBox flexbox">';
				foreach ($sql_start as $key => $value) { 
					if ($_table=='product') {
						$load_tab_list .= $this->product_show($value,'resCol',$_thumb); 
					} else{
						$load_tab_list .= $this->news_Classic($value,'',$_thumb); 
					}
				}
				$load_tab_list .= '</div>';
			} else { 
				$load_tab_list .= '<div class="notice">Nội dung đang cập nhật</div>';
			}
			$load_tab_list .= '
			</div>
			</article>	
			</div>
			</div> ';
		}
		return $load_tab_list;
	}
	public function load_photo($_type='', $_thumb='', $_link=''){
		global $d,$lang,$setting;

		$sql_photo = $d->rawQueryOne("select id, photo from #_photo where type = '".$_type."' and act = 'photo_static' limit 0,1");

		$get_photo = '
			<a href="'.$_link.'" title="'.$setting['ten'.$lang].'">
                <img onerror="this.src=&#39;'.THUMBS.'/'.$_thumb.'/assets/images/noimage.png&#39;'.'" src="'.THUMBS.'/'.$_thumb.'/'.UPLOAD_PHOTO_L.$sql_photo['photo'].'" /> 
            </a>';
            
        return $get_photo;
	}
	//Tháng theo tiếng Việt
	public function change_month($str){
	$temp = date('M',$str);
	switch ($temp) {
		case 'Jan':
		$month = '01';
		break;
		case 'Feb':
		$month = '02';
		break;
		case 'Mar':
		$month = '03';
		break;
		case 'Apr':
		$month = '04';
		break;
		case 'May':
		$month = '05';
		break;
		case 'Jun':
		$month = '06';
		break;
		case 'Jul':
		$month = '07';
		break;
		case 'Aug':
		$month = '08';
		break;
		case 'Sep':
		$month = '09';
		break;
		case 'Oct':
		$month = '10';
		break;
		case 'Nov':
		$month = '11';
		break;
		default:
		$month = '12';
		break;
	}
	return $month;
}
}
?>