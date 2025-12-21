<?php
namespace App\Http\traits;
trait media {
function uploadPhoto($image,$folder){


     $photoName = uniqid() . '.' .$image->extension(); //هيجيب الاكستنشن بتاع الصورة
     $image->move(public_path('/dist/image/'.$folder),$photoName);   //بكتب المسار اي هرفعه فيه الصورة و الاسم الي هخزن بية الصورة
        return $photoName;
    }

function deletePhoto($photoPath){
    if(file_exists($photoPath)){
        unlink($photoPath);
        return true;
    }
        return false;
}
}
?>
