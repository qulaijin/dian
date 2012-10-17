<?php $this->load->view('_header') ?>
<div id="warp">
<?php $this->load->view('_nav') ?>
	<div id="main">
		<div class="topnav">
			<div class="lnav">当前位置 : <a href="__APP__">首页</a> > <a href="__APP__/User/info/id/{$userinfo[id]}">用户信息</a></div>
			<div class="lsearch">	
				<form action="__APP__/search" method="get" class="cf"><input id="search-key" class="text fl" type="text" name="keywords" value="|想要什么尽管搜"/>
				<input class="button fl" type="submit" value="搜索" title="搜索" /></form>
			</div>
		</div>
		<!--info-->
		<div class="userinfo">
		<p class="inp">用户信息</p>
		<form action="<?php echo site_url('user/info/save')?>" method="post" id="reg_form" name="reg_form">
			<table width="100%" border="0">
  				<tr>
   					<td width="100" align="right" class="pt">用户名：</td>
    				<td><?php echo $userinfo['username']; ?></td>
  				</tr>
  				<tr>
    				<td align="right" class="pt">密码：</td>
    				<td><input name="password" id="password" type="password" /><label class="error" id="tip_password">不修改密码请为空</label></td>
  				</tr>
  				<tr>
    				<td width="100" align="right" class="pt">E-mail：</td>
    				<td><input name="email" id="email" type="text" value="<?php echo $userinfo['email']; ?>" /><label class="error" id="tip_email"></label></td>
  				</tr>
		
			</table>	
		<p class="inp">联系方式</p>
			<table width="100%" border="0" class="continfo">
  				<tr>
  					
   					<td width="100" align="right" class="pt">公司</td>
    				<td class="ptl">
    					<?php if (!$userinfo['company']) : ?>
    						<input type="text" name="company" id="continfo" value="公司名输入后不能更改，请仔细核对!">
    					<?php else : ?>
    					<?php echo $userinfo['company']; ?>
    					<input type="hidden" name="company" id="continfo" value="<?php echo $userinfo['company']; ?>">
    					<?php endif; ?>
    				<label class="error2" id="tip_password">修改公司名请联系管理员</label></td>
  				</tr>
  				<tr>
    				<td align="right" class="pt">地区</td>
    				<td class="ptl"><input id="continfo" type="text" name="city" value="<?php echo $userinfo['company']; ?>"/></td>
  				</tr>
  				<tr>
    				<td class="pt">详细地址</td>
    				<td class="ptl"><input name="address" id="continfo" type="text" value="<?php echo $userinfo['address']; ?>" /></td>
  				</tr>
				<tr>
    				<td class="pt">邮编</td>
    				<td class="ptl"><input name="postcode" id="continfo" type="text" value="<?php echo $userinfo['postcode']; ?>" /></td>
  				</tr>
  				<tr>
    				<td class="pt">联系人</td>
    				<td class="ptl"><input name="person" id="continfo" type="text" value="<?php echo $userinfo['person']; ?>" /></td>
  				</tr>
  				<tr>
    				<td class="pt">手机</td>
    				<td class="ptl"><input name="mobile" id="continfo" type="text" value="<?php echo $userinfo['mobile']; ?>" /></td>
  				</tr>
  				<tr>
    				<td class="pt">电话</td>
    				<td class="ptl"><input name="tel" id="continfo" type="text" value="<?php echo $userinfo['tel']; ?>" /></td>
  				</tr>
  				<tr>
    				<td class="pt">传真</td>
    				<td class="ptl"><input name="fax" id="continfo" type="text" value="<?php echo $userinfo['fax']; ?>" /></td>
  				</tr>
  				<tr>
    				<td class="pt">E-mail</td>
    				<td class="ptl"><input name="pemail" id="continfo" type="text" value="<?php echo $userinfo['pemail']; ?>" /></td>
  				</tr>
  				<tr>
    				<td class="pt">网站</td>
    				<td class="ptl"><input name="website" id="continfo" type="text" value="<?php echo $userinfo['website']; ?>" /></td>
  				</tr>
			</table>
			<p class="inp">公司介绍</p>
			<table width="100%" border="0" class="continfo">
				<tr>
					<td><textarea rows="10" cols="140" name="companydesc"><?php echo $userinfo['companydesc']; ?></textarea></td>
				</tr>
			</table>
			<table width="100%" border="0" class="continfo">
				<tr>
					<td align="center"><input type="submit" value="保 &nbsp; 存" class="formbutton"></td>
				</tr>
				<tr>
					<td><input type="hidden" name="id" value="<?php echo $userinfo['id']; ?>"></td>
				</tr>
			</table>
		</form>
		</div>
	</div>		


<?php $this->load->view('_footer') ?>

</div>