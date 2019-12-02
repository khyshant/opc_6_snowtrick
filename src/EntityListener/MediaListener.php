<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 02/12/2019
 * Time: 01:10
 */

namespace App\EntityListener;

use App\Entity\Media;

class MediaListener
{
    /**
     * @var string
     */
    private $uploadDirAbsolutePath;

    /**
     * MediaListenet constructor.
     * @param string $uploadDirAbsolutePath
     */
    public function __construct(string $uploadDirAbsolutePath)
    {
        $this->uploadDirAbsolutePath = $uploadDirAbsolutePath;
    }

    /**
     * @param Media $media
     */
    public function prePersist(Media $media)
    {
        if ($media->getUploadedFile() === null) {
            return;
        }

        $filename = md5(uniqid("", true)) . "." . $media->getUploadedFile()->guessExtension();
        $media->getUploadedFile()->move($this->uploadDirAbsolutePath, $filename);
        $media->setUri($filename);
    }
}