<?php

$url = "";
$fileSize = "";

if (isset($_POST['input'])) {
    $url = $_POST['input'];

    $result = get_headers($url, 1);

    $headers  = array_change_key_case($result);

    $fileSize = intval($headers['content-length']);

    echo $fileSize / 1024 . " MB's";
}


