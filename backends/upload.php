<?php 

// $targetpath = "uploads/" . basename($_FILES['profile']['name']);
// move_uploaded_file($_FILES['profile']['tmp_name'],$targetpath);

require_once './action.php';

$db = new Action();
// insert data here 
if(isset($_POST['img_upload'])){
    $counter = 0;
    foreach ($_FILES['profile']['tmp_name'] as $key => $value) {
        $filename = $_FILES['profile']['name'][$key];
        $tmp_name = $value;
        $img = $db->exit_img($filename);
        if($img == null){
            if(move_uploaded_file($tmp_name,'../assets/img/'.$filename)){
                $db->insert($filename);
                $counter++;
            }
        }
    }
    echo $counter . " image uploaded";
}

if(isset($_GET['read'])){
    $images = $db->selectAll();
    echo json_encode($images);
}

if(isset($_GET['delete'])){
    $id = $_GET['id'];
    $data = $db->select($id);
    if(unlink('../assets/img/'.$data['img_name'])){
        $db->delete($id);
        echo "image successfully deleted";
    }else{
        echo "image not deleted";
    }
}

?>