<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {

    public $viewFolder = "";
    public $subViewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "employees_v";
        $this->load->model("employee_model");
        //user giriş yapmamışsa yönlendir(helper tanımladık);
        if (!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $employees = $this->employee_model->get_all();

        $this->subViewFolder = "list";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Employee List",
            "employees" => $employees
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Add new employee form(get)
    public function add_employee(){

        //If not allowed to add redirect;
        if (!isAllowedWriteModule()){
            redirect(base_url("employees"));
        }

        $this->load->helper('form');

        $this->subViewFolder = "add";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Add New Employee"
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Save new employee(post);
    public function save_employee(){

        //If not allowed to add redirect;
        if (!isAllowedWriteModule()){
            redirect(base_url("employees"));
        }

        //form validation;
        $this->load->library("form_validation");
        $this->form_validation->set_rules("name", "First Name", "required|trim");
        $this->form_validation->set_rules("last_name", "Last Name", "required|trim");
        $this->form_validation->set_rules("title", "Title", "required|trim");
        $this->form_validation->set_rules("email", "Email", "trim|valid_email");
        $this->form_validation->set_rules("phone", "Phone", "trim");
        $this->form_validation->set_rules("address", "Address", "trim");
        $this->form_validation->set_rules("salary", "Salary", "trim");
        $this->form_validation->set_rules("notes", "Notes", "trim");
        $this->form_validation->set_rules("emg_cont_name", "Emergency Contact Name", "trim");
        $this->form_validation->set_rules("emg_cont_rel", "Relationship to employee", "trim");
        $this->form_validation->set_rules("emg_cont_phone", "Contact Person's Phone", "trim");
        $validate = $this->form_validation->run();
        if ($validate) {
            //Validate ten geçerse kayıt işlemi yapıyoruz;
            if ($_FILES["image"]["name"]) {
                $file_name = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME) .random_int(1, 9999) . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

                $config["allowed_types"] = "jpg|jpeg|png";
                $config["upload_path"]   = "./uploads/employee-images/";
                $config["file_name"] = $file_name;

                $this->load->library("upload", $config);

                $upload = $this->upload->do_upload("image");
                if ($upload) {
                    $uploaded_file = $this->upload->data("file_name");
                } else {
                    echo "<div class='alert alert-danger'>There was an error while uploading image!</div>";
                }
            } else{
                $uploaded_file = '';
            }
            

            $insert = $this->employee_model->add(
                array(
                    "name" => $this->input->post("name"),
                    "last_name" => $this->input->post("last_name"),
                    "title" => $this->input->post("title"),
                    "image" => $uploaded_file,
                    "email" => $this->input->post("email"),
                    "phone" => $this->input->post("phone"),
                    "address" => $this->input->post("address"),
                    "salary" => $this->input->post("salary"),
                    "notes" => $this->input->post("notes"),
                    "birthday" => $this->input->post("birthday"),
                    "start_date" => $this->input->post("start_date"),
                    "emg_cont_name" => $this->input->post("emg_cont_name"),
                    "emg_cont_rel" => $this->input->post("emg_cont_rel"),
                    "emg_cont_phone" => $this->input->post("emg_cont_phone")
                )
            );

            if ($insert) {
                $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> Employee added successfully.
                                        </div>');
                redirect(base_url("employees"));
            } else {
                //insert işlemi başarısız ise;
                $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                <strong>Error!</strong> There was an error while adding the employee. Please try again!
                                        </div>');
                redirect(base_url("employees"));
            }
        } else {
            $this->subViewFolder = "add";
            $viewData = array(
                "viewFolder" => $this->viewFolder,
                "subViewFolder" => $this->subViewFolder,
                "form_error" => true
            );
            $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
        }
    }

    //isActiveSetter toggle ile employee durum değiştirme(ajax);
    public function isActiveSetter($id){

        //If not allowed to update redirect;
        if (!isAllowedUpdateModule()){
            die();
        }

        //id geliyorsa tablodaki isActive i update ediyoruz;
        if ($id){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0; //data ajax tan geliyor

            $this->employee_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );

        }

    }

    //Update Employee form;
    public function update_employee($id){

        //If not allowed to update redirect;
        if (!isAllowedUpdateModule()){
            redirect(base_url("employees"));
        }

        $this->load->helper('form');

        $employee = $this->employee_model->get(
            array(
                "id" => $id
            )
        );
        $this->subViewFolder = "update";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Update Employee",
            "employee" => $employee
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Update Employee;
    public function update($id){

        //If not allowed to update redirect;
        if (!isAllowedUpdateModule()){
            redirect(base_url("employees"));
        }

        if (empty($_POST['leave_date'])){
           $leave_date = NULL;
        } else {
            $leave_date = $this->input->post("leave_date");
        }

        if (!empty($_FILES["image"]["name"])){

            //Eski resmi silmek için ilana ait resmi çekiyoruz;
            $this->load->model("employee_model");
            $old_image = $this->employee_model->get_image(
                array(
                    "id" => $id
                )
            );

            $file_path = FCPATH ."uploads/employee-images/$old_image->image";

            $file_name = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME) .random_int(1, 9999) . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

            $config["allowed_types"] = "jpg|jpeg|png";
            $config["upload_path"]   = "./uploads/employee-images/";
            $config["file_name"] = $file_name;
            $config['overwrite'] = TRUE;

            $this->load->library("upload", $config);

            $upload = $this->upload->do_upload("image");
            if ($upload) {
                $uploaded_file = $this->upload->data("file_name");
            } else {
                echo "<div class='alert alert-danger'>There was an error while uploading image!</div>";
            }

            $update = $this->employee_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "name" => $this->input->post("name"),
                    "last_name" => $this->input->post("last_name"),
                    "title" => $this->input->post("title"),
                    "image" => $uploaded_file,
                    "email" => $this->input->post("email"),
                    "phone" => $this->input->post("phone"),
                    "address" => $this->input->post("address"),
                    "salary" => $this->input->post("salary"),
                    "notes" => $this->input->post("notes"),
                    "birthday" => $this->input->post("birthday"),
                    "start_date" => $this->input->post("start_date"),
                    "leave_date" => $leave_date,
                    "emg_cont_name" => $this->input->post("emg_cont_name"),
                    "emg_cont_rel" => $this->input->post("emg_cont_rel"),
                    "emg_cont_phone" => $this->input->post("emg_cont_phone")
                )
            );

            if ($update){

                unlink($file_path);

                $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> Employee updated successfully.
                                        </div>');
                redirect(base_url("employees"));

            } else {

                $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> There was an error while updating the employee. Please try again!
                                        </div>');
                redirect(base_url("employees"));

            }

        } else{

            $update = $this->employee_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "name" => $this->input->post("name"),
                    "last_name" => $this->input->post("last_name"),
                    "title" => $this->input->post("title"),
                    "email" => $this->input->post("email"),
                    "phone" => $this->input->post("phone"),
                    "address" => $this->input->post("address"),
                    "salary" => $this->input->post("salary"),
                    "notes" => $this->input->post("notes"),
                    "birthday" => $this->input->post("birthday"),
                    "start_date" => $this->input->post("start_date"),
                    "leave_date" => $leave_date,
                    "emg_cont_name" => $this->input->post("emg_cont_name"),
                    "emg_cont_rel" => $this->input->post("emg_cont_rel"),
                    "emg_cont_phone" => $this->input->post("emg_cont_phone")
                )
            );

            if ($update){

                $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> Employee updated successfully.
                                        </div>');
                redirect(base_url("employees"));

            } else {

                $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> There was an error while updating the employee. Please try again!
                                        </div>');
                redirect(base_url("employees"));

            }

        }



    }

    //Sweet alert ile delete işlemi;
    public function delete($id){

        //If not allowed to delete redirect;
        if (!isAllowedDeleteModule()){
            redirect(base_url("employees"));
        }

        //Eski resmi silmek için elemana ait resmi çekiyoruz;
        $old_image = $this->employee_model->get_image(
            array(
                "id" => $id
            )
        );

        $file_path = FCPATH ."uploads/employee-images/$old_image->image";

        $delete = $this->employee_model->delete(

            array(
                "id" => $id
            )

        );

        if ($delete){

            unlink($file_path);

            $this->load->model("score_model");
            $employees_has_score = $this->score_model->get_employee_id_from_scores_table(
                array(
                    "employee_id" => $id
                )
            );

            if ($employees_has_score){
                $this->score_model->delete(
                    array(
                        "employee_id" => $id
                    )
                );
            }

            $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> Employee deleted successfully.
                                        </div>');
            redirect(base_url("employees"));

        } else {

            $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> Employee did not deleted. Please try again!
                                        </div>');
            redirect(base_url("employees"));

        }

    }
}

