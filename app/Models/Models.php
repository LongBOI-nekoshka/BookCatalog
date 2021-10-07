<?php
namespace Models;

use Database\database;

class Models
{
    public function returnConn()
    {
        require_once __DIR__.'/../../database/database.php';
        return $conn;
    }

    public function insert(array $data) {
        $keys = '';
        $value = '';
        foreach($data as $key=>$info) {
            if(gettype($info) == 'array') {
                foreach($info as $key=>$base) {
                    $keys = $keys.'`'.$key.'`, ';
                    $value = $value.'\''.$base.'\', ';
                }
            }else {
                $keys = $keys.'`'.$key.'`, ';
                $value = $value.'\''.$info.'\', ';
            }
        }
        $keys = rtrim($keys, ', ');
        $value = rtrim($value, ', ');
        $sql = "INSERT INTO ".$this->table." (".$keys.") VALUES (".$value.")";
        return $this->returnConn()->query($sql);
    }

    public function update(int $id,array $data)
    {
        $sql = [];
        $conn = $this->returnConn();
        foreach($data as $key=>$info) {
            array_push($sql,"UPDATE ".$this->table." SET ".$key."= '".$info."' where id=".$id);
        }
        foreach($sql as $key=>$query) {
            $test = $conn->query($query);
            if($test == false) {
                return $sql[$key] ;
            }
        }
        return true;
    }

    public function delete(int $id) {
        $conn = $this->returnConn();
        $sql = "DELETE FROM ".$this->table." WHERE id='".$id."'";
        return $conn->query($sql);
    }
}