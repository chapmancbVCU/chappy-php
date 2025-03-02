<h1 style="font-size: 50px; text-align: center;">Uploads</h1>

## Table of contents
1. [Overview](#overview)
2. [Setup](#setup)
    * A. [Creating an uploads class](#create-uploads-class)
    * B. [Configure File Type Validation](#configure-file-type-validation)
    * C. [Migration File](#migration-file)
    * D. [Setting up the Model](#model-setup)
3. [Single File Upload](#single-file)
4. [Multiple File Upload](#multiple-file)
<br>
<br>

## Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents]
This framework supports single and multiple file uploads.  Switching between both modes is relatively easy and is achieved by changing one line of code in your view file and the action function that renders the view.  In this guide we will use the ProfileController and it's associated view located at "resources/views/profile/edit.php" as examples.
<br>

## Setup <a id="setup"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents]
The upload feature is supported by the Uploads class.  To use the Uploads class you will need to perform the following steps:
<br>

#### A. Creating an uploads class <a id="create-uploads-class">
Run the following command:

```sh
php console make:upload ProfileImage
```

Once you run this command a new class called `UploadProfileImages` will be created at `app/lib/utilities/`
<br>

#### B. Configure File Type Validation <a id="configure-file-type-validation">
Edit the validateFileType function that is found in your new class.  An example is shown below:

```php
/**
 * Validates file type and sets error message if file type is invalid.
 *
 * @return void
 */
protected function validateFileType(): void { 
    // Setup file type reporting.
    $reportTypes = [];
    foreach($this->_allowedFileTypes as $type) {
        array_push($reportTypes, image_type_to_mime_type($type));
    }

    // Perform validation and set error messages.
    foreach($this->_files as $file) {
        // checking file type
        if(!in_array(exif_imagetype($file['tmp_name']), $this->_allowedFileTypes)){
            $name = $file['name'];
            $msg = $name . " is not an allowed file type. Please use the following types: " . implode(', ', $reportTypes);
            $this->addErrorMessage($name, $msg);
        }
    }
}
```

This function consists of two for loops.  The first is used to setup reporting.  In this implementation we depend on using information from the _allowedFileTypes array for the setup of error messages.  This makes the UploadProfileImage class more usable since we initially set the file types we want to upload in the model for handling uploads.  More on setting up the model in the following section.
<br>

#### C. Migration File <a id="migration-file">
We need to create a table in the database to store information about the profile pictures we want to upload.  Run the following command to create a migration.
```sh
php console make:migration profile_images
```

Edit the up function to contain the fields you need to use for your new table.  Here is an example of of our up function:

```php
public function up() {
    $table = 'profile_images';
    $this->createTable($table);
    $this->addColumn($table, 'url', 'varchar', ['size' => 255]);
    $this->addColumn($table, 'sort', 'int');
    $this->addColumn($table, 'user_id', 'int');
    $this->addColumn($table, 'name', 'varchar', ['size' => 255]);
    $this->addSoftDelete($table);
}
```

The name of the table will already be set along with a call to create the table.  Add any extra fields that you need.  Once you are finished you can perform the migration command shown below:

```sh
php console migrate
```

Once the migration has been complete the new table will now be accessible in your database.
<br>

#### D. Setting up the Model <a id="model-setup">
First we create a new model file.

```sh
php console make:model ProfileImages
```

The new model file will be created at `app/models/`.  You will need to add instance variables for any database fields and set them to public.  We also need to add protected static instance variables for allowed file types, maximum file size, and upload path.  Finally, set the $_table variable to match the name of the table you just created.  Since profile images are associated with a user we also added a $user_id instance variable to this class to match what we have in the migration file.  The final list of instance variables is shown below:

```php
protected static $allowedFileTypes = [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG];
public $deleted = 0;
public $id;
protected static $maxAllowedFileSize = 5242880;
public $name;
protected static $_softDelete = true;
public $sort;
protected static $_table = 'profile_images';
protected static $_uploadPath = 'storage'.DS.'app'.DS.'private'.DS .'profile_images'.DS.'user_';
public $url;
public $user_id;
```

Next, add getter functions for allowed file types and maximum file sizes.  Allowed file types functions is shown below:

```php
public static function getAllowedFileTypes() {
    return self::$allowedFileTypes;
}
```

The max file size function is as follows:

```php
public static function getMaxAllowedFileSize() {
    return self::$maxAllowedFileSize;
}
```

Finally, create a function to perform the upload.  An example is shown below:

```php
/**
 * Performs upload operation for a profile image.
 *
 * @param int $user_id The id of the user that the upload operation 
 * is performed upon.
 * @param Uploads $uploads The instance of the Uploads class for this 
 * upload.
 * @return void
 */
public static function uploadProfileImage($user_id, $uploads) {
    $lastImage = self::findFirst([
        'conditions' => "user_id = ?",
        'bind' => [$user_id],
        'order' => 'sort DESC'
    ]);
    $lastSort = (!$lastImage) ? 0 : $lastImage->sort;
    $path = self::$_uploadPath.$user_id.DS;
    foreach($uploads->getFiles() as $file) {
        $parts = explode('.',$file['name']);
        $ext = end($parts);
        $hash = sha1(time().$user_id.$file['tmp_name']);
        $uploadName = $hash . '.' . $ext;
        $image = new self();
        $image->url = $path . $uploadName;
        $image->name = $uploadName;
        $image->user_id = $user_id;
        $image->sort = $lastSort;
        if($image->save()) {
            $uploads->upload($path, $uploadName, $file['tmp_name']);
            $lastSort++;
        }
    }
}
```
<br>

## Single File Upload <a id="single-file"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents]
Setting up single file uploads requires the correct configuration of your action inside of the appropriate controller and the associated view file.  Let's look at the editAction function for the ProfileController.

```php
public function editAction(): void {
    $user = Users::currentUser();
    if(!$user) {
        Session::addMessage('danger', 'You do not have permission to edit this user.');
        Router::redirect('');
    }

    $profileImages = ProfileImages::findByUserId($user->id);
    if($this->request->isPost()) {

        // Handle file uploads
        $this->request->csrfCheck();
        $files = $_FILES['profileImage'];
        $isFiles = $files['tmp_name'] != '';
        if($isFiles) {
            $uploads = new UploadProfileImage($files, ProfileImages::getAllowedFileTypes(), 
                ProfileImages::getMaxAllowedFileSize(), false, ROOT.DS, "5mb");
            
            $uploads->runValidation();
            $imagesErrors = $uploads->validates();
            if(is_array($imagesErrors)){
                $msg = "";
                foreach($imagesErrors as $name => $message){
                    $msg .= $message . " ";
                }
                $user->addErrorMessage('profileImage', trim($msg));
            }
        }

        $user->assign($this->request->get(), Users::blackListedFormKeys);
        $user->save();
        if($user->validationPassed()){
            if($isFiles) {
                // Upload Image
                ProfileImages::uploadProfileImage($user->id, $uploads);
            }
            $sortOrder = json_decode($_POST['images_sorted']);
            ProfileImages::updateSortByUserId($user->id, $sortOrder);

            // Redirect
            Router::redirect('profile/index');
        }
    }

    $this->view->profileImages = $profileImages;
    $this->view->displayErrors = $user->getErrorMessages();
    $this->view->user = $user;
    $this->view->render('profile/edit');
}
```

Let's zero in on the block of code below the comment for `Handle file uploads`.  Between single and multiple file uploads most of the code is copy in paste.  We shall focus on the following line below and explain what happens.

```php
$uploads = new UploadProfileImage($files, ProfileImages::getAllowedFileTypes(), 
    ProfileImages::getMaxAllowedFileSize(), false, ROOT.DS, "5mb");
```

The boolean value `false` is for the instance variable of the Upload class called $uploads.  When this value is set to false multiple file uploads is disabled.  ROOT.DS is the bucket variable.  Since we are using localhost for profile images it's set to the project root followed by a directory separator variable.  It can also be set as the path to a host containing an S3 bucket on a cloud base service such as Amazon Web Services (AWS).  The last variable, `5mb`, is used for messaging purposes for file size validation.

When setting up the view we use a call to the inputBlock function.  In the example below we retrieve files from POST using the value `profileImage` as shown below:

```php
<?= FormHelper::inputBlock('file', "Upload Profile Image (Optional)", 'profileImage', '', ['class' => 'form-control', 'accept' => 'image/gif image/jpeg image/png'], ['class' => 'form-group mb-3'], $this->displayErrors) ?>
```
<br>

## Multiple File Upload <a id="multiple-file"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents]
There are two main differences when it comes to setting up uploads with multiple files.  Let's look at the call for the UploadProfileImage constructor again.

```php
$uploads = new UploadProfileImage($files, ProfileImages::getAllowedFileTypes(), 
    ProfileImages::getMaxAllowedFileSize(), true, ROOT.DS, "5mb");
```

This time the value for the $multiple parameter is set to true.  That is the only change needed in your model file to switch from single file to multiple file upload mode.  The view file needs two additional changes as shown below:

```php
<?= FormHelper::inputBlock('file', "Upload Profile Image (Optional)", 'profileImage[]', '', ['multiple' => 'multiple', 'class' => 'form-control', 'accept' => 'image/gif image/jpeg image/png'], ['class' => 'form-group mb-3'], $this->displayErrors) ?>
```

The profileImage, the name attribute's value, needs brackets so that we know we are using an array of files as the value for the inputBlock function call.  You also need to add 'multiple' => 'multiple' as an element for the $inputAttrs array.  Otherwise, the window that allows users to select a file will only allow you to select one file.
