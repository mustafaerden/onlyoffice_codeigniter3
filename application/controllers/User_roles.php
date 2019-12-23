<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_roles extends MY_Controller {

    public $viewFolder = "";
    public $subViewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "user_roles_v";
        $this->load->model("user_role_model");
        //user giriş yapmamışsa yönlendir(helper tanımladık);
        if (!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $user_roles = $this->user_role_model->get_all();

        $this->subViewFolder = "list";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "User Permissions",
            "user_roles" => $user_roles
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Add new user role form;
    public function add_user_role(){
        $this->load->helper('form');
        $this->subViewFolder = "add";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Add User Role"
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Save new user role to database;
    public function save(){
        $this->load->helper('form');
        $this->load->library("form_validation");

        $this->form_validation->set_rules("title", "Title", "required|trim");

        $validate = $this->form_validation->run();

        if ($validate){
            $insert = $this->user_role_model->add(
                array(
                    "title" => $this->input->post("title")
                )
            );
            if ($insert){

                $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> User Role added successfully.
                                        </div>');
                redirect(base_url("user_roles"));

            }else{

                $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> User Role could not added. Please try again!
                                        </div>');
                redirect(base_url("user_roles"));

            }

        } else {
            $this->load->helper('form');
            $this->subViewFolder = "add";
            $viewData = array(
                "viewFolder" => $this->viewFolder,
                "subViewFolder" => $this->subViewFolder,
                "title" => "Add New User Role",
                "form_error" => true
            );
            $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
        }
    }

    //Update user role formu (get);
    public function update_form($id){

        $user_role = $this->user_role_model->get(
            array(
                "id" => $id
            )
        );

        $this->subViewFolder = "update";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Update User Role",
            "user_role" => $user_role
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Update user role (POST);
    public function update($id){

        $this->load->library("form_validation");

        $oldUserRole = $this->user_role_model->get(
            array(
                "id" => $id
            )
        );

        if ($oldUserRole->title != $this->input->post("title")){
            $this->form_validation->set_rules("title", "Title", "required|trim");
        }

        $validate = $this->form_validation->run();

        if ($validate){
            $update = $this->user_role_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "title" => $this->input->post("title")
                )
            );
            if ($update){

                $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> User Role update successfully.
                                        </div>');
                redirect(base_url("user_roles"));

            }else{

                $user_role = $this->user_role_model->get(
                    array(
                        "id" => $id
                    )
                );

                $this->subViewFolder = "update";
                $viewData = array(
                    "viewFolder" => $this->viewFolder,
                    "subViewFolder" => $this->subViewFolder,
                    "title" => "Update User Role",
                    "user_role" => $user_role
                );
                $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

            }

        } else {
            $user_role = $this->user_role_model->get(
                array(
                    "id" => $id
                )
            );

            $this->subViewFolder = "update";
            $viewData = array(
                "viewFolder" => $this->viewFolder,
                "subViewFolder" => $this->subViewFolder,
                "title" => "Update User Role",
                "user_role" => $user_role,
                "form_error" => true
            );
            $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
        }

    }

    //isActiveSetter toggle ile user durum değiştirme(ajax);
    public function isActiveSetter($id){

        //id geliyorsa tablodaki isActive i update ediyoruz;
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0; //data ajax tan geliyor
            $this->user_role_model->update(
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

        $delete = $this->user_role_model->delete(
            array(
                "id" => $id
            )
        );

        if ($delete){

            $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> User Role deleted successfully.
                                        </div>');
            redirect(base_url("user_roles"));

        } else {
            $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> User Role did not deleted. Please try again!
                                        </div>');
            redirect(base_url("user_roles"));
        }

    }

    //Permissions;
    public function permissions_form($id){

        $user_role = $this->user_role_model->get(
            array(
                "id" => $id
            )
        );

        $this->subViewFolder = "permissions";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "User Permissions",
            "user_role" => $user_role
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

    }

    //Update permissions(post);
    public function update_permissions($id){

        //Keeping data in database as json;
        $permissions = json_encode($this->input->post("permissions"));

        $update = $this->user_role_model->update(
            array(
                "id" => $id
            ),
            array(
                "permissions" => $permissions
            )
        );
        if ($update){

            $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> Permissions updated successfully.
                                        </div>');
            redirect(base_url("user_roles/permissions_form/$id"));

        }else{
            $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Danger!</strong> Permissions could not updated. Please try again!
                                        </div>');
            redirect(base_url("user_roles/permissions_form/$id"));
        }
    }
}

