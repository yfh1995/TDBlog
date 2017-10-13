<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', app_name())</title>
    @yield('meta')
    {{--<script src="http://libs.baidu.com/jquery/2.1.1/jquery.min.js"></script>--}}
    <script type="text/javascript" src="{{asset('js/jquery-2.1.0.js')}}" ></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}" ></script>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/popup.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/backend/index.css') }}" />
    @yield('style')
</head>
<body id="body">

    {{--@include('includes.messages')--}}
    @include('backend.includes.header')
    @include('backend.includes.menu')



    <div class="content-wrapper">
        <div class="content-header">
            <h1>
                @yield('content-title')<small>@yield('content-description')</small>
            </h1>
        </div>
        <div class="content">

            @yield('content')

        </div>
    </div>

    <div class="footer">

    </div>

    @yield('before-script')
    <script type="text/javascript" src="{{ asset('js/backend/index.js') }}" ></script>
    <script type="text/javascript" src="{{asset('js/blockUI/jquery_blockUI.js')}}" ></script>
    <script type="text/javascript" src="{{asset('js/popup.js')}}" ></script>
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
            okBtnCallBack:function(e, parObj){
                /*点击确定的回调方法*/
                $.unblockUI();
            }
        });
    @endif

</script>

</html>
