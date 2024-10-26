<?php
// echo '<pre>';
// print_r($_SERVER);
$_method = $_SERVER['REQUEST_METHOD'];
$_host = $_SERVER['HTTP_HOST'];
$_uri = $_SERVER['REQUEST_URI'];
$_partes = explode('/', $_uri);

    // echo "<p>{$_host}</p>";
    // echo "<p>{$_uri}</p>";
    // echo "<p>{$_method}</p>";
    // echo '</pre>';