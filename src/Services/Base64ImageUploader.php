<?php

namespace App\Services;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class Base64ImageUploader extends ImageUploader
{
  /**
   * Retrive file format + base64 image.
   * @return Array
   */
  private function processBase64(string $image)
  {
    list($type, $data) = explode(';', $image);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);
    $type = explode('/', $type)[1];
    $type = explode('+', $type)[0];

    return [$type, $data];
  }

  /**
   * Save image to /public/uploads/images/countries
   * 
   * @param string $image - Raw image representation.
   * @param string $imagePrefix - Image prefix to differentiate countries.
   */
  public function save($image) {
    [$type, $data] = $this->processBase64($image);
    $filename = date('YmdHms') . md5(uniqid('', true)) . '.' .$type;

    var_dump($this->url);
    file_put_contents($this->url . $filename, $data);

    return $filename;
  }

}