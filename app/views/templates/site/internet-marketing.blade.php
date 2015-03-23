<?
/**
 * TITLE: Интернет-маркетинг
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())


@section('page_class') imarketing @stop


@section('header_class')@stop


@section('header_content')
    <a href="{{ URL::route('page', ['order', 'type' => 'marketing']) }}" class="btn send">Заказать разработку</a>
    <div class="wrapper"><img src="{{ Config::get('site.theme_path') }}/images/ico-imarketing.png" class="ico">
        <h1>Интернет - маркетинг</h1>
    </div>
@stop


@section('style')
@stop


@section('content')

    <div class="decals"></div>
    <div class="teaser">

        {{ $page->block('description') }}

    </div>
    <div class="content-wrapper">
        <div class="text">

            {{ $page->block('content') }}

            <a href="{{ URL::route('page', ['order', 'type' => 'marketing']) }}" class="btn">Заказать разработку</a>

        </div>
    </div>

@stop


@section('scripts')
@stop