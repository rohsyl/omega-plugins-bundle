@php
$colClass = 'col-sm-' . (12 / $countCol);
@endphp

<div class="row">
    @foreach($componentsView as $v)
        <div class="{{ $colClass }}">
            {!! $v['html'] !!}
        </div>
    @endforeach
</div>
