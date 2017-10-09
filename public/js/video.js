window.onload = function() {

	$("#videoBtn").on("click", function() {
		$("#videoMask").show();
		new ZResize({
			stage: "#videoMask", //舞台  
			item: '#videoWrap', //可缩放的类名  
		});
	});

}