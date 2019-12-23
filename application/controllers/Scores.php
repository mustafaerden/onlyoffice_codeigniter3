<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scores extends MY_Controller {

    public $viewFolder = "";
    public $subViewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "scores_v";
        $this->load->model("score_model");
        //user giriş yapmamışsa yönlendir(helper tanımladık);
        if (!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $scores = $this->score_model->join();

        $this->subViewFolder = "list";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Scores",
            "scores" => $scores
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Add score form (get);
    public function add_score(){

        //If not allowed to add redirect;
        if (!isAllowedWriteModule()){
            redirect(base_url("scores"));
        }

        $this->load->helper('form');

        //Employees tablosundan employee leri çekiyoruz;
        $this->load->model("employee_model");
        $employee = $this->employee_model->get_employee();

        $this->subViewFolder = "add";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Add Score Info",
            "employee" => $employee
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Save Score (Post);
    public function save_score(){

        //if not allowed to write;
        if (!isAllowedWriteModule()){
            redirect(base_url("scores"));
        }

        $date = $this->input->post('date');
        $day = date('l', strtotime($date));

        if ($day == 'Friday'){
            $phoneTime = 11;
        }else {
            $phoneTime = 15;
        }

        $this->load->library("form_validation");
        $this->form_validation->set_rules("employee_id", "Employee", "required|trim");
        $this->form_validation->set_rules("date", "Date", "required|trim");
        $validate = $this->form_validation->run();

        $totalTransfers = $this->input->post("total_sale");

        $tph_raw = $totalTransfers/$phoneTime;
        $tph = number_format((float)$tph_raw, 2, '.', '');

        if ($validate){

            $insert = $this->score_model->add(
                array(
                    "employee_id" => $this->input->post("employee_id"),
                    "date" => $this->input->post("date"),
                    "total_sale" => $totalTransfers,
                    "tph" => $tph,
                    "pt" => $phoneTime
                )
            );

            if($insert){
                $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> Score info added successfully.
                                        </div>');
                redirect(base_url("scores"));
            } else {

                $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> There was an error while adding score info. Please try again!
                                        </div>');
                redirect(base_url("scores"));

            }

        } else {
            $this->load->helper('form');

            //Employees tablosundan employee leri çekiyoruz;
            $this->load->model("employee_model");
            $employee = $this->employee_model->get_employee();

            $this->subViewFolder = "add";
            $viewData = array(
                "title" => "Add Scores Info",
                "viewFolder" => $this->viewFolder,
                "subViewFolder" => $this->subViewFolder,
                "form_error" => true,
                "employee" => $employee
            );
            $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
        }

    }

    //Update Score Form(get)
    public function update_score($id){

        //If not allowed to update redirect;
        if (!isAllowedUpdateModule()){
            redirect(base_url("scores"));
        }

        $this->load->helper('form');

        $score = $this->score_model->join_one(
            array(
                "scores.id" => $id
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
            "score" => $score,
            "employee" => $employee
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }

    //Update Score (Post);
    public function update($id){

        //If not allowed to update redirect;
        if (!isAllowedUpdateModule()){
            redirect(base_url("scores"));
        }

        $date = $this->input->post('date');
        $day = date('l', strtotime($date));

        if ($day == 'Friday'){
            $phoneTime = 11;
        }else {
            $phoneTime = 15;
        }

        $totalTransfers = $this->input->post("total_sale");

        $tph_raw = $totalTransfers/$phoneTime;
        $tph = number_format((float)$tph_raw, 2, '.', '');

        $update = $this->score_model->update(
            array(
                "id" => $id
            ),
            array(

                "employee_id" => $this->input->post("employee_id"),
                "date" => $this->input->post("date"),
                "total_sale" => $totalTransfers,
                "pt" => $phoneTime,
                "tph" => $tph
            )
        );

        if ($update){
            $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> Score info updated successfully.
                                        </div>');

            redirect(base_url("scores"));
        } else {

            $this->load->helper('form');

            $score = $this->score_model->join_one(
                array(
                    "scores.id" => $id
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
                "score" => $score,
                "employee" => $employee
            );
            $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

        }
    }

    //Sweet alert ile delete işlemi;
    public function delete($id){

        //If not allowed to update redirect;
        if (!isAllowedDeleteModule()){
            redirect(base_url("scores"));
        }

        $delete = $this->score_model->delete(

            array(
                "id" => $id
            )

        );

        if ($delete){

            $this->session->set_flashdata('durum', '<div class="alert alert-success alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Success!</strong> Score info deleted successfully.
                                        </div>');
            redirect(base_url("scores"));

        } else {

            $this->session->set_flashdata('durum', '<div class="alert alert-danger alert-dissmissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                            <strong>Error!</strong> Score info did not deleted. Please try again!
                                        </div>');
            redirect(base_url("scores"));

        }

    }

    //Daily Individual Score seçme formu;
    public function individual_score(){

        //Employees tablosundan employee leri çekiyoruz;
        $this->load->model("employee_model");
        $employee = $this->employee_model->get_employee();

        $this->subViewFolder = "individual_select";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "See Individual Score",
            "employee" => $employee
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

    }

    //Kişiye ait daily individual score tablosu;
    public function see_individual_score(){

        if ($this->input->post("employee_id") == 'all'){
            $where = array(
                "date" => $this->input->post("date")
            );
        } else {
            $where = array(
                "employee_id" => $this->input->post("employee_id"),
                "date" => $this->input->post("date")
            );
        }


        $individual = $this->score_model->join(
            $where
        );

        $myArray = json_decode(json_encode($individual), true);
        $sumOfTotalSaleColumns = array_sum(array_column($myArray,'total_sale'));
        $sumOfPtColumns = array_sum(array_column($myArray,'pt'));
        
        $calculateTph = $sumOfTotalSaleColumns/$sumOfPtColumns;
        $tph = number_format((float)$calculateTph, 2, '.', '');

        $this->subViewFolder = "individual_score";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "See Individual Score",
            "individual" => $individual,
            "totalSale" => $sumOfTotalSaleColumns,
            "totalTph" => $tph
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

    }

    //Montly Individual Score secme formu;
    public function montly_individual_score(){

        //Employees tablosundan employee leri çekiyoruz;
        $this->load->model("employee_model");
        $employee = $this->employee_model->get_employee();

        $this->subViewFolder = "montly_individual_select";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "See Individual Score",
            "employee" => $employee
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

    }

    //Kişiye ait montly individual score tablosu;
    public function see_montly_individual_score(){

        $date_range = explode("-", $this->input->post("date_range"));
        $date_from_arr = explode("/", $date_range[0]);
        $date_to_arr = explode("/",$date_range[1]);

        $date_from_str = trim($date_from_arr[2]) . "-" . trim($date_from_arr[0]) . "-" . trim($date_from_arr[1]);
        $date_to_str = trim($date_to_arr[2]) . "-" . trim($date_to_arr[0]) . "-" . trim($date_to_arr[1]);

        $date_from = new DateTime($date_from_str);
        $date_to = new DateTime($date_to_str);

        $from = $date_from->format("Y-m-d");
        $to = $date_to->format("Y-m-d");

        if ($this->input->post("employee_id") == 'all'){
            $where = array(
                "date >=" => $from,
                "date <=" => $to
            );
        } else {
            $where = array(
                "employee_id" => $this->input->post("employee_id"),
                "date >=" => $from,
                "date <=" => $to
            );
        }

        $montly_individual = $this->score_model->join(
            $where
        );

        $myArray = json_decode(json_encode($montly_individual), true);
        $sumOfTotalSaleColumns = array_sum(array_column($myArray,'total_sale'));
        $sumOfPtColumns = array_sum(array_column($myArray,'pt'));
        
        $calculateTph = $sumOfTotalSaleColumns/$sumOfPtColumns;
        $tph = number_format((float)$calculateTph, 2, '.', '');

        $this->subViewFolder = "montly_individual_score";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "See Individual Score",
            "montly_individual" => $montly_individual,
            "totalSale" => $sumOfTotalSaleColumns,
            "totalTph" => $tph
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);

    }

}

