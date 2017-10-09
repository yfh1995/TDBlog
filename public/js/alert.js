var reloadFlag = false;

function showAlert(str, IsReload) {
	document.getElementById("coverBg").style.display = 'block';
	var that = document.getElementsByClassName("ErrorLine")[0];
	for(var i = 0; i < str.length; i++) {
		var p = document.createElement("p");
		p.className = "ErrorTips";
		p.innerHTML = str[i];
		$(".ErrorLine").before(p);
	}
	reloadFlag = IsReload;
}
document.getElementById("")

function IsReload() {
	document.getElementById("coverBg").style.display = 'none';
	if(reloadFlag == true) {
		window.location.reload();
		
	}
}
document.getElementsByClassName("errorBtnSure")[0].addEventListener('click', function() {
	IsReload();
});
document.getElementById("coverBg").addEventListener('click', function() {
	IsReload();
})
document.getElementById("alertErrorBox").addEventListener('click', function(e) {
	e.stopPropagation();
})

/**
 * 创建可拖拽对象的工厂方法
 */
function createDraggableObject() {
	return {
		obj: null,
		left: 0,
		top: 0,
		oldX: 0,
		oldY: 0,
		isMouseLeftButtonDown: false,
		init: function(obj) {
			this.obj = obj;
			var that = this;
			this.obj.onmousedown = function(args) {
				var evt = args || event;
				this.style.zIndex = 100;
				that.isMouseLeftButtonDown = true;
				that.oldX = evt.clientX;
				that.oldY = evt.clientY;
				if(this.currentStyle) {
					that.left = parseInt(this.parentNode.currentStyle.left);
					that.top = parseInt(this.parentNode.currentStyle.top);
				} else {
					var divStyle = document.defaultView.getComputedStyle(this.parentNode, null);
					that.left = parseInt(divStyle.left);
					that.top = parseInt(divStyle.top);
				}
			};
			this.obj.onmousemove = function(args) {
				that.move(args || event);
			};
			this.obj.onmouseup = function() {
				that.isMouseLeftButtonDown = false;
				this.style.zIndex = 0;
			};
		},
		move: function(evt) {
			if(this.isMouseLeftButtonDown) {
				var dx = parseInt(evt.clientX - this.oldX);
				var dy = parseInt(evt.clientY - this.oldY);
				this.obj.parentNode.style.left = (this.left + dx) + 'px';
				this.obj.parentNode.style.top = (this.top + dy) + 'px';
			}
		}
	};
}
var obj1 = createDraggableObject();

obj1.init(document.getElementById("alertHeader"));