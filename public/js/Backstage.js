$(document).ready(function() {
	window.onresize=throll(function(){


        if(window.innerWidth <= 900) {

        	$(".onlyShowIcon").removeClass("onlyShowIcon");
			$(".btn-mobile-sidenav").css({
					"left":"230px"
			})
        }
    },300);

	$(".btn-mobile-sidenav  ").on("click", function() {
		if(window.innerWidth <= 900) {
			if($(".btn-mobile-sidenav .nav-bar ").hasClass("nav-bar-animate")) {
				$(".btn-mobile-sidenav .nav-bar ").removeClass("nav-bar-animate");
				$(".contianer_leftMenu").removeClass("contianer_leftMenu_animate")
			} else {
				$(".btn-mobile-sidenav .nav-bar ").addClass("nav-bar-animate");
				$(".contianer_leftMenu").addClass("contianer_leftMenu_animate")
			}
		} else {
			$(".show").removeClass('show');
			$(".open").removeClass('open');
			$(".btn-mobile-sidenav").addClass("nav-bar-click");
			setTimeout(function() {
				$(".btn-mobile-sidenav").removeClass("nav-bar-click");
			}, 1500);
			if($(".contianer_leftMenu").hasClass("onlyShowIcon")) {
				$(".contianer_leftMenu").removeClass("onlyShowIcon");
				$(".btn-mobile-sidenav").css({
					"left":"230px"
				})
			} else {
				$(".contianer_leftMenu").addClass("onlyShowIcon");
				$(".btn-mobile-sidenav").css({
					"left":"50px"
				})
			}
		}

	});
	$(".btn-mobile-sidenav2 .nav-bar").on("click", function() {
		if($(".application_wrap").hasClass("showApplication")) {
			$(".application_wrap").removeClass("showApplication")
		} else {
			$(".application_wrap").addClass("showApplication")
		}
	})
	$(".hasSubMenu").on("click", function() {
		if(!$(".contianer_leftMenu").hasClass("onlyShowIcon")) {
			if($(this).hasClass("open")) {
				$(this).removeClass("open active");
				$("." + $(this).attr("open-url")).removeClass("show");
				
			} else {
				
				$(this).addClass("open active");
				$("." + $(this).attr("open-url")).addClass("show");
			}
		} 
	});
	var timeHideshow2;
	
	$(".hasSubMenu").on("mouseover",function(){
		clearTimeout(timeHideshow2);
		$(".show2").removeClass('show2')
		if($(".contianer_leftMenu").hasClass("onlyShowIcon")) {
			$(this).removeClass(" active");
			$("." + $(this).attr("open-url")).addClass("show2");
		}
	}).on('mouseout',function(){
		if($(".contianer_leftMenu").hasClass("onlyShowIcon")) {
			var thisELe=$(this);
			timeHideshow2=setTimeout(function(){
				thisELe.removeClass(" active");
				$("." + thisELe.attr("open-url")).removeClass("show2");
			},300);
		}
	})
	$(".sub-menu").on("mouseover",function(){
		if($(".contianer_leftMenu").hasClass("onlyShowIcon")) {
			$(this).addClass("show2");
			clearTimeout(timeHideshow2);	
		}
	}).on("mouseout",function(){
		if($(".contianer_leftMenu").hasClass("onlyShowIcon")) {
			var thisELe=$(this);
			$(this).addClass("show2");
			timeHideshow2=setTimeout(function(){
				thisELe.removeClass("show2");
			},300);
			
		}
	})
	$(".header-menu-item img,.header-menu-item2 img").on('click', function(e) {
		e.stopPropagation();
		if($(".header_tips_wrap").css("display") === "none" || $(".header_tips_wrap").css("display") == undefined) {
			$(".header_tips_wrap").show();
		} else {
			$(".header_tips_wrap").hide();
		}
	});
	$(".header_tips_wrap").on('click', function(e) {
		e.stopPropagation();
	})
	$(document).on("click", function() {
		$(".header_tips_wrap").hide();
	})
})