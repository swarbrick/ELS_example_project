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


      try {
        $sql = "SELECT COUNT(*) FROM k12elsc_appprod.TMP_user_LOAD;";

        $query = $conn->prepare($sql);
        $query->execute();
        $count = $query->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
        if ($count < 1) {
            throw new Exception("There are no records in the temporary database.");
        }

        $user = NULL;
        $users= [];
        $dnp = [];
        $dp = 0;

        $sql = " SELECT user_id, login, eztt_teacher_id, first_name,last_name,pswd, district_id,email_addr,sex,race_id,disabled,loginschoolcode,ed_center_id,
                          change_pswd,loadid,ezlp_teacher,ezlp_admin,ezlp_viewer,dcg_viewer,dcg_editor,dcg_admin,ssn_teacher,ssn_admin,
                          eztt_teacher,eztt_admin, eza_teacher, eza_admin,ezap_teacher, ezap_observer,ezap_admin,site_admin,
                          els_developer,ssn_user_id,dcg_user_id
                 FROM k12elsc_appprod.TMP_user_LOAD;";

        $query = $conn->prepare($sql);
        $query->execute();
        //Fetch all of the rows from our MySQL table.
        while($row=$query->fetch(PDO::FETCH_ASSOC)) {
          $user = new com\els\tools\uu\bean\User();
          $user->setUserId($row["user_id"]);
          $user->setLogin($row["login"]);
          $user->setEzttTeacherId($row["eztt_teacher_id"]);
          $user->setLastName($row["last_name"]);
          $user->setFirstName($row["first_name"]);
          $user->setPswd($row["pswd"]);
          $user->setDistId($row["district_id"]);
          $user->setEmail($row["email_addr"]);
          $user->setSex($row["sex"]);
          $user->setRace($row["race_id"]);
          $user->setDisabled($row["disabled"]);
          $user->setLoginSchoolCode($row["loginschoolcode"]);
          $user->setEdCenter($row["ed_center_id"]);
          $user->setChgPswd($row["change_pswd"]);
          $user->setLoad($row["loadid"]);
          $user->setEzlpTeacher($row["ezlp_teacher"]);
          $user->setEzlpAdmin($row["ezlp_admin"]);
          $user->setEzlpViewer($row["ezlp_viewer"]);
          $user->setDcgViewer($row["dcg_viewer"]);
          $user->setDcgEditor($row["dcg_editor"]);
          $user->setDcgAdmin($row["dcg_admin"]);
          $user->setSsnTeacher($row["ssn_teacher"]);
          $user->setSsnAdmin($row["ssn_admin"]);
          $user->setEzttTeacher($row["eztt_teacher"]);
          $user->setEzttAdmin($row["eztt_admin"]);
          $user->setEzaTeacher($row["eza_teacher"]);
          $user->setEzaAdmin($row["eza_admin"]);
          $user->setEzapTeacher($row["ezap_teacher"]);
          $user->setEzapObserver($row["ezap_observer"]);
          $user->setEzapAdmin($row["ezap_admin"]);
          $user->setSiteAdmin($row["site_admin"]);
          $user->setElsDev($row["els_developer"]);
          $user->setSsnUserId($row["ssn_user_id"]);
          $user->setDcgUserId($row["dcg_user_id"]);

          array_push($users, $user);
        }

        foreach ($users as $user) {

          $login = $user->getLogin();
          $ed_center_id = $user->getEdCenter();
          $temp_user_id = $user->getUserId();

          $sql = "SELECT COUNT(*) FROM k12elsc_appprod.user WHERE login = :login AND ed_center_id = :ed_center_id;";
          $sqlParams = array(":login" => $login, ":ed_center_id" => $ed_center_id);

          $query = $conn->prepare($sql);
          $query->execute($sqlParams);
          $count = $query->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];

          if ($count > 0) {
            $user->setLoad('dnp');

            $loadid = 'dnp';
            $sql = "UPDATE k12elsc_appprod.TMP_user_LOAD SET loadid = :loadid WHERE user_id = :user_id;";
            $sqlParams = array(":user_id" => $temp_user_id, ":loadid" => $loadid);

            $query = $conn->prepare($sql);
            $query->execute($sqlParams);

            array_push($dnp, $user);
          } else {
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
            $n = $user->getLoad();
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
            $hh = $user->getUserId();

            $sql = "INSERT INTO k12elsc_appprod.user (login, eztt_teacher_id, first_name,last_name,pswd, district_id,email_addr,sex,race_id,disabled,loginschoolcode,ed_center_id,
              change_pswd,loadid,ezlp_teacher,ezlp_admin,ezlp_viewer,dcg_viewer,dcg_editor,dcg_admin,ssn_teacher,ssn_admin,
              eztt_teacher,eztt_admin, eza_teacher, eza_admin,ezap_teacher, ezap_observer,ezap_admin,site_admin,
              els_developer,ssn_user_id,dcg_user_id)
                    VALUES ('$a', '$b', '$c', '$d', '$e', '$f', '$g',
                    '$h', '$i', '$j', '$k', '$l', '$m', '$n', '$o',
                    '$p', '$q', '$r', '$s', '$t', '$u', '$v', '$w',
                    '$x', '$y', '$z', '$aa', '$bb', '$cc', '$dd', '$ee',
                    '$ff', '$gg');";

            $query = $conn->prepare($sql);
            $query->execute();

            $perm_user_id = $conn->lastInsertId();
            if($perm_user_id) {
              com\els\auth\user\UserAuthInterface::CreateElsAuthRecAndMap($conn, $perm_user_id, $a, $e, $g, $l, 1);
            }
            $dp++;
// error_log($perm_user_id);
          }
        }

        $sql = "DELETE FROM k12elsc_appprod.TMP_user_LOAD WHERE loadid != 'dnp';";

        $query = $conn->prepare($sql);
        $query->execute();

      } catch (Exception $ex) {
          //$conn->rollBack();
          $ex = explode('\'' , $ex)[3];
          echo json_encode(array("callStatus" => 99, "callStatusMessage" => $ex));
          error_log($ex);
         exit();
      }

    $callStatus = 0;

    echo json_encode(array("callStatus" => $callStatus, "dnp" => $dnp, "dp" => $dp));
