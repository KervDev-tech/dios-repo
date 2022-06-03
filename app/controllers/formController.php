<?php

//made by Kervin Zoren Bonaobra 

//class for form handling

class formController{

    protected function test_input($data) {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    protected function is_valid_email($email){

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $error = "Invalid email format";

            return $error;
        }

        else {

            $error = "";

            return $error;
        }

    }

    protected function is_num_lett_spechar_only($value){

        if (!preg_match("#^[a-zA-Z0-9ñäöüÄÖÜ_]+$#", $value)) {

            $error = "Only letters, numbers and special characters allowed";

            return $error;
        }
        else {
            $error = "";

            return $error;
        }
    }

    protected function is_lett_space_spechar_only($value){

        if (!preg_match("#^[a-zA-ZñäöüÄÖÜ ]+$#", $value)) {

            $error = "Only letters and white spaces  allowed";

            return $error;
        }
        else {
            $error = "";

            return $error;
        }
    }

    protected function is_num_lett_space_only($value){

        if (!preg_match("#^[a-zA-Z0-9ñäöüÄÖÜ ,.]+$#", $value)) {

            $error = "Only letters, numbers and white space allowed";
        
            return $error;
        
        }
        else {

            $error = "";

            return $error;
        }
    }

    protected function is_num_lett_only($value){

        if (!preg_match("#^[a-zA-Z0-9]+$#", $value)) {
           
            $error = "Only letters and numbers only, no spaces allowed";   
         
            return $error;
        }
        else{

            $error = "";

            return $error;
        } 

    }

    protected function is_lett_space_only($value){

        if (!preg_match("/^[a-zA-Z-' ]*$/", $value)) {
            
            $error = "Only letters and white space allowed";

            return $error;
          
        }
        else{
            $error = "";

            return $error;
        }
    }

    protected function is_num_only($value){

        if (!preg_match("/^([0-9\(\)\/\+ \-]*)$/", $value)) {
           $error = "Please input valid format";
        
           return $error;
        }
        else{
            $error = "";

            return $error;
        }

    }

    protected function is_valid_date($date){
        if (DateTime::createFromFormat('Y-m-d', $date)->format('Y-m-d') === $date) {
            $error = "";

            return $error;
        
        }
        else{
            $error = "Please input valid date";

            return $error;
        }
    }
}

?>