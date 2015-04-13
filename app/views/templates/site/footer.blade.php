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

        {{ Menu::placement('footer_menu') }}

    </div>
    <div class="clrfx"></div>
</footer>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter29595765 = new Ya.Metrika({id:29595765,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/29595765" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->