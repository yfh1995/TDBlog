@section('style')

    <link rel="stylesheet" href="{{ asset('css/widgets/grid.css') }}" />

@endsection

@section('content')

    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                @if($grid['batchDeleteBtn'] == \App\Widgets\Grid::OPEN)
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-danger btn-grid-delete">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </div>
                @endif
                <div class="pull-right">
                    <form action="{{$grid['searchUrl']}}" method="GET" class="">
                        <input type="text" class="search-input" placeholder="{{ $grid['placeholder'] }}" name="key" value="{{ $grid['params']['key'] }}">
                        @foreach($grid['params'] as $k=>$v)
                            <input type="text" class="hidden" name="{{ $k }}" value="{{ $v }}">
                        @endforeach
                        <div class="btn-group btn-group-sm">
                            <button type="submit" class="btn btn-primary btn-grid-search">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                            @if($grid['addBtn'] == \App\Widgets\Grid::OPEN)
                            <a class="btn btn-success btn-grid-add" href="{{ $grid['addUrl'] }}">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                            @endif
                            @if($grid['refreshBtn'] == \App\Widgets\Grid::OPEN)
                            <a class="btn btn-warning btn-grid-refresh" href="{{ $grid['refreshUrl'] }}">
                                <span class="glyphicon glyphicon-refresh"></span>
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover table-list">
                    <tr>
                        <th><input type="checkbox" class="checkbox-father" /></th>
                        @foreach($grid['title'] as $v)
                            <th>
                                {{ $v['showName'] }}
                                @if($v['isSort'] && in_array($v['isSort'],[\App\Widgets\Row::SORT_RULE_ACS,\App\Widgets\Row::SORT_RULE_DECS,\App\Widgets\Row::SORT_RULE_ORIGINAL]))
                                    @if($v['sortRule'] == \App\Widgets\Row::SORT_RULE_ACS)
                                        <a>
                                            <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                        </a>
                                    @elseif($v['sortRule'] == \App\Widgets\Row::SORT_RULE_DECS)
                                        <a>
                                            <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                        </a>
                                    @else
                                        <a>
                                            <span class="glyphicon glyphicon-sort"></span>
                                        </a>
                                    @endif
                                @endif
                            </th>
                        @endforeach
                        <th>{{ multilingual(\App\Widgets\Grid::OPERATION) }}</th>
                    </tr>

                    @foreach($grid['data'] as $v)
                        <tr>
                            <td><input type="checkbox" class="checkbox-son" value="{{ $v->id }}" name="id" /></td>
                            @foreach($grid['title'] as $val)
                                @if($val['fieldShowType'] == \App\Widgets\Row::FIELD_SHOW_TYPE_TEXT)
                                    <td>{{ $v->$val['fieldName'] }}</td>
                                @elseif($val['fieldShowType'] == \App\Widgets\Row::FIELD_SHOW_TYPE_LABEL)
                                    <td>
                                        @if(is_array($v->$val['fieldName']))
                                            @foreach($v->$val['fieldName'] as $role)
                                                <span class='label label-success'>{{ $role }}</span>&nbsp;
                                            @endforeach
                                        @else
                                            <span class='label label-success'>{{ $v->$val['fieldName'] }}</span>&nbsp;
                                        @endif
                                    </td>
                                @endif
                            @endforeach
                            <td>
                                @if($grid['editBtn'] == \App\Widgets\Grid::OPEN)
                                    <a><span class="glyphicon glyphicon-pencil"></span></a>
                                @endif
                                @if($grid['deleteBtn'] == \App\Widgets\Grid::OPEN)
                                    <a><span class="glyphicon glyphicon-trash"></span></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="box-footer">
                {{ $grid['data']->appends($grid['params'])->links() }}
                <span class="control-label pull-right">
                    总共 <b>{{$grid['data']->total()}}</b> 条&nbsp;&nbsp;
                    显示&nbsp;
                    <select class="input-sm grid-per-pager" name="per-page">
                        @foreach($grid['pageSize'] as $v)
                            <option value="{{ url($grid['searchUrl'],['size'=>$v]) }}">{{ $v }}</option>
                        @endforeach
                    </select>
                    &nbsp;条
                </span>
            </div>
        </div>
    </div>

    <div class="hidden grid-hidden">
        <form class="grid-form-delete" action="" method=""></form>
    </div>

@endsection

@section('after-script')

    <script type="text/javascript" src="{{ asset('js/widgets/grid.js') }}" ></script>
    <script>

        // 批量删除
        $(".btn-grid-delete").click(function(){
            var html = '';
            $('input[name="id"]:checked').each(function(){
                html += '<input type="text" name="id" value="' + $(this).val() + '">';
            });

            if(html == ''){
                commonPop.showTips({
                    title:'提示',
                    body:'未选择删除项',
                    cancelBtn:false,
                    okBtnCallBack:function(e, parObj){
                        /*点击确定的回调方法*/
                        $.unblockUI();
                    }
                });
                return;
            }

            $('.grid-form-delete').empty().append(html);
            $('.grid-form-delete').submit();
        });
    </script>

@endsection