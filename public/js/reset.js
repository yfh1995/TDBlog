window.onload = function() {
	$("#resetPas_Accout").bind('input porpertychange', function(e) {
		var str=$(this).children("input").val()
		if(str.length==""){
			$("#resetPas_Accout .icon").hide();
		}else{
			$("#resetPas_Accout .icon").show();
		}
	});
	$("#resetPas_Accout .icon").on("click",function(){
		$("#resetPas_Accout input").val("");
		$(this).hide();
	});
	$("#reset_btn").on("mouseover",function(){
		$(this).addClass("mousHhover");
	}).on("mouseout",function(){
		$(this).removeClass("mousHhover");
	});
	
	$("#reset_btn").on("click",function(){
		if(checkEmail($("#resetPas_Accout input").val())===false){
			$(".inputErrorTips").text("你输入的邮箱格式有问题！");
			$("#error").show();
			return false;
		}
	})
	
}