<?php

class Employee_model extends CI_Model {
    public $tableName = "employees";
    public function __construct(){
        parent::__construct();
    }

    //Tablodaki tek kaydı getiren metot;
    public function get($where = array()){
        return $this->db->where($where)->get($this->tableName)->row();
    }

    //Tablodaki image i çeken metot;
    public function get_image($where = array()){
        return $this->db->select('image')->where($where)->get($this->tableName)->row();
    }

    //Gettin employee_id and name and last_name;
    public function get_employee($where = array()){
        return $this->db->select('id, name, last_name')->where($where)->get($this->tableName)->result();
    }

    //Tablodaki tüm kayıtları getiren metot;
    public function get_all($where = array(), $order = "id ASC"){
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
    }

    //Insert metodu;
    public function add($data = array()){
        return $this->db->insert($this->tableName, $data);
    }

    //Update metodu;
    public function update($where = array(), $data = array()){
        return $this->db->where($where)->update($this->tableName, $data);
    }

    //Delete işlemi;
    public function delete($where = array()){
        return $this->db->where($where)->delete($this->tableName);
    }

    //Count all rows(count employees);
    //tüm satilik ilanlarının sayısını çek;
    public function number_of_employees($where = array())
    {
        return $this->db->where($where)->from($this->tableName)->count_all_results();
    }
}
