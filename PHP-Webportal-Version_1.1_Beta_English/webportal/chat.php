<?php
    /**
     * Author: chris at linuxuser.at
     * Licence: MIT
     */

    $fn = "chat.txt";
    $maxlines = 19;

    $nick_maxlength = 10;

    /* Set this to a minimum wait time between posts (in sec) */
    $waittime_sec = 0;

    /* spam keywords */
    $spam[] = "wixer";
    $spam[] = "hurensohn";
    $spam[] = "arschloch";

    /* spam-filter for badwords in nicknames and nickname-ban filter  */
    $nspam[] = "wixer";
    $nspam[] = "hurensohn";
    $nspam[] = "arschloch";
    $nspam[] = "pedo";
    $nspam[] = "pedophil";
    $nspam[] = "pedophile";

    /* IP's to block */
    // $blockip[] = "5.146.84.26";
	$blockip[] = "127.0.0.1";

    $msg = $_REQUEST["m"];
    $n = $_REQUEST["n"];

    if ($waittime_sec > 0) {
        $lastvisit = $_COOKIE["lachatlv"];
        setcookie("lachatlv", time());

        if ($lastvisit != "") {
            $diff = time() - $lastvisit;
            if ($diff < $waittime_sec) { die(); }
        }
    }

    if ($msg != "") {
        if (strlen($msg) < 2) { die(); }
        if (strlen($msg) > 3) {
            /* Smilies are ok */
            if (strtoupper($msg) == $msg) { die(); }
        }
        if (strlen($msg) > 150) { die(); }
        if (strlen($msg) > 15) {
            if (substr_count($msg, substr($msg, 6, 8)) > 1) { die(); }
        }

        foreach ($blockip as $a) {
            if ($_SERVER["REMOTE_ADDR"] == $a) { die(); }
        }

        $mystring = strtoupper($msg);
        foreach ($spam as $a) {
             if (strpos($mystring, strtoupper($a)) === false) {
                 /* Everything Ok Here */
             } else {
                 die();
             }
        }

        foreach ($spam as $a) {
            if (strtoupper($msg) == strtoupper($a)) { die(); }
        }

        $mystring = strtoupper($n);
        foreach ($nspam as $a) {
             if (strpos($mystring, strtoupper($a)) === false) {
                 /* Everything Ok Here */
             } else {
                 die();
             }
        }

        foreach ($nspam as $a) {
            if (strtoupper($n) == strtoupper($a)) { die(); }
        }

        $handle = fopen ($fn, 'r');
        $chattext = fread($handle, filesize($fn)); fclose($handle);

        $arr1 = explode("\n", $chattext);

        if (count($arr1) > $maxlines) {
            /* Pruning */
            $arr1 = array_reverse($arr1);
            for ($i=0; $i<$maxlines; $i++) { $arr2[$i] = $arr1[$i]; }
            $arr2 = array_reverse($arr2);
        } else {
            $arr2 = $arr1;
        }

        $chattext = implode("\n", $arr2);

        // Last spam filter: die if message has already been in the chat history
        if (substr_count($chattext, $msg) > 2) { die(); }

        $out = $chattext.$n.": ".$msg."\n";
        $out = str_replace("\'", "'", $out);
        $out = str_replace("\\\"", "\"", $out);

        $handle = fopen ($fn, 'w'); fwrite($handle, $out.trim()); fclose($handle);
    }
?>