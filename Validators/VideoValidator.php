<?php 

//create a video validate class
class VideoValidator implements FileValidatorInterface{

    use FileHelpertrait;

    //validate the video file
    public function validate($file)
    {   

        $this->checkUploadError($file);

        $fileSize = $file['size'];

        //extract the extension of file
        $extension = $this->getExtension($file);
        //extract the mime type
        $mimeType = $this->getMimeType($file);

        //allowed extension
        $allowedExtension = ['mp4', 'webm'];
        //allowed mimetype
        $allwedMimeType = ['video/mp4', 'video/webm'];

        //check whether file match
        if(!in_array($extension, $allowedExtension)){
            throw new Exception("Invalid video file type");
        }

        if(!in_array($mimeType, $allwedMimeType)){
            throw new Exception("Invalid video mime type");
        }

        //video size should be within 5mb
        $allowedSize = 5 * 1024 * 1024;

        if($fileSize > $allowedSize){
            throw new Exception("Video size must be within 5mb");
        }
    }
}

?>