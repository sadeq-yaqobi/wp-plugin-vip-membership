<?php

class Transaction
{
    private $db, $table;

    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->table = $this->db->prefix . 'vip_transaction';
    }

    public function save($data)
    {
        $data = [
            'user_id' => $data['user_id'],
            'plan_type' => $data['plan_type'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'price'=>$data['price'],
            'order_number'=>$data['order_number']
        ];
        $format = ['%d','%d','%s','%s','%s','%s','%s'];
         $this->db->insert($this->table, $data, $format);
    }

    public function update($ref_id,$order_number)
    {
        $data = [
            'ref_id' => $ref_id,
            'status' => 1,
        ];
        $where=['order_number'=>$order_number];
        $format=['%s','%d'];
        $where_format=['%s'];
        $this->db->update($this->table,$data,$where,$format,$where_format);
    }
}