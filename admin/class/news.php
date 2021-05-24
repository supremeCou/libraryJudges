<?php
class News{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "tbl_news";

    // table columns
    public $id;
    public $title;
    public $language;
    public $date;
    public $subject;
    public $article;
    public $file;
    public $status;
    

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){
        $query = "INSERT INTO  " . $this->table_name . " SET title='$this->title',language='$this->language',news_date='$this->date',"
                . "subject='$this->subject',new_article='$this->article',news_file='$this->file',status='1'";
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
}
