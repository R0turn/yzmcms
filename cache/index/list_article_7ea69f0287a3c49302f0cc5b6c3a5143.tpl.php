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
		 <div class="yzm-content-box yzm-main-left yzm-text-list">
		 		<div class="yzm-title">
		 			<h2><?php echo get_catname($catid);?></h2>
		 		</div>
		 	    <ul>
		 		<?php $tag = yzm_base::load_sys_class('yzm_tag');if(method_exists($tag, 'lists')) {$data = $tag->lists(array('field'=>'title,updatetime,url,color,flag','catid'=>$catid,'limit'=>'20','page'=>'page',));$pages = $tag->pages();}?>
		 		<?php if(is_array($data)) foreach($data as $v) { ?>
		 		   <li>
		 		   	<span class="yzm-date"><?php echo date('Y-m-d', $v['updatetime']);?></span>
		 		   	<a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank">
		 		   		<?php if(strstr($v['flag'],'1')) { ?><em class="yzm-flag">顶</em><?php } ?>
		 		   		<?php echo title_color($v['title'], $v['color']);?>
		 		    </a>
		 		   </li>		
		 		<?php } ?>						
		 		</ul>
				<div id="page"><?php echo $pages;?></div>
		  </div>
		  
		 <div class="yzm-main-right">	
		 	<div class="yzm-content-box">
				<div class="yzm-title">
		 			<h2>点击排行</h2>
		 		</div>
		 	    <ul class="yzm-ranking">
		 			<?php $tag_cache_name = 'tag_cache_'.md5(implode('&',array('field'=>'title,url,color,inputtime','catid'=>$catid,'limit'=>'10','cache'=>'3600',)));if(!$data = getcache($tag_cache_name)){$tag = yzm_base::load_sys_class('yzm_tag');if(method_exists($tag, 'hits')) {$data = $tag->hits(array('field'=>'title,url,color,inputtime','catid'=>$catid,'limit'=>'10','cache'=>'3600',));}if(!empty($data)){setcache($tag_cache_name, $data, 3600);}}?>
					<?php if(is_array($data)) foreach($data as $k=>$v) { ?>
					<?php $k=$k+1;?>
					   <li><em><?php echo $k;?></em><span class="date"><?php echo date('m-d',$v['inputtime']);?></span><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo title_color($v['title'], $v['color']);?></a></li>	
					<?php } ?>						
		 		</ul>		 		
		 	</div>		
		 	<div class="yzm-line"></div>
	 	 	<div class="yzm-content-box">
	 			<div class="yzm-title">
	 	 			<h2>热门标签</h2>
	 	 		</div>
			    <ul class="yzm-tag-list">
				<?php $tag = yzm_base::load_sys_class('yzm_tag');if(method_exists($tag, 'tag')) {$data = $tag->tag(array('field'=>'id,tag,total','catid'=>$catid,'limit'=>'30',));}?>
				<?php if(is_array($data)) foreach($data as $v) { ?>
				   <li><a href="<?php echo tag_url($v['id']);?>" target="_blank"><?php echo $v['tag'];?>(<?php echo $v['total'];?>)</a></li>	
				<?php } ?>						
				</ul>		 		
	 	 	</div>	
						 
		 </div>		  	
 		<?php include template("index","footer"); ?> 