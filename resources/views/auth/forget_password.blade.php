<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>重置密码- TDBlog账号</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="{{asset('css/reset.css')}}"/>
</head>
<body>
<section class='content'>
    <h1 class="title">TDBlogs</h1>

    <form id='resetPas_form' action="" method="post" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div id='resetPas_Accout' class='form_item'>
            <input type="text" name="email" placeholder="你的工作邮箱" required/>
            <svg  class="icon" aria-hidden="true">
                <use xlink:href="#icon-x"></use>
            </svg>
        </div>
        <div id='error' class='form_item'>
            <span class='inputErrorTips'>你填写的邮箱格式有问题</span>
        </div>

        <div id='reset_btn' class='form_item'>
            <input type="submit" value="" />
            <span>重置密码</span>
            <svg id='rightArrowBtn'  class="icon" aria-hidden="true" >
                <use xlink:href="#icon-jiantouyou"></use>
            </svg>
        </div>
        <div id='signUp' class='form_item'>
            <span>如无法通过手机或邮箱找回请发送邮件至690828339@qq.com 寻求帮助</span>
        </div>


    </form>
</section>

<!--通用-->
<script type="text/javascript" src='{{asset('js/jquery-2.1.0.js')}}'></script>
<script type="text/javascript" src='{{asset('js/iconfont.js')}}'></script>
<script type="text/javascript" src='{{asset('js/common.js')}}'></script>

<!--不通用-->
<script src='{{asset('js/reset.js')}}'></script>
</body>
</html>
