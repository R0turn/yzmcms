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
	<div class="yzm-page">
		<div class="yzm-content-box yzm-page-left">
			<ul>				  
				<li><a href="<?php echo $pclink;?>" class="yzm-page-current">关于我们</a></li>
				<li><a href="http://www.yzmcms.com" target="_blank">官方网站</a></li>
				<li><a href="https://www.yzmask.com/show/8.html" target="_blank">插件中心</a></li>
			</ul>
		</div>
		<div class="yzm-content-box yzm-page-right"> 
			<div class="yzm-title">
				<h2><?php echo get_catname($catid);?></h2>
				<span class="yzm-title-right">
					当前位置：<?php echo get_location($catid);?>
				</span>
			</div>
		   <div class="yzm-page-content">
		        <h1><?php echo $title;?></h1>
	 	    	<div class="yzm-content">
	 	    		<?php echo $content;?>
	 	    	</div>
		   </div>
		</div>
	</div>

	<?php include template("index","footer"); ?> 