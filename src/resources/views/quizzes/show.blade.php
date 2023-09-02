<!DOCTYPE html>
<html>
<head>
    <title>クイズ</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h1 class = "text-3xl font-bold underline text-red-500">クイズ</h1>
    <table>
        @foreach ($quiz as $item)
            <h3>{{ $item->text }}</h3>
                @foreach($item->choices as $choice)
                    <p>{{ $choice->text }}</p> 
                @endforeach
        @endforeach
    </table>
</body>
</html>