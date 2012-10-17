<?php $this->load->helper('url')?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8">
<head>
<meta http-equiv="refresh" content="1; url=<?php echo site_url($goto)?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
<meta http-equiv="expires" content="0">
<title>提 示 信 息</title>
<link href="<?php echo base_url()?>css/message.css" rel="stylesheet" type="text/css" />
</head>
<body class="x-border-layout-ct" style="position: relative;">
<div id="warp">
	<div id="head">
	<div class="nav">
		<ul>
			<li class="home"><a href="<?php echo site_url('home')?>" class="">点石成金</a></li>
			<?php if ($this->session->userdata('user_in')):  ?>
			<li><a href="<?php echo site_url('newpost')?>">发布供求</a></li>
			<li><a href="<?php echo site_url('plist')?>">已发布</a></li>
			<li><a href="<?php echo site_url('user/info')?>">用户信息</a></li>
			<li><a href="<?php echo site_url('payment')?>">充值</a></li>
			<li><a href="<?php echo site_url('mesg')?>">短消息</a></li>
			<li class="list"><a href="<?php echo site_url('login/logout')?>">退出</a></li>
			<li class="list"><a href="<?php echo site_url('user/info')?>">用户名: <?php echo $this->session->userdata('user_name');?> </a></li>
			<?php else: ?>
			<li><a href="<?php echo site_url('login')?>">登陆</a></li>
			<li><a href="<?php echo site_url('login/regist')?>">注册</a></li>
			<?php endif; ?>
		</ul>
	</div>
	</div>
	<div id="main">
		<div id="messagebox">
			<div id="messagebox-title" align="center">提示信息</div>
     		<div id="messagebox-content">
       			<p><div><?php echo $message;?></div></p>
        		<p><div><a href="<?php echo site_url($goto)?>">如果您的浏览器不支持自动跳转,请点击这里.</a></div></p>
      		</div>
      	</div>
	</div>	
<?php $this->load->view('_footer') ?>
</div>
</body>
</html>