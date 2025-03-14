<?php
namespace Core\Lib\FileSystem;

/**
 * Supports the ability to upload a single profile image at a time.
 */
class UploadProfileImage extends Uploads {
    /**
     * Creates instance of UploadProfileImage class.
     *
     * @param array|string $files Array of files or the name to be uploaded.
     * @param array $fileTypes An array containing a list of acceptable file 
     * types for a particular upload action.
     * @param int $maxAllowedSize Maximum allowable size for a particular 
     * file.  This can vary depending on requirements.
     * @param bool $multiple A boolean flag to set whether or not we are 
     * working with a single file upload or an array regarding form setup.
     * @param string $bucket The location where the files will be stored.
     * @param string $sizeMsg The message describing the maximum allowable 
     * size usually described as <size_as_an_int><bytes|mb|gb> (e.g.: 5mb).
     */
    public function __construct(array|string $files, array $fileTypes, int $maxAllowedSize, bool $multiple, string $bucket, string $sizeMsg) {
        parent::__construct($files, $fileTypes, $maxAllowedSize, $multiple, $bucket, $sizeMsg);
    }

    /**
     * Performs validation on profile image uploads.  This function focuses on 
     * file size and file type.
     *
     * @return void
     */
    public function runValidation(): void {
        $this->validateSize();
        $this->validateFileType();
    }

    /**
     * Validates file type and sets error message if file type is invalid.
     *
     * @return void
     */
    // protected function validateFileType(): void { 
    //     $reportTypes = [];
    
    //     // Ensure allowed file types are in lowercase to avoid case-sensitivity issues
    //     $allowedFileTypes = array_map('strtolower', $this->_allowedFileTypes);
    
    //     foreach ($this->_allowedFileTypes as $type) {
    //         if (is_int($type)) {
    //             // Convert image type constant to MIME type
    //             $reportTypes[] = image_type_to_mime_type($type);
    //         } else {
    //             // Assume it's already a MIME type
    //             $reportTypes[] = strtolower($type);
    //         }
    //     }
    
    //     foreach ($this->_files as $file) {
    //         $filePath = $file['tmp_name'];
    //         $fileName = $file['name'];
    
    //         // Check if file exists
    //         if (!file_exists($filePath)) {
    //             $this->addErrorMessage($fileName, "Error: File does not exist.");
    //             continue;
    //         }
    
    //         $finfo = finfo_open(FILEINFO_MIME_TYPE);
    //         $mimeType = finfo_file($finfo, $filePath);
    //         finfo_close($finfo);

    
    //         // Debugging: Log MIME type to check if it matches expectations
    //         error_log("Checking file: $fileName | Detected MIME type: $mimeType");
    
    //         // Check if the file type is allowed
    //         if (!in_array($mimeType, $allowedFileTypes, true)) {
    //             $msg = "$fileName is not an allowed file type. Please use the following types: " . implode(', ', $reportTypes);
    //             $this->addErrorMessage($fileName, $msg);
    //         }
    //     }
    // }
    
}