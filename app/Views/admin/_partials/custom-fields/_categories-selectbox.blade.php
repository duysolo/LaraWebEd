<?php
$child = '';
for ($i = 0; $i < $childText; $i++) {
    $child .= '——';
}
?>
@foreach($categories as $key => $row)
    <option value="{{ $row->id or '' }}" {{ (($row->id == (int) $selectedNode) ? ' selected="selected"' : '') }}>{{ $child . $row->global_title }}</option>
    @include('admin._partials.custom-fields._categories-selectbox', ['categories' => $row->child()->get(), 'childText' => ($childText + 1), 'selectedNode' => $selectedNode])
@endforeach