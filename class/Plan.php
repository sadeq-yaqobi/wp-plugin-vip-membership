<?php

class Plan
{
    private $db, $vipTable;

    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->vipTable = $this->db->prefix . 'vip';
    }

    public function find()
    {
        $sql = "SELECT id,type,price,benefits,recommended,status FROM {$this->vipTable} ORDER BY id ASC";
        $stmt = $this->db->get_results($sql);
        if ($stmt)
            return $stmt;
        return false;
    }
}