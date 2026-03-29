<?php 

trait FileHelpertrait{

    //get the extension of file
    public function getExtension($file){
        return strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    }

    //get the mime type of file
    public function getMimeType($file){
        return mime_content_type($file['tmp_name']);
    }

    //check the file upload error
    public function checkUploadError($file){
        if($file['error'] !== 'UPLOAD_ERR_OK'){
            throw new Exception("File upload error");
        }
    }

  
}

?>