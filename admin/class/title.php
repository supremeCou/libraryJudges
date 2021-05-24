<?php
class Title{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "tbl_news_title";

    // table columns
    public $id;
    public $language;
    public $title;
    public $status;
    

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){
        $query = "INSERT INTO  " . $this->table_name . " SET title_name='$this->title',laguage_id='$this->language',status='$this->status'";
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
        $query = "SELECT  *  FROM " . $this->table_name . " WHERE title_name='$this->title' AND laguage_id = '$this->language'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //U
    public function update(){}
    //D
    public function delete(){
        $query = "delete from " . $this->table_name . " where id='$this->id' and laguage_id='$this->language'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function getTitleList() {
        $query = "select * from " . $this->table_name . " where  laguage_id='$this->language'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function getTitleIdbyName() {
        $titleArr = array();
        $query = "SELECT id,title_name  FROM " . $this->table_name . "";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        while ($res = $stmt->fetch(PDO::FETCH_ASSOC)){
              $titleArr[$res['id']] = $res['title_name'];
        }
        return $titleArr;
    }
}
