<?php

class product_model extends CI_Model {
    public function getProducts(){
        $query_str = 'SELECT * FROM `product`';
        $result = $this->db->query($query_str);
        return $result->result();
    }

    public function addProduct($data){
        $query_str = 'INSERT INTO `product`(`id`, `name`, `description`, `image`) VALUES (NULL, ?, ?, ?)';
        $result = $this->db->query($query_str, array($data['name'], $data['description'], $data['image']));
        print_r($result);
        return $result;
    }

    public function updateProduct($data, $updateImage = false){
        if($updateImage){
            $query_str = 'UPDATE `product` SET `name` = ?,`description`= ?, `image` = ? WHERE `id`=?';
            return $this->db->query($query_str, array($data['name'], $data['description'], $data['image'], $data['id']));
        }

        $query_str = 'UPDATE `product` SET `name` = ?,`description`= ? WHERE `id`=?';
        return $this->db->query($query_str, array($data['name'], $data['description'], $data['id']));
    }

    public function removeProduct($id){
        $query_str = 'DELETE FROM `product` WHERE id=?';
        return $this->db->query($query_str, $id);
    }
}