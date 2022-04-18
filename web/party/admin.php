<?php
$base = "../../";

include($base . "code/core/bootstrap.php");

$request = new Request();

$request->page = "party/adminApi";
$request->base = $base;

SingletonRegistry::$registry["Router"]->process();
