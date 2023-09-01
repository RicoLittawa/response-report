<?php
require_once "connection.php";

if (isset($_GET["reportId"])) {
    $reportId = $_GET["reportId"];
    $getReport = $conn->prepare("SELECT * FROM reportinformation WHERE referenceId = ?");
    $getReport->bind_param("i", $reportId);
    $getReport->execute();
    $result = $getReport->get_result();
    $reportRow = $result->fetch_assoc(); // Fetch single row

    $getPatient = $conn->prepare("SELECT * FROM patientinformation WHERE reportId = ?");
    $getPatient->bind_param("i", $reportId);
    $getPatient->execute();
    $result = $getPatient->get_result();
    $patientRow = $result->fetch_assoc(); // Fetch single row

    $getFixedData= $conn->prepare("SELECT * FROM fixedinformation");
    $getFixedData->execute();
    $result= $getFixedData->get_result();
    $fixedRow= $result->fetch_assoc();

    // Merge report and patient data into a single array
    $combinedData = array("report" => $reportRow, "patient" => $patientRow,"fixed"=> $fixedRow);

    echo json_encode($combinedData);
}
