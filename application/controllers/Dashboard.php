<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $viewFolder = "";
    public $subViewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "dashboard_v";
        //user giriş yapmamışsa yönlendir(helper tanımladık);
        if (!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        //Get total numbers of all employees;
        $this->load->model("employee_model");
        $all_employees = $this->employee_model->number_of_employees();

        //Get total numbers of all agents;
        $all_agents = $this->employee_model->number_of_employees(
            array(
                "title" => "Agent"
            )
        );

        //Get total numbers of all managers;
        $all_managers = $this->employee_model->number_of_employees(
            array(
                "title" => "Manager"
            )
        );

        $this->subViewFolder = "list";
        $viewData = array(
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => $this->subViewFolder,
            "title" => "Dashboard",
            "all_employees" => $all_employees,
            "all_agents" => $all_agents,
            "all_managers" => $all_managers
        );
        $this->load->view("{$this->viewFolder}/{$this->subViewFolder}/index", $viewData);
    }




    //Get how many agents are there;

}

