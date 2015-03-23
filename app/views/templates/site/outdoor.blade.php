<?
/**
 * TITLE: Изготовление наружной рекламы
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())
<?
$outdoors = Dic::valuesBySlug('outdoor', function ($query) {
    $query->orderBy('lft', 'ASC');
});
$outdoors = DicLib::loadGallery($outdoors, 'gallery');
#Helper::tad($outdoors);
?>


@section('page_class') billboards_design @stop


@section('header_class')@stop


@section('header_content')
    <a href="{{ URL::route('page', ['order', 'type' => 'outdoor']) }}" class="btn send">Заказать изготовление</a>
    <div class="wrapper"><img src="{{ Config::get('site.theme_path') }}/images/ico-billboards_design.png" class="ico">
        <h1>Изготовление <br>наружной рекламы</h1>
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

        @if (count($outdoors))
            @foreach ($outdoors as $outdoor)

                <h2>{{ $outdoor->name }}</h2>
                <div class="text">
                    <p>
                        {{ $outdoor->description }}
                    </p>
                </div>
                @if (isset($outdoor->gallery) && is_object($outdoor->gallery) && isset($outdoor->gallery->photos) && is_object($outdoor->gallery->photos) && $outdoor->gallery->photos->count())
                    <div class="photos"><!--
                        @foreach ($outdoor->gallery->photos as $photo)
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