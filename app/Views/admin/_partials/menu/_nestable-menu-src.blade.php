@if(isset($menuNodes) && $menuNodes->count())
    <ol class="dd-list">
        @foreach($menuNodes as $key => $row)
            <?php
            $dataTitle = $row->title;
            if (!$dataTitle || $dataTitle == '' || trim($dataTitle, '') == '') {
                switch ($row->type) {
                    case 'category':{
                        $category = $row->category;
                        if ($category) {
                            $dataTitle = $category->global_title;
                        }
                    }
                        break;
                    case 'product-category':{
                        $category = $row->productCategory;
                        if ($category) {
                            $dataTitle = $category->global_title;
                        }
                    }
                        break;
                    case 'page':{
                        $post = $row->page;
                        if ($post) {
                            $dataTitle = $post->global_title;
                        }
                    }
                        break;
                    default:{
                        $post = $row->page;
                        if ($post) {
                            $dataTitle = $post->global_title;
                        }
                    }
                        break;
                }
            }
            $dataTitle = htmlentities($dataTitle);
            ?>
            <li class="dd-item dd3-item {{ (($row->related_id > 0 && $row->related_id != '' && $row->related_id != null) ? 'post-item' : '') }}"
                data-type="{{ $row->type or '' }}"
                data-relatedid="{{ $row->related_id or '' }}"
                data-title="{{ $row->title or '' }}"
                data-class="{{ $row->css_class or '' }}"
                data-id="{{ $row->id or '' }}"
                data-customurl="{{ $row->url or '' }}"
                data-iconfont="{{ $row->icon_font or '' }}">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <span class="text pull-left" data-update="title">{{ $dataTitle }}</span>
                    <span class="text pull-right">{{ $row->type or '' }}</span>
                    <a href="#" title="" class="show-item-details">
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="clearfix"></div>
                </div>
                <div class="item-details">
                    <label class="pad-bot-5">
                        <span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>
                        <input type="text" name="title" value="{{ $row->title or '' }}" data-old="">
                    </label>
                    <label class="pad-bot-5 dis-inline-block">
                        <span class="text pad-top-5" data-update="customurl">Url</span>
                        <input type="text" name="customurl" value="{{ $row->url or '' }}" data-old="">
                    </label>
                    <label class="pad-bot-5 dis-inline-block">
                        <span class="text pad-top-5" data-update="iconfont">Icon - font</span>
                        <input type="text" name="iconfont" value="{{ $row->icon_font or '' }}" data-old="">
                    </label>
                    <label class="pad-bot-10">
                        <span class="text pad-top-5 dis-inline-block">CSS class</span>
                        <input type="text" name="class" value="{{ $row->css_class or '' }}" data-old="">
                    </label>
                    <div class="text-right">
                        <a href="#" title="" class="btn red btn-remove btn-sm">Remove</a>
                        <a href="#" title="" class="btn blue btn-cancel btn-sm">Cancel</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                @include('admin._partials.menu._nestable-menu-src', ['menuNodes' => $row->child()->orderBy('position', 'ASC')->get()])
            </li>
        @endforeach
    </ol>
@endif