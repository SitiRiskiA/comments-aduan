<?php
class ModelPic extends CI_Model {
    protected $table_name = "master_pic";
    public function getData(array $conditions){
        $this->db->where($conditions);
        $this->db->from($this->table_name);
        return $this->db->get()->result();
    }
}
?>