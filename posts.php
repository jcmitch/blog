<?php
    include './lib/php/utils.php';
    include './lib/php/postData.php';
    $data = getPostData();

    $postid = $_GET['postid'];
    $postMarkup = '';
    $postData = $data[$postid];

    if (!empty($postData)) {
        $bodyMarkup = '';
        if (!empty($postData['body'])) {
            foreach ($postData['body'] as $bodyValue) {
                $node = $bodyValue['node'];
                if ($node === 'code') {
                    $bodyMarkup .= <<<HTML
                        <pre><code class="codeBlock">{$bodyValue['value']}</code></pre>
HTML;
                } else {
                    $bodyMarkup .= ('<'.$node.' class="'.$bodyValue['classes'].'">'.$bodyValue['value'].'</'.$node.'>');
                }
            }
        }
        $postMarkup .= <<<HTML
            <div class="glass post">
                <h3>{$postData[title]}</h3>
                {$bodyMarkup}
            </div>
HTML;
    } else {
        $listMarkup = '';
        foreach ($data as $post) {
            $relTimestamp = getRelTime($post['timestamp']);
            $listMarkup .= <<<HTML
                <li><a href="{$post[link]}">$post[title]</a> <span class="timestamp">{$relTimestamp}</span></li>
HTML;
        }
        $postMarkup .= <<<HTML
            <div class="glass post">
                <h3>Posts:</h3>
                <ul class="postList">
                    {$listMarkup}
                </ul>
            </div>
HTML;
    }
?>

<html>
    <head>
        <title>Jeremy Mitchell Posts</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link rel="stylesheet" type="text/css" href="./css/stars.css">
        <link rel="stylesheet" type="text/css" href="./css/index.css">
        <link rel="stylesheet" type="text/css" href="./css/posts.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Jura:300,400,500,600">
        <script src="/lib/js/jquery.min.js"></script>
        <script src="./js/stars.js"></script>
    </head>
    <body>
        <canvas id="starCanvas"></canvas>
        <div class="wrapper">
            <h1 class="header glass">Jeremy Mitchell - Posts</h1>
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
