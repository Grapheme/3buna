<?
/**
 * TITLE: Заявка на размещение
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())


@section('page_class')request-form @stop


@section('style')
@stop


@section('content')

    <div class="decals"></div>
    <form id="request-form" action="." method="POST">
        <h1>Заявка на размещение</h1>
        <div class="wrapper">
            <div class="selected-billboards">
                <div class="row title">Выбраные щиты:</div>
                <div class="row list">
                    <div class="more"><a href="/billboards/">Добавить ешё щит</a></div>
                </div>
            </div>
            <div class="row">
                <!--input(type="hidden" name="billboards")-->
            </div>
            <div class="row need-design">
                <label>
                    <input type="checkbox" checked="checked" name="need_design">
                    <div class="label">Разработать макет рекламного щита</div>
                </label>
            </div>
            <div class="row"></div>
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
                    <button type="submit">Оформить заказ</button>
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