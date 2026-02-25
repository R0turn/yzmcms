<?php defined('IN_YZMPHP') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <title><?php echo $seo_title;?></title>
	  <meta name="author" content="YzmCMS内容管理系统">
	  <meta name="keywords" content="<?php echo $keywords;?>" />
	  <meta name="description" content="<?php echo $description;?>" />
	  <link href="<?php echo STATIC_URL;?>css/yzm-common.css" rel="stylesheet" type="text/css" />
	  <link href="<?php echo STATIC_URL;?>css/yzm-style.css" rel="stylesheet" type="text/css" />
	  <script type="text/javascript" src="<?php echo STATIC_URL;?>js/jquery-1.8.2.min.js"></script>
	  <script type="text/javascript" src="<?php echo STATIC_URL;?>js/yzm-front.js"></script>
  </head>
  <body>
	<?php include template("index","header"); ?> 

	<div class="yzm-line"></div>
		
	<?php $data = get_childcat($catid);?>
	<?php if(empty($data)) { ?><div class="yzm-no-content">暂无可展示的栏目数据</div><?php } ?>
	<?php if(is_array($data)) foreach($data as $val) { ?>
	<div class="yzm-content-box yzm-img-list">
		<div class="yzm-title">
			<h2><?php echo $val['catname'];?></h2>
			<span class="yzm-title-right"><a href="<?php echo $val['pclink'];?>">>>更多</a></span>
		</div>
		<ul>
		<?php $tag = yzm_base::load_sys_class('yzm_tag');if(method_exists($tag, 'lists')) {$data = $tag->lists(array('field'=>'title,thumb,url,color','catid'=>$val['catid'],'limit'=>'8',));}?>
		<?php if(is_array($data)) foreach($data as $v) { ?>
			<li>
				<a href="<?php echo $v['url'];?>">
					<i><img src="<?php echo get_thumb($v['thumb']);?>" alt="<?php echo $v['title'];?>" title="<?php echo $v['title'];?>"></i>
					<p><?php echo title_color($v['title'], $v['color']);?></p>
				</a>
			</li>		
		<?php } ?>						
		</ul>
	</div>	
	<div class="yzm-line"></div>	
	<?php } ?>		

	<?php include template("index","footer"); ?> 