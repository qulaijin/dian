<?php $this->load->view('_header') ?>
<link rel="Stylesheet" type="text/css" href="<?php echo base_url()?>css/validator.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/formValidator-4.1.3.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	$.formValidator.initConfig({formID:"reg_form",theme:"default",submitOnce:true,

		onError:function(msg,obj,errorlist){

			$("#errorlist").empty();

			$.map(errorlist,function(msg){

				$("#errorlist").append("<li>" + msg + "</li>")

			});

			alert(msg);

		},

		ajaxPrompt : '有数据正在异步验证，请稍等...'

	});
		
		$("#username")
		.formValidator({
			onShowText:"请输入用户名",
			onShow:"",
			onFocus:"",
			onCorrect:""})
		.inputValidator({
			min:3,
			max:10,
			onError:"请输入用户名"
		});

		$("#username").ajaxValidator({
			dataType : "html",
			async : true,
			url : "<?php echo site_url('login/check_name')?>",
			success : function(result){
    			if( result == "0" ) return true;
					return "该用户名不存在，<a href='<?php echo site_url('login/regist')?>'>立即注册</a>";
			},
			buttons: $("#signup-submit"),
			error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
			onError : "该用户名不存在，<a href='#'>立即注册</a>",
			onWait : "正在对用户名进行合法性校验，请稍候..."
		});
		$("#password")
		.formValidator({
			onShow:"请输入密码",
			onFocus:"请输入密码",
			onCorrect:"密码合法"
		})
		.inputValidator({
			min:6,
			max:16,
			onError:"密码错误"
		});
});

var msg = '<?php echo $error_msg; ?>';
$(document).ready(function() {
	if (msg != 0){
		switch (msg){
			case 'loginerror' : $('#msgtip').text('用户名或密码错误').show();break;
			default : break;
		}
	}	
});

</script>
<div id="warp">
<?php $this->load->view('_nav') ?>
	<div id="main">
		<div class="regiest">
		<form action="<?php echo site_url('login/check_customer')?>" method="post" id="reg_form" name="reg_form">
			<table width="100%" border="0" class="login_form">
  				<tr>
   					<td width="100" align="right" class="pt">帐号：</td>
    				<td class="line"><input name="username" id="username" type="text" onblur="check_nick_valid();" /></td>
    				<td><label class="error" id="usernameTip"></label></td>
  				</tr>
  				<tr>
    				<td align="right" class="pt">密码：</td>
    				<td class="line"><input name="password" id="password" type="password" onblur="check_passwd();" /></td>
    				<td><label class="error" id="passwordTip"></label></td>
  				</tr>
  				<tr>
    				<td></td>
    				<td><a class="err" href="<?php echo site_url('user/forget')?>">找回忘记的密码</a></td>
  				</tr>
  				<tr>
  					<td></td>
  					<td><span id="msgtip"></span></td>
  				</tr>
  				<tr>
    				<td align="right">&nbsp;</td>
    				<td><input type="submit" value="登 &nbsp;陆" name="commit" id="signup-submit" class="formbutton"></td>
  				</tr>
			</table>	
		</form>
		</div>
	</div>	
<?php $this->load->view('_footer') ?>
</div>
</body></html>