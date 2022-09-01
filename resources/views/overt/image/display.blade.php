@if(isset($url))
<div>
    <img src="{{ $url->url }}" title="{{ $url->name }}" @if(isset($width)) width="{{ $width }}" @endif @if(isset($height)) height="{{ $height }}" @endif />
</div>
@endif