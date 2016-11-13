<?php
namespace App\Core;

class Mysqli {

    public $querynum = 0;
    public $link;
    public $histories;
    public $time;
    public $tablepre;

    public function connect($dbhost, $dbuser, $dbpw, $dbname = '', $dbcharset, $pconnect = 0, $tablepre='', $time = 0) {
        $this->time = $time;
        $this->tablepre = $tablepre;
        $this->link = new mysqli();
        if(!$this->link->real_connect($dbhost, $dbuser, $dbpw, $dbname, null, null, MYSQLI_CLIENT_COMPRESS)) {
            $this->halt('Can not connect to MySQL server');
        }

        if($this->version() > '4.1') {
            if($dbcharset) {
                $this->link->set_charset($dbcharset);
            }

            if($this->version() > '5.0.1') {
                $this->query("SET sql_mode=''");
            }
        }
    }

    public function fetch_array($query, $result_type = MYSQLI_ASSOC) {
        return $query ? $query->fetch_array($result_type) : null;
    }

    public function result_first($sql, &$data) {
        $query = $this->query($sql);
        $data = $this->result($query, 0);
    }

    public function fetch_first($sql, &$arr) {
        $query = $this->query($sql);
        $arr = $this->fetch_array($query);
    }

    public function fetch_all($sql, &$arr) {
        $query = $this->query($sql);
        while($data = $this->fetch_array($query)) {
            $arr[] = $data;
        }
    }

    public function cache_gc() {
        $this->query("DELETE FROM {$this->tablepre}sqlcaches WHERE expiry<$this->time");
    }

    public function query($sql, $type = '', $cachetime = FALSE) {
        $resultmode = $type == 'UNBUFFERED' ? MYSQLI_USE_RESULT : MYSQLI_STORE_RESULT;
        if(!($query = $this->link->query($sql, $resultmode)) && $type != 'SILENT') {
            $this->halt('SQL:', $sql);
        }
        $this->querynum++;
        $this->histories[] = $sql;
        return $query;
    }

    public function affected_rows() {
        return $this->link->affected_rows;
    }

    public function error() {
        return (($this->link) ? $this->link->error : mysqli_error());
    }

    public function errno() {
        return intval(($this->link) ? $this->link->errno : mysqli_errno());
    }

    public function result($query, $row) {
        if(!$query || $query->num_rows == 0) {
            return null;
        }
        $query->data_seek($row);
        $assocs = $query->fetch_row();
        return $assocs[0];
    }

    public function num_rows($query) {
        $query = $query ? $query->num_rows : 0;
        return $query;
    }

    public function num_fields($query) {
        return $query ? $query->field_count : 0;
    }

    public function free_result($query) {
        return $query ? $query->free() : false;
    }

    public function insert_id() {
        return ($id = $this->link->insert_id) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
    }

    public function fetch_row($query) {
        $query = $query ? $query->fetch_row() : null;
        return $query;
    }

    public function fetch_fields($query) {
        return $query ? $query->fetch_field() : null;
    }

    public function version() {
        return $this->link->server_info;
    }

    public function escape_string($str) {
        return $this->link->escape_string($str);
    }

    public function close() {
        return $this->link->close();
    }

    public function halt($message = '', $sql = '') {
        //show_error('run_sql_error', $message.$sql.'<br /> Error:'.$this->error().'<br />Errno:'.$this->errno(), 0);
    }
}
