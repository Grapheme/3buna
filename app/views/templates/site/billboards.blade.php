<?
/**
 * TITLE: Размещение на щитах
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())
<?
$areas = Dic::valuesBySlug('areas', function ($query) {
    $query->orderBy('lft', 'ASC');
}, []);
#Helper::tad($areas);
$billboards = Dic::valuesBySlug('billboards', function ($query) {
    $query->orderBy('lft', 'ASC');
});
if (isset($billboards) && count($billboards)) {

    $billboards = DicLib::loadImages($billboards, 'photo');

    $billboards_for_json = [];
    foreach ($billboards as $billboard) {

        $billboard_style = 'green';
        if ($billboard->status == 'reserved' && $billboard->status_limit > date('Y-m-d'))
            $billboard_style = 'yellow';
        elseif ($billboard->status == 'blocked' && $billboard->status_limit > date('Y-m-d'))
            $billboard_style = 'red';

        if (preg_match("~\d{4}\-\d{2}\-\d{2}~is", $billboard->status_limit))
            $carbon = \Carbon\Carbon::createFromFormat('Y-m-d', $billboard->status_limit);
        else
            $carbon = \Carbon\Carbon::now();

        $image = is_object($billboard->photo) ? $billboard->photo->full() : NULL;

        $array = [
            "id" => $billboard->id,
            "position" => [$billboard->lat, $billboard->lng],
            "type" => $billboard_style,
            //"address" => $billboard->address,
            "address" => $billboard->name,
            "price" => (int)$billboard->price,
            "photo" => $image,
        ];
        if ($billboard_style == 'yellow')
            $array["reserved"] = $carbon->format('d.m.Y');
        elseif ($billboard_style == 'red') {
            $array["reserved"] = $carbon->format('d.m.Y');
            $array["available"] = $carbon->diffInDays();
        }

        $billboards_for_json[] = $array;
    }

    $billboards = DicLib::groupByField($billboards, 'area_id');
}
#Helper::tad($billboards);

?>


@section('page_class') billboards @stop


@section('header_class') billboards @stop


@section('header_content')
    <!--<a href="{{ URL::route('page', 'order-billboard') }}" class="btn send">Отправить заказ</a>-->
    <div class="wrapper"><img src="{{ Config::get('site.theme_path') }}/images/ico-billboards.png" class="ico">
        <h1>Размещение на щитах</h1>
    </div>
@stop


@section('style')
@stop


@section('content')

    <div class="decals"></div>
    <div class="teaser">

        {{ $page->block('description') }}

    </div>
    <div class="tabs-btn">
        <a href="" class="list-view active tab-btn">Списком</a>
        <a href="" class="map-view tab-btn">На карте</a>
        <span class="selected"><span class="count"></span> на сумму <span class="numbers"></span></span>
        <a href="{{ URL::route('page', 'order-billboard') }}" class="btn send">Отправить заказ</a>
    </div>
    <div class="tabs">
        @if (count($areas))
            <div id="list-view" class="tab">
                @foreach ($areas as $area)
                    <?
                    if (!isset($billboards[$area->id]))
                        continue;
                    ?>
                    <section>
                        <center>
                            <h3>{{ $area->name }}</h3>
                        </center>
                        <table>
                            @foreach ($billboards[$area->id] as $billboard)
                                <?
                                $billboard_style = 'green';
                                if ($billboard->status == 'reserved' && $billboard->status_limit > date('Y-m-d'))
                                    $billboard_style = 'yellow'; elseif ($billboard->status == 'blocked'
                                                                         && $billboard->status_limit > date('Y-m-d')
                                )
                                    $billboard_style = 'red';

                                if (preg_match("~\d{4}\-\d{2}\-\d{2}~is", $billboard->status_limit))
                                    $carbon = \Carbon\Carbon::createFromFormat('Y-m-d', $billboard->status_limit);
                                else
                                    $carbon = \Carbon\Carbon::now();

                                $image = is_object($billboard->photo) ? $billboard->photo->full() : NULL;
                                ?>
                                <tr data-id='{{ $billboard->id }}'>
                                    <td class="dummy"></td>
                                    <td class="type {{ $billboard_style }}"></td>
                                    {{--<td class="address">{{ $billboard->address }}</td>--}}
                                    <td class="address">{{ $billboard->name }}</td>
                                    <td class="price">
                                        @if ($billboard->price)
                                            @if ($billboard_style == 'green')
                                                <span class="numbers">{{ $billboard->price }} </span>
                                                <span>руб. </span>
                                            @elseif ($billboard_style == 'yellow')
                                                <span class="numbers">{{ $billboard->price }} </span><span>руб. </span><br><span>Зарезервирован до <span>{{ $carbon->format('d.m') }} </span></span>
                                            @elseif ($billboard_style == 'red')
                                                @if (0)
                                                   <span>Доступно через <strong>{{ $carbon->diffInDays(); }} дней </strong></span><span>за </span><span class="numbers">{{ $billboard->price }} </span><strong>руб.</strong>
                                                @endif
                                                <span class="numbers">{{ $billboard->price }} </span><span>руб. </span><br><span>Доступен с <strong>{{ $carbon->format('d.m') }}</strong></span></span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="photo">
                                        @if ($image)
                                            <a class="photo" href="{{ $image }}">Фото</a><br>
                                        @endif
                                        <a href="" class="address">На карте</a>
                                    </td>
                                    <td class="order">
                                        <a href="#" class="type {{ $billboard_style }}">
                                            @if ($billboard_style == 'green')
                                                Заказать
                                            @elseif ($billboard_style == 'yellow')
                                                Второй резерв
                                            @elseif ($billboard_style == 'red')
                                                Оставить заявку
                                            @endif
                                        </a>
                                    </td>
                                    <td class="dummy"></td>
                                </tr>
                            @endforeach
                        </table>
                    </section>

                @endforeach
            </div>
        @endif
        <div id="billboard-map" class="tab"></div>
    </div>
    <div class="tabs-btn">
        <span class="selected" style="display: none;"><span class="count">Выбрано 0 щитов</span> на сумму <span class="numbers">0 рублей.</span></span>
        <br><br>
        <a href="{{ URL::route('page', 'order-billboard') }}" class="btn send">Отправить заказ</a>
        <br><br>
    </div>
    <script>
        billboards_json = {
            "center": [47.25221300, 39.69359700],
            "zoom": 12,
            "items": {{ json_encode($billboards_for_json) }}
        }
    </script>

@stop


@section('scripts')
@stop