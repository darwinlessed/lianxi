<?php /*a:1:{s:81:"D:\myphp_www\PHPTutorial\WWW\newphp\admins\application\admins\view\site\index.php";i:1525835764;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<title>网站设置</title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
	<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
	<style type="text/css">
		.header span{background: #009688;margin-left: 30px;padding: 10px;color:#ffffff;}
		.header div{border-bottom: solid 2px #009688;margin-top: 8px;}
		.header button{float: right;margin-top: -5px;}
	</style>
</head>
<body style="padding: 10px;">
	<div class="header">
		<span>网站设置</span>
		<div></div>
	</div>
	<form class="layui-form" style="margin-top: 10px;">
		<div class="layui-form-item">
			<label class="layui-form-label">网站名称</label>
			<div class="layui-input-inline">
				<input type="text" class="layui-input" name="title" value="<?php echo htmlentities($site['values']); ?>">
			</div>
		</div>
	</form>
	<div class="layui-form-item">
		<div class="layui-input-block">
			<button class="layui-btn" onclick="save()">提交</button>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	layui.use(['layer'],function(){
		$ = layui.jquery;
		layer = layui.layer;
	});

	function save(){
		var title = $.trim($('input[name="title"]').val());
		if(title==''){
			layer.msg('网站名称不能为空',{'icon':2});
			return;
		}
		$.post('/index.php/admins/site/save',{'title':title},function(res){
			if(res.code>0){
				layer.msg(res.msg,{'icon':2});
			}else{
				layer.msg(res.msg,{'icon':1});
				setTimeout(function(){window.location.reload();},1000);
			}
		},'json');
	}
</script>