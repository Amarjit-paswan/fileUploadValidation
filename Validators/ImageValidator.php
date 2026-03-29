<?php 

class ImageValidator implements FileValidatorInterface{
    use FileHelpertrait;

    public function validate($file){

        $this->checkUploadError($file);

        $fileSize = $file['size'];

        //extract the extension of file
        $extension = $this->getExtension($file);
        //extract the mime type
        $mimeType = $this->getMimeType($file);

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