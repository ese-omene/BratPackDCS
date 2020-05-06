<?php


class Validate
{
    public function validateForm($c_name, $p_name, $p_email, $address, $phone, $form_errs){
        if (empty($c_name)) {
            $form_errs .= "Please enter your child's name<br/>";
        }
        if (empty($p_name)){
            $form_errs .= "Please enter your name<br/>";
        }
        if (empty($phone)) {
            $form_errs .= "Please enter phone<br/>";
        } else {
            $pattern = "/^[1-9]\d{2}-\d{3}-\d{4}/";
            if (checkPattern($pattern, $phone)) {
                $form_errs .= "Please enter valid phone number<br/>";
            }
        }
        if (empty($p_email)) {
            $form_errs .= "Please enter email<br/>";
        } else {
            if (!filter_var($p_email, FILTER_VALIDATE_EMAIL)) {
                $form_errs .= "Please enter valid email format<br/>";
            }
        }
        if (empty($address)) {
            $form_errs .= "Please enter your address<br/>";
        }

        return $form_errs;
    }

    public function checkPattern($pattern, $value){
        return !preg_match($pattern, $value);
    }
}