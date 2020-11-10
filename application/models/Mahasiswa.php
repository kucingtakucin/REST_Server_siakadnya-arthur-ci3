<?php


class Mahasiswa extends CI_Model
{
    /**
     * @param null $id
     * @return mixed
     */
    public function get($id = null)
    {
        if ($id === null) {
            return $this->db->get("mahasiswa")->result_array();
        }
        return $this->db->get_where('mahasiswa', ['id' => $id])->result_array();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $this->db->delete('mahasiswa',['id' => $id]);
        return $this->db->affected_rows();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $this->db->insert('mahasiswa', $data);
        return $this->db->affected_rows();
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        $this->db->update('mahasiswa', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}