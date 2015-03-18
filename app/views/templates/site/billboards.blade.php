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
            "address" => $billboard->address,
            "price" => $billboard->price,
            "photo" => $image,
        ];
        if ($billboard_style == 'yellow')
            $array["available"] = $carbon->format('d.m');
        elseif ($billboard_style == 'red')
            $array["available"] = $carbon->diffInDays();

        $billboards_for_json[] = $array;
    }

    $billboards = DicLib::groupByField($billboards, 'area_id');
}
#Helper::tad($billboards);

?>


@section('page_class')billboards @stop


@section('style')
@stop


@section('content')

    <div class="decals"></div>
    <div class="teaser">
        Рекламное агентство «Трибуна» владеет собственной сетью рекламных
        конструкций 6х3 в Ростове-на-Дону и специализируется на наружной рекламе.
    </div>
    <div class="tabs-btn">
        <a href="" class="list-view">Списком</a>
        <a href="" class="map-view active">На карте</a>
        <span class="selected"><span class="count"></span> на сумму <span class="numbers"></span></span>
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
                                    <td class="address">{{ $billboard->address }}</td>
                                    <td class="price">
                                        @if ($billboard_style == 'green')
                                            <span class="numbers">{{ $billboard->price }} </span>
                                            <strong>рублей </strong><span>в месяц</span>
                                        @elseif ($billboard_style == 'yellow')
                                            <span>Зарезервирован до <strong>{{ $carbon->format('d.m') }}, </strong></span><span class="numbers">{{ $billboard->price }} </span><strong>руб.</strong>
                                        @elseif ($billboard_style == 'red')
                                            <span>Доступно через <strong>{{ $carbon->diffInDays(); }} дней </strong></span><span>за </span><span class="numbers">{{ $billboard->price }} </span><strong>руб.</strong>
                                        @endif
                                    </td>
                                    <td class="photo">
                                        @if ($image)
                                            <a href="{{ $image }}">Фото</a>
                                        @endif
                                    </td>
                                    <td class="order"><a href="#">Заказать</a></td>
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
    <center><a href="request-form.html" class="send-btn">Отправить заказ</a></center>
    <script>
        billboards_json = {
            "center": [47.25221300, 39.69359700],
            "zoom": 10,
            "items": [{
                "id": 1,
                "position": [47.25821300, 39.69359700],
                "type": "yellow",
                "address": "Какаято улица, 2",
                "reserved": 12.06, //зарезервировано до 12.06
                "price": 19500,
                "photo": "http://dummyimage.com/748x370/",
            }, {
                "id": 2,
                "position": [47.25022400, 39.29359700],
                "type": "green",
                "address": "Соколова, 18",
                "price": 19500,
                "photo": "http://dummyimage.com/748x370/",
            }, {
                "id": 3,
                "position": [47.09222400, 39.69956700],
                "type": "red",
                "address": "Ещё какаято улица, 3",
                "available": 86, //доступно через 86 дней
                "price": 19500,
                "photo": "http://dummyimage.com/748x370/",
            }],
        }
    </script>

@stop


@section('scripts')
@stop