<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>

@if (0)
    @if(Config::get('app.use_scripts_local'))
        {{ HTML::scriptmod('js/vendor/jquery.min.js') }}
    @else
        {{ HTML::script("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js") }}
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    @endif
@endif

<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>

{{ HTML::scriptmod(Config::get('site.theme_path').'/scripts/vendor.js') }}

@if (0)
    {{ HTML::script("js/vendor/jquery.validate.min.js") }}
    {{ HTML::script("js/vendor/jquery-form.min.js") }}
@endif

<script>var tribuna_theme_path_ = '{{ Config::get('site.theme_path') }}'; //Без слеша в конце;</script>

{{ HTML::scriptmod(Config::get('site.theme_path').'/scripts/main.js') }}
