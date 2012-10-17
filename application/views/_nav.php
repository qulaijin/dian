<div id="head">
	<div class="nav">
		<ul>
			<li class="home <?php if($url =='home') : ?>curren" <?php endif; ?>"><a href="<?php echo site_url('home')?>" class="">点石成金</a></li>
			<?php if ($this->session->userdata('user_in')):  ?>
			<li <?php if($url =='newpost') : ?> class="curren" <?php endif; ?>><a href="<?php echo site_url('user/newpost')?>">发布供求</a></li>
			<li<?php if($url =='plist') : ?> class="curren" <?php endif; ?>><a href="<?php echo site_url('user/plist')?>">已发布</a></li>
			<li <?php if($url =='uinfo') : ?> class="curren" <?php endif; ?>><a href="<?php echo site_url('user/info')?>">用户信息</a></li>
			<li <?php if($url =='payment') : ?> class="curren" <?php endif; ?>><a href="<?php echo site_url('user/payment')?>">充值</a></li>
			<li <?php if($url =='msg') : ?> class="curren" <?php endif; ?>><a href="<?php echo site_url('user/msg')?>">短消息</a></li>
			<li class="list"><a href="<?php echo site_url('user/info')?>">用户名: <strong><?php echo $this->session->userdata('user_name');?></strong> </a></li>
			<li><a href="<?php echo site_url('login/logout')?>">退出</a></li>
			<?php else: ?>
			<li <?php if($url =='login') : ?> class="curren" <?php endif; ?>><a href="<?php echo site_url('login')?>">登陆</a></li>
			<li <?php if($url =='regist') : ?> class="curren" <?php endif; ?>><a href="<?php echo site_url('login/regist')?>">注册</a></li>
			<?php endif; ?>
		</ul>
	</div>
</div>