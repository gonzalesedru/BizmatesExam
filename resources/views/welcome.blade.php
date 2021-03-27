<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Journey HTML CSS Template</title>
        <!-- load stylesheets -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
        <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
        <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
        <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
        <link rel="stylesheet" href="css/style.css">
    
    </head>
    <body class="antialiased">
        <div id="app">
            <navbar></navbar>
            <main-component></main-component>
        </div>

    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="js/jquery-1.11.3.min.js"></script>             
    <script src="js/popper.min.js"></script>                    
    <script src="js/bootstrap.min.js"></script>   
</html>
