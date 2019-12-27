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

    try {
      $sql = " SELECT COUNT(*) FROM k12elsc_appprod.TMP_user_LOAD ;";
      $query = $conn->prepare($sql);
      $query->execute();
      $count = $query->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];

      if ($count == 0) {
        throw new Exception("There are no records in the temporary database.");
      }

      $sql = " SELECT login, eztt_teacher_id, first_name,last_name,pswd, district_id,email_addr,sex,race_id,disabled,loginschoolcode,ed_center_id,
                        change_pswd,loadid,ezlp_teacher,ezlp_admin,ezlp_viewer,dcg_viewer,dcg_editor,dcg_admin,ssn_teacher,ssn_admin,
                        eztt_teacher,eztt_admin, eza_teacher, eza_admin,ezap_teacher, ezap_observer,ezap_admin,site_admin,
                        els_developer,ssn_user_id,dcg_user_id
               FROM k12elsc_appprod.TMP_user_LOAD LIMIT 5;";

      $query = $conn->prepare($sql);
      $query->execute();
      //Fetch all of the rows from our MySQL table.
      $sample = $query->fetchAll(PDO::FETCH_ASSOC);

      $result = ["callStatus" => 0, "count" => $count, "sample" => $sample];
    } catch (Exception $ex) {
        //$conn->rollBack();
        $ex = explode('\'' , $ex)[3];
        echo json_encode(array("callStatus" => 99, "callStatusMessage" => $ex));
        error_log ($ex);
       exit();
    }

    echo json_encode($result);
