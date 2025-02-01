<?php

class Plan
{
    private $db, $vipTable;

    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->vipTable = $this->db->prefix . 'vip_plan';
    }

    public function find()
    {
        $sql = "SELECT id,type,price,benefits,recommended,status FROM {$this->vipTable} ORDER BY id ASC";
        $stmt = $this->db->get_results($sql);
        if ($stmt) return $stmt;
        return false;
    }

    public function find_by_id($plan_id)
    {
        $sql = "SELECT id,type,price FROM {$this->vipTable} WHERE id=%d";
        $stmt = $this->db->get_row($this->db->prepare($sql, $plan_id));
        if ($stmt) return $stmt;
        return false;
    }

}