<?php
    class Users{

        // Connection
        private $conn;

        // Table
        private $db_table = "tbl_user";

        // Columns
        public $id;
        public $user_email;
        public $user_name;
        public $user_password;
        public $user_department;
        public $created_on;
        public $updated_on;
        public $created_by;  
        public $status;         

        // Db connection
        public function __construct($db){
            $this->conn = $db;

        }

       

        // CREATE
        public function createUser(){



           $sqlQuery = "INSERT INTO tbl_user
                                            SET
                        user_name = :user_name, 
                        user_email = :user_email, 
                        user_password = :user_password, 
                        user_department = :user_department, 
                        created_by = :created_by";

                   
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->user_name=htmlspecialchars(strip_tags($this->user_name));
            $this->user_email=htmlspecialchars(strip_tags($this->user_email));
            $this->user_password=htmlspecialchars(strip_tags($this->user_password));
            $this->user_department=htmlspecialchars(strip_tags($this->user_department));
            $this->created_by=htmlspecialchars(strip_tags($this->created_by));
        

                    // bind data
            $stmt->bindParam(":user_name", $this->user_name);
            $stmt->bindParam(":user_email", $this->user_email);
            $stmt->bindParam(":user_password", $this->user_password);
            $stmt->bindParam(":user_department", $this->user_department);
            $stmt->bindParam(":created_by", $this->created_by);
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }//end of create


        // GET ALL
        public function getUsers(){
             $sqlQuery = "SELECT id, user_name, user_email,user_department  ,status, created_on FROM ".$this->db_table." WHERE status='1' ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }


        public function UniqueEmailCheck(){
            $sqlQuery = "SELECT count(*) as cntUser FROM ".$this->db_table." WHERE status='1' AND user_email=? ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->user_email);
            $stmt->execute();
            return $count = $stmt->fetchColumn();
        }


        public function DuplicateEmailCheck(){
            $sqlQuery = "SELECT count(*) as cntUser FROM ".$this->db_table." WHERE status='1' AND user_email=:user_email AND id !=:id ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":user_email", $this->user_email);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return $count = $stmt->fetchColumn();
        }





                // READ single
        public function getSingleUser(){
            
            $sqlQuery = "SELECT id, user_name, user_email,user_department  ,status, created_on ,user_password                        
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

             return $stmt;

            
        } 



///Update table data

       public function update($data,$conditions){
        if(!empty($data) && is_array($data)){
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            if(!array_key_exists('modified',$data)){
                $data['updated_on'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $val=htmlspecialchars(strip_tags($val));
                $colvalSet .= $pre.$key."='".$val."'";
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $sql = "UPDATE ".$this->db_table." SET ".$colvalSet.$whereSql;

            //echo $sql;
            $stmt = $this->conn->prepare($sql);
            $update = $stmt->execute();
            //print_r($update);die;
            return $update?$stmt->rowCount():false;
        }else{
            return false;
        }
    }//end of update statment




    /*
     * Delete data from the database
     * @param string name of the table
     * @param array where condition on deleting data
     */
    public function delete($conditions){
        $whereSql = '';
        if(!empty($conditions)&& is_array($conditions)){
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $sql = "DELETE FROM ".$this->db_table.$whereSql;
        //echo $sql;
        $stmt = $this->conn->prepare($sql);
        $delete = $stmt->execute();
        return $delete?$delete:false;
    }//end of delete function







        
    }
?>