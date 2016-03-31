<?php
function getRelTimeArr($time1, $time2 = NULL, $output = 'years,months,weeks,days,hours,minutes,seconds') {
    $output = preg_split('/[^a-z]+/', strtolower((string) $output));

    if (empty($output)) {
        return FALSE;
    }

    extract(array_flip($output), EXTR_SKIP);

    $time1  = max(0, (int) $time1);
    $time2  = empty($time2) ? time() : max(0, (int) $time2);
    $timespan = abs($time1 - $time2);

    isset($years) and $timespan -= 31556926 * ($years = (int) floor($timespan / 31556926));
    isset($months) and $timespan -= 2629744 * ($months = (int) floor($timespan / 2629743.83));
    isset($weeks) and $timespan -= 604800 * ($weeks = (int) floor($timespan / 604800));
    isset($days) and $timespan -= 86400 * ($days = (int) floor($timespan / 86400));
    isset($hours) and $timespan -= 3600 * ($hours = (int) floor($timespan / 3600));
    isset($minutes) and $timespan -= 60 * ($minutes = (int) floor($timespan / 60));
    isset($seconds) and $seconds = $timespan;
    unset($timespan, $time1, $time2);
    $deny = array_flip(array('deny', 'key', 'difference', 'output'));

    $difference = array();
    foreach ($output as $key) {
        if (isset($$key) AND ! isset($deny[$key])) {
            $difference[$key] = $$key;
        }
    }

    if (empty($difference)) {
        return FALSE;
    }

    if (count($difference) === 1) {
        return current($difference);
    }

    return $difference;
}

function getRelTime($time) {
    $relTimeArr = getRelTimeArr($time);
    $relTime = '';
    $relKey = '';
    foreach ($relTimeArr as $key=>$time) {
        if (!empty($time) && empty($relTime)) {
            $relTime = $time;
            $relKey = $key;
            if ($relTime === 1) {
                $relKey = substr($relKey, 0, strlen($relKey)-1);
            }
        }
    }
    return ($relTime.' '.$relKey);
}

?>