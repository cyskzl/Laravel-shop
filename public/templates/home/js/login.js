$(function(){
	$('#submit').click(function(){
		var phone=$('#phone').val();
		var pass=$('#pass').val();
		var phone_reg = /^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\d{8}$/;
		var pass_reg=/^\w{6,}$/;
		var text='Tip:';
		if (!(phone_reg.test(phone)&&pass_reg.test(pass))) {
			if (!phone) {
				text += '请填写手机号码';
				$('#alert').show("fast",function(){
					$('#text').text(text);
				});
				return false;
			}
			if (!phone_reg.test(phone)) {
				text +='手机号码格式错误';
				$('#alert').show("fast",function(){
						$('#text').text(text);
					});
				return false;
			}
			if (!pass) {
				text += '请填写密码';
				$('#alert').show("fast",function(){
					$('#text').text(text);
				});
				return false;
			}
			if (!pass_reg.test(pass)) {
				text +='/密码格式错误';
				$('#alert').show("fast",function(){
						$('#text').text(text);
					});
				return false;
			}
		}
	})
	$('#close').click(function(){
		$('#alert').hide();
	});
})