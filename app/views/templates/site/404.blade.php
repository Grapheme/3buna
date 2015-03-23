<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
@extends(Helper::layout())
<?
$page_title = 'Страница не найдена';
?>


@section('page_class')forbidden @stop


@section('header_logo')@stop


@section('style')
@stop


@section('content')

    <div class="content-wrapper">
        <div class="support"></div><img src="{{ Config::get('site.theme_path') }}/images/forbidden.png">
    </div>

@stop


@section('scripts')
@stop