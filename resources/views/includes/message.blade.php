@section('style')
    <link rel="stylesheet" href="{{asset('css/alert.css')}}" />
@endsection

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

@section('message-script')
    @@parent

    <script type="text/javascript" src="{{ asset('asset/js/alert.js') }}"></script>
    <script>
        $(function(){
            var messages_cnt = parseInt("{{ count($errors) }}");
            if(messages_cnt) $("#coverBg").fadeIn('fast');
        });
    </script>
@endsection