<?php 

class ValidatorResolver{

    public function resolve($file)
    {
        $mimeType = mime_content_type($file);

        $resolvers = [
            'image/jpg' => ImageValidator::class,
            'image/png' => ImageValidator::class,
            'image/jpeg' => ImageValidator::class,
            'video/mp4' => VideoValidator::class,
            'video/webm' => VideoValidator::class
        ];

        if(!isset($resolvers[$mimeType])){
            throw new Exception("Unsupported file type");
        }

        $class = new $resolvers[$mimeType];
        return new $class();
    }
}

?>