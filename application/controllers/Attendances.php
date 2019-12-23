<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendances extends MY_Controller {

    public $viewFolder = "";
    public $subViewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "attendance_v";
        $this->load->model("attendance_model");
        //user giriş yapmamışsa yönlendir(helper tanımladık);
        if (!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $attendances = $this->attendance_model->join();

        $this->subViewFolder = "list";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Attendance",
            "attendances" => $attendances
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Add attendance form (Get);
    public function add_attendance(){
        $this->load->helper('form');

        //Employees tablosundan employee leri çekiyoruz;
        $this->load->model("employee_model");
        $employee = $this->employee_model->get_employee();

        $this->subViewFolder = "add";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Add Attendance Info",
            "employee" => $employee
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

    }

    //Save Attendance (Post);
    public function save_attendance(){

        if (empty($_POST['time_from'])){
            $time_from = NULL;
        } else {
            $time_from = $this->input->post("time_from");
        }

        if (empty($_POST['time_to'])){
            $time_to = NULL;
        } else {
            $time_to = $this->input->post("time_to");
        }

        $this->load->library("form_validation");
        $this->form_validation->set_rules("employee_id", "Employee", "required|trim");
        $this->form_validation->set_rules("date", "Date", "required|trim");
        $this->form_validation->set_rules("comments", "Comments", "trim");
        $validate = $this->form_validation->run();

        if ($validate){

            $insert = $this->attendance_model->add(
                array(
                    "employee_id" => $this->input->post("employee_id"),
                    "date" => $this->input->post("date"),
                    "time_from" => $time_from,
                    "time_to" => $time_to,
                    "onDuty" => $this->input->post("onDuty"),
                    "comments" => $this->input->post("comments")
                )
            );

            if($insert){
                $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> Attendance info added successfully.
                                        </div>');
                redirect(base_url("attendances"));
            } else {

                $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> There was an error while adding attendance info. Please try again!
                                        </div>');
                redirect(base_url("attendances"));

            }

        } else {
            $this->load->helper('form');

            //Employees tablosundan employee leri çekiyoruz;
            $this->load->model("employee_model");
            $employee = $this->employee_model->get_employee();

            $this->subViewFolder = "add";
            $viewData = array(
                "title" => "Add Attendance Info",
                "viewFolder" => $this->viewFolder,
                "subViewFolder" => $this->subViewFolder,
                "form_error" => true,
                "employee" => $employee
            );
            $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
        }

    }

    //Update Attendance Form (Get);
    public function update_attendance($id){
        $this->load->helper('form');

        $attendance = $this->attendance_model->join_one(
            array(
                "attendance.id" => $id
            )
        );

        //Employees tablosundan employee leri çekiyoruz;
        $this->load->model("employee_model");
        $employee = $this->employee_model->get_employee();

        $this->subViewFolder = "update";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Update Attendance",
            "attendance" => $attendance,
            "employee" => $employee
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Update Attendance (Post);
    public function update($id){

        if (empty($_POST['time_from'])){
            $time_from = NULL;
        } else {
            $time_from = $this->input->post("time_from");
        }

        if (empty($_POST['time_to'])){
            $time_to = NULL;
        } else {
            $time_to = $this->input->post("time_to");
        }

        $update = $this->attendance_model->update(
            array(
                "id" => $id
            ),
            array(

                "employee_id" => $this->input->post("employee_id"),
                "date" => $this->input->post("date"),
                "time_from" => $time_from,
                "time_to" => $time_to,
                "onDuty" => $this->input->post("onDuty"),
                "comments" => $this->input->post("comments")
            )
        );

        if ($update){
            $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> Attendance info updated successfully.
                                        </div>');

            redirect(base_url("attendances"));
        } else {

            $this->load->helper('form');

            $attendance = $this->attendance_model->join_one(
                array(
                    "attendance.id" => $id
                )
            );

            //Employees tablosundan employee leri çekiyoruz;
            $this->load->model("employee_model");
            $employee = $this->employee_model->get_employee();

            $this->subViewFolder = "update";
            $viewData = array(
                "title" => "Update Attendance Info",
                "viewFolder" => $this->viewFolder,
                "subViewFolder" => $this->subViewFolder,
                "form_error" => true,
                "attendance" => $attendance,
                "employee" => $employee
            );
            $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

        }
    }

    //Sweet alert ile delete işlemi;
    public function delete($id){

        $delete = $this->attendance_model->delete(

            array(
                "id" => $id
            )

        );

        if ($delete){

            $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> Attendance info deleted successfully.
                                        </div>');
            redirect(base_url("attendances"));

        } else {

            $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> Attendance info did not deleted. Please try again!
                                        </div>');
            redirect(base_url("attendances"));

        }

    }
}

