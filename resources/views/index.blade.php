<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat</title>
     <!--jQuery -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

    <div class="app">
        <header>
            <h1>chat</h1>
            <div id="messages">

            </div>
            <form action="" id="message_form">
                <input type="text" name="message" id="message_input" placeholder="write a message...">
                <button type="submit" id="message_send" >send</button>
            </form>
        </header>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>