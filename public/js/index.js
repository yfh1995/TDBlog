$(function(){
	var $muneLi = $(".sidebar-menu>li:not(:first)"),
		$muneA = $(".treeview>a"),
		$treeviewMenu = $(".treeview-menu>li>a"),
		$muneShrink = $(".sidebar-toggle"),
		$leftMune = $(".main-sidebar"),
		$logo = $(".logo");
	
	$(window).resize(function(){
		if( $(window).width() > 768 ) {
			$(".content-wrapper").removeClass("short");
			$(".content-wrapper").removeClass("long");
			if($leftMune.width() == 50){
				$(".content-wrapper").addClass("smallcont");
			}
			$leftMune.removeClass("smallshrink");
		}else{
			$(".content-wrapper").removeClass("smallcont");
			
			$leftMune.removeClass("smallshrink");
		}
	});
	//左侧菜单收缩
	$muneShrink.on("click",function(){	
		if($(window).width() > 768){
			if($leftMune.hasClass("shrink") && $logo.hasClass("shrink")){
				$(".sidebar-menu li.menu-header").removeClass("hide");
				$(".sidebar-menu>li>.treeview-menu").removeClass("hide");
				$(".sidebar-menu>li>a>.shrinkhide, .sidebar-menu>li>a>.pull-right").removeClass("hide");
				$leftMune.removeClass("shrink");
				$logo.removeClass("shrink");
				$(".logo-min").hide();
				$(".logo-lg").show();	
				$(".content-wrapper").removeClass("smallcont");
			}else{
				$(".sidebar-menu li.menu-header").addClass("hide");
				$(".sidebar-menu>li>.treeview-menu").addClass("hide");
				$(".sidebar-menu>li>a>.shrinkhide, .sidebar-menu>li>a>.pull-right").addClass("hide");
				$leftMune.addClass("shrink");
				$logo.addClass("shrink");
				$(".logo-min").show();
				$(".logo-lg").hide();	
				$(".content-wrapper").addClass("smallcont");
			}	
		}else{
			if($leftMune.hasClass("smallshrink")){
				$leftMune.removeClass("smallshrink");	
				//$(".content-wrapper").removeClass("smallcont");
				if($leftMune.width() == 50){
					$(".content-wrapper").removeClass("short");
				}else{
					$(".content-wrapper").removeClass("long");
				}
			}else{
				$leftMune.addClass("smallshrink");
				//$(".content-wrapper").addClass("smallcont");
				if($leftMune.width() == 50){
					$(".content-wrapper").addClass("short");
				}else{
					$(".content-wrapper").addClass("long");
				}
			}
		}

		$muneLi.hover(function(){
			if($leftMune.width() == 50){
				$(this).find($(".shrinkhide")).addClass("suspension");
				$(this).find($(".sidebar-menu>li>.treeview-menu")).addClass("suscontent");
			}
		},function(){
			$(this).find($(".shrinkhide")).removeClass("suspension");
			$(this).find($(".sidebar-menu>li>.treeview-menu")).removeClass("suscontent");
		})
	})
	
	// 菜单具体内容显示隐藏
	$muneA.on("click",function(event){
		event.stopPropagation();
		var _this = $(this);
		if($leftMune.width() == 230){
			commonShrink(_this)
		}
		
	})
	
	$treeviewMenu.on("click",function(event){
		event.stopPropagation();
		var _this = $(this);
		commonShrink(_this);
		if($leftMune.width() == 50){
			if($(this).parent().parent().css("border-bottom-right-radius") == "4px"){
				$(this).parent().parent().css("border-bottom-right-radius",0)
			}else{
				$(this).parent().parent().css("border-bottom-right-radius","4px")
			}
			
		}
	})
	
	function commonShrink(_this){
		if(_this.children("span").hasClass("pull-right")){
			if(_this.hasClass("active")){
				_this.removeClass("active");
				_this.siblings("ul").slideUp("slow",function(){
					_this.children(".pull-right").removeClass("glyphicon-menu-down").addClass("glyphicon-menu-left");
				});
			}else{
				_this.addClass("active").parent().siblings().children("a").removeClass("active");
				_this.siblings("ul").slideDown("slow",function(){
					_this.children(".pull-right").removeClass("glyphicon-menu-left").addClass("glyphicon-menu-down");
				}).parent().siblings().children("ul").slideUp("slow",function(){
					_this.parent().siblings().children("a").children(".pull-right").removeClass("glyphicon-menu-down").addClass("glyphicon-menu-left");
				});
			}	
		}
	}
	
	//显示用户详情
	$(".dropdown>a").on("click",function(){
		if($(".dropdown-menu").css("display") == "none"){
			$(".dropdown-menu").show();
		}else{
			$(".dropdown-menu").hide();
		}
	})

	/*
	 *
	 * 请注意，以下位置有菜鸡出没
	 *
	 */

	//内容区高度自适应
    $('.content').css('min-height',$(window).height() - $('.header').outerHeight() - $('.content-header').outerHeight());
	$(window).resize(function(){
		$('.content').css('min-height',$(window).height() - $('.header').outerHeight() - $('.content-header').outerHeight());
	});

})