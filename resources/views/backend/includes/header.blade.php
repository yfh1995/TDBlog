@section('style')
    @@parent

    <link rel="stylesheet" href="{{asset('css/index.css')}}" />
@endsection

<div class="header">
    <a href="#" class="logo">
        <span class="logo-min"><b>{{substr(multilingual('backend.global.title'),0,2)}}</b></span>
        <span class="logo-lg"><b>{{multilingual('backend.global.title')}}</b></span>
    </a>
    <div class="nav">
        <a href="javascript:;" class="sidebar-toggle"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
        <div class="navbar-menu">
            <div class="dropdown">
                <a href="" class="dropdown-toggle">
                    <img src="{{user()->avatar}}" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{user()->name}}</span>
                </a>
            </div>
            <ul class="dropdown-menu">
                <li class="user-header">
                    <img src="{{user()->avatar}}" class="img-circle" alt="User Image">
                    <p>
                        {{user()->name}}
                        <span class="small">Member since {{user()->name}} </span>
                    </p>
                </li>
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="{{url('/admin/auth/setting')}}" class="btn btn-default btn-flat">{{multilingual('backend.header.set')}}</a>
                    </div>
                    <div class="pull-right">
                        <a href="{{url('/admin/auth/logout')}}" class="btn btn-default btn-flat">{{multilingual('backend.header.logout')}}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

@section('after-scrip')
    <script type="text/javascript" src="{{asset('js/index.js')}}" ></script>
@endsection
