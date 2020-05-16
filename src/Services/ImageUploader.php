<?php

namespace App\Services;

use Exception;


class ImageUploader
{
    protected $url;

    public function setPublicPath(string $path) : void
    {
      /** TODO:
         This shit needs to be refactored.
         Have to create an installer which
         makes sure that all dirs are existent.
      */
      if (!file_exists($path)) {
        mkdir($path, 0766, true);
      }

      $this->url = $path;
    }

    /**
     * @param mixed $image
     */
    public function save($image)
    {
      if (!isset($this->url)) {
        throw new Exception('Cannot save file to undefined directory');
      }

      $filename = md5(uniqid()) . '.' . $image->guessClientExtension();
      
      $image->move(
        $this->url,
        $filename
      );

      return $filename;
    }

    public function unlink(string $imagePath) {
      if (!file_exists($this->url . $imagePath)) {
        throw new Exception('Cannot find file to delete');
        return;
      }

      unlink($this->url . $imagePath);
    }
}