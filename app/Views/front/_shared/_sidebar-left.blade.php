@if($showSidebar)
    <section class="main-left">
        <aside>
            <ul class="list-unstyled">
                @foreach($sidebarCategories as $key => $row)
                <li>
                    <span class="h4">{{ $row->title }}</span>
                    <ul class="list-unstyled">
                        @if($row->relatedPosts) @foreach($row->relatedPosts as $keyPost => $rowPost)
                        <li><a href="{{ _getPostLink($currentLanguageCode, $rowPost) }}" title="{{ $rowPost->title }}">{{ $rowPost->title }}</a></li>
                        @endforeach @endif
                    </ul>
                </li>
                @endforeach
            </ul>
        </aside>
    </section>
@endif