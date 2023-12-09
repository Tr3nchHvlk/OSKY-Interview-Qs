<?php
    // $res = file_get_contents($url);
    $file_opened = fopen("./data.json", "r");

    $raw_bytes = fread($file_opened, filesize("./data.json"));

    $json_decoded = json_decode($raw_bytes);

    // var_dump($json_decoded[0]);

    $as_html = sprintf("<p>%s</p>", $json_decoded[0]->pubDate);

    $datetime_parsed = DateTime::createFromFormat("D, j M Y H:i:s T", $json_decoded[0]->pubDate);

    echo $json_decoded[0]->description;

    echo "\n";

    echo $datetime_parsed->format("l, jS \of F Y g:i a");

    fclose($file_opened);
?>