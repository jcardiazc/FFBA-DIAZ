<!DOCTYPE html>
<html>
<head>
    <title>Films tendance de la journée</title>
</head>
<body>
    <h1>Films tendance de la journée</h1>

    <ul>
        @foreach ($films as $film)
            <li>{{ $film['title'] }}</li>
        @endforeach
    </ul>
</body>
</html>