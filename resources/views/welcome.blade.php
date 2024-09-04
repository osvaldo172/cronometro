<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronómetro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .timer {
            font-size: 48px;
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
<button onclick="startTimer()">Iniciar</button>
<button onclick="stopAndSend()">Detener y enviar</button>
<button onclick="resetTimer()">Detener y reiniciar</button>

<form id="timerForm" action="{{ route('storeTime') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="time" id="hiddenTime">
</form>

<script>
    let timerInterval;
    let seconds = 0;
    let minutes = 0;
    let hours = 0;

    function startTimer() {
        if (timerInterval) {
            clearInterval(timerInterval);
        }
        timerInterval = setInterval(updateTimer, 1000);
    }

    function stopAndSend() {
        clearInterval(timerInterval);
        const timeString =
            (hours < 10 ? "0" + hours : hours) + ":" +
            (minutes < 10 ? "0" + minutes : minutes) + ":" +
            (seconds < 10 ? "0" + seconds : seconds);

        document.getElementById("hiddenTime").value = timeString;
        document.getElementById("timerForm").submit();
    }

    function resetTimer() {
        clearInterval(timerInterval);
        seconds = 0;
        minutes = 0;
        hours = 0;
        document.getElementById("timer").innerHTML = "00:00:00";
    }

    function updateTimer() {
        seconds++;
        if (seconds == 60) {
            seconds = 0;
            minutes++;
            if (minutes == 60) {
                minutes = 0;
                hours++;
            }
        }

        document.getElementById("timer").innerHTML =
            (hours < 10 ? "0" + hours : hours) + ":" +
            (minutes < 10 ? "0" + minutes : minutes) + ":" +
            (seconds < 10 ? "0" + seconds : seconds);
    }
</script>

</body>
</html>
