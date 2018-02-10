@if ($paginator->hasPages())
    <style>
        .pagination li {
            display: inline-block;
            border-radius: 2px;
            text-align: center;
            vertical-align: top;
            height: 30px;
        }

        .pagination li a {
            color: #444;
            display: inline-block;
            font-size: 1.2rem;
            padding: 0 10px;
            line-height: 30px;
        }

        .pagination li.active a {
            color: #fff;
        }

        .pagination li.active {
            background-color: #ee6e73;
        }

        .pagination li.disabled a {
            cursor: default;
            color: #999;
        }

        .pagination li i {
            font-size: 2rem;
        }

        .pagination li.pages ul li {
            display: inline-block;
            float: none;
        }

        @media only screen and (max-width: 992px) {
            .pagination {
                width: 100%;
            }
            .pagination li.prev,
            .pagination li.next {
                width: 10%;
            }
            .pagination li.pages {
                width: 80%;
                overflow: hidden;
                white-space: nowrap;
            }
            .waves-effect {
                position: relative;
                cursor: pointer;
                display: inline-block;
                overflow: hidden;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                -webkit-tap-highlight-color: transparent;
                vertical-align: middle;
                z-index: 1;
                will-change: opacity, transform;
                transition: all .3s ease-out;
            }
        }
    </style>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><a href="#"><i class="material-icons">navigate_before</i></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="material-icons">navigate_before</i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="#">{{ $page }}</a></li>
                    @else
                        <li class="waves-effect"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="material-icons">navigate_next</i></a></li>
        @else
            <li class="disabled"><a href="#"><i class="material-icons">navigate_next</i></a></li>
        @endif
    </ul>
@endif
