<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<div>
		<p>
            Сообщение: {{ $name }} @if (isset($phone)) {{ $phone }} @endif
            <hr/>
			{{ Helper::nl2br($content) }}
            <hr/>
		</p>
	</div>
</body>
</html>