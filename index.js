document.addEventListener("DOMContentLoaded", () => {
  //Save information
  $("#information").submit((e) => {
    e.preventDefault();
    let reference = $("#reference").val();
    //Report Information

    let typeOfEmergency = $("input[name='typeOfEmergency[]']:checked").val();
    let date = $("#date").val();
    let time = $("#time").val();
    let typeOfIncident = $("#typeOfIncident").val();
    let location = $("#location").val();
    let nameOfCaller = $("#nameOfCaller").val();
    let noOfPersonInvolved = $("#noOfPersonInvolved").val();
    //  Patient Information
    let patientName = $("#patientName").val();
    let address = $("#address").val();
    let age = $("#age").val();
    let gender = $('select[name="gender"] option:checked').val();
    let injuryCondition = $("#injuryCondition").val();
    let actionTaken = $("#actionTaken").val();
    let responder = $("#responder").val();

    let infoId = $("#infoId").val();
    let driver = $("#driver").val();
    let member = $("#member").val();
    let dispatch = $("#dispatch").val();
    let preparedby = $("#preparedby").val();

    let data = {
      saveBtn: true,
      reference: reference,
      typeOfEmergency: typeOfEmergency,
      date: date,
      time: time,
      typeOfIncident: typeOfIncident,
      nameOfCaller: nameOfCaller,
      location: location,
      noOfPersonInvolved: noOfPersonInvolved,
      patientName: patientName,
      address: address,
      age: age,
      gender: gender,
      injuryCondition: injuryCondition,
      actionTaken: actionTaken,
      responder: responder,
      infoId: infoId,
      driver: driver,
      member: member,
      dispatch: dispatch,
      preparedby: preparedby,
    };

    $.ajax({
      url: "savedata.php",
      method: "POST",
      data: data,
      success: (data) => {
        swal.fire("Success", data, "success").then((result) => {
          if (result.isConfirmed) {
            window.location.reload();
          }
        });
      },
    });
  });
  const formatTime = (data) => {
    const [hours, minutes] = data.split(":");
    const jsDate = new Date();
    jsDate.setHours(hours, minutes);
    const jsFormattedTime = jsDate.toLocaleTimeString([], {
      hour: "numeric",
      minute: "2-digit",
      hour12: true,
    });
    return jsFormattedTime;
  };
  $(".print-button").each(function () {
    $(this).on("click", () => {
      let reportId = $(this).data("report-id"); // Get the reportId from data attribute
      $("#myModal").modal("show");
      console.log(reportId);
      $.ajax({
        url: "printdata.php",
        method: "GET",
        data: { reportId: reportId },
        dataType: "json",
        success: (data) => {
          const report = data.report;
          const patient = data.patient;
          const fixed = data.fixed;
          $("#fetchedType").text(report.typeOfEmergency);
          $("#fetchedDate").text(report.dateTaken);
          $("#fetchedTime").text(formatTime(report.timeTaken));
          $("#fetchTypeIncident").text(report.typeOfIncident);
          $("#fetchedLocation").text(report.location);
          $("#fetchedCaller").text(report.nameOfCaller);
          $("#fetchedInvolved").text(report.noOfPersonsInvolved);
          $("#fetchedDriver").text(fixed.driver);
          $("#fetchedMembers").text(fixed.members);
          $("#fetchedDispatche").text(fixed.dispatch);
          $("#fetchedPreparedBy").text(fixed.preparedBy);
          const $dataTableBody = $("#modalPatientTable tbody");

          const newRow = `
          <tr>
          <td>${patient.name}</td>
          <td>${patient.address}</td>
          <td>${patient.age}</td>
          <td>${patient.gender}</td>
          <td>${patient.InjuryCondition}</td>
          <td>${patient.actionTaken}</td>
          <td>${patient.responder}</td>
          </tr>
          `;
          $dataTableBody.append(newRow);
        },
      });
    });
  });

  //Print a copy
  $("#printCopyOfReport").click(() => {
    $("#content").printThis({
      importCSS: true,
      importStyle: true,
      removeInline: false,
    });
  });
  //Delete Report
 $(".delete-bitton").each(function(){
  $(this).on("click",()=>{
    let reportId = $(this).data("report-id"); // Get the reportId from data attribute
    $.ajax({
      url:"delete.php",
      method:"POST",
      data: {reportId:reportId},
      success:(data)=>{
        console.log(data)
      }

    })
  })
 })

  $("#closePrint").click(() => {
    window.location.reload();
  });
});
