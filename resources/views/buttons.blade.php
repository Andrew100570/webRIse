<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение порядка кнопок</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .button-container {
            display: flex;
            flex-direction: column;
        }
        .button-container button {
            margin: 5px;
        }
    </style>
</head>
<body>

<div class="button-container">
    <button class="button" id="button1">1</button>
    <button class="button" id="button2">2</button>
    <button class="button" id="button3">3</button>
</div>

<script>
    $(function() {
        var o = [1, 2, 3];
        $('.button').click(function() {
            o.push(o.shift());
            $('.button').each(function(i) {
                $('#button' + o[i]).appendTo('.button-container');
            });
        });
    });
</script>

</body>
</html>
