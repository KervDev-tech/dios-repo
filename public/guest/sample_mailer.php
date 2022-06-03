<?php

include_once '../../app/includes/autoLoad.php';

$emp = new empController;

$emp->tryMailer();

?>