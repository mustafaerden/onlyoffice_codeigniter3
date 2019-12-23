<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userop extends CI_Controller {

    public $viewFolder = "";
    public $subViewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users_v";
        $this->load->model("user_model");
        $this->load->library("recaptcha");
    }

    //Login işlemi formu;
    public function login(){

        if (get_active_user()){
            redirect(base_url("dashboard"));
        }


        $widget = $this->recaptcha->getWidget();
        $script = $this->recaptcha->getScriptTag();

        $this->subViewFolder = "login";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Login",
            "widget" => $widget,
            "script" => $script
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

    }

    //Login işleminin yapılması(post);
    public function do_login(){

        if (get_active_user()){
            redirect(base_url("dashboard"));
        }

        $this->load->library("form_validation");

        $recaptcha = $this->input->post('g-recaptcha-response');

        $this->form_validation->set_rules("username", "Username", "required|trim");
        $this->form_validation->set_rules("password", "Password", "required|trim|min_length[5]|max_length[11]");

        $validate = $this->form_validation->run();

        if ($validate && !empty($recaptcha)){

            $user = $this->user_model->get(
                array(
                    "username" => $this->input->post("username"),
                    "password" => sha1(md5($this->input->post("password"))),
                    "isActive" => 1
                )
            );

            if ($user){

                /***********Kullanıcı Yetkilerinin Session a Aktarımı(helperdan)*****************/
                setUserRoles();
                /********************************************************************************/

                $this->session->set_userdata("user", $user);
                $this->session->set_flashdata('durum', '<div class="alert alert-info alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            Welcome '. $user->name . $user->last_name .'!
                                        </div>');
                redirect(base_url("dashboard"));

            }else{
                $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> Username or password is incorrect!
                                        </div>');
                redirect(base_url("login"));
            }

        }else{
            $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> Please confirm you are not a robot!
                                        </div>');

            $widget = $this->recaptcha->getWidget();
            $script = $this->recaptcha->getScriptTag();

            $this->subViewFolder = "login";
            $viewData = array(
                "viewFolder" => $this->viewFolder,
                "subViewFolder" => $this->subViewFolder,
                "title" => "Login",
                "form_error" => true,
                "widget" => $widget,
                "script" => $script
            );
            $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
        }

    }

    //Logout;
    public function logout(){
        $this->session->unset_userdata("user");
        redirect("login");
    }
}