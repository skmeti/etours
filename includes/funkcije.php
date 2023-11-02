<?php

setlocale(LC_ALL, "Croatian"); // za windows
setlocale(LC_ALL, "hr_HR"); // za unix

function slugify($str) 
{

    $search = array('Ș', 'Ț', 'ş', 'ţ', 'Ş', 'Ţ', 'ș', 'ț', 'î', 'â', 'ă', 'Î', 'Â', 'Ă', 'ë', 'Ë', 'Č', 'Ć', 'č', 'ć','Đ','đ','Ž','ž','Š','š');
    $replace = array('s', 't', 's', 't', 's', 't', 's', 't', 'i', 'a', 'a', 'i', 'a', 'a', 'e', 'E','C','C','c','c','D','d','Z','z','S','s');
    $str = str_ireplace($search, $replace, strtolower(trim($str)));
    $str = preg_replace('/[^\w\d-\ ]/', '', $str);
    $str = str_replace(' ', '-', $str);
    return preg_replace('/-{2,}/', '-', $str);
}

function firstImage($table, $tableid, $size, $class)
{

	global $db;

    $query = "SELECT * FROM images WHERE table_name ='".$table."' AND table_id = '".$tableid."' ORDER BY id ASC LIMIT 0,1";
    $result = mysqli_query ( $db,  $query );
    $data = mysqli_fetch_assoc ( $result ); 

    if ($data['file']) {

        echo '<img src="/images/' . $size . "/" . $data['file'] . '" alt=""  class="',$class,'" />';

    } 
}

function firstImageSlider($tableid)
{

    global $db;

    $query = "SELECT * FROM images WHERE table_name ='slider' AND table_id = '".$tableid."' ORDER BY id ASC LIMIT 0,1";
    $result = mysqli_query ( $db,  $query );
    $data = mysqli_fetch_assoc ( $result ); 

    if ($data['file']) {

        echo '<img src="/images/special/',$data['file'],'" data-u="image" />';

    } 
}


function makeGallery($table, $tableid, $size, $class)
{

    global $db;

    $query = "SELECT * FROM images WHERE table_name ='".$table."' AND table_id = '".$tableid."' ORDER BY id";
    $result = mysqli_query ( $db,  $query );
    while ($data = mysqli_fetch_assoc ( $result )){

        if ($data['file']) {

            echo '<div class="col-md-4 imageGallery">
                <a class="galleryStart" rel="galerija" href="/images/large/' . $data['file'] . '">
                <img src="/images/' . $size . "/" . $data['file'] . '" alt=""  class="',$class,'" /></a></div>';

        }
    } 
}

function downloadFiles($table, $tableid, $size, $class)
{

    global $db;

    $query = "SELECT * FROM files WHERE table_name ='".$table."' AND table_id = '".$tableid."' ORDER BY id";
    $result = mysqli_query ( $db,  $query );
    while ($data = mysqli_fetch_assoc ( $result )){

        if ($data['file']) {

            echo '<div class="col-md-12 filedownloaddiv">
            <a  href="/files/' . $data['file'] . '">
                <img src="/assets/img/pdfs-512.png" alt=""  class="',$class,'" /> Tlocrt stana u PDFu</div></a>';

        }
    } 
}


?>