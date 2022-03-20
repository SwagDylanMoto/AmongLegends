<?php
$base = "../";

include($base."code/core/bootstrap.php");

$request = new Request();

$request->page = "index";
$request->base = $base;

SingletonRegistry::$registry["Router"]->process();
