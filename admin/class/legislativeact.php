<?php
    class Legislative{

        // Connection
        private $conn;

        // Table
        private $db_table = "tbl_principal_act";

        // Columns
        public $id;
        public $act_name;
        public $file_principal_act;
        public $act_number;
        public $gazette_citation;
        public $date_of_president_asset;
        public $file_president_asset;
        public $date_of_enforcment;
        public $file_enforcment;
        public $status;
        public $created_on;
        public $created_by;
        public $updated_on;
        public $updated_by;        

        // Db connection
        public function __construct($db){
            $this->conn = $db;

        }

       

        
        
    }
?>