<?php

namespace App\Service;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper {

    /** 
     * @var string
     *
     */
    private $uploadsPath;

    public function __construct(string $uploadsPath)
    {
        $this->uploadsPath = $uploadsPath;
    }

    public function uploadArticleImage(UploadedFile $uploadedFile): string
    {
        $destination = $this->uploadsPath.'/article_image';

            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(),PATHINFO_FILENAME);
            $newFilename = Urlizer::urlize(
                $originalFilename 
                . '_' 
                . uniqid()
                . '.' 
                . $uploadedFile->guessExtension()
            );

            $uploadedFile->move(
                $destination,
                $newFilename,
            );
            return $newFilename;
    }
}
