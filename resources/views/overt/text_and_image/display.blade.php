<div class="">
    @php
        $position = $position['value'];
        $TOP = 1;
        $RIGHT = 2;
        $BOTTOM = 3;
        $LEFT = 4;
    @endphp

    @if($position == $TOP)
    @if(isset($url))
        <div>
            <img src="{{ $url->url }}" title="{{ $url->name }}" width="100%" />
        </div>
    @endif
    {!! @$text !!}
    @elseif($position == $BOTTOM)
        {!! @$text !!}
        @if(isset($url))
            <div>
                <img src="{{ $url->url }}" title="{{ $url->name }}" width="100%" />
            </div>
        @endif
    @elseif($position == $LEFT)
        <div class="row">
            <div class="col-12">
                @if(isset($url))
                    <div>
                        <img src="{{ $url->url }}" title="{{ $url->name }}" width="100%" />
                    </div>
                @endif
            </div>
            <div class="col-12">
                {!! @$text !!}
            </div>
        </div>
    @elseif($position == $RIGHT)
        <div class="row">
            <div class="col-12">
                {!! @$text !!}
            </div>
            <div class="col-12">
                @if(isset($url))
                    <div>
                        <img src="{{ $url->url }}" title="{{ $url->name }}" width="100%" />
                    </div>
                @endif
            </div>
        </div>
    @endif


</div>