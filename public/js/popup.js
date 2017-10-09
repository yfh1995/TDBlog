
	var commonPop = {
		
		showTips : function(data){
			var config = {
				title : data.title || "",
				body : data.body || "",
				timeshown : data.time || 0,
                top : data.top || '35%',
                left : data.left || "35%",
                margin : data.margin || 0,
                parentclass : data.parentclass || "",
                zindex : data.zindex || 9999,
                cancelBtn : data.cancelBtn || false,
                cancelBtnText : data.cancelBtnText || "取消",
                okBtnCallBcak : data.okBtnCallBcak || false,
                okBtnText : data.okBtnText || "确定",
                onShow : data.onShow,
                onClose : data.onClose,
                id : data.id || ""
			};
			commonPop._modalDialog(config);
		},
		_modalDialog : function(config){
            var title = config.title;//标题
            var body = config.body; //内容
            var timeshown = config.timeshown?config.timeshown:0;//多少秒后关闭窗口，如果为0 ，则不关闭

            function gettitlehtml(arg_title){
                return "<div class='gb-modaldialog-title'>"+arg_title+"</div>";
            }

            function getbodyhtml(arg_body){
                return "<div class='gb-modaldialog-content'>"+arg_body+"</div>";
            }

            var html = [];
            html.push('<div class="gb-modaldialog '+config.parentclass+'">');

            //如果有设置标题，显示标题的html;
            if(title!=null && title!=""){
                html.push(gettitlehtml(title));
            }

            //获取内容的html
            if(body!=null && body!=""){
                html.push(getbodyhtml(body));
            }

            // 取消和确定按钮
            if (config.cancelBtn && config.okBtnCallBcak) {
                html.push('<div class="gb-modaldialog-btnwrap twobtn">');
            }else{
                html.push('<div class="gb-modaldialog-btnwrap">');
            }
            if (config.okBtnCallBcak) {
                html.push('<em><span id="js-gb-modaldialog-okbtn" class="btnok">' + config.okBtnText + '</span></em>');
            }
            if (config.cancelBtn) {
                html.push('<em><span id="js-gb-modaldialog-cancelbtn" class="btncancel">' + config.cancelBtnText + '</span></em>');
            }
            html.push('</div>');


            // 关闭标签
            html.push('</div>');

            //显示模态窗口
            $.blockUI({
                message:html.join(''),
                css: { 
                     cursor:'default',
                     textAlign:'left',
                     width:'auto',
                     border:0,
                     top:config.top,
                     left:config.left,
                     backgroundColor:'transparent',
                     margin : config.margin
                },
                baseZ:config.zindex,
                overlayCSS:  { 
                    backgroundColor: '#000', 
                    opacity:0.6, 
                    cursor:'default' 
                },
                onBlock : callShow,
            }); 

            //关闭窗口事件
            $("#js-gb-modaldialog-closebtn").click(function(){
                var $parent = $(this).parents(".gb-modaldialog");
                $.unblockUI();
                if (config.onClose) {
                    config.onClose($parent);
                }
            });
            $("#js-gb-modaldialog-cancelbtn").click(function(){
                var $parent = $(this).parents(".gb-modaldialog");
                $.unblockUI();
                if (config.onClose) {
                    config.onClose($parent);
                }
            });

            // 确定按钮事件
            $("#js-gb-modaldialog-okbtn").click(function(e){
                if (config.okBtnCallBcak) {
                	console.log(config.okBtnCallBcak + 'config.okBtnCallBcak');
                    var $parentObj = $(this).parents(".gb-modaldialog");
                    config.okBtnCallBcak(e, $parentObj,$.unblockUI,config.id);
                }
            });

            // 窗体展现后，如果存在config.onShow事件，回掉
            function callShow(){
                var $parent = $("#js-gb-modaldialog-closebtn").parents(".gb-modaldialog");
                if (config.onShow) {
                    config.onShow($parent);
                }
            }

            //判断是否要在多少秒以后，自动关闭窗口
            if(timeshown!=0){
                setTimeout($.unblockUI, timeshown); 
            }
        }
	};
	
