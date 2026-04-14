<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestPeople - Company</title>
</head>
<body>
    <h1>GestPeople</h1>
    <h2>{{ Auth::user() }}</h2>
    <ul>
        @foreach ($departamentos as $departamento)
            <li>{{ $departamento->denominacao }}</li>
            <li>{{ $departamento->responsabilidade }}</li>

        @endforeach
    </ul>
</body>
</html>