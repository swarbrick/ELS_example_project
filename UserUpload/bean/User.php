<?php
    namespace com\els\tools\uu\bean;

    /**
     * Description of Question
     *
     * @author dswarbrick
     */
    class User {

        public $user_id;
        public $login;
        public $eztt_teacher_id;
        public $last_name;
        public $first_name;
        public $pswd;
        public $district_id;
        public $email_addr;
        public $sex;
        public $race_id;
        public $disabled;
        public $loginschoolcode;
        public $ed_center_id;
        public $ed_center_description;
        public $change_pswd;
        public $loadid;
        public $ezlp_teacher;
        public $ezlp_admin;
        public $ezlp_viewer;
        public $dcg_viewer;
        public $dcg_editor;
        public $dcg_admin;
        public $ssn_teacher;
        public $ssn_admin;
        public $eztt_teacher;
        public $eztt_admin;
        public $eza_teacher;
        public $eza_admin;
        public $ezap_teacher;
        public $ezap_observer;
        public $ezap_admin;
        public $site_admin;
        public $els_developer;
        public $ssn_user_id;
        public $dcg_user_id;


        public function getUserId() {
          return $this->user_id;
        }

        public function getLogin() {
            return $this->login;
        }

        public function getEzttTeacherId() {
            return $this->eztt_teacher_id;
        }

        public function getLastName() {
            return $this->last_name;
        }

        public function getFirstName() {
            return $this->first_name;
        }

        public function getPswd() {
            return $this->pswd;
        }

        public function getDistId() {
            return $this->district_id;
        }

        public function getEmail() {
            return $this->email_addr;
        }

        public function getSex() {
            return $this->sex;
        }

        public function getRace() {
            return $this->race_id;
        }

        public function getDisabled() {
            return $this->disabled;
        }

        public function getLoginSchoolCode() {
            return $this->loginschoolcode;
        }

        public function getEdCenter() {
            return $this->ed_center_id;
        }

        public function getEdCenterDescription() {
            return $this->ed_center_description;
        }

        public function getChgPswd() {
            return $this->change_pswd;
        }

        public function getLoad() {
            return $this->loadid;
        }

        public function getEzlpTeacher() {
            return $this->ezlp_teacher;
        }

        public function getEzlpAdmin() {
            return $this->ezlp_admin;
        }

        public function getEzlpViewer() {
            return $this->ezlp_viewer;
        }

        public function getDcgViewer() {
            return $this->dcg_viewer;
        }

        public function getDcgEditor() {
            return $this->dcg_editor;
        }

        public function getDcgAdmin() {
            return $this->dcg_admin;
        }

        public function getSsnTeacher() {
            return $this->ssn_teacher;
        }

        public function getSsnAdmin() {
            return $this->ssn_admin;
        }

        public function getEzttTeacher() {
            return $this->eztt_teacher;
        }

        public function getEzttAdmin() {
            return $this->eztt_admin;
        }

        public function getEzaTeacher() {
            return $this->eza_teacher;
        }

        public function getEzaAdmin() {
            return $this->eza_admin;
        }

        public function getEzapTeacher() {
            return $this->ezap_teacher;
        }

        public function getEzapObserver() {
            return $this->ezap_observer;
        }

        public function getEzapAdmin() {
            return $this->ezap_admin;
        }

        public function getSiteAdmin() {
            return $this->site_admin;
        }

        public function getElsDev() {
            return $this->els_developer;
        }

        public function getSsnUserId() {
            return $this->ssn_user_id;
        }

        public function getDcgUserId() {
            return $this->dcg_user_id;
        }




        public function setUserId($user_id) {
            $this->user_id = $user_id;
        }

        public function setLogin($login) {
            $this->login = $login;
        }

        public function setEzttTeacherId($eztt_teacher_id) {
            $this->eztt_teacher_id = $eztt_teacher_id;
        }

        public function setLastName($last_name) {
            $this->last_name = $last_name;
        }

        public function setFirstName($first_name) {
            $this->first_name = $first_name;
        }

        public function setPswd($pswd) {
            $this->pswd = $pswd;
        }

        public function setDistId($district_id) {
            $this->district_id = $district_id;
        }

        public function setEmail($email_addr) {
            $this->email_addr = $email_addr;
        }

        public function setSex($sex) {
            $this->sex = $sex;
        }

        public function setRace($race_id) {
            $this->race_id = $race_id;
        }

        public function setDisabled($disabled) {
            $this->disabled = $disabled;
        }

        public function setLoginSchoolCode($loginschoolcode) {
            $this->loginschoolcode = $loginschoolcode;
        }

        public function setEdCenter($ed_center_id) {
            $this->ed_center_id = $ed_center_id;
        }

        public function setEdCenterDescription($ed_center_description) {
            $this->ed_center_description = $ed_center_description;
        }

        public function setChgPswd($change_pswd) {
            $this->change_pswd = $change_pswd;
        }

        public function setLoad($loadid) {
            $this->loadid = $loadid;
        }

        public function setEzlpTeacher($ezlp_teacher) {
            $this->ezlp_teacher = $ezlp_teacher;
        }

        public function setEzlpAdmin($ezlp_admin) {
            $this->ezlp_admin = $ezlp_admin;
        }

        public function setEzlpViewer($ezlp_viewer) {
            $this->ezlp_viewer = $ezlp_viewer;
        }

        public function setDcgViewer($dcg_viewer) {
            $this->dcg_viewer = $dcg_viewer;
        }

        public function setDcgEditor($dcg_editor) {
            $this->dcg_editor = $dcg_editor;
        }

        public function setDcgAdmin($dcg_admin) {
            $this->dcg_admin = $dcg_admin;
        }

        public function setSsnTeacher($ssn_teacher) {
            $this->ssn_teacher = $ssn_teacher;
        }

        public function setSsnAdmin($ssn_admin) {
            $this->ssn_admin = $ssn_admin;
        }

        public function setEzttTeacher($eztt_teacher) {
            $this->eztt_teacher = $eztt_teacher;
        }

        public function setEzttAdmin($eztt_admin) {
            $this->eztt_admin = $eztt_admin;
        }

        public function setEzaTeacher($eza_teacher) {
            $this->eza_teacher = $eza_teacher;
        }

        public function setEzaAdmin($eza_admin) {
            $this->eza_admin = $eza_admin;
        }

        public function setEzapTeacher($ezap_teacher) {
            $this->ezap_teacher = $ezap_teacher;
        }

        public function setEzapObserver($ezap_observer) {
            $this->ezap_observer = $ezap_observer;
        }

        public function setEzapAdmin($ezap_admin) {
            $this->ezap_admin = $ezap_admin;
        }

        public function setSiteAdmin($site_admin) {
            $this->site_admin = $site_admin;
        }

        public function setElsDev($els_developer) {
            $this->els_developer = $els_developer;
        }

        public function setSsnUserId($ssn_user_id) {
            $this->ssn_user_id = $ssn_user_id;
        }

        public function setDcgUserId($dcg_user_id) {
            $this->dcg_user_id = $dcg_user_id;
        }


    }
?>
