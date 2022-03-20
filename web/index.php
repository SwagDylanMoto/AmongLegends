<?php
$base = "../";

include($base."code/core/bootstrap.php");

$request = new Request();

$request->page = "index";
$request->base = $base;

print_r(SingletonRegistry::$registry);

SingletonRegistry::$registry["Router"]->process

?>

<p>HELLO WORLD</p>