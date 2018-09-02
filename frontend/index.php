<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/main.css">
    <title>Document</title>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: bashska
 * Date: 25.08.18
 * Time: 12:53
 */

include '/var/www/bash.inc/engine/engine.php';

mb_internal_encoding("UTF-8");




print_r(render('index.tpl', $vars));

?>
<script src="scripts/jquery.js"></script>
<script src="scripts/common.js"></script>
<script src="scripts/ajax/registredform_ajax.js"></script>
</body>
</html>