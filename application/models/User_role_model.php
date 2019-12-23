<?php

class User_role_model extends CI_Model {
    public $tableName = "user_roles";
    public function __construct(){
        parent::__construct();
    }

    //Tablodaki tek kaydı getiren metot;
    public function get($where = array()){
        return $this->db->where($where)->get($this->tableName)->row();
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
}
