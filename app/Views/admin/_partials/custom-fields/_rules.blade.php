@if(isset($rules) && $rules)
    @foreach($rules as $key => $row)
        <div class="line-group and-group" data-text="" data-rel="and">
            @foreach($row->field_options as $keyOptions => $rowOptions)
                <div class="line rule-line rule-and">
                    <select name="" class="form-control pull-left rule-a" id="">
                        <optgroup label="Basic">
                            <option value="user_type" {{ (($rowOptions->rel_name == 'user_type') ? 'selected="selected"' : '') }}>
                                Logged in User Type
                            </option>
                        </optgroup>
                        <optgroup label="Page">
                            <option value="page_id" {{ (($rowOptions->rel_name == 'page_id') ? 'selected="selected"' : '') }}>
                                Page
                            </option>
                            <option value="page_template" {{ (($rowOptions->rel_name == 'page_template') ? 'selected="selected"' : '') }}>
                                Page Template
                            </option>
                        </optgroup>
                        <optgroup label="Post">
                            <option value="post_template" {{ (($rowOptions->rel_name == 'post_template') ? 'selected="selected"' : '') }}>
                                Post Template
                            </option>
                            <option value="category_id" {{ (($rowOptions->rel_name == 'category_id') ? 'selected="selected"' : '') }}>
                                Category
                            </option>
                            <option value="category_template" {{ (($rowOptions->rel_name == 'category_template') ? 'selected="selected"' : '') }}>
                                Category Template
                            </option>
                            <option value="post_with_related_category_id" {{ (($rowOptions->rel_name == 'post_with_related_category_id') ? 'selected="selected"' : '') }}>
                                Post with related category
                            </option>
                        </optgroup>
                        <optgroup label="Product">
                            <option value="product_template" {{ (($rowOptions->rel_name == 'product_template') ? 'selected="selected"' : '') }}>
                                Product Template
                            </option>
                            <option value="product_category_id" {{ (($rowOptions->rel_name == 'product_category_id') ? 'selected="selected"' : '') }}>
                                Product Category
                            </option>
                            <option value="product_category_template" {{ (($rowOptions->rel_name == 'product_category_template') ? 'selected="selected"' : '') }}>
                                Product Category Template
                            </option>
                            <option value="product_with_related_product_category_id" {{ (($rowOptions->rel_name == 'product_with_related_product_category_id') ? 'selected="selected"' : '') }}>
                                Product with related category
                            </option>
                        </optgroup>
                        <optgroup label="Other">
                            <option value="scf_user" {{ (($rowOptions->rel_name == 'scf_user') ? 'selected="selected"' : '') }}>
                                User
                            </option>
                            <option value="model_name" {{ (($rowOptions->rel_name == 'model_name') ? 'selected="selected"' : '') }}>
                                Model name
                            </option>
                        </optgroup>
                    </select>
                    <select name="" class="form-control pull-left rule-type" id="">
                        <option value="==" {{ (($rowOptions->rel_type == '==') ? 'selected="selected"' : '') }}>is equal to</option>
                        <option value="!=" {{ (($rowOptions->rel_type == '!=') ? 'selected="selected"' : '') }}>is not equal to</option>
                    </select>
                    <div class="rules-b-group mar-lef-5 pull-left">
                        <select name="" class="form-control rule-b hidden" id="" data-rel="category_id">
                            @include('admin._partials.custom-fields._categories-selectbox', ['categories' => $categories, 'childText' => 0, 'selectedNode' => $rowOptions->rel_value])
                        </select>
                        <select name="" class="form-control rule-b hidden" id=""
                                data-rel="post_with_related_category_id">
                            @include('admin._partials.custom-fields._categories-selectbox', ['categories' => $categories, 'childText' => 0, 'selectedNode' => $rowOptions->rel_value])
                        </select>
                        <select name="" class="form-control rule-b hidden" id="" data-rel="product_category_id">
                            @include('admin._partials.custom-fields._categories-selectbox', ['categories' => $productCategories, 'childText' => 0, 'selectedNode' => $rowOptions->rel_value])
                        </select>
                        <select name="" class="form-control rule-b hidden" id=""
                                data-rel="product_with_related_product_category_id">
                            @include('admin._partials.custom-fields._categories-selectbox', ['categories' => $productCategories, 'childText' => 0, 'selectedNode' => $rowOptions->rel_value])
                        </select>
                        <select name="" class="form-control rule-b hidden" id="" data-rel="user_type">
                            @if(isset($options['roles'])) @foreach($options['roles'] as $option)
                                <option value="{{ $option->id or '' }}" {{ (($rowOptions->rel_name == 'user_type' && $rowOptions->rel_value == $option->id) ? 'selected="selected"' : '') }}>{{ $option->name or '' }}</option>
                            @endforeach @endif
                        </select>
                        <select name="" class="form-control rule-b hidden" id="" data-rel="page_id">
                            @if(isset($options['pages'])) @foreach($options['pages'] as $option)
                                <option value="{{ $option->id or '' }}" {{ (($rowOptions->rel_name == 'page_id' && $rowOptions->rel_value == $option->id) ? 'selected="selected"' : '') }}>{{ $option->global_title or '' }}</option>
                            @endforeach @endif
                        </select>
                        <select name="" class="form-control rule-b hidden" id="" data-rel="page_template">
                            @if(isset($options['page_templates'])) @foreach($options['page_templates'] as $option)
                                <option value="{{ $option or '' }}" {{ (($rowOptions->rel_name == 'page_template' && $rowOptions->rel_value == $option) ? 'selected="selected"' : '') }}>{{ $option or '' }}</option>
                            @endforeach @endif
                        </select>
                        <select name="" class="form-control rule-b hidden" id="" data-rel="post_template">
                            @if(isset($options['post_templates'])) @foreach($options['post_templates'] as $option)
                                <option value="{{ $option or '' }}" {{ (($rowOptions->rel_name == 'post_template' && $rowOptions->rel_value == $option) ? 'selected="selected"' : '') }}>{{ $option or '' }}</option>
                            @endforeach @endif
                        </select>
                        <select name="" class="form-control rule-b hidden" id="" data-rel="product_template">
                            @if(isset($options['product_templates'])) @foreach($options['product_templates'] as $option)
                                <option value="{{ $option or '' }}" {{ (($rowOptions->rel_name == 'product_template' && $rowOptions->rel_value == $option) ? 'selected="selected"' : '') }}>{{ $option or '' }}</option>
                            @endforeach @endif
                        </select>
                        <select name="" class="form-control rule-b hidden" id="" data-rel="category_template">
                            @if(isset($options['category_templates'])) @foreach($options['category_templates'] as $option)
                                <option value="{{ $option or '' }}" {{ (($rowOptions->rel_name == 'category_template' && $rowOptions->rel_value == $option) ? 'selected="selected"' : '') }}>{{ $option or '' }}</option>
                            @endforeach @endif
                        </select>
                        <select name="" class="form-control rule-b hidden" id="" data-rel="product_category_template">
                            @if(isset($options['product_category_templates'])) @foreach($options['product_category_templates'] as $option)
                                <option value="{{ $option or '' }}" {{ (($rowOptions->rel_name == 'product_category_template' && $rowOptions->rel_value == $option) ? 'selected="selected"' : '') }}>{{ $option or '' }}</option>
                            @endforeach @endif
                        </select>
                        <select name="" class="form-control rule-b hidden" id="" data-rel="scf_user">
                            @if(isset($options['users'])) @foreach($options['users'] as $option)
                                <option value="{{ $option->id or '' }}" {{ (($rowOptions->rel_name == 'scf_user' && $rowOptions->rel_value == $option->id) ? 'selected="selected"' : '') }}>{{ $option->username or '' }}</option>
                            @endforeach @endif
                        </select>
                        <select name="" class="form-control rule-b" id="" data-rel="model_name">
                            @if(isset($options['models'])) @foreach($options['models'] as $option)
                                <option value="{{ $option or '' }}" {{ (($rowOptions->rel_name == 'model_name' && $rowOptions->rel_value == $option) ? 'selected="selected"' : '') }}>{{ $option or '' }}</option>
                            @endforeach @endif
                        </select>
                    </div>
                    <a class="location-add-rule-and location-add-rule btn btn-primary pull-left" href="#">and</a>
                    <a href="#" title="" class="remove-rule-line">-</a>
                    <div class="clearfix"></div>
                </div>
            @endforeach
        </div>
    @endforeach
