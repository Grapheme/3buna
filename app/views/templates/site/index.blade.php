<?
/**
 * TITLE: Главная страница
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())


@section('page_class')index @stop


@section('style')
@stop


@section('content')

    <div class="decals"></div>
    <div class="teaser">

        {{ $page->block('description') }}

        <br>
        <small>С нашей адресной программой Вы можете ознакомиться <a href="{{ URL::route('page', 'billboards') }}">здесь</a>.</small>

    </div>
    <div class="activities">
        <section class="billboards">
            <div class="holder">
                <div class="title">{{ $page->block('billboards', 'name') }}</div>
                <div class="description">{{ $page->block('billboards') }}</div>
            </div>
            <a href="{{ URL::route('page', 'billboards') }}" class="more">Адресная программа</a>
        </section>
        <section class="advert">
            <div class="holder">
                <div class="title">{{ $page->block('outdoor', 'name') }}</div>
                <div class="description">{{ $page->block('outdoor') }}</div>
            </div>
            <a href="{{ URL::route('page', 'outdoor') }}" class="more">Примеры работ</a>
        </section>
        <section class="imarketing">
            <div class="holder">
                <div class="title">{{ $page->block('internet-marketing', 'name') }}</div>
                <div class="description">{{ $page->block('internet-marketing') }}</div>
            </div>
            <a href="{{ URL::route('page', 'internet-marketing') }}" class="more">Подробнее</a>
        </section>
        <section class="web-sites">
            <div class="holder">
                <div class="title">{{ $page->block('web', 'name') }}</div>
                <div class="description">{{ $page->block('web') }}</div>
            </div>
            <a href="{{ URL::route('page', 'web') }}" class="more">Портфолио</a>
        </section>
        <div class="clrfx"></div>
    </div>
    <div class="content">
        <div class="top"></div>
        <div class="mid">
            <div class="header-small">Коротко о нас</div>

            <h1>{{ isset($page->seo) && is_object($page->seo) && isset($page->seo->h1) && $page->seo->h1 ? $page->seo->h1 : $page->block('h1') }}</h1>

            <div class="info">

                {{ $page->block('info') }}

            </div>

            {{ $page->block('additional') }}

            <div class="small-map"></div>

        </div>
        <div class="bottom"></div>
    </div>

@stop


@section('scripts')
@stop