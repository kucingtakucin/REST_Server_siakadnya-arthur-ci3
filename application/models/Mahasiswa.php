<?php


class Mahasiswa extends CI_Model
{
    public function get()
    {
        return $this->db->get("mahasiswa");
    }
}