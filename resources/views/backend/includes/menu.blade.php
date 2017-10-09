<div class="main-sidebar">
    <div class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ user()->avatar }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ multilingual('backend.menu.online') }}</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">{{ multilingual('backend.menu.menu') }}</li>

            @foreach($menu as $v)

                @include('backend.includes.menu_structure',['menu'=>$v,'permissions'=>$permissions])

            @endforeach

        </ul>
    </div>
</div>