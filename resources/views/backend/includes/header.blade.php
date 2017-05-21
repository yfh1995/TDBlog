@section('style')
    @@parent

    <link rel="stylesheet" type="text/css" href="{{ asset('css/Backstage.css') }}"/>
@endsection

<div class="header-wrap">
    <p class='header_logo'>{{ app_name() }}</p>

    <div class='header-menu'>
        <div style="clear: both;">

        </div>
        <div class='header-menu-item'>
            <svg id='diaoseban' class="icon header-icon" aria-hidden="true">
                <use xlink:href="#icon-diaoseban"></use>
            </svg>
            <svg id='yingyong' class="icon header-icon" aria-hidden="true">
                <use xlink:href="#icon-yingyong"></use>
            </svg>
            <img src="{{ asset('img/e82ad60f55325b6d414bd23f42b457e1.jpg') }}" alt="" />
            <p class='userName'>admin</p>
        </div>
        <div class='header-menu-item2'>
            <img src="{{ asset('img/e82ad60f55325b6d414bd23f42b457e1.jpg') }}" alt="" />
        </div>

    </div>
</div>
<div class='header_tips_wrap'>
    <!--<div class='header_img'>
        <img src="img/e82ad60f55325b6d414bd23f42b457e1.jpg" alt="" />
    </div>-->
    <div class='header_img'>
        <img src="{{ asset('img/e82ad60f55325b6d414bd23f42b457e1.jpg') }}" alt="" />
        <div class='useInfo'>
            <p class='userName'>admin</p>
            <p class='userState'><span class='circle circle_success'></span>在线</p>
        </div>
    </div>
    <div class='header_tips_content'>
        <div class="user_info">身高：</div>
        <div class="user_info">666CM</div>
        <div class="user_info">身高：</div>
        <div class="user_info">666CM</div>
        <div class="user_info">身高：</div>
        <div class="user_info">666CM</div>
        <div class="user_info">身高：</div>
        <div class="user_info">666CM</div>
    </div>
    <div class='header_footer'>
        <div class="user_application"><button>按钮1</button></div>
        <div class="user_application"><button>按钮2</button></div>
        <div class="user_application"><button>按钮3</button></div>
        <div class="user_application"><button>按钮4</button></div>
    </div>
</div>
<div class="btn-mobile-sidenav2">
    <div class='nav-bar'>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<div class='application_wrap'>
    <ul>
        <li>调色板</li>
        <li>功能1</li>
        <li>功能2</li>
        <li>功能3</li>
        <li>功能4</li>
    </ul>
</div>

@section('after-scrip')
<script type="text/javascript" src="{{ asset('js/iconfont.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/Backstage.js') }}"></script>
@endsection