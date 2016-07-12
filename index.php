<?php
    include './lib/php/utils.php';
    include './lib/php/postData.php';
    $PAGE_SIZE = 5;

    $data = getPostData();
    $pageCount = ceil(count($data)/$PAGE_SIZE);

    $pagenum = $_GET['page'];
    if (empty($pagenum) || preg_match('/[^0-9,]$/', $pagenum)) {
        $pagenum = 1;
    }
    if (count($data) <= (($pagenum-1)*$PAGE_SIZE)) {
        $pagenum = 1;
    }
    $data = $data = array_slice($data, ($pagenum-1)*$PAGE_SIZE, $PAGE_SIZE);

    $postMarkup = '';
    foreach ($data as $post) {
        $relTimestamp = getRelTime($post['timestamp']);
        $postMarkup .= <<<HTML
            <div class="glass post">
                <h3><a href="{$post[link]}">{$post[title]}</a></h3>
                <p>{$post[summary]}</p>
                <div class="timestamp">{$relTimestamp} ago</div>
            </div>
HTML;
    }

    $buttonMarkup = '';
    if ($pageCount > 1) {
        $buttonListMarkup = '';
        $prev = $pagenum-1;
        $next = $pagenum+1;
        if ($prev > 1) {
            $buttonListMarkup .= <<<HTML
                <li class="glass"><a href="/?page=1">1</a></li>
HTML;
        }
        if ($prev > 2) {
            $buttonListMarkup .= <<<HTML
                <li class="elipsis">...</li>
HTML;
        }
        if ($prev > 0) {
            $buttonListMarkup .= <<<HTML
                <li class="glass"><a href="/?page={$prev}">{$prev}</a></li>
HTML;
        }
        $buttonListMarkup .= <<<HTML
            <li class="glass darkGlass"><span>{$pagenum}</span></li>
HTML;
        if ($next <= $pageCount) {
            $buttonListMarkup .= <<<HTML
                <li class="glass"><a href="/?page={$next}">{$next}</a></li>
HTML;
        }
        if ($next < $pageCount-1) {
            $buttonListMarkup .= <<<HTML
                <li class="elipsis">...</li>
HTML;
        }
        if ($next < $pageCount) {
            $buttonListMarkup .= <<<HTML
                <li class="glass"><a href="/?page={$pageCount}">{$pageCount}</a></li>
HTML;
        }
        $buttonMarkup .= <<<HTML
            <div class="post navButtonsWrapper">
                <ul class="navButtons">
                {$buttonListMarkup}
                </ul>
            </div>
HTML;
    }
?>

<html>
    <head>
        <title>Jeremy Mitchell</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link rel="stylesheet" type="text/css" href="./css/stars.css">
        <link rel="stylesheet" type="text/css" href="./css/index.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Jura:300,400,500,600">
        <script src="/lib/js/jquery.min.js"></script>
        <script src="./js/stars.js"></script>
    </head>
    <body>
        <canvas id="starCanvas"></canvas>
        <div class="wrapper">
            <h1 class="header glass">Jeremy Mitchell</h1>
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
            <?php echo $buttonMarkup ?>
        </div>
    </body>
</html>
