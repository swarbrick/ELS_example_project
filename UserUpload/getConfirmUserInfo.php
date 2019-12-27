<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    require_once("../toolsCommon.php");
    require_once("./bean/User.php");

    inheritedValidation();
    userAuthorizedApp("User Upload");
    $conn = getDBConn();

// error_log(print_r($_REQUEST, TRUE));

      $users = [];
      $amount = $_REQUEST["hidAccountAmount"];
      $i = 1;
      $userIds = [];
      while ($i <= $amount) {
        $userId = $_REQUEST["userId".$i];
        array_push($userIds, $userId);
        $i++;
      }
      $i = 0;
// error_log(print_r($userIds, TRUE));
      function getUser($uid) {
        global $conn;
        global $users;

        $sql = "SELECT first_name, last_name, ed_center_id FROM k12elsc_appprod.user WHERE user_id = :user_id;";
        $sqlParams = array(":user_id" => $uid);
        $query = $conn->prepare($sql);
        $query->execute($sqlParams);
        if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $user = new \com\els\tools\uu\bean\User();
          $user->setFirstName($row["first_name"]);
          $user->setLastName($row["last_name"]);
          $user->setEdCenter($row["ed_center_id"]);
          $user->setUserId($uid);
        }

        $ed_center_id = $user->getEdCenter();

        $sql = "SELECT description FROM k12elsc_appprod.education_center_ref WHERE ed_center_id = :ed_center_id;";
        $sqlParams = array(":ed_center_id" => $ed_center_id);
        $query = $conn->prepare($sql);
        $query->execute($sqlParams);

        if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $user->setEdCenterDescription($row["description"]);
        }

        array_push($users, $user);
      }

    try {
      while ($i < $amount) {
        getUser($userIds[$i]);
        $i++;
      }
// error_log(print_r($users, TRUE));

      $m = 0;
      $n = 0;
      $p = count($users);

      while($m < $p) {
        while($n < $p) {
          if ($m <> $n) {
            if ($users[$m]->getEdCenter() == $users[$n]->getEdCenter()) {
              throw new Exception("At least two of the ed centers connected to the user_ids you provided are the same.");
            }
          }
          $n++;
        }
        $m++;
      }

      $result = ["callStatus" => 0, "users" => $users];

    } catch (Exception $ex) {
        //$conn->rollBack();
        $ex = explode('\'' , $ex)[3];
        echo json_encode(array("callStatus" => 99, "callStatusMessage" => $ex));
        error_log ($ex);
       exit();
    }

    echo json_encode($result);
