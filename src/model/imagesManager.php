<?php

/**
 * @function saveImage
 * @description saves a given image in full and cropped format
 * @warning fileNames should be generated elsewhere
 * @param array $image
 * @param int|string $postId used to define file name
 * @param int $imageNumber used to define index in file name
 * @return string|int $imageName filename | 0 if file isn't in ["png","jpeg","gif"]
 */
function saveImage($image, $postId, $imageNumber)
{

    $extension = getImageExtension($image);
    if ($extension !== 0) {

        // Check if directories exist and create them if not
        file_exists("view/content/img/original") ?: mkdir("view/content/img/original");
        file_exists("view/content/img/thumbnail") ?: mkdir("view/content/img/thumbnail");

        // uses the correct image import
        switch ($extension) {
            case "png":
                $img = imagecreatefrompng($image["tmp_name"]);
                break;
            case "jpg":
                $img = imagecreatefromjpeg($image["tmp_name"]);
                break;
            case "gif":
                $img = imagecreatefromgif($image["tmp_name"]);
                break;
        }

        // Determine whether the image is in landscape or portrait aspect ratio
        $imageWidth = imagesx($img);
        $imageHeight = imagesy($img);

        if ($imageWidth > $imageHeight) {
            //Landscape
            $cropHeight = $imageHeight;
            $cropWidth = $cropHeight;
        } else {
            //Portrait
            $cropWidth = $imageWidth;
            $cropHeight = $cropWidth;
        }

        // Crop for thumbnail
        $thumbnail = imagecrop($img, ["x" => ($imageWidth - $cropWidth) / 2, "y" => ($imageHeight - $cropHeight) / 2, "width" => $cropWidth, "height" => $cropHeight]);
        $thumbnail = imagescale($thumbnail, 512, 512);

        // Save to jpeg to save space
        $imageName = "$postId-$imageNumber.jpg";
        imagejpeg($thumbnail, "view/content/img/thumbnail/" . $imageName, 100);
        imagejpeg($img, "view/content/img/original/" . $imageName, 100);

        // Destroys the variables to save ram usage
        imagedestroy($img);
        imagedestroy($thumbnail);
    } else {
        $imageName = 0;
    }

    return $imageName;
}

/**
 * @function getImageExtension
 * @description gets file extension if it's an image
 * @return string|int $ext file extension|0 if no in ["png","jpeg","gif"]
 */
function getImageExtension($file)
{
    switch (getimagesize($file["tmp_name"])["mime"]) {
        case "image/png":
            $ext = "png";
            break;
        case "image/jpeg":
            $ext = "jpg";
            break;
        case "image/gif":
            $ext = "gif";
            break;
        default:
            $ext = 0;
    }
    return $ext;
}
