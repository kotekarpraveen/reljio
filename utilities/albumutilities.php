<?php


function storeAlbum($url, $type = "PHOTO")
{
    if (($curlresult = processCurl("GET", $url, array())) && (isset($curlresult['error']))) {
        error_log("Processing curl failed." . json_encode($curlresult));
        return $curlresult;
    }
    //echo count(json_decode($curlresult));

    $insertres = insertAlbumPhotoData(json_decode($curlresult), $type);

    return $insertres;
}


function insertAlbumPhotoData($data, $type = "photo")
{
    if (!($mysqlconn = get_mysql_connection())) {
        error_log("Mysql connection error");
        return get_error(3000);
    }

    $keys = [];
    $values = [];

    $query = null;

    $multivalue = null;

    // print_r($data);
    $n = count($data);
    // echo $n;
    $i = 1;
    foreach ($data as $res) {

        //print_r((array)$res);
        $keys = array_keys((array)$res);
        $values = array_values((array)$res);
        $values[2] = "'" . $values[2] . "'";

        if ($type = "PHOTO") {
            $values[3] = "'" . $values[3] . "'";
            $values[4] = "'" . $values[4] . "'";
        }

        $multivalue .= "(" . implode(',', $values) . ",now(),now())";

        if ($i == $n) {
            break;
        }

        $multivalue .= ", ";

        $i++;
        // error_log($query);
    }

    // /echo "I count " . $i;

    $query .=  "INSERT INTO photo (album_id,photo_id,title,url,thumbnail,createdon,updatedon) values $multivalue";
    if ($type == "ALBUM") {
        $query .=  "INSERT INTO album (user_id,album_id,title,createdon,updatedon) values $multivalue";
    }


    // echo $query;

    error_log($query);

    if (!$mysqlresult = $mysqlconn->query($query)) {

        error_log($mysqlconn->error);
        error_log("mysql error" . json_encode($mysqlresult));
        $mysqlconn->close();
        return get_error(3001);
    }
    return $mysqlconn->insert_id;
}

function getPhotoDetails($filter)
{

    error_log(json_encode($filter));

    if (!($mysqlcon = get_mysql_connection())) {
        error_log("Mysql connection error");
        return get_error(3000);
    }

    $query = "SELECT * FROM photo ";

    if (isset($filter['id'])) {
        $query .= get_query_connector($query) . sprintf(" photo_id= '%s'", mysql_fix_string(trim($filter['id']), $mysqlcon));
    }

    if (isset($filter['albumId'])) {
        $query .= get_query_connector($query) . sprintf(" album_id= '%s'", mysql_fix_string(trim($filter['albumId']), $mysqlcon));
    }

    if (isset($filter['title'])) {
        $query .= get_query_connector($query) . sprintf(" title= '%s'", mysql_fix_string(trim($filter['title']), $mysqlcon));
    }



    $query .= " ORDER BY photo_id desc";

    $page = 1;
    if (!empty($filter['page'])) {
        $page = $filter['page'];
    }

    if ($page) {
        $query .= sprintf(" LIMIT %u , %u", ($page - 1) * DB_PAGE_LIMIT, DB_PAGE_LIMIT);
    }


    error_log($query);

    if (!($result = $mysqlcon->query($query))) {
        error_log("SQL Query Failed: (" . $mysqlcon->errno . ") " . $mysqlcon->error);
        $mysqlcon->close();
        return get_error(3001);
    }

    if ($result->num_rows == 0) {
        $mysqlcon->close();
        return get_error(1001);
    }

    $val = array();
    while ($row = $result->fetch_assoc()) {
        $val[] = $row;
    }

    $mysqlcon->close();
    return $val;
}



function getAlbumDetails($filter)
{

    error_log(json_encode($filter));

    if (!($mysqlcon = get_mysql_connection())) {
        error_log("Mysql connection error");
        return get_error(3000);
    }

    $query = "SELECT * FROM album ";

    if (isset($filter['userId'])) {
        $query .= get_query_connector($query) . sprintf(" user_id= '%s'", mysql_fix_string(trim($filter['userId']), $mysqlcon));
    }

    if (isset($filter['id'])) {
        $query .= get_query_connector($query) . sprintf(" album_id= '%s'", mysql_fix_string(trim($filter['id']), $mysqlcon));
    }

    if (isset($filter['title'])) {
        $query .= get_query_connector($query) . sprintf(" title= '%s'", mysql_fix_string(trim($filter['title']), $mysqlcon));
    }

    $query .= " ORDER BY album_id desc";

    $page = 1;
    if (!empty($filter['page'])) {
        $page = $filter['page'];
    }

    if ($page) {
        $query .= sprintf(" LIMIT %u , %u", ($page - 1) * DB_PAGE_LIMIT, DB_PAGE_LIMIT);
    }


    error_log($query);

    if (!($result = $mysqlcon->query($query))) {
        error_log("SQL Query Failed: (" . $mysqlcon->errno . ") " . $mysqlcon->error);
        $mysqlcon->close();
        return get_error(3001);
    }

    if ($result->num_rows == 0) {
        $mysqlcon->close();
        return get_error(1001);
    }

    $val = array();
    while ($row = $result->fetch_assoc()) {
        $val[] = $row;
    }

    $mysqlcon->close();
    return $val;
}

function updatePhotoAlbumData($data, $type = "photo")
{
    $data['updatedon'] = date('Y-m-d H:m:s');
    if ($type == "album") {
        $fieldvalue = $data['album_id'];

        unset($data['album_id']);
        $res = updateTableByFieldName("album_id", $fieldvalue, $data, $type);
    } else {
        $fieldvalue = $data['photo_id'];
        unset($data['photo_id']);

        $res = updateTableByFieldName("photo_id", $fieldvalue, $data, $type);
    }
    return $res;
}


function updateTableByFieldName($fieldname, $fieldvalue, $data, $table)
{
    $mysqlcon = get_mysql_connection();

    $keys = array_keys($data);
    $last = $keys[count($keys) - 1];

    $query = "UPDATE " . $table . " SET ";

    foreach ($data as $key => $value) {

        $query .= $key . "='" . mysql_fix_string($value, $mysqlcon) . "'";

        if ($key !== $last) {
            $query .= " , ";
        }
    }

    $query .= sprintf(" WHERE %s='%s'", mysql_fix_string($fieldname, $mysqlcon), mysql_fix_string($fieldvalue, $mysqlcon));

    error_log($query);

    if (!($stmt = $mysqlcon->prepare($query))) {
        error_log("Update " . $table . " failed: (" . $mysqlcon->errno . ") " . $mysqlcon->error);

        $mysqlcon->close();
        return get_error(1001);
    }

    if (!($stmt->execute())) {
        error_log("Update " . $table . " failed: (" . $stmt->errno . ") " . $stmt->error);
        $mysqlcon->close();
        return get_error(1001);
    }

    if ($stmt->affected_rows == 0) {
        error_log("No Data to Update:(" . $stmt->errno . ") : " . $stmt->error);
        $mysqlcon->close();
        return get_error(1003);
    }

    $stmt->close();

    $mysqlcon->close();

    return array("success" => $fieldvalue);
}
