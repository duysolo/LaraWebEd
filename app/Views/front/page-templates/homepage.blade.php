@extends('front._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
    @include('front/_shared/_sidebar-left')
    <section class="main-content full-container">
        <div class="intro">
            {!! $object->content !!}
        </div>
        <?php
        $sections = (_getField($currentObjectCustomFields, '8_sections')) ? $currentObjectCustomFields['8_sections'] : '';
        $sections = _getRepeaterField($sections);
        ?>
        @foreach($sections as $key => $row)
        <div class="full-background section-{{ $key + 1 }}" style="background-color: {{ _getSubField($row, '9_background_color') }};">
            <div class="row">
                <div class="col-lg-6 text-field">
                    {!! _getSubField($row, '10_section_content') !!}
                </div>
                <div class="col-lg-6 image-field">
                    <img src="{{ _getSubField($row, '11_section_image') }}" alt="LaraWebEd" class="img-responsive middle-auto">
                </div>
            </div>
        </div>
        @endforeach
    </section>
@endsection
