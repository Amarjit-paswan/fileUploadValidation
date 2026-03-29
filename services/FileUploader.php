<?php 

require_once __DIR__ . '../../resolvers/ValidatorResolver.php';

class FileUploader{
    
    use FileHelpertrait;

    public function upload($files){

        $directory = __DIR__ . '../../storage/uploads';

        if(!file_exists($directory)){
            mkdir($directory,0777,true);
        }

        // iterate the files
        for($i=0; $i < count($files['name']); $i++){

            $file = [
                'name' => $files['name'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['size'][$i],
                'size' => $files['error'][$i]
            ];

            //decide which validator to call
            $resolver = new ValidatorResolver();
            $validator = $resolver->resolve($file);

            //Validat the file
            $validator->validate($file);

            //generate a unique name
            $fileName = uniqid();

            //get extension
            $extension = $this->getExtension($file);

            $path = $directory . $fileName . '.'. $extension;

            //upload file into server
            if(!move_uploaded_file($file['tmp_name'], $path)){
                throw new Exception("File Uploaded Failed");
            }
        }
    }
}


?>