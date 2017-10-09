window.onload = function() {

	$("#login_Account").bind('input porpertychange', function(e) {
		var str=$(this).children("input").val()
		if(str.length==""){
			$("#login_Account .icon").hide();
		}else{
			$("#login_Account .icon").show();
		}
	});
	$("#login_Account .icon").on("click",function(){
		$("#login_Account input").val("");
		$(this).hide();
	});
	$("#login_password").bind('input porpertychange', function(e) {
		var str=$(this).children("input").val();

		if(str.length==""){
			$("#login_password .icon").hide();
		}else{
			$("#login_password .icon").show();
		}
	});
	$("#login_password .icon").on("click",function(){
		if($(this).index()==1){//清空文本框操作
			$("#login_password input").val("");
			$(this).hide();
		}else{
			if($("#login_password input").attr("type")=="text"){
				$("#login_password input").attr("type","password");
				$(this).children("use").attr("xlink:href","#icon-yanjing");
			}else{
				$("#login_password input").attr("type","text");
				$(this).children("use").attr("xlink:href","#icon-yanjing1");
			}
		}
	});
	
	$("#login_btn").on("mouseover",function(){
		$(this).addClass("mousHhover");
	}).on("mouseout",function(){
		$(this).removeClass("mousHhover");
	});
	
	$("#login_btn").on("click",function(){
		if(checkEmail($("#login_Account input").val())===false){
			
			$(".inputErrorTips").text("你输入的邮箱格式有问题！");
			$("#error").show();
			return false;
		}
	})
	
}