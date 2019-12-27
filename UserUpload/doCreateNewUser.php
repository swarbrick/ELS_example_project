<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    require_once("../toolsCommon.php");
    require_once("./bean/User.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/../Private/ElsAuth/UserAuthInterface.php");

    inheritedValidation();
    userAuthorizedApp("User Upload");


    $conn = getDBConn();
    $userData = $_REQUEST;
// error_log(print_r($userData, TRUE));
// error_log($userData["inpLogin"]);
      try {
        $login = $userData["inpLogin"];
        $district_id = $userData["inpDistrictId"];
        $ed_center_id = $userData["inpEdCenterId"];

        $sql = "SELECT COUNT(*) FROM k12elsc_appprod.district_ref WHERE district_id = :district_id;";
        $sqlParams = array(":district_id" => $district_id);

        $query = $conn->prepare($sql);
        $query->execute($sqlParams);
        $count = $query->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
        if ($count < 1) {
            throw new Exception("That district number is not found in the permanent database.");
        }

        $sql = "SELECT COUNT(*) FROM k12elsc_appprod.user WHERE login = :login AND ed_center_id = :ed_center_id;";
        $sqlParams = array(":login" => $login, ":ed_center_id" => $ed_center_id);

        $query = $conn->prepare($sql);
        $query->execute($sqlParams);
        $count = $query->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
        if ($count > 0) {
            throw new Exception("That combination of login and ed_center_id is already in use in the permanent database.");
        }

        $user = NULL;

          $user = new com\els\tools\uu\bean\User();
          $user->setLogin($userData["inpLogin"]);
          $user->setEzttTeacherId($userData["inpEzttTeacherId"]);
          $user->setLastName($userData["inpLastName"]);
          $user->setFirstName($userData["inpFirstName"]);
          $user->setPswd($userData["inpPswd"]);
          $user->setDistId($userData["inpDistrictId"]);
          $user->setEmail($userData["inpEmailAddress"]);
          $user->setSex($userData["inpSex"]);
          $user->setRace($userData["inpRaceId"]);
          $user->setDisabled($userData["inpDisabled"]);
          $user->setLoginSchoolCode($userData["inpLoginSchoolCode"]);
          $user->setEdCenter($userData["inpEdCenterId"]);
          $user->setChgPswd($userData["selChgPswd"]);
          $user->setEzlpTeacher($userData["selEzlpT"]);
          $user->setEzlpAdmin($userData["selEzlpA"]);
          $user->setEzlpViewer($userData["selEzlpV"]);
          $user->setDcgViewer($userData["selDcgV"]);
          $user->setDcgEditor($userData["selDcgE"]);
          $user->setDcgAdmin($userData["selDcgA"]);
          $user->setSsnTeacher($userData["selSsnT"]);
          $user->setSsnAdmin($userData["selSsnA"]);
          $user->setEzttTeacher($userData["selEzttT"]);
          $user->setEzttAdmin($userData["selEzttA"]);
          $user->setEzaTeacher($userData["selEzaT"]);
          $user->setEzaAdmin($userData["selEzaA"]);
          $user->setEzapTeacher($userData["selEzapT"]);
          $user->setEzapObserver($userData["selEzapO"]);
          $user->setEzapAdmin($userData["selEzapA"]);
          $user->setSiteAdmin($userData["selSiteAdmin"]);
          $user->setElsDev($userData["selElsDev"]);
          $user->setSsnUserId($userData["inpSsnUserId"]);
          $user->setDcgUserId($userData["inpDcgUserId"]);

            $a = $user->getLogin();
            $b = $user->getEzttTeacherId();
            $c = $user->getFirstName();
            $d = $user->getLastName();
            $e = $user->getPswd();
            $f = $user->getDistId();
            $g = $user->getEmail();
            $h = $user->getSex();
            $i = $user->getRace();
            $j = $user->getDisabled();
            $k = $user->getLoginSchoolCode();
            $l = $user->getEdCenter();
            $m = $user->getChgPswd();
            $o = $user->getEzlpTeacher();
            $p = $user->getEzlpAdmin();
            $q = $user->getEzlpViewer();
            $r = $user->getDcgViewer();
            $s = $user->getDcgEditor();
            $t = $user->getDcgAdmin();
            $u = $user->getSsnTeacher();
            $v = $user->getSsnAdmin();
            $w = $user->getEzttTeacher();
            $x = $user->getEzttAdmin();
            $y = $user->getEzaTeacher();
            $z = $user->getEzaAdmin();
            $aa = $user->getEzapTeacher();
            $bb = $user->getEzapObserver();
            $cc = $user->getEzapAdmin();
            $dd = $user->getSiteAdmin();
            $ee = $user->getElsDev();
            $ff = $user->getSsnUserId();
            $gg = $user->getDcgUserId();

// error_log(print_r($user, TRUE));
// error_log($ff);
// exit();

            $sql = "INSERT INTO k12elsc_appprod.user (login, eztt_teacher_id, first_name,last_name,pswd, district_id,email_addr,sex,race_id,disabled,loginschoolcode,ed_center_id,
              change_pswd,ezlp_teacher,ezlp_admin,ezlp_viewer,dcg_viewer,dcg_editor,dcg_admin,ssn_teacher,ssn_admin,
              eztt_teacher,eztt_admin, eza_teacher, eza_admin,ezap_teacher, ezap_observer,ezap_admin,site_admin,
              els_developer,ssn_user_id,dcg_user_id)
                    VALUES ('$a', '$b', '$c', '$d', '$e', '$f', '$g',
                    '$h', '$i', '$j', '$k', '$l', '$m', '$o',
                    '$p', '$q', '$r', '$s', '$t', '$u', '$v', '$w',
                    '$x', '$y', '$z', '$aa', '$bb', '$cc', '$dd', '$ee',
                    '$ff', '$gg');";

            $query = $conn->prepare($sql);
            $query->execute();

            $perm_user_id = $conn->lastInsertId();
            if($perm_user_id) {
              com\els\auth\user\UserAuthInterface::CreateElsAuthRecAndMap($conn, $perm_user_id, $a, $e, $g, $l, 1);
            }
// error_log($perm_user_id);

      } catch (Exception $ex) {
          //$conn->rollBack();
          $ex = explode('\'' , $ex)[3];
          echo json_encode(array("callStatus" => 99, "callStatusMessage" => $ex));
          error_log($ex);
         exit();
      }

    $callStatus = 0;

    echo json_encode(array("callStatus" => $callStatus));
