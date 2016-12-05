<?php
    
    function clean($input){
       $string = htmlentities($input,ENT_NOQUOTES,'UTF-8');
       $string = str_replace('&euro;',chr(128),$string);
       $string = html_entity_decode($string,ENT_NOQUOTES,'ISO-8859-15');
       return $string;
    }
    function generate($length) {
        $token = '';
        for($i = 0; $i < $length; $i++) {
            $token .= mt_rand(0, 9);
        }
        return $token;
    }
    function encryptor($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'rots_*1-9';
        $secret_iv = '2016-rots*&';

        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    function timeAgo($timeNew,$timeOld) {
    
        $difference = $timeNew - $timeOld;
                
        if ($difference > DAYS) {
            $difference = round($difference/DAYS) . " days ago";
        }
        else if ($difference > HOURS) {
            $difference = round($difference/HOURS) . " hours ago";
        }
        else if ($difference > MINUTES) {
            $difference = round($difference/MINUTES) . " minutes ago";
        }
        else if ($difference > SECONDS) {
            $difference .= " seconds ago";
        }
        return $difference;
    }

    function logAction($action, $message=""){

        $logfile = SITE_ROOT.DS."logs".DS."logfile.txt";
        $new = file_exists($logfile) ? false : true ;

        if ($handle = fopen($logfile, 'a')) {
            $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
            $content = "{$timestamp} | {$action} : {$message} \n";
            fwrite($handle, $content);
            fclose($handle);        
        }
    }

    function convertDate($date){
        $formatted = date('Y-m-d',strtotime(str_replace('/', '-', $date)));
        return $formatted;
    }
    function getDayMonth($date){
        $daymonth = date('m-d',strtotime(str_replace('/', '-', $date)));
        return $daymonth;
    }
    function connect(){
        $link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        if (!$link) {
            die(mysqli_error($link));
        }
        return $link;
    }
    
    function prepare($number){
        $count = 1;
        if (isset($number)) {
            return substr_replace($number,'+255',0,-9);
        }
    }

   
  


