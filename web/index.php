<?php
$base = "../";

include($base."code/core/bootstrap.php");

$request = new Request();

$request->page = "test";
$request->base = $base;

SingletonRegistry::$registry["Router"]->process();
