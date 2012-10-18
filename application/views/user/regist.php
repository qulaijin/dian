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
			onShowText:"",
			onShow:"",
			onFocus:"可输入4~30位<br>包含数字、英文和中文",
			onCorrect:"完成",
			})
		.inputValidator({
			min:4,
			max:10,
			onError:"请输入用户名"
		});

		$("#username").ajaxValidator({
			dataType : "html",
			async : true,
			url : "<?php echo site_url('login/check_name')?>",
			success : function(result){
    			if( result == "1" ) return true;
					return "该用户名已被注册";
			},
			buttons: $("#signup-submit"),
			error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
			onError : "该用户名已存在，请更换用户名",
			onWait : "正在对用户名进行合法性校验，请稍候..."
		});

				$("#password").formValidator({onShow:"",onFocus:"至少6位,<br>包含数字、英文和中文",onCorrect:"完成"}).inputValidator({min:6,empty:{leftEmpty:false,rightEmpty:false,emptyError:"密码两边不能有空符号"},onError:"请输入密码"});
/*
		$("#confirm_password")
		.formValidator({
			onShow:"请再次输入密码",
			onFocus:"密码长度只能在6-16位字符之间",
			onCorrect:"密码一致"
		})
		.inputValidator({
			min:6,
			empty:{
			leftEmpty:false,
			rightEmpty:false,
			emptyError:"重复密码两边不能有空符号"
			},
			onError:"密码长度只能在6-16位字符之间"
			})
		.compareValidator({
			desID:"password",
			operateor:"=",
			onError:"2次密码不一致,请确认"
			});
			*/
		$("#email")
		.formValidator({
			onShow:"",
			onFocus:"输入常用E-mail,<br>找回密码时可用",
			onCorrect:"完成",
			defaultValue:"@"})
		.inputValidator({
			min:6,
			max:100,
			onError:"请输入常用E-mail"})
		.regexValidator({
		regExp:"^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$",
			onError:"你输入的邮箱格式不正确"
		});
		$("#email").ajaxValidator({
			dataType : "html",
			async : true,
			url : "<?php echo site_url('login/check_email')?>",
			success : function(result){
    			if( result == "1" ) return true;
					return "此E-mail已被注册过";
			},
			buttons: $("#signup-submit"),
			error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
			onError : "该邮箱已被使用，请您更换其它邮箱",
			onWait : "正在检测邮箱是否重复，请稍候..."
		});
		$("#verify")
			.formValidator(
				{
					onShow: "",
					onFocus: "输入下面的验证码",
					onCorrect: "完成"
				})
			.inputValidator(
				{
					min: 1,
					onError: "请输入下面验证码"
				});
				
		$("#verify").ajaxValidator({
			dataType : "html",
			async : true,
			url : "<?php echo site_url('login/check_verify')?>",
			success : function(result){
    			if( result == "1" ) return true;
					return "验证码错误";
			},
			buttons: $("#signup-submit"),
			onError : "验证码错误",
			onWait : ""
		});
				
		$(":checkbox[name='agree']")
		.formValidator({
			tipID:"chooseTip",
			onShow:"",
			onFocus:"",
			onCorrect:""})
		.inputValidator({
			min:1,
			onError:"请阅读后打勾"
		});
});

function change_verify(obj)
{

    $(obj).attr('src','<?php echo site_url('login/verify')?>'+'/'+Math.random());
}
var msg = '<?php echo $error_msg; ?>';
$(document).ready(function() {
	if (msg != 0){
		switch (msg){
			case 'verifier' : $('#cvlRegister').empty().text('验证码错误').show();break;
			default : break;
		}
	}	
});
</script>
<div id="warp">
<?php $this->load->view('_nav') ?>
<div id="main">
		<div class="regiest">
		<form action="<?php echo site_url('login/save')?>" method="post" id="reg_form" name="reg_form" onsubmit="javascript:return WebForm_OnSubmit();">
			<table width="100%" border="0" class="login_form">
  				<tr>
   					<td width="100" align="right" class="pt">帐号：</td>
    				<td class="line"><input name="username" id="username" type="text"/></td>
    				<td><label class="error" id="usernameTip"></label></td>
  				</tr>
  				<tr>
    				<td width="100" align="right" class="pt">E-mail：</td>
    				<td class="line"><input name="email" id="email" type="text" /></td>
    				<td><label class="error" id="emailTip"></label></td>
  				</tr>
  				<tr>
    				<td align="right" class="pt">密码：</td>
    				<td class="line"><input name="password" id="password" type="password"/></td>
    				<td><lable class="error" id="passwordTip"></div></td>
  				</tr>
  			<!--	<tr>
    				<td align="right" class="pt">确认密码：</td>
    				<td class="line"><input name="confirm_password" id="confirm_password" type="password"/></td>
    				<td><label class="error" id="confirm_passwordTip"></div></td>
  				</tr> -->
  				<tr>
    				<td align="right" class="pt">验证码:&nbsp;</td>
    				<td class="line"><input name="verify" id="verify" type="text"/></td>
    				<td><label class="error" id="verifyTip"></label></td>
  				</tr>
  				<tr>
  				<td></td>
  				<td><img src="<?php echo site_url('login/verify')?>" class="verify" onclick="change_verify(this)" /></td>
  				</tr>
  				<tr>
  				<td></td>
  				<td>
  				 <input id="choose" class="radio" type="checkbox" name="agree"> &nbsp;点石成金的《使用协议》</td>
  				 <td><label class="error" id="chooseTip"></label></td>
  				</tr>
  				<tr>
    				<td align="right">&nbsp;</td>
    				<td><input type="submit" value="注 &nbsp;册" name="commit" id="signup-submit" class="formbutton" onclick="return validate('2');WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ibtRegister&quot;, &quot;&quot;, true, &quot;2&quot;, &quot;&quot;, false, false))"></td>
  				</tr>
			</table>	
		</form>
		
		<div class="onError"><span id="cvlRegister" style="color: Red; display: none;">注册信息错误</span></div>
		
		</div>
	</div>
<script type="text/javascript">
<!--
function WebForm_OnSubmit() {
if (typeof(ValidatorOnSubmit) == "function" && ValidatorOnSubmit() == false) return false;
return true;
}
// -->
</script>

<?php $this->load->view('_footer') ?>
</div>

</body></html>