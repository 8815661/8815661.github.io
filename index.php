<?php
include 'function.php';
?><!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo SITENAME;?> biubiubiu </title>
  <meta name="renderer" content="webkit">
  <link href="amazeui.flat.min.css" rel="stylesheet">
</head>



<body>
<div class="am-container">
<h1><?php echo SITENAME;?></h1>
<form class="am-form" id="myform">
<div class="am-form-group">
      <center><textarea class="" rows="5" id="content" placeholder=" "></textarea></center>
</div>
<?php
if(VCODE==1){
?>
<div class="am-input-group">
<input type="text" id="scode" class="am-form-field" style="width:100px;" placeholder="验证码"><img src="scode.php" alt="点击刷新" title="点击刷新" id="scode_img" style="vertical-align:middle;cursor:pointer;">
</div>
<?php
}
?>

<p align="center"><button type="submit" class="am-btn am-btn-success">　提交　</button></p>



<div id="msg"></div>
</form>	
<div id="list">
<div class="am-panel am-panel-success">

<div class="am-panel-bd">


  {{content}}
  </div>
<?php if(checklogin()){?>
  <div class="am-panel-footer"><a href="javascript:;" data-id="{{id}}" class="del">删除</a></div>
<?php }?>
</div>
</div>
<ul data-am-widget="pagination" class="am-pagination" id="pager" style="display:none;">
<li class="am-pagination-prev ">
  <a href="javascript:;" class="" id="prev">←</a>
</li>
<li class="am-pagination-next ">
  <a href="javascript:;" class="" id="next">→</a>
</li>
</ul>
<footer class="am-footer am-footer-default"> <?php if(checklogin()){?><a href="logout.php">安全退出</a><?php }else{ ?><a href="login.php">　</a><?php }?></footer>
</div>
</div>
<script src="jquery.min.js"></script>
<script src="js.js"></script>
<script>
$(function(){
	
	var offset=0;
	var total=0;
	var html=$("#list").html();

	$('#scode_img').bind('click',function(){
		this.src='scode.php?rand='+Math.random();
	});
	$('#myform').bind('submit',function(){
		if($('#content').val().trim()==''){
			$('#msg').html('<div class="am-alert am-alert-danger" data-am-alert>　</div>');
			return false;
		}
		if($('#scode').val()==''){
			$('#msg').html('<div class="am-alert am-alert-danger" data-am-alert>请填写验证码</div>');
			return false;
		}
		$.post('js_post.php',{'content':$('#content').val(),'scode':$('#scode').val(),'rand':Math.random()},function(data){
			if(data=='success'){
				$('#content').val('');
				$('#scode').val('');
				$('#scode_img').attr('src','scode.php?rand='+Math.random());
				offset=0;
				load_content();
			}
			if(data=='scode'){
				$('#scode').val('');
				$('#msg').html('<div class="am-alert am-alert-danger" data-am-alert>验证码有误</div>');
			}
		});
		return false;
	});
	
	$('#content').bind('keydown',function(){
		$('#msg').html('');
	});
	
	$('#scode').bind('keydown',function(){
		$('#msg').html('');
	});

	$('#prev').bind('click',function(){
		offset=offset-<?php echo PAGESIZE?>;
		if(offset<0){
			offset=offset+<?php echo PAGESIZE?>;;
			return false;
		}
		load_content();
	});

	$('#next').bind('click',function(){
		offset=offset+<?php echo PAGESIZE?>;
		if(offset>total-1){
			offset=offset-<?php echo PAGESIZE?>;
			return false;
		}
		load_content();
	});
	
	function load_content(){
		$.post('js_total.php',{'rand':Math.random()},function(data){
			total=data;
		});
		$.post('js_content.php',{'rand':Math.random(),'offset':offset},function(data){
			data=JSON.parse(data);
						
			$("#list").html('');
			var res='';
			for(var i=0;i<data.length;i++){
				var list=html;
				list=list.replace("{{addtime}}",formatDateTime(data[i].addtime));
				list=list.replace("{{content}}",data[i].content);
				list=list.replace("{{id}}",data[i].id);
				res+=list;
			}
			if(data.length>0){
				$('#pager').show();
			}
			$("#list").html(res);
			$('.del').bind('click',function(){
				var id=$(this).attr('data-id');
				$.post('js_del.php',{'id':id,'rand':Math.random()},function(data){
					
					if(data!='error'){
						load_content();
					}
				});
			});
		});
	}
	
	load_content();
	
	<?php
	if(AUTOFLASH==1){
	?>
	setInterval(function(){
		offset=0;
		load_content
	},5000);
	<?php
	}
	?>
	
});
</script>
</body>
</html>