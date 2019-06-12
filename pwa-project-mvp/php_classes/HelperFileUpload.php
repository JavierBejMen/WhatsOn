<?php

final class HelperFileUpload
{
    public static function isFileUploaded(array $file): bool
    {
        return is_uploaded_file($file["tmp_name"]);
    }
    public static function moveUploadedFileToDestinationFilePath(array $file, string $absoluteFilePath): bool
    {
        return move_uploaded_file($file["tmp_name"], $absoluteFilePath);
    }
}
