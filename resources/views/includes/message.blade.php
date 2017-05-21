<div id="coverBg">
    <div id="alertErrorBox" class="animated zoomIn">
        <p id="alertHeader" >信息</p>
        <div class='ErrorLine'></div>
        @if(count($messages))
            @foreach($messages as $message)
                <p class='ErrorTips'>{{ $message }}</p>
            @endforeach
        @else
            <p class='ErrorTips'></p>
        @endif
        <button class=" errorBtnSure">确认</button>
    </div>
</div>

@section('message-script')
    @@parent

    <script type="text/javascript" src="{{ asset('asset/js/alert.js') }}"></script>
    <script>
        $(function(){
            var messages_cnt = parseInt("{{ count($messages) }}");
            if(messages_cnt) $("coverBg").style.display="block";
        });
    </script>
@endsection