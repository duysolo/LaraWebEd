Custom fields
=============

This guide show you how to create custom fields (for page, post, product, categories, product categories...)

----------

####Register custom fields:
--------
[How to create custom fields in LaraWebEd](https://www.youtube.com/watch?v=8ku2yaByYMI)

####Access custom fields:
--------

You can access the custom fields from both controllers and views via:

#####Front controllers:
In the front controller of Page, Post, Category, Product, Product Category, you have the method **_defaultItem()** and **other page template methods**. You can access all the custom fields of these items by:

````code
$this->dis['currentObjectCustomFields']
````

#####Front views:

````code
$currentObjectCustomFields
````

####The helpers for custom fields

- Get field: get a field value by field name: **_getField**

````code
$field_name = '42_title';
$title = _getField($currentObjectCustomFields, $field_name);
````

- Get repeater field: get a repeater by field name: **_getRepeaterField**

````code
@foreach(_getRepeaterField(_getField($currentObjectCustomFields, '1_slider')) as $key => $row)
    <div class="swiper-slide">
        <a href="{{ _getSubField($row, '3_url') }}" title="{{ _getSubField($row, '2_title') }}">
            <img src="{{ _getSubField($row, '4_image') }}" alt="{{ _getSubField($row, '2_title') }}">
        </a>
    </div>
@endforeach
````