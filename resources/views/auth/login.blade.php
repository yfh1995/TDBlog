<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登陆- TDBlog账号</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/alert.css')}}" />
</head>
<body>
<section class='content'>
    <h1 class="title">TDBlogs</h1>
    <form id='login_form' action="" method="post" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div id='login_Account' class='form_item'>
            <input type="text" placeholder="邮箱" name="email" required/>
            <svg  class="icon" aria-hidden="true">
                <use xlink:href="#icon-x"></use>
            </svg>
        </div>
        <div id='login_password' class='form_item'>
            <input type="password" placeholder="密码" name="password" required/>
            <svg  class="icon" aria-hidden="true">
                <use xlink:href="#icon-x"></use>
            </svg>
            <svg id='lookPasword'  class="icon" aria-hidden="true" >
                <use xlink:href="#icon-yanjing"></use>
            </svg>
        </div>
        <div id='tips' class='form_item'>
            <span class='forgotPas'>忘记密码？</span>

        </div>
        <div id='error' class='form_item'>
            <span class='inputErrorTips'>你填写的邮箱格式有问题</span>
        </div>
        <div id='login_btn' class='form_item'>
            <input type="submit" value="" />
            <span>登录</span>
            <svg id='rightArrowBtn'  class="icon" aria-hidden="true" >
                <use xlink:href="#icon-jiantouyou"></use>
            </svg>
        </div>
        <div id='signUp' class='form_item'>
            <span>还没有账号?&nbsp;<a href="{{ url('register') }}">注册新账号</a></span>
        </div>


    </form>
</section>
<div id="coverBg">
    <div id="alertErrorBox" class="animated zoomIn">
        <p id="alertHeader" >信息</p>
        <div class='ErrorLine'></div>
        @if(count($errors))
            @foreach($errors->all() as $error)
                <p class='ErrorTips'>{{ $error }}</p>
            @endforeach
        @endif
        <button class=" errorBtnSure">确认</button>
    </div>
</div>
<!--通用-->
<script type="text/javascript" src='{{asset('js/jquery-2.1.0.js')}}'></script>
<script type="text/javascript" src='{{asset('js/iconfont.js')}}'></script>
<script type="text/javascript" src='{{asset('js/common.js')}}'></script>

<!--不通用-->
<script src='{{asset('js/login.js')}}'></script>
<script type="text/javascript" src="{{ asset('js/alert.js') }}"></script>
<script>
    $(function(){
        var messages_cnt = parseInt("{{ count($errors) }}");
        if(messages_cnt) $("#coverBg").fadeIn('fast');
    });
</script>
</body>
</html>
