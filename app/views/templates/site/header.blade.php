<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
<header class="@section('header_class') middle @show">
    <div class="holder">
        <ul class="main-menu">
            <li><a href="{{ URL::route('page', 'billboards') }}">Размещение на щитах</a></li>
            <!--
            <li><a href="#">Изготовление наружной рекламы</a></li>
            <li><a href="#">Интернет-маркетинг</a></li>
            <li><a href="#">Разработка сайтов</a></li>
            -->
            <li><a href="{{ URL::route('mainpage') }}">О компании</a></li>
            <li><a href="{{ URL::route('page', 'contacts') }}">Контакты</a></li>
        </ul>
    </div><a href="{{ URL::route('mainpage') }}" class="logo"><img src="{{ Config::get('site.theme_path') }}/images/logo.png"></a>
    @section('header_content')@show
</header>
