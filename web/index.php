<?php
include("../code/core/bootstrap.php");

$request = new Request();

$request->page = "index";

print_r(SingletonRegistry::$registry);

?>

<p>HELLO WORLD</p>