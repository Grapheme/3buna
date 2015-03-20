<?
/**
 * TITLE: Контакты
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())


@section('page_class')contacts @stop


@section('style')
@stop


@section('content')

    <div class="decals"></div>
    <h1>Контакты</h1>
    <div class="content">
        <div class="row">
            <div class="unit">
                <h2>Адрес</h2>
                <p>
                    {{ $page->block('address') }}
                </p>
            </div>
            <div class="unit">
                <h2>Телефоны</h2>
                <p>
                    {{ $page->block('phones') }}
                </p>
            </div>
            <div class="unit">
                <h2>Почта</h2>
                <p>
                    {{ $page->block('email') }}
                </p>
            </div>
            <div class="clrfx"></div>
        </div>
        <div class="map"></div>
        <h2>Обратная связь</h2>
        <form action="{{ URL::route('app.send-message') }}" method="POST" class="contacts-form">
            <div class="wrapper">
                <div class="row">
                    <input name="name" placeholder="Имя">
                    <input name="phone" placeholder="Телефон">
                </div>
                <div class="row">
                    <textarea name="content" placeholder="Текст сообщения"></textarea>
                </div>
                <button type="submit">Отправить</button>
                <div class="notice">Все поля обязательны для заполнения.</div>
            </div>
            <div class="final">
                <div class="title">Спасибо!</div>
                <div class="text">Ваше письмо<br> успешно отправлено</div>
            </div>
        </form>
    </div>

@stop


@section('scripts')
@stop