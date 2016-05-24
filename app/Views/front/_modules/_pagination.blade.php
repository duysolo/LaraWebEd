<?php
// config
$link_limit = 7; // maximum number of links
$queryStringArray = \Request::only([]);
$paginator->appends($queryStringArray);
?>

@if ($paginator->lastPage() > 1)
<div class="clearfix pager-wrapper">
    <ul class="pagination">
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }} go-first">
            <a href="{{ $paginator->url(1) }}" class="arrow">&laquo;</a>
        </li>
        <li class="{{ (!$paginator->previousPageUrl()) ? ' disabled' : '' }} previous">
            <a href="{{ $paginator->previousPageUrl() }}" class="arrow">&lsaquo;</a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <?php
        $half_total_links = floor($link_limit / 2);
        $from = $paginator->currentPage() - $half_total_links;
        $to = $paginator->currentPage() + $half_total_links;
        if ($paginator->currentPage() < $half_total_links) {
            $to += $half_total_links - $paginator->currentPage();
        }
        if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
            $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
        }
        ?>
        @if ($from < $i && $i < $to)
            <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endif
        @endfor
        <li class="{{ (!$paginator->nextPageUrl()) ? ' disabled' : '' }} next">
            <a href="{{ $paginator->nextPageUrl() }}" class="arrow">&rsaquo;</a>
        </li>
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }} go-last">
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="arrow">&raquo;</a>
        </li>
    </ul>
    <span class="pull-right page-label">{{ trans('cms.page') }} {{ $paginator->currentPage().'/'.$paginator->lastPage() }}</span>
</div>
@endif
