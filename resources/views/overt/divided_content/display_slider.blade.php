<div id="carousel-{{ $id }}" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
    @foreach($componentsView as $i => $v)
        <div class="carousel-item @if($i == 0) active @endif">
            {!! $v['html'] !!}
        </div>
    @endforeach
    </div>
</div>
