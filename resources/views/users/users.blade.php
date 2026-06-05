<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users</title>
    <style>
        thead {
            background-color: #CCCCCC;
        }

        table {
            width: 100%;
            border-collapse: collapse
        }

        th,
        td {
            padding: 8px;
            text-align: left
        }

        img {
            width: 40px;
            height: 40px;
            border-radius: 100%;
        }

        div{
            width: 40px;
            height: 40px;
            border-radius: 100%;
            background-color: #CCCCCC;
            color: white;
            font-size: 30px;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <h2>Users</h2>
    <h3>Total Users: {{$users->count()}}</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    @if ($user->image)
                    <img src="{{$user->image}}" />
                    @else
                    <div>{{strtoupper(substr($user->full_name, 0, 1))}}</div>
                    @endif
                </td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>