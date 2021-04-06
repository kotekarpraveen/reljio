<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json; charset=UTF-8");

error_reporting(E_ALL);


require('../../include/const.php');
//require(AUTO_LOAD_PATH);
require('../../include/errors.php');
require('../../utilities/utilities.php');
require('../../utilities/albumutilities.php');


//Check type of method
if (!isset($_SERVER['REQUEST_METHOD']) || !isset($_SERVER['REQUEST_URI'])) {
    HTTPFailWithCode(400, 'HTTP method or request uri is not set');
}

//Get Type of method request(GET,POST etc..) and request uri
$method = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch ($method) {
    case 'GET':
        get_request($request);
        break;

    case 'POST':
        post_request($request);
        break;

    case 'PUT':
        put_request($request);
        break;

    case 'DELETE':
        delete_request($request);
        break;

    case 'OPTIONS':
        option_request($request);
        break;

    default:
        HTTPFailWithCode(405, "Forbidden request");
}



//GET method
function get_request($request)
{
    $parse_url = parse_url($request);
    $pathinfo = pathinfo($parse_url['path']);
    $id = $pathinfo['filename'];


    error_log($id);


    switch ($id) {
        case 'store':
            error_log("GET INPUT >>>>>>>>>>" . json_encode($_GET));
            $result = storeAlbum(PHOTO_JSON_URL);
            break;

        case 'photo':
            $result = getPhotoDetails($_GET);
            break;

        default:
            HTTPFailWithCode(405, "Forbidden request");
    }
    print json_encode($result);
}

function post_request($request)
{

    HTTPFailWithCode(405, "Forbidden request");
}

function put_request($request)
{
    $parse_url = parse_url($request);
    $pathinfo = pathinfo($parse_url['path']);
    $id = $pathinfo['filename'];

    $putdata = json_decode(file_get_contents("php://input"), true);

    error_log("Putdata==>" . json_encode($putdata));
    if (!isset($putdata['album_id']) && !isset($putdata['photo_id']) && !isset($putdata['title']) && !isset($putdata['url']) && !isset($putdata['thumbnail'])) {
        HTTPFailWithCode(405, 'Please fill mandatory fields.');
    }

    if ($id == "photo") {
        $result = updatePhotoAlbumData($putdata, "photo");
    } else {
        HTTPFailWithCode(405, "Forbidden request");
    }

    print json_encode($result);
}

function delete_request($request)
{
    HTTPFailWithCode(405, "Forbidden request");
}

function option_request($request)
{
    $result = get_dashboard_summary($_SERVER);
    //HTTPFailWithCode(405, "Forbidden request");
}
