<?php
class Attendance_model extends CI_Model{
    public $tableName = "attendance";
    public function __construct()
    {
        parent::__construct();
    }

    //Attendance tablosu ile employees tablosunu join edip, attendance tablosundaki herşeyi ve employees tablosundan id, name ve last_name i alıyoruz
    public function join($where = array()){
//        $this->db->select("attendance.id id, employees.name employee_name, attendance.date attendance_date");
//        $this->db->select("attendance.id id, employees.name name, attendance.date date");
        $this->db->select("attendance.id, employees.name, employees.last_name, attendance.date, attendance.time_from, attendance.time_to, attendance.onDuty, attendance.comments");
        $this->db->from("attendance");
        $this->db->where($where);
        $this->db->join("employees", "employees.id = attendance.employee_id");
        $this->db->order_by('attendance.date', 'DESC');
        return $this->db->get()->result();
    }

    //Üstekinin tek row çekeni
    public function join_one($where = array()){
        $this->db->select("attendance.id, attendance.employee_id, employees.name, employees.last_name, attendance.date, attendance.time_from, attendance.time_to, attendance.onDuty, attendance.comments");
        $this->db->from("attendance");
        $this->db->where($where);
        $this->db->join("employees", "employees.id = attendance.employee_id");
        $this->db->order_by('attendance.date', 'DESC');
        return $this->db->get()->row();
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