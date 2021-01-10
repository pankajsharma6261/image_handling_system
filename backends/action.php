<?php 


require_once './dbConnection.php';

class Action extends Database {

    public function insert($filename = ''){
        $sql = "INSERT INTO images(img_name) VALUES(:img_name)";
        $result = $this->conn->prepare($sql);
        $result->execute([ 'img_name' => $filename ]);
        return true ;
    }

    public function selectAll(){
        $sql = "SELECT * FROM images";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function select($id){
        $sql = "SELECT * FROM images WHERE id=:id";
        $stm = $this->conn->prepare($sql);
        $stm->execute([ 'id' => $id ]);
        $result = $stm->fetch();
        return $result;
    }
    public function exit_img($name){
        $sql = "SELECT * FROM images WHERE img_name=:name";
        $stm = $this->conn->prepare($sql);
        $stm->execute([ 'name' => $name ]);
        $result = $stm->fetch();
        return $result;
    }

    public function delete($id){

        $sql = "DELETE FROM images WHERE id=:id";
        $stm = $this->conn->prepare($sql);
        $stm->execute([ 'id' => $id ]);
        return true;
    }
}


?>