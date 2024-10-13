<?php
use Umityatarkalkmaz\Model;

class user extends Model{
    public function user($username)
    {
        return $this->table('user')->where('username', $username)->limit(1)->first();
    }
    public function deleteUser($id)
    {
        return $this->delete('user')->where('id', $id)->execute();
    }

    public function addUser($name, $pass)
    {
        return $this->insert('user', ['username' => $name, 'password' => $pass])->execute();
    }
    public function updateTost($name, $pass, $id)
    {
        return $this->update('user', ['username' => $name, 'password' => $pass])->where('id', $id)->execute();
    }
}