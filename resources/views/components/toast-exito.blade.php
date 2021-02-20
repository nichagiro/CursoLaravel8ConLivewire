<div>
    @if (session('status'))
        <div class="w-full bg-{{$color}}-500 text-center text-white">
            <b>{{session('status')}}</b>
        </div>
    @endif
</div>