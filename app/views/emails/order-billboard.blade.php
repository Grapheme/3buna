<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<div>
        @if (isset($org) && $org)
            <p>
                Организация: {{ $org }}
            </p>
        @endif
        @if (isset($phone) && $phone)
            <p>
                Телефон: {{ $phone }}
            </p>
        @endif
        @if (isset($email) && $email)
            <p>
                e-mail: {{ $email }}
            </p>
        @endif
        @if (isset($need_design) && $need_design)
            <p>
                + Разработать дизайн для макетов биллборда
            </p>
        @endif

        @if (isset($billboards) && !is_null($billboards) && count($billboards))

            <p>Выбранные щиты:</p>

            @foreach ($billboards as $billboard)

                <p>
                    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/admin/entity/billboards/{{ $billboard->id }}/edit" target="_blank">{{ $billboard->name }}</a> -
                    @if ($billboard->status == 'free')
                        зарезервировать
                    @elseif ($billboard->status == 'reserved')
                        поставить второй резерв
                    @elseif ($billboard->status == 'blocked')
                        известить, когда освободится
                    @endif
                </p>

            @endforeach
        @endif
        @if (isset($comment) && $comment)
            <p>
                {{ Helper::nl2br($comment) }}
            </p>
        @endif
	</div>
</body>
</html>