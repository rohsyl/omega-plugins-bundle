@if(isset($url))
<div>
    <img src="{{ $url->url }}" title="{{ $url->name }}" />
</div>
@endif