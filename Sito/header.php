<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="stile.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.min.css" integrity="sha512-BiFZ6oflftBIwm6lYCQtQ5DIRQ6tm02svznor2GYQOfAlT3pnVJ10xCrU3XuXnUrWQ4EG8GKxntXnYEdKY0Ugg==" crossorigin="anonymous" />

    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

</head>

<body>

<div class="header">
    <div class="contenuto_header">
        <div class="logo">
            <a href="index.php"><img src="logo.png" alt="200" height="44"/></a>
        </div>

        <div class="divisore"></div>

        <ul class="menu">
            <li><a class="grigio cool" href="index.php">Home</a></li>
            <li><a class="grigio cool" href="lista.php">Lista</a></li>
            <li><a class="grigio cool" href="about.php">About</a></li>
            <li><a class="grigio cool" href="contatti.php">Contatti</a></li>
        </ul>
    </div>
</div>

<script type="text/javascript">
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll('a');
    const menuLength = menuItem.length;

    for (let i=0; i < menuLength; i++){
        if (menuItem[i].href === currentLocation){
            menuItem[i].className = "paginaAttiva"
        }
    }
</script>