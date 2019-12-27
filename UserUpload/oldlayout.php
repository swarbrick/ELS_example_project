<?php
    require_once("../toolsCommon.php");

    inheritedValidation();
    userAuthorizedApp("User Upload");

    $conn = getDBConn();


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Upload</title>

                <link rel="stylesheet" type="text/css" href="/jquery/css/els_2013/jquery-ui-1.10.2.custom.min.css" />
                <!-- <link rel="stylesheet" type="text/css" href="js/datatables-1.10.15.min.css" /> -->
                <link rel="stylesheet" type="text/css" href="/frameworks/bootstrap/bootstrap-4.3.1-dist/css/bootstrap.min.css"/>
                <link rel="stylesheet" type="text/css" href="/frameworks/MDB/MDBPro4.8.2/css/mdb.min.css" />

                <!-- <script src="js/datatables-1.10.15.min.js"></script> -->
    </head>
    <body>

              <!--tabs -->
              <ul class="nav nav-tabs md-tabs stylish-color" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#uploadActions" role="tab">
                    <i class="fas fa-user pr-2"></i>Upload ELS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#validateActions" role="tab">
                    <i class="fas fa-heart pr-2"></i>Validate ELS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#publishActions" role="tab">
                    <i class="fas fa-heart pr-2"></i>Publish ELS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#createActions" role="tab">
                    <i class="fas fa-heart pr-2"></i>Create ELS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#createCleverActions" role="tab">
                    <i class="fas fa-heart pr-2"></i>Create Clever</a>
                </li>
                <li class="nav-item ml-auto">
                  <div class="nav-link" data-toggle="tab" id="btnReturnIndex" role="tab">
                    <i class="fas fa-heart pr-2"></i>Tool Index</div>
                </li>
                <li class="nav-item">
                  <div class="nav-link" data-toggle="tab" id="btnLogout" role="tab">
                    <i class="fas fa-heart pr-2"></i>Sign Out</div>
                </li>
              </ul>
        <!--tabs -->
        <div class="tab-content"><!--everything else beside tabs and resp-->

          <div class="tab-pane fade in show active " id="uploadActions" role="tabpanel">
            <div class="row">

              <div class="col-md-3">
                <ul class="nav md-pills  flex-column" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#uploadUser" role="tab">Upload Single District User File
                      <i class="fas fa-download ml-2"></i>
                    </a>
                  </li>
                </ul>
              </div>

              <div class="col-md-9">
                <div class="tab-content vertical">
                  <div class="tab-pane fade in show active" id="uploadUser" role="tabpanel">
                    <p><strong>This step uploads your single district user document to the temporary table.</strong></p><br>
                    <p>This file should be delimited by commas. It should not have a header row. It should not have a blank row at the beginning or end. It shouldn't have commas at the end of rows. It should not include a "created_at" column. Its data should be divided into the following columns:</p>
                    <p>login, eztt_teacher_id, first_name, last_name, pswd, district_id, email_addr, sex, race_id, disabled, loginschoolcode, ed_center_id,
                        change_pswd, loadid, ezlp_teacher, ezlp_admin, ezlp_viewer, dcg_viewer, dcg_editor, dcg_admin, ssn_teacher, ssn_admin,
                        eztt_teacher, eztt_admin, eza_teacher, eza_admin, ezap_teacher, ezap_observer, ezap_admin, site_admin,
                        els_developer, ssn_user_id, dcg_user_id</p><br><br>
                    <form name="uploadUserForm" id="uploadUserForm" enctype="multipart/form-data">
                        <strong><label>Single District User File: </label></strong><br><input type="file" id="uploadUserFile" name="uploadUserFile" ><br><br>
                        <br><button id="btnUploadUser">Submit</button>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="tab-pane fade" id="validateActions" role="tabpanel">
            <div class="row">

              <div class="col-md-3">
                <ul class="nav md-pills  flex-column" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#validateTemp" role="tab">Validate Temporary Table
                      <i class="fas fa-download ml-2"></i>
                    </a>
                  </li>
                </ul>
              </div>

              <div class="col-md-9">
                <div class="tab-content vertical">
                  <div class="tab-pane fade in show active" id="validateTemp" role="tabpanel">
                    <p><strong>This step helps you inspect the records in the temporary table.</strong></p><br>
                    <button id="btnValidateTemp">See Sample</button><br><br>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="tab-pane fade" id="publishActions" role="tabpanel">
            <div class="row">

              <div class="col-md-3">
                <ul class="nav md-pills  flex-column" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#publishUsers" role="tab">Publish Records in Temporary Table to Permanent Table
                      <i class="fas fa-download ml-2"></i>
                    </a>
                  </li>
                </ul>
              </div>

              <div class="col-md-9">
                <div class="tab-content vertical">
                  <div class="tab-pane fade in show active" id="publishUsers" role="tabpanel">
                    <p><strong>This allows you to attempt to publish what is in the temporary table. Records that are duplicates will not be published. You will be alerted to which records they are if there are any.</strong></p><br>
                    <button id="btnPublishUsers">Publish</button><br><br>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="tab-pane fade" id="createActions" role="tabpanel">
            <div class="row">

              <div class="col-md-3">
                <ul class="nav md-pills  flex-column" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#createUser" role="tab">Create New User
                      <i class="fas fa-download ml-2"></i>
                    </a>
                  </li>
                </ul>
              </div>

              <div class="col-md-9">
                <div class="tab-content vertical">
                  <div class="tab-pane fade in show active" id="createUser" role="tabpanel">
                    <p><strong>This provides a form that allows you to create a single new user. </strong></p>
                    <p><strong>The following fields are required: </strong></p>
                    <p>login, first_name, last_name, pswd, district_id, ed_center_id</p>
                    <p><strong>All other fields will be assigned a default value if they are not specifically entered.</strong></p><br>

                    <form name="frmCreateUser" id="frmCreateUser" enctype="multipart/form-data">
                    <div class="row">
                    <div class="column" style="padding-right: 60px;">
                      <label><strong>login:</strong></label><input type="text" id="inpLogin" name="inpLogin"/><br>
                      <label><strong>eztt_teacher_id:</strong></label><input type="text" id="inpEzttTeacherId" name="inpEzttTeacherId"/><br>
                      <label><strong>first_name:</strong></label><input type="text" id="inpFirstName" name="inpFirstName"/><br>
                      <label><strong>last_name:</strong></label><input type="text" id="inpLastName" name="inpLastName"/><br>
                      <label><strong>pswd:</strong></label><input type="text" id="inpPswd" name="inpPswd"/><br>
                      <label><strong>district_id:</strong></label><input type="text" id="inpDistrictId" name="inpDistrictId"/><br>
                      <label><strong>email_addr:</strong></label><input type="text" id="inpEmailAddress" name="inpEmailAddress"/><br>
                      <label><strong>sex:</strong></label><input type="text" id="inpSex" name="inpSex"/><br>
                      <label><strong>race_id:</strong></label><input type="text" id="inpRaceId" name="inpRaceId"/><br>
                      <label><strong>disabled:</strong></label><input type="text" id="inpDisabled" name="inpDisabled"/><br>
                      <label><strong>loginschoolcode:</strong></label><input type="text" id="inpLoginSchoolCode" name="inpLoginSchoolCode"/><br>
                      <label><strong>ed_center_id:</strong></label><input type="text" id="inpEdCenterId" name="inpEdCenterId"/><br>
                      <label><strong>ssn_user_id:</strong></label><input type="text" id="inpSsnUserId" name="inpSsnUserId"><br>
                      <label><strong>dcg_user_id:</strong></label><input type="text" id="inpDcgUserId" name="inpDcgUserId"><br><br><br>
                    </div>
                    <div class="column" style="padding-right: 60px;">
                        <label><strong>change_pswd:</strong></label>
                        <select class="browser-default custom-select" id="selChgPswd" name="selChgPswd">
                            <option value="Y">Y</option>
                            <option value="N" selected>N</option>
                        </select><br>
                        <label><strong>ezlp_teacher:</strong></label>
                        <select class="browser-default custom-select" id="selEzlpT" name="selEzlpT">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>ezlp_admin:</strong></label>
                        <select class="browser-default custom-select" id="selEzlpA" name="selEzlpA">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>ezlp_viewer:</strong></label>
                        <select class="browser-default custom-select" id="selEzlpV" name="selEzlpV">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>dcg_viewer:</strong></label>
                        <select class="browser-default custom-select" id="selDcgV" name="selDcgV">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>dcg_editor:</strong></label>
                        <select class="browser-default custom-select" id="selDcgE" name="selDcgE">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                      </div>
                      <div class="column" style="padding-right: 60px;">
                        <label><strong>dcg_admin:</strong></label>
                        <select class="browser-default custom-select" id="selDcgA" name="selDcgA">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>ssn_teacher:</strong></label>
                        <select class="browser-default custom-select" id="selSsnT" name="selSsnT">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>ssn_admin:</strong></label>
                        <select class="browser-default custom-select" id="selSsnA" name="selSsnA">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>eztt_teacher:</strong></label>
                        <select class="browser-default custom-select" id="selEzttT" name="selEzttT">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>eztt_admin:</strong></label>
                        <select class="browser-default custom-select" id="selEzttA" name="selEzttA">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>eza_teacher:</strong></label>
                        <select class="browser-default custom-select" id="selEzaT" name="selEzaT">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                      </div>
                      <div class="column">
                        <label><strong>eza_admin:</strong></label>
                        <select class="browser-default custom-select" id="selEzaA" name="selEzaA">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>ezap_teacher:</strong></label>
                        <select class="browser-default custom-select" id="selEzapT" name="selEzapT">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>ezap_observer:</strong></label>
                        <select class="browser-default custom-select" id="selEzapO" name="selEzapO">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>ezap_admin:</strong></label>
                        <select class="browser-default custom-select" id="selEzapA" name="selEzapA">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>site_admin:</strong></label>
                        <select class="browser-default custom-select" id="selSiteAdmin" name="selSiteAdmin">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br>
                        <label><strong>els_developer:</strong></label>
                        <select class="browser-default custom-select" id="selElsDev" name="selElsDev">
                            <option value=0>0</option>
                            <option value=1>1</option>
                        </select><br><br>
                        <button id="btnCreateUser">Create</button><br><br>
                    </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="tab-pane fade" id="createCleverActions" role="tabpanel">
            <div class="row">

              <div class="col-md-3">
                <ul class="nav md-pills  flex-column" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#createClever" role="tab">Create Clever Authorization for Single User
                      <i class="fas fa-download ml-2"></i>
                    </a>
                  </li>
                </ul>
              </div>

              <div class="col-md-9">
                <div class="tab-content vertical">
                  <div class="tab-pane fade in show active" id="createClever" role="tabpanel">
                    <p><strong>This step creates a Clever authorization for a single user. That user may have multiple logins that it is connected to. You will need to know the user_id for each of those logins.</strong></p><br>
                    <form name="frmCleverNumber" id="frmCleverNumber" enctype="multipart/form-data">
                      The following fields are required:
                      <br><label><strong>user_name (clever id):</strong></label><input type="text" id="inpCleverUserName" name="inpCleverUserName"/><br>
                      <label><strong>email_addr:</strong></label><input type="text" id="inpCleverEmail" name="inpCleverEmail"/><br>
                      How many ELS accounts will be connected to the Clever authorization you'd like to create?
                      <br><input type="text" name="createCleverUserIdAmount" id="createCleverUserIdAmount"><br>
                      <button id="btnCleverUserIdAmount">Submit</button>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>
