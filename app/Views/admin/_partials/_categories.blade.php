@if($nodes->count())
    <ul class="list-unstyled">
        @foreach($nodes as $key => $row)
            <li>
                <label>
                    <input type="checkbox"
                           {{ ((in_array($row->id, $checkedNodes)) ? 'checked="checked"' : '') }} name="category_ids[]"
                           value="{{ $row->id or '' }}">
                    {{ $row->global_title or '' }}
                </label>
                @include('admin._partials._categories', ['nodes' => $row->child()->get(), 'checkedNodes' => $checkedNodes])
            </li>
        @endforeach
    </ul>
@endif