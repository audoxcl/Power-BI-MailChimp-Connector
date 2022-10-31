<?php

/* #########################
* This code was developed by:
* Audox Ingeniería SpA.
* website: www.audox.com
* email: info@audox.com
######################### */

include 'auth.php';

function getRecords($endpoint, $params){

    $MailChimpDataCenter = $params['data_center'];
    $MailChimpApiKey = $params['api_key'];

    $auth = base64_encode('user:'.$MailChimpApiKey);
    $url = "https://$MailChimpDataCenter.api.mailchimp.com/3.0".$endpoint;
    $url_params = array();
    if(!empty($params['count'])) $url_params['count'] = $params['count'];
    if(!empty($params['offset'])) $url_params['offset'] = $params['offset'];
    if(!empty($url_params)) $url .= "?".http_build_query($url_params);

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Basic '.$auth
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $endpoint_method = end(explode("/", $endpoint));

    if(!in_array($endpoint_method, array("lists", "members", "segments", "campaigns", "reports"))) return $result;

    $result = json_decode($result);

    $total_items = $result->total_items;

    $result = $result->$endpoint_method;

    $records = [];

    if(!empty($result)){
        foreach($result as $record){
            $records[] = $record;
        }
    }

    if($total_items > $params['offset'] + count($result)){
        $params["offset"] = $params['offset'] + count($result);
        $records = array_merge($records, getRecords($endpoint, $params));
    }

    return $records;

}

$headers = getallheaders();
if(function_exists('Auth') && Auth($headers['Authorization']) == false) die(json_encode(array("error_code" => "401", "error_description" => "Unauthorized")));

$params = array(
    "data_center" => $_REQUEST['data_center'],
    "api_key" => $_REQUEST['api_key'],
    "offset" => 0,
    "count" => $_REQUEST['count'],
);

if($_REQUEST["action"] == "getRecords") $result = getRecords($_REQUEST['endpoint'], $params);

echo json_encode($result);

?>