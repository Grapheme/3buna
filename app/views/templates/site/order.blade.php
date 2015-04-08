<?
/**
 * TITLE: Заявка на изготовление, маркетинг, разработку
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())


@section('page_class')request-form @stop


@section('style')
@stop


@section('content')
    <?
    $title = 'Заявка на изготовление';
    if (Input::get('type') == 'marketing')
        $title = 'Заявка на маркетинг';
    if (Input::get('type') == 'web')
        $title = 'Заявка на разработку';
    ?>
    
    <?
    $btn_title = 'Оформить заказ';
    if (Input::get('type') == 'marketing' || Input::get('type') == 'web')
        $btn_title = 'Отправить заказ';
    ?>
    <div class="decals"></div>
    <form id="request-form" action="{{ URL::route('app.order') }}" method="POST">
        <h1>{{ $title }}</h1>
        <div class="wrapper">
            <div class="row">
                <label>
                    <div class="label">Организация*:</div>
                    <input name="org">
                </label>
            </div>
            <div class="row"></div>
            <div class="row">
                <label>
                    <div class="label">Телефон*:</div>
                    <input name="phone" placeholder="+7">
                </label>
            </div>
            <div class="row"></div>
            <div class="row">
                <label>
                    <div class="label">Email:</div>
                    <input name="email">
                </label>
            </div>
            <div class="row"></div>
            <div class="row comment">
                <label>
                    <div class="label">Коментарий к заказу:</div>
                    <textarea name="comment" placeholder="Например, укажите удобное время для звонка"></textarea>
                </label>
            </div>
            <div class="row">
                <center>
                    <button type="submit">{{ $btn_title }}</button>
                </center>
            </div>
        </div>
        <div class="final">
            <div class="green">Спасибо!</div>
            <div class="text">Ваша заявка<br> успешно отправлена.</div>
        </div>
    </form>

@stop


@section('scripts')
@stop