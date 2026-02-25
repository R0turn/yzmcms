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
		 <div class="yzm-content-box yzm-main-left yzm-news-list">
		 		<div class="yzm-title">
		 			<h2><?php echo get_catname($catid);?></h2>
		 		</div>

		 		<?php $tag = yzm_base::load_sys_class('yzm_tag');if(method_exists($tag, 'lists')) {$data = $tag->lists(array('field'=>'id,catid,title,description,url,flag,color,thumb','catid'=>$catid,'limit'=>'10','page'=>'page',));$pages = $tag->pages();}?>
		 		<?php if(is_array($data)) foreach($data as $v) { ?>
		 		<div class="yzm-news">
		 			<a href="<?php echo $v['url'];?>" class="yzm-news-img">
		 				<img src="<?php echo get_thumb($v['thumb']);?>" alt="<?php echo $v['title'];?>" title="<?php echo $v['title'];?>" />
		 			</a>
		 			<div class="yzm-news-right">
		 				<?php if(strstr($v['flag'],'1')) { ?><em>顶</em><?php } ?> <!-- 内容属性 -->
		 				<a href="<?php echo $v['url'];?>"><?php echo title_color($v['title'], $v['color']);?></a>
		 				<p><?php echo $v['description'];?></p>
		 				<div class="yzm-news-tags">
		 					<?php $tag_data = content_list_tag($v['catid'], $v['id']);?>
 							<?php if(is_array($tag_data)) foreach($tag_data as $val) { ?>	
 							<a href="<?php echo tag_url($val['id']);?>" target="_blank" ><?php echo $val['tag'];?></a>
 							<?php } ?>
		 				</div>
		 			</div>
		 		</div>		
		 		<?php } ?>						

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
		 			<h2>随机推荐</h2>
		 		</div>
		 	    <ul class="yzm-like-list">
		 			<?php $tag = yzm_base::load_sys_class('yzm_tag');if(method_exists($tag, 'lists')) {$data = $tag->lists(array('field'=>'title,url,color,inputtime','catid'=>$catid,'order'=>'RAND()','limit'=>'10',));}?>
					<?php if(is_array($data)) foreach($data as $v) { ?>
					   <li><span class="date"><?php echo date('m-d',$v['inputtime']);?></span><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="_blank"><?php echo title_color($v['title'], $v['color']);?></a></li>	
					<?php } ?>						
		 		</ul>		 		
		 	</div>	
 		 	<div class="yzm-line"></div>
 		 	<div class="yzm-list-advertise">
 		 		<a href="http://www.yzmcms.com" target="_blank">
 		 		<p>PC+WAP+微信三站合一</p>
 		 		<p class="yzm-ad">YzmCMS开源CMS</p>
 		 		</a>
 		 	</div>
 		 	<div class="yzm-line"></div>
 	 	 	<div class="yzm-content-box">
 	 			<div class="yzm-title">
 	 	 			<h2>最新评论</h2>
 	 	 		</div>
 			    <ul>
 				<?php $tag = yzm_base::load_sys_class('yzm_tag');if(method_exists($tag, 'comment_newest')) {$data = $tag->comment_newest(array('limit'=>'10',));}?>
 				<ul class="yzm-comment-list">
 				<?php if(is_array($data)) foreach($data as $v) { ?>	
 					<li>
 					<a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a>
 					<p><em><?php if($v['userid']) { ?><?php echo $v['username'];?><?php } else { ?>网友评论<?php } ?></em>：<?php echo $v['content'];?></p>
 					</li>
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