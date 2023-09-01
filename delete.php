<?php 
require_once "connection.php";
if (isset($_POST["reportId"])){
    $id= $_POST["reportId"];

    $deletepatientData= $conn->prepare("DELETE FROM patientinformation WHERE reportId=?");
    $deletepatientData->bind_param("i",$id);
    $deletepatientData->execute();

    $deleteInformation= $conn->prepare("DELETE FROM reportinformation WHERE referenceId=?");
    $deleteInformation->bind_param("i",$id);
    $deleteInformation->execute();

    echo "deleted"
}