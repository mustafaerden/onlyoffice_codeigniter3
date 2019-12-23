<?php
class Score_model extends CI_Model{
    public $tableName = "scores";
    public function __construct()
    {
        parent::__construct();
    }

    //Scores tablosu ile employees tablosunu join edip, scores tablosundaki herşeyi ve employees tablosundan id, name ve last_name i alıyoruz
    public function join($where = array()){
        $this->db->select("scores.id, employees.name, employees.last_name, scores.date, scores.total_sale,    scores.tph, scores.pt");
        $this->db->from("scores");
        $this->db->where($where);
        $this->db->join("employees", "employees.id = scores.employee_id");
        $this->db->order_by('scores.date', 'DESC');
        return $this->db->get()->result();
    }

    //Üstekinin tek row çekeni
    public function join_one($where = array()){
        $this->db->select("scores.id, employees.name, employees.last_name, scores.employee_id, scores.date, scores.total_sale, scores.tph, scores.pt");
        $this->db->from("scores");
        $this->db->where($where);
        $this->db->join("employees", "employees.id = scores.employee_id");
        $this->db->order_by('scores.date', 'DESC');
        return $this->db->get()->row();
    }

    //Get all employee_id s(we need it when deleting an employee;
    public function get_employee_id_from_scores_table($where=array()){
        return $this->db->select('employee_id')->where($where)->get($this->tableName)->result();
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

}