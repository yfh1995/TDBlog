@section('style')

    <link rel="stylesheet" href="{{ asset('css/widgets/grid.css') }}" />

@endsection

@section('content')

    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                @if($grid['batchDeleteBtn'] == \App\Grid::OPEN)
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-danger btn-grid-delete">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </div>
                @endif
                <div class="pull-right">
                    <form action="" method="" class="">
                        <input type="text" class="search-input" placeholder="{{ $grid['placeholder'] }}" name="key" value="">
                        <div class="btn-group btn-group-sm">
                            <button type="submit" class="btn btn-primary btn-grid-search">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                            @if($grid['addBtn'] == \App\Grid::OPEN)
                            <a class="btn btn-success btn-grid-add">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                            @endif
                            @if($grid['refreshBtn'] == \App\Grid::OPEN)
                            <a class="btn btn-warning btn-grid-refresh">
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
                                {{ $v['name'] }}
                                @if($v['isSort'] && in_array($v['isSort'],[\App\Grid::SORT_RULE_ACS,\App\Grid::SORT_RULE_DECS,\App\Grid::SORT_RULE_ORIGINAL]))
                                    @if($v['sortRule'] == \App\Grid::SORT_RULE_ACS)
                                        <a>
                                            <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                        </a>
                                    @elseif($v['sortRule'] == \App\Grid::SORT_RULE_DECS)
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
                        <th>{{ multilingual(\App\Grid::OPERATION) }}</th>
                    </tr>

                    @foreach($data as $v)
                        <tr>
                            <td><input type="checkbox" class="checkbox-son" value="{{ $v['id'] }}" name="id" /></td>
                            @foreach($grid['title'] as $val)
                                @if($val['showType'] == \App\Grid::SHOW_TYPE_TEXT)
                                    <td>{{ $v[$val['name']] }}</td>
                                @elseif($val['showType'] == \App\Grid::SHOW_TYPE_LABEL)
                                    <td>
                                        @if(is_array($v[$val['name']]))
                                            @foreach($v[$val['name']] as $role)
                                                <span class='label label-success'>{{ $role }}</span>&nbsp;
                                            @endforeach
                                        @else
                                            <span class='label label-success'>{{ $v[$val['name']] }}</span>&nbsp;
                                        @endif
                                    </td>
                                @endif
                            @endforeach
                            <td>
                                @if($grid['editBtn'] == \App\Grid::OPEN)
                                    <a><span class="glyphicon glyphicon-pencil"></span></a>
                                @endif
                                @if($grid['deleteBtn'] == \App\Grid::OPEN)
                                    <a><span class="glyphicon glyphicon-trash"></span></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="box-footer">
                {{ $data->appends($grid['params'])->links() }}
                <span class="control-label pull-right">
                    总共 <b>{{$data->total()}}</b> 条&nbsp;&nbsp;
                    显示&nbsp;
                    <select class="input-sm grid-per-pager" name="per-page">
                        @foreach($grid['pageSize'] as $v)
                            <option value="{{ url($url,['size'=>$v]) }}">{{ $v }}</option>
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