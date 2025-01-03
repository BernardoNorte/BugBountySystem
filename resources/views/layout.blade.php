<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,
 maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bug Bounty Program</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        html {
            height: 100%;
        }

        body {
            height: 100%;
            display: flex;
        }

        body>nav {
            min-width: 150px;
            background-color: lightgray;
            margin-right: 20px;
        }

        body>nav ul {
            list-style-type: none;
            padding-left: 15px;
            margin-bottom: 10px;
        }

        body>nav li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li>
                <a href="{{ route('programs.index') }}">Programs</a>
            </li>
            <li>
                
            </li>
        </ul>
    </nav>
    <div class="main">
        <header>
            <h1>@yield('header-title')</h1>
        </header>
        <div class="content">
            @yield('main')
        </div>
    </div>
</body>

</html>