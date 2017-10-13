
// 复选框全选/全不选
$(".checkbox-father").click(function(){
    if(this.checked){
        $(".checkbox-son").prop("checked", true);
    }else{
        $(".checkbox-son").prop("checked", false);
    }
});

// 子复选框影响复选框
$(".checkbox-son").click(function(){
    var total = $('.checkbox-son').size();
    var num = $('input[name="id"]:checked').size();
    if(num == total) $('.checkbox-father').prop("checked",true);
    if(num == 0) $('.checkbox-father').prop("checked",false);
});

// 刷新页面
$(".btn-grid-refresh").click(function(){
    window.location.reload();
});