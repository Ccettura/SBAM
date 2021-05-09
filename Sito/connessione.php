<?php

function OpenCon()
{
    $dbhost = "mattone.ddns.net";
    $dbuser = "sbam";
    $dbpass = "cipolla";
    $db = "SBAM";
    $port = 61000;
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db, $port) or die("Connect failed: %s\n" . $conn->error);

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}

?>
