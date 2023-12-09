<?php
    // $res = file_get_contents($url);
    $file_opened = fopen("./data.json", "r");

    $raw_bytes = fread($file_opened, filesize("./data.json"));

    $json_decoded = json_decode($raw_bytes);

    // sort json objects based on title alphabetically (insertion sort)
    $json_sorted = [];

    foreach($json_decoded as $jdk => $jdv) {
        if (sizeof($json_sorted) > 0) {
            foreach($json_sorted as $jsk => $jsv) {
                if ($jdv->title > $jsv->title) {
                    // echo $jsv->title . " " . $jdv->title . "\n";
                    if ($jsk == array_key_last($json_sorted)) {
                        array_splice($json_sorted, $jsk + 1, 0, array($jdv));
                    }
                } else {
                    array_splice($json_sorted, $jsk, 0, array($jdv));
                    break;
                }
            }
        } else {array_push($json_sorted, $jdv);}
    }

    var_dump($json_sorted);

    // sprintf("<p>%s</p>", $json_decoded[0]->pubDate);

    // $datetime_parsed = DateTime::createFromFormat("D, j M Y H:i:s T", $json_decoded[0]->pubDate);

    // echo $json_decoded[0]->description;

    // echo "\n";

    // echo $datetime_parsed->format("l, jS \of F Y g:i a");

    fclose($file_opened);
?>