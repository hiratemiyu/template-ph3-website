<!DOCTYPE html>
<html>
<head>
    <title>ユーザー一覧</title>
</head>
<body>
    <h1>ユーザー一覧</h1>

    <table>
        <tr>
            <th>名前</th>
            <th>Email</th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
