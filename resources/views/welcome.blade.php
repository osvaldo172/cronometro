<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cronómetro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .timer {
            font-size: 20em;
            margin-bottom: 20px;
        }
        button {
            font-size: 20px;
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
        }

        .alert {
            color: green;
            margin-top: 20px;
            font-size: 20px;
        }
    </style>
</head>
<body>

@if (session('success'))
    <div class="alert">
        {{ session('success') }}
    </div>
@endif

<div class="timer" id="timer">00:00:00</div>

<script>
    function fetchTime() {
        fetch('/current-time')
            .then(response => response.json())
            .then(data => {
                document.getElementById('timer').innerHTML = data.time;
            });
    }

    // Actualiza el tiempo cada segundo
    setInterval(fetchTime, 250);
</script>

</body>
</html>
