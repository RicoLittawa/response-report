<?php
require_once 'connection.php';

$reference = $conn->prepare("SELECT * from reference");
$reference->execute();
$result = $reference->get_result();
$row = $result->fetch_assoc();
$referenceId = $row['referenceId'];
?>
<html lang="en" class="html">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="index.css" />
  <title>Response Report</title>
</head>

<body>
  <!-- Print Report -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Print Report</h5>
        </div>
        <div class="modal-body">
          <div id="content" class="mx-5">
            <header class="mt-5">
              <div id="parentHeader">
                <img src="assets/logo1.jpg" class="modal-logo img-fluid" width="100" height="100" alt="" />
                <div class="text-center">
                  <p class="mb-0 pb-0 text-content">REPUBLIC OF THE PHILIPPINES</p>
                  <h5 class="withBorder">CITY DISASTER RISK REDUCTION AND MANAGEMENT OFFICE</h5>
                  <p class="fst-italic mt-0 pt-0 text-content">
                    Brgy Bolbok, Batangas City, Batangas 4200 <br />
                    (043) 7023902/984-4300/727-2768/cdrrmobatangas@yahoo.com
                  </p>
                </div>
              </div>
            </header>
            <section>
              <p class="fs-6 text-center fw-bold title-size">RESPONSE REPORT</p>
              <div class="d-flex justify-content-between">
                <p class="fw-bold mb-0 mt-0 text-content">Type of Emergency: <span id="fetchedType" class="fw-normal"></span></p>
                <div>
                  <p class="fw-bold mb-0 mt-0 text-content">Date: <span id="fetchedDate" class="fw-normal"></span></p>
                  <p class="fw-bold mb-0 mt-0 text-content">Time of call: <span id="fetchedTime" class="fw-normal"></span></p>
                </div>
              </div>
              <div>
                <p class="fw-bold mb-0 mt-0 text-content">Type of Incident: <span id="fetchTypeIncident" class="fw-normal"></span></p>
                <p class="fw-bold mb-0 mt-0 text-content">Location: <span id="fetchedLocation" class="fw-normal"></span></p>
                <p class="fw-bold mb-0 mt-0 text-content">Name of Caller: <span id="fetchedCaller" class="fw-normal"></span></p>
                <p class="fw-bold mb-0 mt-0 text-content">No. of Person Involved: <span id="fetchedInvolved" class="fw-normal"></span></p>
              </div>
              <div class="pt-3">
                <table class="table table-bordered" id="modalPatientTable">
                  <thead>
                    <tr>
                      <th>NAME</th>
                      <th>ADDRESS</th>
                      <th>AGE</th>
                      <th>GENDER</th>
                      <th>INJURY/CONDITION</th>
                      <th>ACTION TAKEN</th>
                      <th>RESPONDERS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    </tr>
                  </tbody>
                </table>
              </div>
            </section>
            <section class="mx-5 ps-3 pt-4">
              <h6 class="fw-bold text-content">Members Responded:</h6>
              <div class="ms-3">
                <p class="fw-bold mb-0 mt-0 text-content">Driver: <span class="ms-5" id="fetchedDriver"></span></p>
                <p class="fw-bold mb-0 mt-0 text-content">Member/s: <span class="ms-5" id="fetchedMembers"></span></p>
                <p class="fw-bold mb-0 mt-0 text-content">Dispatch: <span class="ms-5" id="fetchedDispatche"></span></p>
              </div>
              <div>
                <p class="pt-3 text-content">Prepared by:</p>
                <p class="fw-bold mb-0 mt-0 text-content" id="fetchedPreparedBy"></p>
                <span class="text-content">Emergency Medical Personal</span>
              </div>
              <h6 class="pt-3 text-content">Verified by:</h6>
              <div>
                <p class="fw-bold mb-0 mt-0 text-content">JULIUS M. MALANTIC,MDRM</p>
                <span class="text-content">Operations and Warning Officer</span>
              </div>
              <div>
                <p class="pt-3 text-content">Noted by:</p>
                <p class="fw-bold mb-0 mt-0 text-content">RODRIGO D. DELA ROCA,RSW,MDRM</p>
                <span class="text-content">OIC Department Head - CDRRMO</span>
              </div>
            </section>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="closePrint" data-bs-dismiss="modal">Close</button>
          <button type="button" id="printCopyOfReport" class="btn btn-primary">Print</button>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <header>
      <img src="./assets/header.png" class="img-fluid header-img object-fit-cover" alt="" width="3000px">
    </header>
    <section id="form-container" class="bg-white">
      <form class="" id="information" method="post">
        <input name="reference" id="reference" type="text" value="<?php echo htmlentities($referenceId) ?>" hidden>
        <h5 class="px-5 pt-5 fw-bold">Report Information</h5>
        <div class="row">
          <div class="col">
            <div class="type-of-emergency px-5 py-3">
              <label for="">Type of Emergency</label>
              <div class="checkbox-container">
                <div class="d-flex">
                  <input name="typeOfEmergency[]" type="radio" value="Medical" id="medical" checked />
                  <label for="" class="pb-1 px-2">Medical</label>
                </div>
                <div class="d-flex">
                  <input name="typeOfEmergency[]" type="radio" value="Trauma" id="trauma" />
                  <label for="" class="pb-1 px-2">Trauma</label>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="d-flex" style="width: 200px;">
              <div class="pe-3">
                <label for="" class="form-label">Date</label>
                <input name="date" type="date" class="form-control" id="date" />
              </div>
              <div>
                <label for="" class="form-label">Time</label>
                <input name="time" type="time" class="form-control" id="time" />
              </div>
            </div>
          </div>
        </div>
        <div class="row px-5 pb-2">
          <div class="col">
            <div class="form-group">
              <label for="form-label">Type of Incident</label>
              <input name="typeOfIncident" type="text" class="form-control" id="typeOfIncident" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="form-label">Location</label>
              <input name="location" type="text" class="form-control" id="location" />
            </div>
          </div>
        </div>
        <div class="row px-5 pb-2">
          <div class="col">
            <div class="form-group">
              <label for="form-label">Name of Caller</label>
              <input name="nameOfCaller" type="text" class="form-control" id="nameOfCaller" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="form-label">No. of Person Involved</label>
              <input name="noOfPersonInvolved" type="text" class="form-control" id="noOfPersonInvolved" />
            </div>
          </div>
        </div>
        <h5 class="px-5 py-3 fw-bold">Patient Information</h5>
        <div class="row px-5">
          <div class="col">
            <div class="mb-3">
              <label for="patientName" class="form-label">Name</label>
              <input type="text" name="patientName" id="patientName" class="form-control" />
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <input type="text" name="address" id="address" class="form-control" />
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="age" class="form-label">Age</label>
              <input type="text" name="age" id="age" class="form-control" />
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="gender" class="form-label">Gender</label>
              <select name="gender" id="gender" class="form-select">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
        </div>
        <div class="mb-3 px-5">
          <label for="injuryCondition" class="form-label">Injury/Condition</label>
          <textarea name="injuryCondition" id="injuryCondition" cols="2" rows="3" class="form-control"></textarea>
        </div>
        <div class="mb-3 px-5">
          <label for="actionTaken" class="form-label">Action Taken</label>
          <textarea name="actionTaken" id="actionTaken" cols="5=2" rows="3" class="form-control"></textarea>
        </div>
        <div class="mb-3 px-5">
          <label for="responder" class="form-label">Responder</label>
          <input type="text" name="responder" id="responder" class="form-control" />
        </div>
        <h5 class="px-5 pt-5 fw-bold">Edit</h5>
        <?php 
        $getfixInfo= $conn->prepare("SELECT * from fixedinformation");
        $getfixInfo->execute();
        $result= $getfixInfo->get_result();
        $data = $result->fetch_assoc();
        
        ?>
        <input type="text" id="infoId" value="<?php echo htmlentities($data["id"]) ?>" hidden/>

        <div class="row">
          <div class="col">
            <div class="mb-3 px-5">
              <label for="driver" class="form-label">Driver</label>
              <input type="text" name="driver" id="driver" class="form-control" value="<?php echo htmlentities($data["driver"]) ?>"/>
            </div>
          </div>
          <div class="col">
            <div class="mb-3 px-5">
              <label for="member" class="form-label">Members</label>
              <textarea name="member" id="member" cols="5=2" rows="3" class="form-control"><?php echo htmlentities($data["members"]) ?></textarea>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col">
            <div class="mb-3 px-5">
              <label for="dispatch" class="form-label">Dispatch</label>
              <input type="text" name="dispatch" id="dispatch" class="form-control" value="<?php echo htmlentities($data["dispatch"]) ?>"/>
            </div>
          </div>
          <div class="col">
            <div class="mb-3 px-5">
              <label for="preparedby" class="form-label">Prepared By</label>
              <input type="text" name="preparedby" id="preparedby" class="form-control" value="<?php echo htmlentities($data["preparedBy"]) ?>"/>
            </div>
          </div>
        </div>
        <div class="d-grid gap-2 px-5 pt-3 pb-5">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
    </section>
    <section>
      <div class="pt-5 bg-white">
        <?php
        $getData = $conn->prepare("SELECT * FROM patientinformation");
        $getData->execute();
        $dataResult = $getData->get_result();
        ?>
        <table class="table table-striped table-bordered px-3" id="patientInfo">
          <t-head>
            <tr>
              <th>id</th>
              <th>Name</th>
              <th>Age</th>
              <th>Gender</th>
              <th>Injury/Condition</th>
              <th>Action Taken</th>
              <th>Responders</th>
              <th>Print Report</th>
            </tr>
          </t-head>
          <t-body>
            <?php
            while ($row = $dataResult->fetch_assoc()) :
            ?>
              <tr>
                <td><?php echo htmlentities($row['reportId']) ?></td>
                <td><?php echo htmlentities($row['name']) ?> <br>
                  <?php echo htmlentities($row['address']) ?></td>
                <td><?php echo htmlentities($row['age']) ?></td>
                <td><?php echo htmlentities($row['gender']) ?></td>
                <td><?php echo htmlentities($row['InjuryCondition']) ?></td>
                <td><?php echo htmlentities($row['actionTaken']) ?></td>
                <td><?php echo htmlentities($row['responder']) ?></td>
                <td>
                  <button class="btn btn-success print-button" type="button" id="printReport" data-report-id="<?php echo htmlentities($row['reportId']) ?>">
                    <i class="fa-solid fa-print"></i>
                  </button>
                  <button type="button" class="btn btn-success" id="editReport" data-report-id="<?php echo htmlentities($row['reportId']) ?>">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <button type="button" class="btn btn-danger delete-bitton" id="deleteReport" data-report-id="<?php echo htmlentities($row['reportId']) ?>">
                    <i class="fa-solid fa-trash"></i></i>
                  </button>

                </td>
              </tr>
            <?php endwhile; ?>
          </t-body>
        </table>
      </div>
    </section>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="./jasonday-printThis-23be1f8/printThis.js"></script>

</html>