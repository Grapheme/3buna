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
        Рекламное агентство «Трибуна» владеет собственной сетью рекламных
        конструкций 6х3 в Ростове-на-Дону и специализируется на наружной рекламе.
        <br>
        <small>С нашей адресной программой Вы можете ознакомиться <a href="{{ URL::route('page', 'billboards') }}">здесь</a>.</small>

    </div>
    <div class="activities">
        <section class="billboards">
            <div class="holder">
                <div class="title">Размещение на щитах</div>
                <div class="description">Рекламное агентство «Трибуна» владеет собственной сетью рекламных конструкций.</div>
            </div><a href="{{ URL::route('page', 'billboards') }}" class="more">Адресная программа</a>
        </section>
        <section class="advert">
            <div class="holder">
                <div class="title">Изготовление наружной рекламы</div>
                <div class="description">Наше оборудование позволяет изготовить любые виды рекламы от вывески до щита.</div>
            </div>
            {{--<a href="#" class="more">Читать далее</a>--}}
        </section>
        <section class="imarketing">
            <div class="holder">
                <div class="title">Интернет-маркетинг</div>
                <div class="description">Мы занимаемся маркетингом и выходим на новый современный уровень.</div>
            </div>
            {{--<a href="#" class="more">Читать далее</a>--}}
        </section>
        <section class="web-sites">
            <div class="holder">
                <div class="title">Разработка веб-сайтов</div>
                <div class="description">Мы занимаемся проектированием, разработкой и сопровождением веб-сайтов и мобильных приложений.</div>
            </div>
            {{--<a href="#" class="more">Смотреть работы</a>--}}
        </section>
        <div class="clrfx"></div>
    </div>
    <div class="content">
        <div class="top"></div>
        <div class="mid">
            <div class="header-small">Коротко о нас</div>
            <h1>Мы делаем лучшую наружную рекламу<br> в Ростове-на-Дону</h1>
            <div class="info">
                <p>
                    Рекламное агентство «Трибуна» владеет собственной сетью рекламных
                    конструкций 6х3 в г.Ростове-на-Дону и специализируется на наружной
                    рекламе. Сеть конструкций охватывает полностью всю черту
                    города, специально обученные маркетологи отбирали наиболее популярные
                    места.
                </p>
                <p>
                    С нашей адресной программой Вы можете ознакомиться здесь. Также мы
                    оказываем сопутствующие услуги:
                </p>
                <ul>
                    <li>разработка оригинал-макетов.</li>
                    <li>печать баннером и постеров.</li>
                </ul>
            </div>
            <div class="desc">Для рекламных агентств предусмотрены гибкие условия сотрудничества.</div>
            <div class="header-small">Контакты</div>
            <div class="contacts-block">
                Мы находимся по адресу:<br>
                <strong>г. Ростов-на-дону, ул. нансена, 239,</strong><br>
                телефон: <strong>(863) 218-52-22</strong>
            </div>
            <div class="small-map"></div>
        </div>
        <div class="bottom"></div>
    </div>

@stop


@section('scripts')
@stop