<!--I deleted a closing div here-->
        </div><!--everything else beside tabs and resp-->
        <div id="resp" class="fixed-bottom" ></div>

        <script src="/jquery/js/jquery-2.1.4.min.js"></script>
        <script src="/jquery/js/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="/frameworks/bootstrap/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
        <script src="/frameworks/MDB/MDBPro4.8.2/js/mdb.min.js" ></script>

        <script>

        $(".dialog").dialog({
            autoOpen: false,
            height: 300,
            width: 450,
            modal: true
        });

        $("#btnReturnIndex").button().click(function() {
            window.location.href = "/EzaTools/index.php";
        });

        $("#btnLogout").button().click(function() {
            $.getJSON("/EzaTools/userLogout.php").done(function(data) {
                var redirect = data.callBack.redirect;
                window.location.href = redirect;
            });
        });

        $("#btnUploadUser").button().click(function(e) {
          e.preventDefault();

          if ($('#uploadUserFile').get(0).files.length === 0) {
              $("#resp").append(`
                <div class="alert alert-warning alert-dismissable" style="float: down">
                  File not selected
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                `);
              return false;
          }

          //$("#btnGetStage").attr("disabled", true);

          //console.log("Form Data = " + data);
          var ajaxDataUser = new FormData($("#uploadUserForm")[0]);

          $.each($('#uploadUserFile').get(0).files, function(i, file) {
              // console.log("I = " + i + " File = " + file.name);
              ajaxDataUser.append('uploadUserFile', file);
          });
// console.log(ajaxDataUser);

          $("#resp").append(`
            <div class="alert alert-info alert-dismissable" style="float: down">
              Server uploading files to database
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            `);


          $.ajax({
              url: 'doUserFileUpload.php',  //Server script to process data
              dataType: "json",
              type: 'POST',
              // Form data
              data: ajaxDataUser,
              //Options to tell jQuery not to process data or worry about content-type.
              cache: false,
              contentType: false,
              processData: false,                        //Ajax events
              beforeSend: function() {},
              success: function(data) {
                  //hideUploadForm(true);
                  if (data.callStatus == 0) {
                      statusText = "Uploading Process Completed without errors";
                      statusType = "success";
                  } else {
                      statusText = "Uploading Process had error - "+JSON.stringify(data["callStatusMessage"]);
                      statusType = "danger";
                  }
                  $("#resp").append(`
                    <div class="alert alert-${statusType} alert-dismissable" style="float: down">
                      ${statusText}
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    `);

                  //$("#btnUpload").attr("disabled", false);
                  //$("#ezFiles").val('');
                  //setTimeout(function() {
                  //    $("#resp").html('');
                  //}, 25000);
              },
              error: function(e) {
                  alert("Error Occured: " + e);
                  $("#resp").append(`
                    <div class="alert alert-danger alert-dismissable" style="float: down">
                      Issue with sending processing request to the server.
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    `);
                  //$("#btnUpload").attr("disabled", false);
              }

          });

        })

        $("#btnValidateTemp").button().click(function(e) {
          e.preventDefault();

          $("#resp").append(`
            <div class="alert alert-info alert-dismissable" style="float: down">
              Server retrieving files from database
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            `);

          $.ajax({
              url: 'getTempTable.php',  //Server script to process data
              dataType: "json",
              type: 'POST',
              // Form data
              // data: ajaxData,
              //Options to tell jQuery not to process data or worry about content-type.
              cache: false,
              contentType: false,
              processData: false,                        //Ajax events
              beforeSend: function() {},
              success: function(data) {
                  //hideUploadForm(true);
                  if (data.callStatus == 0) {
                      statusText = "Retrieval Process Completed without errors";
                      statusType = "success";

                      var viewDefString = `<br>
                          <p><strong>The staged data has ${data["count"]} records in it.</strong></p>
                          <p>The following displays up to 5 records from the staged data:</p>
                          <table border="1" cellpadding="4" >
                            <thead>
                              <tr>
                                <th>login</th>
                                <th>eztt_teacher_id</th>
                                <th>first_name</th>
                                <th>last_name</th>
                                <th>pswd</th>
                                <th>district_id</th>
                                <th>email_addr</th>
                                <th>sex</th>
                                <th>race_id</th>
                                <th>disabled</th>
                                <th>loginschoolcode</th>
                                <th>ed_center_id</th>
                                <th>change_pswd</th>
                                <th>loadid</th>
                                <th>ezlp_teacher</th>
                                <th>ezlp_admin</th>
                                <th>ezlp_viewer</th>
                                <th>dcg_viewer</th>
                                <th>dcg_editor</th>
                                <th>dcg_admin</th>
                                <th>ssn_teacher</th>
                                <th>ssn_admin</th>
                                <th>eztt_teacher</th>
                                <th>eztt_admin</th>
                                <th>eza_teacher</th>
                                <th>eza_admin</th>
                                <th>ezap_teacher</th>
                                <th>ezap_observer</th>
                                <th>ezap_admin</th>
                                <th>site_admin</th>
                                <th>els_developer</th>
                                <th>ssn_user_id</th>
                                <th>dcg_user_id</th>
                              </tr>
                            </thead>
                            <tbody>`;

                            var n = 0;
                            while (data["sample"][n]) {
                              viewDefString += `<tr>
                                    <td>${data["sample"][n]["login"]}</td>
                                    <td>${data["sample"][n]["eztt_teacher_id"]}</td>
                                    <td>${data["sample"][n]["first_name"]}</td>
                                    <td>${data["sample"][n]["last_name"]}</td>
                                    <td>${data["sample"][n]["pswd"]}</td>
                                    <td>${data["sample"][n]["district_id"]}</td>
                                    <td>${data["sample"][n]["email_addr"]}</td>
                                    <td>${data["sample"][n]["sex"]}</td>
                                    <td>${data["sample"][n]["race_id"]}</td>
                                    <td>${data["sample"][n]["disabled"]}</td>
                                    <td>${data["sample"][n]["loginschoolcode"]}</td>
                                    <td>${data["sample"][n]["ed_center_id"]}</td>
                                    <td>${data["sample"][n]["change_pswd"]}</td>
                                    <td>${data["sample"][n]["loadid"]}</td>
                                    <td>${data["sample"][n]["ezlp_teacher"]}</td>
                                    <td>${data["sample"][n]["ezlp_admin"]}</td>
                                    <td>${data["sample"][n]["ezlp_viewer"]}</td>
                                    <td>${data["sample"][n]["dcg_viewer"]}</td>
                                    <td>${data["sample"][n]["dcg_editor"]}</td>
                                    <td>${data["sample"][n]["dcg_admin"]}</td>
                                    <td>${data["sample"][n]["ssn_teacher"]}</td>
                                    <td>${data["sample"][n]["ssn_admin"]}</td>
                                    <td>${data["sample"][n]["eztt_teacher"]}</td>
                                    <td>${data["sample"][n]["eztt_admin"]}</td>
                                    <td>${data["sample"][n]["eza_teacher"]}</td>
                                    <td>${data["sample"][n]["eza_admin"]}</td>
                                    <td>${data["sample"][n]["ezap_teacher"]}</td>
                                    <td>${data["sample"][n]["ezap_observer"]}</td>
                                    <td>${data["sample"][n]["ezap_admin"]}</td>
                                    <td>${data["sample"][n]["site_admin"]}</td>
                                    <td>${data["sample"][n]["els_developer"]}</td>
                                    <td>${data["sample"][n]["ssn_user_id"]}</td>
                                    <td>${data["sample"][n]["dcg_user_id"]}</td>
                                  </tr>`;
                                  n++;
                            };

                            viewDefString += `
                                </tbody>
                              </table>
                              `;

                              $("#validateTemp").html(`${viewDefString}`);


                  } else {
                      statusText = "Retrieval Process had error - "+JSON.stringify(data.callStatusMessage);
                      statusType = "danger";
                  }

                  $("#resp").append(`
                    <div class="alert alert-${statusType} alert-dismissable" style="float: down">
                      ${statusText}
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    `);
              },
              error: function(e) {
                  alert("Error Occured: " + e);
                  $("#resp").append(`
                    <div class="alert alert-danger alert-dismissable" style="float: down">
                      Issue with sending processing request to the server
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    `);
              }

          });


        })

        $("#btnPublishUsers").button().click(function(e) {
          e.preventDefault();
          $("#resp").append(`
            <div class="alert alert-info alert-dismissable" style="float: down">
              Server publishing files to permanent database
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            `);

          $.ajax({
              url: 'doPublishUsers.php',  //Server script to process data
              dataType: "json",
              type: 'POST',

              cache: false,
              contentType: false,
              processData: false,                        //Ajax events
              beforeSend: function() {},
              success: function(data) {
                console.log(data);
                  if (data.callStatus == 0) {
                      statusText = "Publishing Process Completed without errors";
                      statusType = "success";

                      if (data["dnp"].length == 0) {
                        $("#publishUsers").html(`<p><strong>All records were published</strong></p>`);
                      } else {
                        var viewUnpublishedUsersString = `<br>
                          <p><strong>${data["dp"]}</strong> records were successfully published.</p>
                          <p><strong>${data["dnp"].length}</strong> records were not able to be published because their logins were duplicates of existing logins within their ed centers.</p>
                          <p>The following is the unpublished records. They are currently available in the temporary table as well. If you perform a new upload to the temporary table, the records currently in the temporary table will be deleted.</p>
                          <table border="1" cellpadding="4">
                            <thead>
                              <tr>
                              <th>login</th>
                              <th>eztt_teacher_id</th>
                              <th>first_name</th>
                              <th>last_name</th>
                              <th>pswd</th>
                              <th>district_id</th>
                              <th>email_addr</th>
                              <th>sex</th>
                              <th>race_id</th>
                              <th>disabled</th>
                              <th>loginschoolcode</th>
                              <th>ed_center_id</th>
                              <th>change_pswd</th>
                              <th>loadid</th>
                              <th>ezlp_teacher</th>
                              <th>ezlp_admin</th>
                              <th>ezlp_viewer</th>
                              <th>dcg_viewer</th>
                              <th>dcg_editor</th>
                              <th>dcg_admin</th>
                              <th>ssn_teacher</th>
                              <th>ssn_admin</th>
                              <th>eztt_teacher</th>
                              <th>eztt_admin</th>
                              <th>eza_teacher</th>
                              <th>eza_admin</th>
                              <th>ezap_teacher</th>
                              <th>ezap_observer</th>
                              <th>ezap_admin</th>
                              <th>site_admin</th>
                              <th>els_developer</th>
                              <th>ssn_user_id</th>
                              <th>dcg_user_id</th>
                              </tr>
                            </thead>
                            <tbody>`;

                            var n = 0;
                            while (data["dnp"][n]) {
                              viewUnpublishedUsersString += `<tr>
                              <td>${data["dnp"][n]["login"]}</td>
                              <td>${data["dnp"][n]["eztt_teacher_id"]}</td>
                              <td>${data["dnp"][n]["first_name"]}</td>
                              <td>${data["dnp"][n]["last_name"]}</td>
                              <td>${data["dnp"][n]["pswd"]}</td>
                              <td>${data["dnp"][n]["district_id"]}</td>
                              <td>${data["dnp"][n]["email_addr"]}</td>
                              <td>${data["dnp"][n]["sex"]}</td>
                              <td>${data["dnp"][n]["race_id"]}</td>
                              <td>${data["dnp"][n]["disabled"]}</td>
                              <td>${data["dnp"][n]["loginschoolcode"]}</td>
                              <td>${data["dnp"][n]["ed_center_id"]}</td>
                              <td>${data["dnp"][n]["change_pswd"]}</td>
                              <td>${data["dnp"][n]["loadid"]}</td>
                              <td>${data["dnp"][n]["ezlp_teacher"]}</td>
                              <td>${data["dnp"][n]["ezlp_admin"]}</td>
                              <td>${data["dnp"][n]["ezlp_viewer"]}</td>
                              <td>${data["dnp"][n]["dcg_viewer"]}</td>
                              <td>${data["dnp"][n]["dcg_editor"]}</td>
                              <td>${data["dnp"][n]["dcg_admin"]}</td>
                              <td>${data["dnp"][n]["ssn_teacher"]}</td>
                              <td>${data["dnp"][n]["ssn_admin"]}</td>
                              <td>${data["dnp"][n]["eztt_teacher"]}</td>
                              <td>${data["dnp"][n]["eztt_admin"]}</td>
                              <td>${data["dnp"][n]["eza_teacher"]}</td>
                              <td>${data["dnp"][n]["eza_admin"]}</td>
                              <td>${data["dnp"][n]["ezap_teacher"]}</td>
                              <td>${data["dnp"][n]["ezap_observer"]}</td>
                              <td>${data["dnp"][n]["ezap_admin"]}</td>
                              <td>${data["dnp"][n]["site_admin"]}</td>
                              <td>${data["dnp"][n]["els_developer"]}</td>
                              <td>${data["dnp"][n]["ssn_user_id"]}</td>
                              <td>${data["dnp"][n]["dcg_user_id"]}</td>
                                  </tr>`;
                                  n++;
                            }

                            viewUnpublishedUsersString += `
                                </tbody>
                              </table>
                              `;

                              $("#publishUsers").html(`${viewUnpublishedUsersString}`);
                      }

                  } else {
                      statusText = "Publishing Process had error - "+JSON.stringify(data["callStatusMessage"]);
                      statusType = "danger";
                  }
                  $("#resp").append(`
                    <div class="alert alert-${statusType} alert-dismissable" style="float: down">
                      ${statusText}
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    `);
              },
              error: function(e) {
                  alert("Error Occured: " + e);
                  $("#resp").append(`
                    <div class="alert alert-danger alert-dismissable" style="float: down">
                      Issue with sending processing request to the server
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    `);
              }

          });
        })

        $("#btnCreateUser").button().click(function(e) {
          e.preventDefault();

          var login = $('#inpLogin').val();
          var first = $('#inpFirstName').val();
          var last = $('#inpLastName').val();
          var pswd = $('#inpPswd').val();
          var district_id = $('#inpDistrictId').val();
          var ed_center_id = $('#inpEdCenterId').val();

          if (!login || !first || !last || !pswd || !district_id || !ed_center_id) {
              $("#resp").append(`
                <div class="alert alert-danger alert-dismissable" style="float: down">
                  Required Fields not Entered
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                `);
              return false;
          }

          var ajaxDataCreateUser = new FormData($("#frmCreateUser")[0]);

          $("#resp").append(`
            <div class="alert alert-info alert-dismissable" style="float: down">
              Server uploading new user to database
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            `);


          $.ajax({
              url: 'doCreateNewUser.php',  //Server script to process data
              dataType: "json",
              type: 'POST',
              // Form data
              data: ajaxDataCreateUser,
              //Options to tell jQuery not to process data or worry about content-type.
              cache: false,
              contentType: false,
              processData: false,                        //Ajax events
              beforeSend: function() {},
              success: function(data) {

                  if (data.callStatus == 0) {
                      statusText = "Uploading Process Completed without errors";
                      statusType = "success";

                      $("#inpLogin").val("");
                      $("#inpEzttTeacherId").val("");
                      $("#inpFirstName").val("");
                      $("#inpLastName").val("");
                      $("#inpPswd").val("");
                      $("#inpDistrictId").val("");
                      $("#inpEmailAddress").val("");
                      $("#inpSex").val("");
                      $("#inpRaceId").val("");
                      $("#inpDisabled").val("");
                      $("#inpLoginSchoolCode").val("");
                      $("#inpEdCenterId").val("");
                      $("#inpSsnUserId").val("");
                      $("#inpDcgUserId").val("");

                      $("#selChgPswd").val("N");
                      $("#selEzlpT").val("0");
                      $("#selEzlpA").val("0");
                      $("#selEzlpV").val("0");
                      $("#selDcgV").val("0");
                      $("#selDcgE").val("0");
                      $("#selDcgA").val("0");
                      $("#selSsnT").val("0");
                      $("#selSsnA").val("0");
                      $("#selEzttT").val("0");
                      $("#selEzttA").val("0");
                      $("#selEzaT").val("0");
                      $("#selEzaA").val("0");
                      $("#selEzapT").val("0");
                      $("#selEzapO").val("0");
                      $("#selEzapA").val("0");
                      $("#selSiteAdmin").val("0");
                      $("#selElsDev").val("0");

                  } else {
                      statusText = "Uploading Process had error - "+JSON.stringify(data["callStatusMessage"]);
                      statusType = "danger";
                  }
                  $("#resp").append(`
                    <div class="alert alert-${statusType} alert-dismissable" style="float: down">
                      ${statusText}
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    `);
              },
              error: function(e) {
                  alert("Error Occured: " + e);
                  $("#resp").append(`
                    <div class="alert alert-danger alert-dismissable" style="float: down">
                      Issue with sending processing request to the server.
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    `);
              }

          });

        })

        $("#btnCleverUserIdAmount").button().click(function(e) {
          e.preventDefault();

          var number = $('#createCleverUserIdAmount').val();
          number = parseInt(number);
          var cleverUserName = $('#inpCleverUserName').val();
          var cleverEmailAddress = $('#inpCleverEmail').val();

          if (!number) {
              $("#resp").append(`
                <div class="alert alert-danger alert-dismissable" style="float: down">
                  At least 1 user_id will be required.
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                `);
              return false;
          }
          if (!cleverUserName || !cleverEmailAddress) {
              $("#resp").append(`
                <div class="alert alert-danger alert-dismissable" style="float: down">
                  All fields are required.
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                `);
              return false;
          }

          var cleverHtmlInsert = `
          <form name="frmCleverData" id="frmCleverData" enctype="multipart/form-data">
            <p>Please fill in the following user_ids:</p>
            <p><span style="opacity: 0">--------------</span><strong>user_ids</strong></p>

          `;

          var i = 1;
          while (i <= number) {
            cleverHtmlInsert += `
            <input type="text" name="userId${i}" id="userId${i}" placeholder="userId${i}"><br>
            `
            i++;
          }

          cleverHtmlInsert += `
          <input type="hidden" id="hidCleverUserName" name="hidCleverUserName" value="${cleverUserName}">
          <input type="hidden" id="hidCleverEmail" name="hidCleverEmail" value="${cleverEmailAddress}">
          <input type="hidden" id="hidAccountAmount" name="hidAccountAmount" value="${number}">
          </form>
          <br><button id="btnCleverConfirm">Request Data for Confirmation</button>
          `

          $("#createClever").html(cleverHtmlInsert);
        })


        $('body').on('click', "#btnCleverConfirm", function(e) {
          e.preventDefault();
          $('#btnCleverConfirm').prop('disabled', true);

          var cleverUserName = $('#hidCleverUserName').val();
          var cleverEmailAddress = $('#hidCleverEmail').val();
          var number = $('#hidAccountAmount').val();

          $("#resp").append(`
            <div class="alert alert-info alert-dismissable" style="float: down">
              Server retrieving data for the user ids provided.
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            `);

          var ajaxDataCleverData = new FormData($("#frmCleverData")[0]);

          $.ajax({
              url: 'getConfirmUserInfo.php',  //Server script to process data
              dataType: "json",
              type: 'POST',
              // Form data
              data: ajaxDataCleverData,
              //Options to tell jQuery not to process data or worry about content-type.
              cache: false,
              contentType: false,
              processData: false,                        //Ajax events
              beforeSend: function() {},
              success: function(data) {
                var users = data["users"];
                var usersJson = JSON.stringify(users);


                  if (data.callStatus == 0) {
                      statusText = "Retrieval Process Completed without errors";
                      statusType = "success";

                      var cleverHtmlInsert2 = `
                      <form name="frmCleverFinish" id="frmCleverFinish" enctype="multipart/form-data">
                        <p>Please confirm that the following users and ed centers are the ones you are looking for:</p>
                      `;

                      i = 0;
                      while (i < number) {
                        cleverHtmlInsert2 += `
                        <h4>${users[i]["first_name"]} ${users[i]["last_name"]} @ ${users[i]["ed_center_description"]}</h4><br>
                        `;
                        i++;
                      }

                      cleverHtmlInsert2 += `
                      <input type="hidden" id="hidCleverUserName2" name="hidCleverUserName2" value="${cleverUserName}">
                      <input type="hidden" id="hidCleverEmail2" name="hidCleverEmail2" value="${cleverEmailAddress}">
                      <input type="hidden" id="hidAccountAmount2" name="hidAccountAmount2" value="${number}">
                      <input type="hidden" id="hidUsers" name="hidUsers" value='${usersJson}'>
                      <br><button id="btnCleverFinish">Create User Authorization(s)</button>
                      </form>
                      `;

                      $("#createClever").html(cleverHtmlInsert2);

                  } else {
                      statusText = "Retrieval Process had error - "+JSON.stringify(data["callStatusMessage"]);
                      statusType = "danger";
                  }
                  $("#resp").append(`
                    <div class="alert alert-${statusType} alert-dismissable" style="float: down">
                      ${statusText}
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    `);
              },
              error: function(e) {
                  alert("Error Occured: " + e);
                  $("#resp").append(`
                    <div class="alert alert-danger alert-dismissable" style="float: down">
                      Issue with sending processing request to the server.
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    `);
                  //$("#btnUpload").attr("disabled", false);
              }

          });
        })

          $('body').on('click', "#btnCleverFinish", function(e) {
            e.preventDefault();
            $('#btnCleverFinish').prop('disabled', true);

            var cleverUserName = $('#hidCleverUserName2').val();
            var cleverEmailAddress = $('#hidCleverEmail2').val();
            var number = $('#hidAccountAmount2').val();
            var usersJson = $('#hidUsers').val();

            $("#resp").append(`
              <div class="alert alert-info alert-dismissable" style="float: down">
                Server uploading new auth to database
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              </div>
              `);

            var ajaxDataCleverData2 = new FormData($("#frmCleverFinish")[0]);

            $.ajax({
                url: 'doCreateCleverAuth.php',  //Server script to process data
                dataType: "json",
                type: 'POST',
                // Form data
                data: ajaxDataCleverData2,
                //Options to tell jQuery not to process data or worry about content-type.
                cache: false,
                contentType: false,
                processData: false,                        //Ajax events
                beforeSend: function() {},
                success: function(data) {
                    if (data.callStatus == 0) {
                        statusText = "Create Process Completed without errors";
                        statusType = "success";

                    } else {
                        statusText = "Create Process had error - "+JSON.stringify(data["callStatusMessage"]);
                        statusType = "danger";
                    }
                    $("#resp").append(`
                      <div class="alert alert-${statusType} alert-dismissable" style="float: down">
                        ${statusText}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      </div>
                      `);
                },
                error: function(e) {
                    alert("Error Occured: " + e);
                    $("#resp").append(`
                      <div class="alert alert-danger alert-dismissable" style="float: down">
                        Issue with sending processing request to the server.
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      </div>
                      `);
                }

            });

          })

        </script>

    </body>
