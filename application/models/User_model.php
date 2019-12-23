<?php

class User_model extends CI_Model {
    public $tableName = "users";
    public function __construct(){
        parent::__construct();
    }

//    public function join($where = array()){
//        $this->db->select("users.id, user_roles.title, users.user_role_id, users.username, users.name, users.last_name, users.email, users.isActive");
//        $this->db->from("users");
//        $this->db->where($where);
//        $this->db->join("user_roles", "user_roles.id = users.id");
//        return $this->db->get()->result();
//    }

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
