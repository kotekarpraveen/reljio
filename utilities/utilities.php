<?php

function get_error($number)
{
    global $_GLOBAL;
    return array("errorcode" => $number, "error" => $_GLOBAL["error"][$number]);
}


//Fail with HTTP Code
function HTTPFailWithCode($code, $message)
{
    header(reasonForCode($code));
    exit($message);
}


function HTTPRedirect($location)
{
    print json_encode(array('redirect' => $location));
    exit(0);
}

//HTTP reason codes
function reasonForCode($code)
{
    switch ($code) {
        case 100:
            $text = 'Continue';
            break;
        case 101:
            $text = 'Switching Protocols';
            break;
        case 200:
            $text = 'OK';
            break;
        case 201:
            $text = 'Created';
            break;
        case 202:
            $text = 'Accepted';
            break;
        case 203:
            $text = 'Non-Authoritative Information';
            break;
        case 204:
            $text = 'No Content';
            break;
        case 205:
            $text = 'Reset Content';
            break;
        case 206:
            $text = 'Partial Content';
            break;
        case 300:
            $text = 'Multiple Choices';
            break;
        case 301:
            $text = 'Moved Permanently';
            break;
        case 302:
            $text = 'Moved Temporarily';
            break;
        case 303:
            $text = 'See Other';
            break;
        case 304:
            $text = 'Not Modified';
            break;
        case 305:
            $text = 'Use Proxy';
            break;
        case 400:
            $text = 'Bad Request';
            break;
        case 401:
            $text = 'Unauthorized';
            break;
        case 402:
            $text = 'Payment Required';
            break;
        case 403:
            $text = 'Forbidden';
            break;
        case 404:
            $text = 'Not Found';
            break;
        case 405:
            $text = 'Method Not Allowed';
            break;
        case 406:
            $text = 'Not Acceptable';
            break;
        case 407:
            $text = 'Proxy Authentication Required';
            break;
        case 408:
            $text = 'Request Time-out';
            break;
        case 409:
            $text = 'Conflict';
            break;
        case 410:
            $text = 'Gone';
            break;
        case 411:
            $text = 'Length Required';
            break;
        case 412:
            $text = 'Precondition Failed';
            break;
        case 413:
            $text = 'Request Entity Too Large';
            break;
        case 414:
            $text = 'Request-URI Too Large';
            break;
        case 415:
            $text = 'Unsupported Media Type';
            break;
        case 500:
            $text = 'Internal Server Error';
            break;
        case 501:
            $text = 'Not Implemented';
            break;
        case 502:
            $text = 'Bad Gateway';
            break;
        case 503:
            $text = 'Service Unavailable';
            break;
        case 504:
            $text = 'Gateway Time-out';
            break;
        case 505:
            $text = 'HTTP Version not supported';
            break;
        default:
            $text = 'Unknown Error';
            break;
    }

    return 'HTTP/1.1' . ' ' . $code . ' ' . $text;
}




function get_mysql_connection()
{
    $mysqlconn = new mysqli(HOST, DB_USERNAME, DB_PASSWORD, DBNAME);

    if ($mysqlconn->connect_errno) {
        return false;
    }

    return $mysqlconn;
}

function mysql_fix_string($string, $mysqlcon)
{
    if (get_magic_quotes_gpc()) {
        $string = stripslashes($string);
    }

    return $mysqlcon->real_escape_string($string);
}

function get_query_connector($query)
{
    if (!stristr($query, "WHERE")) {
        return " WHERE ";
    } else {
        return " AND ";
    }
}


function processCurl($method, $url, $params)
{
    if ($method === "GET") {
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i == 0) {
                $url .= "?" . $key . "=" . $value;
            } else {
                $url .= "&" . $key . "=" . $value;
            }
            $i++;
        }
    }

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($curl,CURLOPT_HTTPHEADER,array("Content-Type : application/json","Data-Type : application/json"));
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            break;

        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            break;

        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            break;

        case "GET":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            break;

        default:
            break;
    }


    $response = curl_exec($curl);
    //error_log(json_encode($response));
    $data = json_decode($response, true);

    $status = curl_getinfo($curl);

    if ($status['http_code'] !== 200) {
        error_log(json_encode($status));
        return get_error(1006);
    }

    curl_close($curl);

    return $response;
}

//Fail with error json
function HTTPFail($message)
{
    error_log($message);
    print json_encode(array('error' => $message));
    exit(0);
}
