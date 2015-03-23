<?
/**
 * TITLE: Простая страница
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())


@section('page_class')common @stop


@section('header_class')@stop


@section('style')
@stop


@section('header_content')
    <div class="wrapper">
        <h1>{{ (isset($page->seo) && is_object($page->seo) && $page->seo->h1 != '') ? $page->seo->h1 : $page->name }}</h1>
    </div>
@stop


@section('content')

    <div class="decals"></div>
    <div class="content-wrapper">

        @if (count($page->blocks))
            @foreach ($page->blocks as $block_slug => $block)

                {{ $page->block($block_slug, 'name') ? '<h2>' . $page->block($block_slug, 'name') . '</h2>' : '' }}

                {{ $page->block($block_slug) }}

            @endforeach
        @endif

    </div>

@stop


@section('scripts')
@stop