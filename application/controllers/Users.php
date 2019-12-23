<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public $viewFolder = "";
    public $subViewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users_v";
        $this->load->model("user_model");
        //user giriş yapmamışsa yönlendir(helper tanımladık);
        if (!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        //Getting all data from users table if role field is manager, else only data of logged in user(helper isManager defined)
        $user = get_active_user();

        if (!isAllowedWriteModule()){
            $where = array(
                "id" => $user->id
            );
        } else{
            $where = array();
        }

//        if (isManager()){
//            $where = array();
//        }else{
//            $where = array(
//              "id" => $user->id
//            );
//        }

        $users = $this->user_model->get_all(
            $where
        );

        $this->subViewFolder = "list";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Users",
            "users" => $users
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Add new user form;
    public function add_user(){

        if (!isAllowedWriteModule()){
            redirect(base_url("users"));
        }

        $this->load->helper('form');

        //User roles ları çekiyoruz;
        $this->load->model("user_role_model");
        $user_roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        $this->subViewFolder = "add";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Add User",
            "user_roles" => $user_roles
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Save new user to database;
    public function save(){

        if (!isAllowedWriteModule()){
            redirect(base_url("users"));
        }

        $this->load->helper('form');
        $this->load->library("form_validation");

        $this->form_validation->set_rules("username", "Username", "required|trim|is_unique[users.username]");
        $this->form_validation->set_rules("name", "First Name", "required|trim");
        $this->form_validation->set_rules("last_name", "Last Name", "required|trim");
        $this->form_validation->set_rules("email", "Email", "trim|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("user_role_id", "User Role", "required|trim");
        $this->form_validation->set_rules("password", "Password", "required|trim|min_length[5]|max_length[11]");
        $this->form_validation->set_rules("re_password", "Confirm Password", "required|trim|min_length[5]|max_length[11]|matches[password]");

        $this->form_validation->set_message(
            array(
                "is_unique" => "{field} already in use!"
            )
        );

        $validate = $this->form_validation->run();

        if ($validate){
            $insert = $this->user_model->add(
                array(
                    "username" => $this->input->post("username"),
                    "name" => $this->input->post("name"),
                    "last_name" => $this->input->post("last_name"),
                    "user_role_id" => $this->input->post("user_role_id"),
                    "email" => $this->input->post("email"),
                    "password" => sha1(md5($this->input->post("password")))
                )
            );
            if ($insert){

                $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> User added successfully.
                                        </div>');
                redirect(base_url("users"));

            }else{

                $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> User adding is failed. Please try again!
                                        </div>');
                redirect(base_url("users"));

            }

        } else {
            $this->load->helper('form');
            //User roles ları çekiyoruz;
            $this->load->model("user_role_model");
            $user_roles = $this->user_role_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            $this->subViewFolder = "add";
            $viewData = array(
                "viewFolder" => $this->viewFolder,
                "subViewFolder" => $this->subViewFolder,
                "title" => "Add New User",
                "form_error" => true,
                "user_roles" => $user_roles
            );
            $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
        }
    }

    //Update user formu (get);
    public function update_form($id){

        $loggedInUser = get_active_user();

        if (!isAllowedUpdateModule() && $loggedInUser->id !== $id){
            redirect(base_url("users"));
        }

        $user = $this->user_model->get(
            array(
               "id" => $id
            )
        );

        //User roles ları çekiyoruz;
        $this->load->model("user_role_model");
        $user_roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        $this->subViewFolder = "update";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Update User",
            "user" => $user,
            "user_roles" => $user_roles
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Update user (POST);
    public function update($id){

        $loggedInUser = get_active_user();

        if (!isAllowedUpdateModule() && $loggedInUser->id !== $id){
            redirect(base_url("users"));
        }

        $this->load->library("form_validation");

        $oldUser = $this->user_model->get(
            array(
                "id" => $id
            )
        );

        if ($oldUser->username != $this->input->post("username")){
            $this->form_validation->set_rules("username", "Username", "required|trim|is_unique[users.username]");
        }

        if ($oldUser->email != $this->input->post("email")){
            $this->form_validation->set_rules("email", "Email", "trim|valid_email|is_unique[users.email]");
        }

        $this->form_validation->set_rules("name", "First Name", "required|trim");
        $this->form_validation->set_rules("last_name", "Last Name", "required|trim");
        $this->form_validation->set_rules("user_role_id", "User Role", "required|trim");

        $this->form_validation->set_message(
            array(
                "is_unique" => "{field} already in use!"
            )
        );

        $validate = $this->form_validation->run();

        if ($validate){
            $update = $this->user_model->update(
                array(
                  "id" => $id
                ),
                array(
                    "username" => $this->input->post("username"),
                    "name" => $this->input->post("name"),
                    "last_name" => $this->input->post("last_name"),
                    "email" => $this->input->post("email"),
                    "user_role_id" => $this->input->post("user_role_id")
                )
            );
            if ($update){

                $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> User update successfully.
                                        </div>');
                redirect(base_url("users"));

            }else{

                $user = $this->user_model->get(
                    array(
                        "id" => $id
                    )
                );

                $this->subViewFolder = "update";
                $viewData = array(
                    "viewFolder" => $this->viewFolder,
                    "subViewFolder" => $this->subViewFolder,
                    "title" => "Update User",
                    "user" => $user
                );
                $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

            }

        } else {
            $user = $this->user_model->get(
                array(
                    "id" => $id
                )
            );
            //User roles ları çekiyoruz;
            $this->load->model("user_role_model");
            $user_roles = $this->user_role_model->get_all(
                array(
                    "isActive" => 1
                )
            );
            $this->subViewFolder = "update";
            $viewData = array(
                "viewFolder" => $this->viewFolder,
                "subViewFolder" => $this->subViewFolder,
                "title" => "Update User",
                "form_error" => true,
                "user" => $user,
                "user_roles" => $user_roles
            );
            $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
        }

    }

    //Update password form (get);
    public function update_password_form($id){

        $loggedInUser = get_active_user();

        if (!isAllowedUpdateModule() && $loggedInUser->id !== $id){
            redirect(base_url("users"));
        }

        $user = $this->user_model->get(
            array(
                "id" => $id
            )
        );

        $this->subViewFolder = "password";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Update User's Password",
            "user" => $user
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

    }

    //Update password (post);
    public function update_password($id){

        $loggedInUser = get_active_user();

        if (!isAllowedUpdateModule() && $loggedInUser->id !== $id){
            redirect(base_url("users"));
        }

        $this->load->library("form_validation");

        $this->form_validation->set_rules("password", "Password", "required|trim|min_length[5]|max_length[11]");
        $this->form_validation->set_rules("re_password", "Confirm Password", "required|trim|min_length[5]|max_length[11]|matches[password]");

        $validate = $this->form_validation->run();

        if ($validate){
            $update = $this->user_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "password" => sha1(md5($this->input->post("password")))
                )
            );
            if ($update){

                $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> User\'s password updated successfully.
                                        </div>');
                redirect(base_url("users"));

            }else{
                $user = $this->user_model->get(
                    array(
                        "id" => $id
                    )
                );

                $this->subViewFolder = "password";
                $viewData = array(
                    "viewFolder" => $this->viewFolder,
                    "subViewFolder" => $this->subViewFolder,
                    "title" => "Update User's Password",
                    "user" => $user
                );
                $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

            }

        } else {
            $user = $this->user_model->get(
                array(
                    "id" => $id
                )
            );
            $this->subViewFolder = "password";
            $viewData = array(
                "viewFolder" => $this->viewFolder,
                "subViewFolder" => $this->subViewFolder,
                "title" => "Update User's Password",
                "form_error" => true,
                "user" => $user
            );
            $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
        }

    }

    //isActiveSetter toggle ile user durum değiştirme(ajax);
    public function isActiveSetter($id){

        if (!isAllowedUpdateModule()){
            die();
        }

        //id geliyorsa tablodaki isActive i update ediyoruz;
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0; //data ajax tan geliyor
            $this->user_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }
    }

    //Sweet alert ile delete işlemi;
    public function delete($id){

        if (!isAllowedDeleteModule()){
            redirect(base_url("users"));
        }

        $delete = $this->user_model->delete(
            array(
                "id" => $id
            )
        );

        if ($delete){

            $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> User deleted successfully.
                                        </div>');
            redirect(base_url("users"));

        } else {
            $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> User did not deleted. Please try again!
                                        </div>');
            redirect(base_url("users"));
        }

    }

}

