<?php
    $currentPasscode = '123';

    $season = !empty($_GET['season']) ? $_GET['season'] : '2016';

    $curIndex = 0;
    $selCats = 0;
    $fileName = 'data/cats'.$season.'.json';
    $fileContent = '';
    $userOne = array(
        'name' => 'User One',
        'nickname' => 'One',
        'id' => 'one'
    );
    $userTwo = array(
        'name' => 'User Two',
        'nickname' => 'Two',
        'id' => 'two'
    );
    $passcode = '';

    $updateDates = array(
        '2016' => 'May 26th 2016',
        '2015' => 'October 5th 2015'
    );

    if (!empty($_COOKIE) && !empty($_COOKIE['catpass'])) {
        $passcode = $_COOKIE['catpass'];
    }

    if(file_exists($fileName) && filesize($fileName) > 0){
        $handle = fopen($fileName, "r");
        $fileContent = fread($handle, filesize($fileName));
        fclose($handle);
    }

    // get real users
    if ($passcode === $currentPasscode) {
        $userOne['nickname'] = 'Chas';
        $userTwo['nickname'] = 'Jeremy';
    }

    $headerMarkup = '<h1 class="headline">'.$season.' Season Cat Stats ';
    if ($season !== '2016') {
        $headerMarkup .= '<span class="eos">(FINAL)</span>';
    }
    $headerMarkup .= '</h1><select class="season-select">';
    if ($season === '2016') {
        $headerMarkup .= '<option value="2016" selected>2016</option><option value="2015">2015</option>';
    } else if ($season === '2015') {
        $headerMarkup .= '<option value="2016">2016</option><option value="2015" selected>2015</option>';
    }
    $headerMarkup .= '</select>';

    $loginMarkup = '';
    if ($passcode !== $currentPasscode && $passcode !== 'guest') {
        $loginMarkup = <<<HTML
            <div class="overlay">
                <div class="login-wrapper">
                    <h3>Enter Passcode</h3>
                    <input type="text" class="passcode">
                    <div class="login-btn-wrap">
                        <button class="guest">Continue as Guest</button>
                        <button class="login">Login</button>
                    </div>
                </div>
            </div>
HTML;
    }

    $header = '';

    function getSelectedState(&$curIndex, &$selCats) {
        $btnStr = $_GET['cats'];
        if (empty($btnStr)) {
            if ($curIndex < 5) {
                $result = 'selected';
                $selCats++;
            }
        } else {
            $btns = explode(",",$btnStr);
            $result = '';
            foreach($btns as $btn) {
                if ($btn == $curIndex) {
                    $result = 'selected';
                    $selCats++;
                }
            }
        }
        $curIndex++;
        return $result;
    }

    function getSelectedUsers($curUser) {
        $usrStr = $_GET['usr'];
        if (empty($usrStr)) {
            return 'checked';
        } else {
            $usrs = explode(",", $usrStr);
            foreach ($usrs as $usr) {
                if ($usr === $curUser) {
                    return 'checked';
                }
            }
        }
    }
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/catstats.css">
        <script src="/lib/js/jquery.min.js"></script>
        <script src="/lib/js/jquery.cookie.js"></script>
        <script src="/lib/js/charts.min.js"></script>
        <script src="./js/catstats.js"></script>
        <script type="text/javascript">
        var rawData = <?php
            echo json_encode($fileContent);?>;
        var userOne = '<?php
            echo json_encode($userOne);?>';
        var userTwo = '<?php
            echo json_encode($userTwo);?>';
        </script>
    </head>
    <body>
        <div class="header">
            <div>
                <?php echo $headerMarkup; ?>
            </div>
            <div class="global-stats">
                <div>
                    Last Updated: <span class="update-date"><?php echo $updateDates[$season]; ?></span>
                </div>
                <div>
                    Total Cats: <span class="total-cats">0</span> <?php echo $userOne['nickname']; ?> Cats: <span class="user-one-total-cats">0</span> <?php echo $userTwo['nickname']; ?> Cats: <span class="user-two-total-cats">0</span>
                </div>
            </div>
        </div>
        <div class="graph-wrap">
            <div class="first-row">
                <div class="line-title">Breakdown by date:</div>
            </div>
            <div class="second-row">
                <div class="pie-charts">
                    <span class="total-pie-wrap">
                        <div>Breakdown by user:</div>
                    </span>
                    <span class="selected-pie-wrap">
                        <div>Breakdown by cat:</div>
                    </span>
                </div>
                <div class="rank-table">
                    <table>
                        <tr>
                            <th>Cat</th>
                            <th>Count</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="controls-wrapper">
            <ul class="user-list">
                <li>Include:</li>
                <li>
                    <input class="user-select" type="checkbox" name="user" value="<?php echo $userOne['id']; ?>" <?php echo getSelectedUsers('one')?>> <?php echo $userOne['nickname']; ?>
                </li>
                <li>
                    <input class="user-select" type="checkbox" name="user" value="<?php echo $userTwo['id']; ?>" <?php echo getSelectedUsers('two')?>> <?php echo $userTwo['nickname']; ?>
                </li>
            </ul>
            <ul class="select-action-btns">
                <li>
                    <button class="select-all">Select All</button>
                </li>
                <li>
                    <button class="clear-all">Clear All</button>
                </li>
                <li>
                    <button class="share-url">Get Share URL</button>
                </li>
            </ul>
            <span class="scroll-info">&#8595; Scroll down for more &#8595;</span>
            <ul class="cat-btn-list">
                <li class="cat-btn-li">
                    <button class="cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1171729405">
                        <img height="100%" width="auto" src="./images/cats/1171729405.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class="cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="626267923">
                        <img height="100%" width="auto" src="./images/cats/626267923.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class="cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="552127919">
                        <img height="auto" width="100%" src="./images/cats/552127919.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class="cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="786804483">
                        <img height="100%" width="auto" src="./images/cats/786804483.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class="cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1802254567">
                        <img height="auto" width="100%" src="./images/cats/1802254567.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class="cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1090082463">
                        <img height="auto" width="100%" src="./images/cats/1090082463.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="393143349">
                        <img height="auto" width="100%" src="./images/cats/393143349.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="2125380943">
                        <img height="auto" width="100%" src="./images/cats/2125380943.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="508660310">
                        <img height="100%" width="auto" src="./images/cats/508660310.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1404432534">
                        <img height="auto" width="100%" src="./images/cats/1404432534.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="761170521">
                        <img height="auto" width="100%" src="./images/cats/761170521.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="713133850">
                        <img height="auto" width="100%" src="./images/cats/713133850.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1054000754">
                        <img height="auto" width="100%" src="./images/cats/1054000754.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1649039599">
                        <img height="auto" width="100%" src="./images/cats/1649039599.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="548566067">
                        <img height="auto" width="100%" src="./images/cats/548566067.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1652498069">
                        <img height="100%" width="auto" src="./images/cats/1652498069.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1095176301">
                        <img height="auto" width="100%" src="./images/cats/1095176301.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1766348599">
                        <img height="100%" width="auto" src="./images/cats/1766348599.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="857638975">
                        <img height="auto" width="100%" src="./images/cats/857638975.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="815755387">
                        <img height="auto" width="100%" src="./images/cats/815755387.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1174622966">
                        <img height="auto" width="100%" src="./images/cats/1174622966.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="883250133">
                        <img height="auto" width="100%" src="./images/cats/883250133.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="251509877">
                        <img height="auto" width="100%" src="./images/cats/251509877.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="61026026">
                        <img height="auto" width="100%" src="./images/cats/61026026.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="216808128">
                        <img height="auto" width="100%" src="./images/cats/216808128.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="344073301">
                        <img height="100%" width="auto" src="./images/cats/344073301.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1979258906">
                        <img height="auto" width="100%" src="./images/cats/1979258906.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="728297504">
                        <img height="auto" width="100%" src="./images/cats/728297504.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1064467000">
                        <img height="auto" width="100%" src="./images/cats/1064467000.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="659736090">
                        <img height="auto" width="100%" src="./images/cats/659736090.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1509027085">
                        <img height="auto" width="100%" src="./images/cats/1509027085.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="237967665">
                        <img height="auto" width="100%" src="./images/cats/237967665.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="299287436">
                        <img height="100%" width="auto" src="./images/cats/299287436.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1665801016">
                        <img height="auto" width="100%" src="./images/cats/1665801016.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1475292467">
                        <img height="100%" width="auto" src="./images/cats/1475292467.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="587340290">
                        <img height="100%" width="auto" src="./images/cats/587340290.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="196839564">
                        <img height="auto" width="100%" src="./images/cats/196839564.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1670271561">
                        <img height="auto" width="100%" src="./images/cats/1670271561.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="2076129329">
                        <img height="auto" width="100%" src="./images/cats/2076129329.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="539060679">
                        <img height="auto" width="100%" src="./images/cats/539060679.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1507947117">
                        <img height="100%" width="auto" src="./images/cats/1507947117.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1025826781">
                        <img height="auto" width="100%" src="./images/cats/1025826781.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1969501135">
                        <img height="auto" width="100%" src="./images/cats/1969501135.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="385744812">
                        <img height="auto" width="100%" src="./images/cats/385744812.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1343926834">
                        <img height="100%" width="auto" src="./images/cats/1343926834.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="583126592">
                        <img height="auto" width="100%" src="./images/cats/583126592.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1628791128">
                        <img height="auto" width="100%" src="./images/cats/1628791128.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="141418133">
                        <img height="auto" width="100%" src="./images/cats/141418133.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1127255687">
                        <img height="auto" width="100%" src="./images/cats/1127255687.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1318345945">
                        <img height="100%" width="auto" src="./images/cats/1318345945.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1602454163">
                        <img height="100%" width="auto" src="./images/cats/1602454163.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="74555550">
                        <img height="auto" width="100%" src="./images/cats/74555550.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1577540586">
                        <img height="100%" width="auto" src="./images/cats/1577540586.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1185337434">
                        <img height="100%" width="auto" src="./images/cats/1185337434.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1970164712">
                        <img height="100%" width="auto" src="./images/cats/1970164712.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1375251613">
                        <img height="100%" width="auto" src="./images/cats/1375251613.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="1177223253">
                        <img height="100%" width="auto" src="./images/cats/1177223253.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="352353053">
                        <img height="100%" width="auto" src="./images/cats/352353053.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="2088008157">
                        <img height="auto" width="100%" src="./images/cats/2088008157.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="591737784">
                        <img height="100%" width="auto" src="./images/cats/591737784.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="909068024">
                        <img height="100%" width="auto" src="./images/cats/909068024.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="414133737">
                        <img height="100%" width="auto" src="./images/cats/414133737.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
                <li class="cat-btn-li">
                    <button class=" cat-btn <?php echo getSelectedState($curIndex, $selCats)?>" data-id="118341350">
                        <img height="100%" width="auto" src="./images/cats/118341350.png" />
                        <div class="cat-btn-cover"><span class="cat-btn-span"><?php echo $selCats?></span></div>
                    </button>
                </li>
            </ul>
        </div>
        <?php echo $loginMarkup ?>
    </body>
</html>
