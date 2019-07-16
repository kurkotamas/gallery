<?php

class User extends Db_object {

    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $email;
    public $user_image;
    public $tmp_path;
    public $upload_directory = "images";
    public $image_placeholder = "http://placehold.it/400x400&text=image";


    protected static $db_table = "users";
    protected static $db_id = "id";
    protected static $db_table_fields = array('username', 'password', 'firstname', 'lastname', 'email', 'user_image');


    public $errors = array();
    public $upload_errors_array = array(

        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_mac_filesize directive",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
    );

    public static function verify_user($username, $password) {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        $sql = "SELECT * FROM " . self::$db_table ." WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        $the_result_array = self::find_by_query($sql);

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public function image_path_and_placeholder() {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }

    public function set_file($file) {

        if(empty($file) || !$file || !is_array($file)) {
            $this->error[] = "There was no file uploaded here.";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = $file['name'];
            $this->tmp_path = $file['tmp_name'];
        }
    }

    public function save_user_and_image() {

        if(!empty($this->errors)) {
            return false;
        }
        if(empty($this->user_image) || empty($this->tmp_path)) {
            $this->create();
        } else {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->user_image} already exists";
            }
            if(move_uploaded_file($this->tmp_path, $target_path)) {
                if($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            }else {

                $this->errors[] = "the file directory probably does not have permission";
                return false;

            }
        }

    }

    public function ajax_save_user_image($user_image, $user_id) {
        global $database;
        $user_image = $database->escape_string($user_image);
        $user_id = $database->escape_string($user_id);

        $this->user_image = $user_image;
        $this->id = $user_id;

        $sql = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' WHERE id = {$this->id}";
        $update_image = $database->query($sql);

        echo $this->image_path_and_placeholder();
    }








}