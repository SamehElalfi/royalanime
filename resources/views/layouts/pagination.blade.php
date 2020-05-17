@if ($paginator->hasPages())
    @if (!($paginator->currentPage() > $paginator->lastPage()))
    <div class=" overflow-auto">
        <nav aria-label="Page navigation overflow-auto">
            <ul class="pagination justify-content-center">

                {{-- Previous Button --}}
                <li class="page-item  {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{$paginator->previousPageUrl()}}" tabindex="-1" rel="nofollow">
                        <i class="fa fa-angle-right"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>

                {{-- Previous 4 Pages --}}
                @for ($i = $paginator->currentPage()-2; $i < $paginator->currentPage(); $i++)
                    @if ($i < 1)
                        @continue
                    @endif
                    <li class="page-item">
                        <a class="page-link" href="?page={{$i}}{{ isset($sortBy) ? '&sortBy='.$sortBy : '' }}{{ isset($sortBy) ? '&order='.$order : '' }}{{ isset($query) ? '&q='.$query : '' }}" rel="nofollow">
                            {{$i}}
                        </a>
                    </li>
                @endfor
                
                {{-- Current Page --}}
                <li class="page-item active">
                    <a class="page-link" rel="nofollow">
                        {{$paginator->currentPage()}}
                    </a>
                </li>
                
                {{-- Next 4 Pages --}}
                @for ($i = $paginator->currentPage()+1; $i < $paginator->currentPage()+3; $i++)
                    @if ($i > $paginator->lastPage())
                        @continue
                    @endif
                    <li class="page-item">
                        <a class="page-link" href="?page={{ $i }}{{ isset($sortBy) ? '&sortBy='.$sortBy : '' }}{{ isset($sortBy) ? '&order='.$order : '' }}{{ isset($query) ? '&q='.$query : '' }}" rel="nofollow">
                            {{$i}}
                        </a>
                    </li>
                @endfor
                
                {{-- Next Button --}}
                <li class="page-item {{ $paginator->currentPage() >= $paginator->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{$paginator->nextPageUrl()}}" rel="nofollow">
                        <i class="fa fa-angle-left"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    @endif
@endif