<?php
// savedata.php
require_once "connection.php";
if (isset($_POST['saveBtn'])) {
    $reference = $_POST['reference'];
    //Report Information
    $typeOfEmergency = $_POST['typeOfEmergency'];
    $date = date("Y-m-d",strtotime($_POST['date']));
    $time = date("H:i", strtotime($_POST['time']));
    $typeOfIncident = $_POST['typeOfIncident'];
    $nameOfCaller = $_POST['nameOfCaller'];
    $location = $_POST['location'];
    $noOfPersonInvolved = $_POST['noOfPersonInvolved'];
    //Patient Information
    $patientName = $_POST['patientName'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $injuryCondition = $_POST['injuryCondition'];
    $actionTaken = $_POST['actionTaken'];
    $responder = $_POST['responder'];
    //Fixed info
    $infoId= $_POST["infoId"];
    $driver= $_POST["driver"];
    $member= $_POST["member"];
    $dispatch= $_POST["dispatch"];
    $preparedby= $_POST["preparedby"];
    $message= "";

    //Update fixed info
    $updateInfo = $conn->prepare("UPDATE fixedinformation SET driver=?, members=?, dispatch=?, preparedBy=? WHERE id = ?");
    $updateInfo->bind_param("ssssi", $driver, $member, $dispatch, $preparedby, $infoId);
    $updateInfo->execute();
    



    $insertReportInfo = $conn->prepare("INSERT INTO reportinformation (referenceId,typeOfEmergency,dateTaken,timeTaken,typeOfIncident,location,nameOfCaller,noOfPersonsInvolved)
    VALUES (?,?,?,?,?,?,?,?) ");
    $insertReportInfo->bind_param("isssssss", $reference,$typeOfEmergency,$date,$time,$typeOfIncident,$location,$nameOfCaller,$noOfPersonInvolved);
   if ($insertReportInfo->execute()){

    $insertPatient = $conn->prepare("INSERT INTO patientinformation (reportId,name,address,age,gender,InjuryCondition,actionTaken,responder) VALUES (?,?,?,?,?,?,?,?)");
    $insertPatient->bind_param("isssssss",$reference,$patientName,$address,$age,$gender,$injuryCondition,$actionTaken,$responder);
    $insertPatient->execute();
    $message.="Saved";
    
    if ($message== "Saved"){
        $newRef = $reference +1;
        $updateRef = $conn->prepare("UPDATE reference set referenceId= ?");
        $updateRef->bind_param("i",$newRef);
        $updateRef->execute();
        echo "Success";
    }else{
        echo "Data not saved";
    }

   }
   else{
    echo "error";
   }
}
