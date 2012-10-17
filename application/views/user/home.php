<?php $this->load->view('_header') ?>
<div id="warp">
<?php $this->load->view('_nav') ?>
	<div id="main">
		<div class="topnav">
			<div class="lnav">当前位置 : <a href="<?php echo site_url(); ?>">首页</a></div>
			<div class="lsearch">	
				<form action="<?php echo site_url('search/sresult'); ?>" method="post" class="cf"><input id="search-key" class="text fl" type="text" name="keyword" value="|想要什么尽管搜"/>
				<input class="button fl" type="submit" value="搜索" title="搜索" /></form>
			</div>
		</div>
		<!--info-->
		<div class="welcome">
			<p class="wecl">欢迎来到点石成金!</p>
			<p><span class="wld">马上</span><span class="formbutton">&nbsp;&nbsp;<a href="<?php echo site_url('user/newpost'); ?>">发布供求</a></span></p>
		</div>
		
	</div>		
<?php $this->load->view('_footer') ?>
</div>
</body></html>