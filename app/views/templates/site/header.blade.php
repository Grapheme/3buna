<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
<header class="@section('header_class') middle @show">
    <div class="holder">

        {{ Menu::placement('main_menu') }}

    </div>
    @section('header_logo')
        <a href="{{ URL::route('mainpage') }}" class="logo"><img src="{{ Config::get('site.theme_path') }}/images/logo.png"></a>
    @show
    @section('header_content')@show
</header>
