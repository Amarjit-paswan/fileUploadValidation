<?php 

class ImageValidator implements FileValidatorInterface{

    public function validate($file){

        // store uploaded file info
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];

        //find the extension of file
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $mimeType = mime_content_type($fileTmpName);

        $allowedExtension = ['png','jpeg', 'jpg']; //allowed extension
        $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/jpg']; //allowed mime types

        if(!in_array($extension, $allowedExtension)){
            throw new Exception("Image type must be png, jpeg and jpg");
        }

        if(!in_array($mimeType, $allowedMimeTypes)){
            throw new Exception("Invalid file content");
        }

        //allowed size
        $allowedSize = 2 * 1024 * 1024;

        if($fileSize > $allowedSize){
            throw new Exception("Image file size must be within 2 mb");
        }
    }

}

?>