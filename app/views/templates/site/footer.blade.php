<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
<footer>
    <div class="left">
        <div class="company">&copy; 2015 Рекламное агентство «Трибуна»</div><a href="mailto:info@3buna.ru" class="mail">info@3buna.ru</a>
    </div>
    <div class="right">
        <ul class="footer-menu">
            <li><a href="{{ URL::route('page', 'billboards') }}">Размещение на щитах</a></li>
            <li><a href="#">Изготовление наружной рекламы</a></li>
            <li><a href="#">Интернет-маркетинг</a></li>
            <li><a href="#">Разработка сайтов</a></li>
            <li><a href="{{ URL::route('mainpage') }}">О компании</a></li>
            <li><a href="{{ URL::route('page', 'contacts') }}">Контакты</a></li>
        </ul>
    </div>
    <div class="clrfx"></div>
</footer>