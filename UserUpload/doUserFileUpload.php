<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    require_once("../toolsCommon.php");

    inheritedValidation();
    userAuthorizedApp("User Upload");

    $conn = getDBConn();

    $filename = $_FILES["uploadUserFile"]["tmp_name"];
    $isOK = ($_FILES["uploadUserFile"]["size"] > 0);

    if ($isOK) {

      function EmptyStringToZero($field) {
        if ($field = '') {
          $field = 0;
        }
      }

      try {

        $sql = " DELETE FROM k12elsc_appprod.TMP_user_LOAD ;";
        $query = $conn->prepare($sql);
        $query->execute();

        $insSql_1 = "INSERT INTO k12elsc_appprod.TMP_user_LOAD ".
                    "(login, eztt_teacher_id, first_name, last_name, pswd, district_id, email_addr, sex, race_id, disabled,loginschoolcode, ed_center_id,
                      change_pswd, loadid, ezlp_teacher, ezlp_admin, ezlp_viewer, dcg_viewer, dcg_editor, dcg_admin, ssn_teacher, ssn_admin,
                      eztt_teacher, eztt_admin, eza_teacher, eza_admin, ezap_teacher, ezap_observer, ezap_admin, site_admin,
                      els_developer, ssn_user_id, dcg_user_id)";

          $csv = array_map('str_getcsv', file($filename));
          $recNum = 0;
          $valuesStr = "";
          $valDelim = " VALUES";
          foreach ($csv as $csvrow) {
            $recNum ++;
            if (count($csvrow) !== 33) {
              throw new Exception("Row number ".$recNum." does not have 33 columns that are delimited by commas.");
            }
            if($recNum == 1) {
// error_log(print_r($csvrow, TRUE));
              if (strpos($csvrow[6], '@') == false) {
                throw new Exception("Does your file have a header row at the top?");
              }

              $distRef = $csvrow[5];
// error_log($distRef);

              $sql = " SELECT COUNT(*) FROM k12elsc_appprod.district_ref
                WHERE district_id = :district_id;";
              $sqlParams = array(":district_id" => $distRef);

              $query = $conn->prepare($sql);
              $query->execute($sqlParams);
              $row = $query->fetch(\PDO::FETCH_ASSOC);
// error_log($row["COUNT(*)"]);
              if ($row["COUNT(*)"] < 1) {
                throw new Exception("There is not a record in the DB that matches that district_id.");
              }


            } else {
              if ($csvrow[5] != $distRef) {
                throw new Exception("The district number for row number ".$recNum." is not the same as the district number for the top row of the file.");
              }
            }

            $login = $csvrow[0];
            $ezTeacherId = $csvrow[1];
            $first = $csvrow[2];
            $last = $csvrow[3];
            $pswd = $csvrow[4];
            $distId = $csvrow[5];
            $email = $csvrow[6];
            $sex = $csvrow[7];
            $race = $csvrow[8];
            $disabled = $csvrow[9];
            $loginSchCd = $csvrow[10];
            $edCentId = $csvrow[11];
            $chgPswd = $csvrow[12];
            $loadId = $csvrow[13];

            $ezlpTeacher = $csvrow[14];
            $ezlpAdmin = $csvrow[15];
            $ezlpViewer = $csvrow[16];
            $dcgViewer = $csvrow[17];
            $dcgEditor = $csvrow[18];
            $dcgAdmin = $csvrow[19];
            $ssnTeacher = $csvrow[20];
            $ssnAdmin = $csvrow[21];
            $ezttTeacher = $csvrow[22];
            $ezttAdmin = $csvrow[23];
            $ezaTeacher = $csvrow[24];
            $ezaAdmin = $csvrow[25];
            $ezapTeacher = $csvrow[26];
            $ezapObserver = $csvrow[27];
            $ezapAdmin = $csvrow[28];
            $siteAdmin = $csvrow[29];

            $elsDev = $csvrow[30];
            $ssnUserId = $csvrow[31];
            $dcgUserId = $csvrow[32];

            if (strpos($email, "'") == true) {
              $email = str_replace("'", "\'", $email);
            }

            EmptyStringToZero($ezlpTeacher);
            EmptyStringToZero($ezlpAdmin);
            EmptyStringToZero($ezlpViewer);
            EmptyStringToZero($dcgViewer);
            EmptyStringToZero($dcgEditor);
            EmptyStringToZero($dcgAdmin);
            EmptyStringToZero($ssnTeacher);
            EmptyStringToZero($ssnAdmin);
            EmptyStringToZero($ezttTeacher);
            EmptyStringToZero($ezttAdmin);
            EmptyStringToZero($ezaTeacher);
            EmptyStringToZero($ezaAdmin);
            EmptyStringToZero($ezapTeacher);
            EmptyStringToZero($ezapObserver);
            EmptyStringToZero($ezapAdmin);
            EmptyStringToZero($siteAdmin);


            $valuesStr .= $valDelim."('$login','$ezTeacherId','$first','$last','$pswd','$distId','$email','$sex','$race','$disabled',";
            $valuesStr .= "'$loginSchCd','$edCentId','$chgPswd','$loadId','$ezlpTeacher','$ezlpAdmin','$ezlpViewer','$dcgViewer','$dcgEditor','$dcgAdmin',";
            $valuesStr .= "'$ssnTeacher','$ssnAdmin','$ezttTeacher','$ezttAdmin','$ezaTeacher','$ezaAdmin','$ezapTeacher','$ezapObserver','$ezapAdmin','$siteAdmin',";
            $valuesStr .= "'$elsDev','$ssnUserId','$dcgUserId')";

            $valDelim = ",";

            if (fmod($recNum, 100) == 0) {
                // finish out Values string and do insert
               $sql = $insSql_1.$valuesStr;
// if ($recNum == 800) { error_log($sql);}
               //error_log("sql = " . $sql);
                   //error_log(print_r($params, true));
                   $query = $conn->prepare($sql);
                   $query->execute();

               // Reset the Values Block
               $valDelim = " ";
               $valuesStr = " VALUES";
            }
          }

          if ($valuesStr <> " VALUES") {
                 // At end of loop insert the remaining Values block
                $sql = $insSql_1.$valuesStr;


                    $query = $conn->prepare($sql);
                    $query->execute();

          }

      } catch (Exception $ex) {
          //$conn->rollBack();
          $ex = explode('\'' , $ex)[3];
          echo json_encode(array("callStatus" => 99, "callStatusMessage" => $ex));
          error_log ($ex);
         exit();
      }
    }

    $callStatus = 0;


    echo json_encode(array("callStatus" => $callStatus));
