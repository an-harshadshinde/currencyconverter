<?php

    function get_currency($from_Currency, $to_Currency, $amount)
    {
        //Get the amount
        $amount = urlencode($amount);

        //Convert From 
        $from_Currency = urlencode($from_Currency);

        //Convert To
        $to_Currency = urlencode($to_Currency);

        //Google Finance URL for curl request
        $url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";

        //Sent Curl request
        $ch = curl_init();
        $timeout = 0;
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        
        $rawdata = curl_exec($ch);
        curl_close($ch);
        
        //echo "<br>".$rawdata;
        $data = explode('bld>', $rawdata);
        $data = explode($to_Currency, $data[1]);

        //Round the Final Output
        return round($data[0], 2);
    }

    // Call the function to get the currency converted
    $result = get_currency($_GET['from'], $_GET['to'], $_GET['amt']);

?><?=$result?>