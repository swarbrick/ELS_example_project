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

    $cleverId = $_REQUEST["hidCleverUserName2"];
    $email = $_REQUEST["hidCleverEmail2"];
    $password =  password_hash( "Thi5 Us3r Has Not Set Up A PaSsw0Rd!!" , PASSWORD_DEFAULT);
    $external_provider_id = 2;

    $amount = $_REQUEST["hidAccountAmount2"];
    $usersJson = $_REQUEST["hidUsers"];
    $users = json_decode($usersJson, TRUE);
    $auth_role_id = 0;

    try {
      $sql = "INSERT INTO k12elsc_appprod.login_auth (user_name, password, email_addr, external_provider_id) VALUES (:user_name, :password, :email_addr, :external_provider_id);";
      $sqlParams = array(":user_name" => $cleverId, ":email_addr" => $email, ":password" => $password, ":external_provider_id" => $external_provider_id);

      $query = $conn->prepare($sql);
      $query->execute($sqlParams);

      $login_auth_id = $conn->lastInsertId();

      $i = 0;
      while($i < count($users)) {
        $user = $users[$i];
        $user_id = $user["user_id"];
        $ed_center_id = $user["ed_center_id"];

        $sql = "INSERT INTO k12elsc_appprod.login_auth_user_map (login_auth_id, auth_role_id, user_id, ed_center_id) VALUES (:login_auth_id, :auth_role_id, :user_id, :ed_center_id);";
        $sqlParams = array(":login_auth_id" => $login_auth_id, ":auth_role_id" => $auth_role_id, ":user_id" => $user_id, ":ed_center_id" => $ed_center_id);

        $query = $conn->prepare($sql);
        $query->execute($sqlParams);

        $i++;
      }



      $result = ["callStatus" => 0];

    } catch (Exception $ex) {
        //$conn->rollBack();
        $ex = explode('\'' , $ex)[3];
        echo json_encode(array("callStatus" => 99, "callStatusMessage" => $ex));
        error_log ($ex);
       exit();
    }

    echo json_encode($result);
