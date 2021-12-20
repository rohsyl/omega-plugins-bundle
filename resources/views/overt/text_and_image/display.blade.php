<div class="">
    {!! @$text !!}
    @if(isset($url))
        <div>
            <img src="{{ $url->url }}" title="{{ $url->name }}" width="100%" />
        </div>
    @endif
</div>