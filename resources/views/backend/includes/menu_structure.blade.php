@if(isset($menu['children']))

    @if($menu['permission_slug'] == null || isset($permissions[$menu['permission_slug']]))
        @if($menu['parent_id'] == 0)
            <li class="treeview">
        @else
            <li>
        @endif
            <a href="#">
                <span class="glyphicon {{ $menu['icon'] }}"></span>
                @if($menu['parent_id'] == 0)
                    <span class="shrinkhide">{{ $menu['title'] }}</span>
                @else
                    <span>{{ $menu['title'] }}</span>
                @endif
                <span class="pull-right glyphicon glyphicon-menu-left"></span>
            </a>
            <ul class="treeview-menu">

                @foreach($menu['children'] as $v)

                    @include('backend.includes.menu_structure',['menu'=>$v,'permissions'=>$permissions])

                @endforeach

            </ul>
        </li>
    @endif

@else

    @if($menu['permission_slug'] == null || isset($permissions[$menu['permission_slug']]))
        <li>
            <a href="{{ Admin::url($menu['uri']) }}"><span class="glyphicon {{ $menu['icon'] }}"></span>
                @if($menu['parent_id'] == 0)
                    <span class="shrinkhide">{{ $menu['title'] }}</span>
                @else
                    <span>{{ $menu['title'] }}</span>
                @endif
            </a>
        </li>
    @endif

@endif