$(function(){
	// 手机验证
	// $('#phone').focusout(function(){
	// 	var reg = /^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\d{8}$/;
	// 	if(reg.test($('#phone').val())){
			
	// 	}
	// })
	var flag = $('#check').attr('checked');
	$('#check').click(function(){
		if(!flag){
			$(this).attr('checked','checked');
		}else{
			$(this).removeAttr('checked');
		}
	})
	$('#submit').click(function(){
		var phone=$('#phone').val();
		var email=$('#email').val();
		var pass=$('#pass').val();
		var pass_again=$('#pass_again').val();
		var text='Tip:';
		var phone_reg = /^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\d{8}$/;
		var email_reg=/^[1-9a-zA-Z_][0-9a-zA-Z_-]{1,}@\w+\.\w{2,}$/;
		var pass_reg=/^\w{6,}$/;
		var flag = $('#check').attr('checked');
		if (!flag) {
			text += '请勾选服务条款';
			$('#alert').show("fast",function(){
				$('#text').text(text);
			});
			return false;
		};
		if (!(phone_reg.test(phone)&&email_reg.test(email)&&pass_reg.test(pass)&&parseInt(pass)==parseInt(pass_again))) {
			if (!phone_reg.test(phone)) {
				if (!phone) {
					text += '请填写手机号码';
					$('#alert').show("fast",function(){
						$('#text').text(text);
					});
					return false;
				}
				text +='手机号码格式错误';
				$('#alert').show("fast",function(){
						$('#text').text(text);
					});
				return false;
			}
			if (!email_reg.test(email)) {
				if (!email) {
					text += '请填写邮箱';
					$('#alert').show("fast",function(){
						$('#text').text(text);
					});
					return false;
				}
				text += '/邮箱格式错误';
				$('#alert').show("fast",function(){
						$('#text').text(text);
					});
				return false;
			}
			if (!pass_reg.test(pass)) {
				if (!pass) {
					text += '请填写密码';
					$('#alert').show("fast",function(){
						$('#text').text(text);
					});
					return false;
				}
				text +='/密码格式错误';
				$('#alert').show("fast",function(){
						$('#text').text(text);
					});
				return false;
			}
			if(parseInt(pass)!=parseInt(pass_again)){
				if (!pass_again) {
					text += '请再一次输入密码';
					$('#alert').show("fast",function(){
						$('#text').text(text);
					});
					return false;
				}
				text +='/密码不一致';
				$('#alert').show("fast",function(){
						$('#text').text(text);
					});
				return false;
			}

		};
		
	})
	$('#close').click(function(){
		$('#alert').hide();
	});

});