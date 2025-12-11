<?php
if(!defined('SOURCES')) die("Error");
/* Kiểm tra active photo */
if(isset($config['title']))
{
	$type = 'title';
	$arrCheck = array();
	$actCheck = 'man_photo';
	foreach($config['title'][$actCheck] as $k => $v) $arrCheck[] = $k;
	if(!count($arrCheck) || !in_array($type,$arrCheck)) $func->transfer("Trang không tồn tại", "index.php", false);
}
else
{
	$func->transfer("Trang không tồn tại", "index.php", false);
}
switch($act)
{
	/* Photos */
	case "man_photo":
	get_photos();
	$template = "title/man/photos";
	break;
	case "add_photo":
	$template = "title/man/photo_add";
	break;
	case "edit_photo":
	get_photo();
	$template = "title/man/photo_edit";
	break;
	case "save_photo":
	save_photo();
	break;
	case "delete_photo":
	delete_photo();
	break;
	default:
	$template = "404";
}
/* Get photo */
function get_photos()
{
	global $d, $func, $curPage, $items, $paging, $type;
	$per_page = 10;
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select * from #_title where type = ? and act <> ? order by stt,id desc $limit";
	$items = $d->rawQuery($sql,array($type,'photo_static'));
	$sqlNum = "select count(*) as 'num' from #_title where type = ? and act <> ? order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum,array($type,'photo_static'));
	$total = $count['num'];
	$url = "index.php?com=title&act=man_photo&type=".$type;
	$paging = $func->pagination($total,$per_page,$curPage,$url);
}
/* Edit photo */
function get_photo()
{
	global $d, $func, $curPage, $item, $list_cat, $type;
	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=title&act=man_photo&type=".$type."&p=".$curPage, false);
	$item = $d->rawQueryOne("select * from #_title where id = ? and act <> ? and type = ? limit 0,1",array($id,'photo_static',$type));
	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=title&act=man_photo&type=".$type."&p=".$curPage, false);
}
/* Save photo */
function save_photo()
{
	global $d, $func, $curPage, $config, $type;
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=title&act=man_photo&type=title&p=".$curPage, false);
	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	$dataMultiTemp = (isset($_POST['dataMulti'])) ? $_POST['dataMulti'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}
	}
	$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
	if($id)
	{
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		$data['act'] = 'photo_multi';
		$d->where('id', $id);
		$d->where('type', $type);
		if($d->update('title',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=title&act=man_photo&type=".$type."&p=".$curPage);
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=title&act=man_photo&type=".$type."&p=".$curPage, false);
	}
	else
	{
		$numberPhoto = (isset($config['title']['man_photo'][$type]['number_photo'])) ? $config['title']['man_photo'][$type]['number_photo'] : 0;
		if($numberPhoto && $dataMultiTemp)
		{
			for($i=0;$i<count($dataMultiTemp);$i++)
			{
				$dataMulti = $dataMultiTemp[$i];
				$dataMulti['hienthi'] = (isset($dataMultiTemp[$i]['hienthi'])) ? 1 : 0;
				$dataMulti['type'] = $type;
				$dataMulti['act'] = 'photo_multi';
				if(
					(isset($dataMulti['tenvi']) && $dataMulti['tenvi'] != '') || 
					(isset($dataMulti['link']) && $dataMulti['link'] != '') || 
					(isset($dataMulti['link_video']) && $dataMulti['link_video'] != '')
				)
				{
					if(!$d->insert('title',$dataMulti)) $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=title&act=man_photo&type=".$type."&p=".$curPage, false);
				}
			}
			$func->transfer("Lưu dữ liệu thành công", "index.php?com=title&act=man_photo&type=".$type."&p=".$curPage);
		}
		$func->transfer("Dữ liệu rỗng", "index.php?com=title&act=man_photo&type=".$type."&p=".$curPage, false);
	}
}
/* Delete photo */
function delete_photo()
{
	global $d, $func, $curPage, $type;
	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
	if($id)
	{
		$row = $d->rawQueryOne("select id, photo from #_title where id = ? and type = ? limit 0,1",array($id,$type));
		if($row['id'])
		{
			$func->delete_file(UPLOAD_PHOTO.$row['photo']);
			$d->rawQuery("delete from #_title where id = ? and type = ?",array($id,$type));
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=title&act=man_photo&type=".$type."&p=".$curPage);
		}
		else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=title&act=man_photo&type=".$type."&p=".$curPage, false);
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);
		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$row = $d->rawQueryOne("select id, photo from #_title where id = ? and type = ? limit 0,1",array($id,$type));
			if($row['id'])
			{
				$func->delete_file(UPLOAD_PHOTO.$row['photo']);
				$d->rawQuery("delete from #_title where id = ? and type = ?",array($id,$type));
			}
		}
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=title&act=man_photo&type=".$type."&p=".$curPage);
	}
	else $func->transfer("Không nhận được dữ liệu", "index.php?com=title&act=man_photo&type=".$type."&p=".$curPage, false);
}
?>