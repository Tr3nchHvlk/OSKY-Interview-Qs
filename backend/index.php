<!DOCTYPE html>
<html>

<style>
    body {
        background-color: white;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
    * {
        /* border: 1px solid black; */
    }
    #new-container {
        position: relative;
        transform: translate(-50%, 0%);
        left: 50%;
        width: 81vw;
        display: flex;
        flex-direction: column;
    }
    .news-block {
        position: relative;
        background-color: rgb(243, 243, 243);
        width: 100%;
        min-height: 110px;
        max-height: 400px;
        margin-top: 17px;
        border-radius: 4px;
        border: 1px solid rgb(166, 166, 166);
        overflow: auto;
        /* height: max-content;
        display: inline-block; */
        /* box-shadow: inset 0px 0px 20px 10px rgba(0, 0, 0, 0.1); */
    }
    .news-title {
        position: absolute;
        transform: translate(0%, -100%);
        top: 24px;
        margin-left: 18px;
        width: 65%;
        font-size: x-large;
    }
    .news-title > a {
        color: black;
        text-decoration: none;
    }
    .news-date {
        position: absolute;
        transform: translate(-100%, -100%);
        top: 25px;
        left: 100%;
        width: 35%;
        margin-left: -19px;
        text-align: right;
    }
    .news-description {
        position: absolute;
        font-size: small;
        transform: translate(0%, 0%);
        top: 41px;
        width: 85%;
        margin-left: 44px;
        max-height: 300px;
        /* border: 1px solid black; */
    }
</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Example</title>
</head>

<body>
    <div id="new-container">
        <?php
            $file_opened = fopen("./data.json", "r");

            // $raw_bytes = file_get_contents("https://test.osky.dev/101/data.json");
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

            // var_dump($json_sorted);

            foreach($json_sorted as $jsk => $jsv) {
                $datetime_parsed = DateTime::createFromFormat("D, j M Y H:i:s T", $jsv->pubDate);
                echo "<div class=\"news-block\"><h2 class=\"news-title\"><a href=\"#\">" . $jsv->title . "</a></h2><p class=\"news-date\"><i>" . $datetime_parsed->format("l, jS \of F Y g:i a") . "</i></p><div class=\"news-description\"><p>" . $jsv->description . "</p></div></div>\n";
            }

            fclose($file_opened);
        ?>
    </div>
</body>

</html>