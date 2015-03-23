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
        @if (isset($comment) && $comment)
            <p>
                {{ Helper::nl2br($comment) }}
            </p>
        @endif
	</div>
</body>
</html>