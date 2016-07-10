@if(isset($categories) && $categories->count() > 0)
    <ul class="list-item">
        @foreach($categories as $key => $row)
            <li>
                <a href="#" data-title="{{ $row->global_title or '' }}" data-relatedid="{{ $row->id or '' }}" data-type="{{ $type or 'category' }}">{{ $row->global_title or '' }}</a>
                @include('admin._partials.menu._categories-select-src', ['categories' => $row->child()->where('status', '=', 1)->get(), 'type' => $type])
            </li>
        @endforeach
    </ul>
@endif