@else
    <div class="line-group and-group" data-text="" data-rel="and">
        <div class="line rule-line rule-and">
            <select name="" class="form-control pull-left rule-a" id="">
                <optgroup label="Basic">
                    <option value="user_type">
                        Logged in User Type
                    </option>
                </optgroup>
                <optgroup label="Page">
                    <option value="page_id">
                        Page
                    </option>
                    <option value="page_template">
                        Page Template
                    </option>
                </optgroup>
                <optgroup label="Post">
                    <option value="post_template">
                        Post Template
                    </option>
                    <option value="category_id">
                        Category
                    </option>
                    <option value="category_template">
                        Category Template
                    </option>
                    <option value="post_with_related_category_id">
                        Post with related category
                    </option>
                </optgroup>
                <optgroup label="Product">
                    <option value="product_template">
                        Product Template
                    </option>
                    <option value="product_category_id">
                        Product Category
                    </option>
                    <option value="product_category_template">
                        Product Category Template
                    </option>
                    <option value="product_with_related_product_category_id">
                        Product with related category
                    </option>
                </optgroup>
                <optgroup label="Other">
                    <option value="scf_user">
                        User
                    </option>
                    <option value="model_name">
                        Model name
                    </option>
                </optgroup>
            </select>
            <select name="" class="form-control pull-left rule-type" id="">
                <option value="==">is equal to</option>
                <option value="!=">is not equal to</option>
            </select>
            <div class="rules-b-group mar-lef-5 pull-left">
                <select name="" class="form-control rule-b hidden" id="" data-rel="category_id">
                    @include('admin._partials.custom-fields._categories-selectbox', ['categories' => $categories, 'childText' => 0, 'selectedNode' => 0])
                </select>
                <select name="" class="form-control rule-b hidden" id=""
                        data-rel="post_with_related_category_id">
                    @include('admin._partials.custom-fields._categories-selectbox', ['categories' => $categories, 'childText' => 0, 'selectedNode' => 0])
                </select>
                <select name="" class="form-control rule-b hidden" id="" data-rel="product_category_id">
                    @include('admin._partials.custom-fields._categories-selectbox', ['categories' => $productCategories, 'childText' => 0, 'selectedNode' => 0])
                </select>
                <select name="" class="form-control rule-b hidden" id=""
                        data-rel="product_with_related_product_category_id">
                    @include('admin._partials.custom-fields._categories-selectbox', ['categories' => $productCategories, 'childText' => 0, 'selectedNode' => 0])
                </select>
                <select name="" class="form-control rule-b hidden" id="" data-rel="user_type">
                    @if(isset($options['roles'])) @foreach($options['roles'] as $option)
                        <option value="{{ $option->id or '' }}">{{ $option->name or '' }}</option>
                    @endforeach @endif
                </select>
                <select name="" class="form-control rule-b hidden" id="" data-rel="page_id">
                    @if(isset($options['pages'])) @foreach($options['pages'] as $option)
                        <option value="{{ $option->id or '' }}">{{ $option->global_title or '' }}</option>
                    @endforeach @endif
                </select>
                <select name="" class="form-control rule-b hidden" id="" data-rel="page_template">
                    @if(isset($options['page_templates'])) @foreach($options['page_templates'] as $option)
                        <option value="{{ $option or '' }}">{{ $option or '' }}</option>
                    @endforeach @endif
                </select>
                <select name="" class="form-control rule-b hidden" id="" data-rel="post_template">
                    @if(isset($options['post_templates'])) @foreach($options['post_templates'] as $option)
                        <option value="{{ $option or '' }}">{{ $option or '' }}</option>
                    @endforeach @endif
                </select>
                <select name="" class="form-control rule-b hidden" id="" data-rel="product_template">
                    @if(isset($options['product_templates'])) @foreach($options['product_templates'] as $option)
                        <option value="{{ $option or '' }}">{{ $option or '' }}</option>
                    @endforeach @endif
                </select>
                <select name="" class="form-control rule-b hidden" id="" data-rel="category_template">
                    @if(isset($options['category_templates'])) @foreach($options['category_templates'] as $option)
                        <option value="{{ $option or '' }}">{{ $option or '' }}</option>
                    @endforeach @endif
                </select>
                <select name="" class="form-control rule-b hidden" id="" data-rel="product_category_template">
                    @if(isset($options['product_category_templates'])) @foreach($options['product_category_templates'] as $option)
                        <option value="{{ $option or '' }}">{{ $option or '' }}</option>
                    @endforeach @endif
                </select>
                <select name="" class="form-control rule-b hidden" id="" data-rel="scf_user">
                    @if(isset($options['users'])) @foreach($options['users'] as $option)
                        <option value="{{ $option->id or '' }}">{{ $option->username or '' }}</option>
                    @endforeach @endif
                </select>
                <select name="" class="form-control rule-b" id="" data-rel="model_name">
                    @if(isset($options['models'])) @foreach($options['models'] as $option)
                        <option value="{{ $option or '' }}">{{ $option or '' }}</option>
                    @endforeach @endif
                </select>
            </div>
            <a class="location-add-rule-and location-add-rule btn btn-primary pull-left" href="#">and</a>
            <a href="#" title="" class="remove-rule-line">-</a>
            <div class="clearfix"></div>
        </div>
    </div>
@endif