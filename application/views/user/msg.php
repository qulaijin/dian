<?php $this->load->view('_header') ?>
<div id="warp">
<?php $this->load->view('_nav') ?>
	<div id="main">
		<div class="topnav">
			<div class="lnav">当前位置 : <a href="<?php echo site_url(); ?>">首页</a> > <a href="<?php echo site_url('user/msg'); ?>">短消息</a></div>
			<div class="lsearch">	
				<form action="<?php echo site_url('search/sresult'); ?>" method="post" class="cf"><input id="search-key" class="text fl" type="text" name="keyword" value="|想要什么尽管搜"/>
				<input class="button fl" type="submit" value="搜索" title="搜索" /></form>
			</div>
		</div>
		<!--info-->
		<div class="msg">
			<div class="msglist">
			<p class="inp">短消息</p>	
					<?php 
						foreach($msglist as $msg){
							echo '<dl>';
							echo '<dd class="name">' . $userinfo['username'] . ' : </dd>';
							echo '<dd>' . $msg['subject'] . '</dd>';
							echo '<dd class="time">' . date("Y年m月d日 H:i",$msg['dateline']) . '</dd>';					
							echo '</dl>';
							if($msg['reply']){
								echo '<dl class="reply">';
								echo '<dd class="name">管理员 : </dd>';
								echo '<dd>' . $msg['reply'] . '</dd>';
								echo '<dd class="rtime">' . date("Y年m月d日 H:i",$msg['lastline']) . '</dd>';					
							echo '</dl>';
							}
						}					
					?>
				</dl>
			</div>
			<!-- form-->			
			<form action="<?php echo site_url('user/msg/save'); ?>" method="post">
				<div class="subject">
					<textarea name="subject" tabindex="1" class="subject-text"></textarea>                   </textarea>
				</div>
					<div class="msgbotton"><input type="submit" value="发送" class="submit"></div>
				
				</table>
			</form>
		</div>
		
		
	</div>		


<?php $this->load->view('_footer') ?>

</div>