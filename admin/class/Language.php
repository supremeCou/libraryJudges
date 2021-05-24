<?php
class Language{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "tbl_language";

    // table columns
    public $id;
    public $language;
    public $status;
    

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){
        $query = "INSERT INTO  " . $this->table_name . " SET language='$this->language',status='$this->status'";
        $stmt = $this->connection->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    //R
    public function read(){
        $query = "SELECT *  FROM " . $this->table_name . " WHERE status ='1' ORDER BY id DESC";
        $stmt = $this->connection->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    
    public function existingLaguage(){
        $query = "SELECT  *  FROM " . $this->table_name . " WHERE language = '$this->language' and status='1'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //U
    public function update(){}
    //D
    public function delete(){
        $query = "update " . $this->table_name . " set status ='0' where id='$this->id'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
