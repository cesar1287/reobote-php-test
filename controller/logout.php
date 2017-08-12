<?php

include_once dirname(__DIR__).'/model/urls.php';

session_start();

session_destroy();

header("location: ".$GLOBALS['project_index']);