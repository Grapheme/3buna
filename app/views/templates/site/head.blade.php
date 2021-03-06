<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
<?
/**
 * META TITLE
 */
if (isset($page) && is_object($page)) {
        if (isset($page->seo) && is_object($page->seo) && $page->seo->title) {
                $page_title = $page->seo->title;
        } else {
                $page_title = $page->name;
        }
} elseif (isset($seo) && is_object($seo) && $seo->title) {
        $page_title = $seo->title;
} elseif (!isset($page_title)) {
        $page_title = Config::get('site.seo.default_title');
}
/**
 * META DESCRIPTION
 */
if (isset($page) && is_object($page) && isset($page->seo) && is_object($page->seo) && $page->seo->description) {
        $page_description = $page->seo->description;
} elseif (isset($seo) && is_object($seo) && $seo->description) {
        $page_description = $seo->description;
} elseif (!isset($page_description)) {
        $page_description = Config::get('site.seo.default_description');
}
/**
 * META KEYWORDS
 */
if (isset($page) && is_object($page) && isset($page->seo) && is_object($page->seo) && $page->seo->keywords) {
        $page_keywords = $page->seo->keywords;
} elseif (isset($seo) && is_object($seo) && $seo->keywords) {
        $page_keywords = $seo->keywords;
} elseif (!isset($page_keywords)) {
        $page_keywords = Config::get('site.seo.default_keywords');
}
?>
@section('title'){{{ $page_title }}}@stop
@section('description'){{{ $page_description }}}@stop
@section('keywords'){{{ $page_keywords }}}@stop
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        {{ HTML::style(Config::get('site.theme_path').'/styles/vendor.css') }}
        {{ HTML::style(Config::get('site.theme_path').'/styles/main.css') }}

        {{ HTML::script(Config::get('site.theme_path').'/scripts/vendor/modernizr.js') }}
