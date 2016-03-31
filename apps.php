<?php
    include './lib/php/appData.php';
    $data = getAppData();

    $postMarkup = '';
    foreach ($data as $post) {
        $paraMarkup = '';
        foreach($post['paragraphs'] as $paragraph) {
            $paraMarkup .= '<p>'.$paragraph.'</p>';
        }
        $postMarkup .= <<<HTML
            <div class="glass post appBlock">
                <a href="{$post[link]}">
                    <h3>{$post[title]}</h3>
                    <img src="{$post[image]}">
                </a>
                {$paraMarkup}
            </div>
HTML;
    }
?>

<html>
    <head>
        <title>Jeremy Mitchell Apps</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link rel="stylesheet" type="text/css" href="./apps/css/stars.css">
        <link rel="stylesheet" type="text/css" href="./css/index.css">
        <link rel="stylesheet" type="text/css" href="./css/apps.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Jura:300,400,500,600">
        <script src="/lib/js/jquery.min.js"></script>
        <script src="./apps/js/stars.js"></script>
    </head>
    <body>
        <canvas id="starCanvas"></canvas>
        <div class="wrapper">
            <h1 class="header glass">Jeremy Mitchell - Apps</h1>
            <div class="glass post about">
                <div class="bio">Engineer, baseball enthusiest, and some other stuff</div>
                <ul class="bioList">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/jeremy-mitchell-31630538">LinkedIn</a>
                    </li>
                    <li>
                        <a href="/bio.html">Bio</a>
                    </li>
                </ul>
                <ul class="contentList">
                    <li>
                        <a href="/posts.php">Posts</a>
                    </li>
                    <li>
                        <a href="/apps.php">Apps</a>
                    </li>
                </ul>
            </div>
            <?php echo $postMarkup ?>
        </div>
    </body>
</html>