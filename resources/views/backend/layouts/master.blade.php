<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', app_name())</title>
    @yield('meta')
    <script src="http://libs.baidu.com/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('js/blockUI/jquery_blockUI.js')}}" ></script>
    <script type="text/javascript" src="{{asset('js/popup.js')}}" ></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}" ></script>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/popup.css')}}" />
    @yield('style')
</head>
<body>

    {{--@include('includes.messages')--}}
    @include('backend.includes.header')
    @include('backend.includes.menu')

    @yield('content')

    @yield('before-script')
    @yield('after-script')

</body>

<script>

    @if(count($errors))
        var errors = '';

        @foreach($errors->all() as $error)
            errors += "<p>{{ $error }}</p>";
        @endforeach

        commonPop.showTips({
            title:'提示',
            body:errors,
            cancelBtn:true,
            okBtnCallBcak:function(e, parObj){
                /*点击确定的回调方法*/
                $.unblockUI();
            }
        });
    @endif

</script>

</html>
