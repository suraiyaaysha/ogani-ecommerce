{{-- @if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
        <li class="disabled">
            <a href="#" tabindex="-1"><i class="fa fa-long-arrow-left"></i></a>
        </li>
    @else
        <li class=""><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a></li>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="disabled">{{ $element }}</li>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active">
                        <a>{{ $page }}</a>
                    </li>
                @else
                    <li>
                        <a href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-long-arrow-right"></i></a>
        </li>
    @else
        <li class="disabled">
            <a href="#"><i class="fa fa-long-arrow-right"></i></a>
        </li>
    @endif

 @endif --}}



@if ($paginator->hasPages())
    {{-- <ul class="pagination pagination"> --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><a href="#" tabindex="-1"><i class="fa fa-long-arrow-left"></i></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-long-arrow-left"></i></a></li>
        @endif
        @if($paginator->currentPage() > 3)
            <li class="hidden-xs"><a href="{{ $paginator->url(1) }}">1</a></li>
        @endif
        @if($paginator->currentPage() > 4)
            <li><span>...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="active"><a>{{ $i }}</a></li>
                @else
                    <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li><span>...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="hidden-xs"><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-long-arrow-right"></i></a></li>
        @else
            <li class="disabled"><a href="#" tabindex="-1"><i class="fa fa-long-arrow-right"></i></a></li>
        @endif
    {{-- </ul> --}}
@endif
