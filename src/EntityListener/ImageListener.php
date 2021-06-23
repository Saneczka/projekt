<?php

namespace App\EntityListener;

use App\Entity\Image;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Asset\Package;

class ImageListener
{
    /**
     * @var Package
     */
//    private $assetsHelper;

    /**
     * @var FileUploader
     */
//    private $fileUploader;

//    private $imageUploadPath;

    private $image;
    private $rootPath;
/*
    public function __construct(string $rootPath)
    {
//        $this->assetsHelper = $assetsHelper;
//        $this->fileUploader = $fileUploader;
//        $this->imageUploadPath = $imageUploadPath;
        $this->appKernel = $appKernel;
    }

    public function postLoad(Image $image, LifecycleEventArgs $args): void
    {
        $image->setWebView(
            $this->assetsHelper->getUrl("/uploads/images/" . $image->getFilename())
        );

        if (!$image->getTempFilename()) {
            $image->setTempFilename($image->getFilename());
            // Enable update events to be triggered
            $image->setImageFileName(null);
        }
    }

    public function prePersist(Image $image, LifecycleEventArgs $args)
    {
        $this->image = $args->getEntity();

        $filename = $this->fileUploader->upload($this->image->getFile(), $this->imageUploadPath);
        $this->image->setImageFileName($filename);
    }

    public function preUpdate(Image $image, PreUpdateEventArgs $args)
    {
        $this->image = $args->getEntity();

        $filename = $this->fileUploader->upload($this->image->getFile(), $this->imageUploadPath);

        $this->image->setFilename($filename);
        unlink($this->imageUploadPath . "/" . $this->image->getTempFilename());
    }*/

    public function preRemove(Image $image, LifecycleEventArgs $args)
    {
//        $this->image = $args->getEntity();
//        unlink($rootPath."/public/".$this->image->getPrefixedImageFileName());
    }
}
