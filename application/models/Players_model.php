<?php
class Players_model extends CI_Model
{
    private const KEY = 'players';
    public function __construct()
    {
        $this->load->database();
        $this->load->driver('cache');
    }

    public function get_players($id = FALSE)
    {
        if ($id == FALSE) {
            //如果value的值发生变化，返回false？
            $rows = $this->_get_all();
            if (!$rows) {
                $rows = $this->db->get('players')->result_array();
                $this->_set_all($rows);
                return $rows;
            }
            return $rows;
        }

        $row = $this->_get_row($this->_get_rkey($id));
        if (!$row) {
            $row = $this->db->get_where('players', array('Id' => $id))->row_array();
            $this->_set_row($this->_get_rkey($id), $row);
        }
        return $row;
    }

    public function set_player()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'age' => $this->input->post('age')
        );

        return $this->db->insert('players', $data);
    }

    private function _get_rkey($id)
    {
        return 'player_' . $id;
    }

    private function _get_all()
    {
        echo '<pre>';
        var_dump($this->cache->redis);
        echo '<pre>';

        return $this->cache->redis->get(self::KEY);
    }

    private function _set_all($rows)
    {
        $this->cache->redis->save(self::KEY, $rows,120);//2分钟,需要设置缓存时间
    }

    private function _get_row($rkey)
    {
        return $this->cache->redis->get($rkey);
    }

    private function _set_row($rkey, $row)
    {
        $this->cache->redis->save($rkey, $row);
    }
}
