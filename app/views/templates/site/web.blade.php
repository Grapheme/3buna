<?
/**
 * TITLE: Разработка сайтов и веб-приложений
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())
<?
$webs = Dic::valuesBySlug('web', function ($query) {
    $query->orderBy('lft', 'ASC');
});
$webs = DicLib::loadGallery($webs, 'gallery');
#Helper::tad($webs);
?>


@section('page_class') web @stop


@section('header_class')@stop


@section('header_content')
    <a href="{{ URL::route('page', 'order') }}" class="btn send">Заказать сайт</a>
    <div class="wrapper"><img src="{{ Config::get('site.theme_path') }}/images/ico-computer.png" class="ico">
        <h1>Разработка веб-сайтов</h1>
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

        @if (count($webs))
            @foreach ($webs as $web)

                <h2>{{ $web->name }}</h2>
                <div class="text">
                    <p>
                        {{ $web->description }}
                    </p>
                </div>
                @if (isset($web->gallery) && is_object($web->gallery) && isset($web->gallery->photos) && is_object($web->gallery->photos) && $web->gallery->photos->count())
                    <div class="photos"><!--
                        @foreach ($web->gallery->photos as $photo)
                        --><a href="{{ $photo->full() }}" title="{{ $photo->title }}" class="unit">
                            <div class="info-wrapper">
                                <div class="support"></div>
                                <div class="info">{{ $photo->title }}</div>
                            </div>
                            <img src="{{ URL::route('image.resize', [$photo->id, 216, 216]) }}"></a><!--
                        @endforeach
                                -->
                        <div class="clrfx"></div>
                    </div>
                @endif
            @endforeach
        @endif

    </div>

@stop


@section('scripts')
@stop