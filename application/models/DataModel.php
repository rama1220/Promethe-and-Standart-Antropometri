<?php

class DataModel extends CI_Model
{

    function custom($q)
    {
        $query = $this->db->query($q);
        return $query;
    }

    function select($col)
    {
        $query = $this->db->select($col);
        return $query;
    }

    function getWhere($col, $kon)
    {
        $query = $this->db->where($col, $kon);
        return $query;
    }

    function getUsia(){
        $this->db->select('*');
		$this->db->from('usia_pasien');
		$query = $this->db->get();
		return $query->result_array();
    }

    function order_by($col,$mode){
        $query = $this->db->order_by($col,$mode);
        return $query;
    }

    function getWhereArr($array)
    {
        $query = $this->db->where($array);
        return $query;
    }

    function getData($table)
    {
        $query = $this->db->get($table);
        return $query;
    }

    function getJoin($table, $condition, $type)
    {
        $query = $this->db->join($table, $condition, $type);
        return $query;
    }

    function distinct($col)
    {
        $query = $this->db->distinct();
        $query = $this->db->select($col);
        return $query;
    }

    function insert($table, $data)
    {
        $query = $this->db->insert($table, $data);
        return $query;
    }

    public function insert_multiple($table,$data)
    {
        $query = $this->db->insert_batch($table, $data);
        return $query;
    }

    public function update_multiple($table,$data,$id){
        $query = $this->db->update_batch($table,$data,$id);
        return $query;
    }

    function update($table, $data)
    {
        $query = $this->db->update($table, $data);
        return $query;
    }

    function delete($col, $condition, $table)
    {
        $query = $this->db->where($col, $condition);
        $query = $this->db->delete($table);
        return $query;
    }

    function delete_arr($where,$table){
        $query = $this->db->where($where);
        $query = $this->db->delete($table);
        return $query;
    }

    function getInsertId(){
        return $this->db->insert_id();
    }
    public function getUsiaById($where, $table)
    {
        return $this->db->get_where($table, array('id' => $where))->row();
    }
    function getDataByUmur($id_umur)
    {
        $sql = "SELECT 
                    p.id, 
                    p.umur, 
                    b.min_SD AS b_min_SD, 
                    b.median AS b_median, 
                    b.plus_SD AS b_plus_SD, 
                    t.min_SD AS t_min_SD, 
                    t.median AS t_median, 
                    t.plus_SD AS t_plus_SD, 
                    bt.min_SD AS bt_min_SD, 
                    bt.median AS bt_median, 
                    bt.plus_SD AS bt_plus_SD, 
                    u.min_SD AS u_min_SD, 
                    u.median AS u_median, 
                    u.plus_SD AS u_plus_SD 
                FROM 
                    usia_pasien AS p 
                JOIN 
                    bb AS b ON p.id = b.id_umur 
                JOIN 
                    tb AS t ON p.id = t.id_umur 
                JOIN 
                    bb_tb AS bt ON p.id = bt.id_umur 
                JOIN 
                    imt_u AS u ON p.id = u.id_umur 
                WHERE 
                    p.id = ?
                ORDER BY 
                    p.id ASC";
    
        $query = $this->db->query($sql, array($id_umur));
        return $query->result();
    }
    

    public function getberat()
	{
		$this->db->select('u.umur, b.min_SD, b.median, b.plus_SD');
		$this->db->from('bb AS b');
		$this->db->join('usia_pasien AS u', 'b.id_umur = u.id');
		$query = $this->db->get();
		return $query->result();
	}
	public function gettinggi()
	{
		$this->db->select('u.umur, b.min_SD, b.median, b.plus_SD');
		$this->db->from('tb AS b');
		$this->db->join('usia_pasien AS u', 'b.id_umur = u.id');
		$query = $this->db->get();
		return $query->result();
	}

	public function getbb_tb()
	{
		$this->db->select('u.umur, b.min_SD, b.median, b.plus_SD');
		$this->db->from('bb_tb AS b');
		$this->db->join('usia_pasien AS u', 'b.id_umur = u.id');
		$query = $this->db->get();
		return $query->result();
	}
	public function getimt()
	{
		$this->db->select('u.umur, b.min_SD, b.median, b.plus_SD');
		$this->db->from('imt_u AS b');
		$this->db->join('usia_pasien AS u', 'b.id_umur = u.id');
		$query = $this->db->get();
		return $query->result();
	}

    function Login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }


}
