<?php
class ModelMedia extends CI_Model {
    protected $table_name = "master_media";
    public function getData(array $conditions){
        $this->db->where($conditions);
        $this->db->from($this->table_name);
        return $this->db->get()->result();
    }

    public function insertData(array $data){
        $this->db->insert("trans_aduan", $data);
    }
}
?>