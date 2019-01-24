<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
	<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
	<style type="text/css">
		.header span{background: #009688;margin-left: 30px;padding: 10px;color:#ffffff;}
		.header div{border-bottom: solid 2px #009688;margin-top: 8px;}
	</style>
</head>
<body style="padding: 10px;">
	<div class="header">
		<span>菜单管理</span>
		<div></div>
	</div>

	<form class="layui-form">
		{if condition="$pid>0"}
		<button class="layui-btn layui-btn-primary layui-btn-sm" style="float: right;margin:5px 0px;" onclick="back({$backid});return false;">返回上级</button>
		{/if}
		<input type="hidden" name="pid" value="{$pid}">
		<table class="layui-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>排序</th>
					<th>菜单名称</th>
					<th>controller</th>
					<th>method</th>
					<th>是否隐藏</th>
					<th>是否禁用</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				{volist name="data.lists" id="vo"}
				<tr>
					<td>{$vo.mid}</td>
					<td><input type="text" class="layui-input" name="ords[{$vo.mid}]" value="{$vo.ord}"></td>
					<td><input type="text" class="layui-input" name="titles[{$vo.mid}]" value="{$vo.title}"></td>
					<td><input type="text" class="layui-input" name="controllers[{$vo.mid}]" value="{$vo.controller}"></td>
					<td><input type="text" class="layui-input" name="methods[{$vo.mid}]" value="{$vo.method}"></td>
					<td><input type="checkbox" lay-skin="primary" name="ishiddens[{$vo.mid}]" title="隐藏" {$vo.ishidden?'checked':''} value=1></td>
					<td><input type="checkbox" lay-skin="primary" name="status[{$vo.mid}]" title="禁用" {$vo.status?'checked':''} value=1></td>
					<td><button class="layui-btn layui-btn-xs" onclick="child({$vo.mid});return false;">子菜单</button></td>
				</tr>
				{/volist}
				<tr>
					<td></td>
					<td><input type="text" class="layui-input" name="ords[0]"></td>
					<td><input type="text" class="layui-input" name="titles[0]"></td>
					<td><input type="text" class="layui-input" name="controllers[0]"></td>
					<td><input type="text" class="layui-input" name="methods[0]"></td>
					<td><input type="checkbox" lay-skin="primary" name="ishiddens[0]" title="隐藏" value=1></td>
					<td><input type="checkbox" lay-skin="primary" name="status[0]" title="禁用" value=1></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</form>
	<button class="layui-btn" onclick="save()">保存</button>
	<script type="text/javascript">
		layui.use(['layer','form'],function(){
			$ = layui.jquery;
			layer = layui.layer;
			form = layui.form;
		});

		// 子菜单
		function child(pid){
			window.location.href="/index.php/admins/Menu/index?pid="+pid;
		}

		// 返回上一级
		function back(pid){
			window.location.href="/index.php/admins/Menu/index?pid="+pid;
		}

		// 保存
		function save(){
			$.post('/index.php/admins/menu/save',$('form').serialize(),function(res){
				if(res.code>0){
					layer.alert(res.msg,{'icon':2});
				}else{
					layer.msg(res.msg,{'icon':1});
					setTimeout(function(){window.location.reload();},1000);
				}
			},'json');
		}
	</script>
</body> 
</html>