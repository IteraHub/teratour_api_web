<?php

use models\models\MarkersQuery;
use \models\models\ImagesQuery;
use models\models\Images;
require_once './vendor/autoload.php';
require_once 'config.php';
header('Content-Type: application/json');


function getMarkers($id){
    $markers = MarkersQuery::create()->findPk($id);
    if(!$markers) {
        echo json_encode(['status'=>false,'msg'=>"record not found"]);
        return;
    } 
    $images =  $markers->getImagess();
    $result = $markers->toArray();
    $result['images'] = $images->toArray();
    echo json_encode(['status'=>true,"data"=>$result]);
}

if (isset($_GET['id'])){
    $id = $_GET['id'];
    getMarkers($id);
}