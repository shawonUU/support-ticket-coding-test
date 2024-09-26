<?php

use App\Models\User;

    function getNotify($type)
    {
        if ($type == 1) {
            $fmsg = 'Data Added Successfully';
        } elseif ($type == 2) {
            $fmsg = 'Data Updated Successfully';
        } elseif ($type == 3) {
            $fmsg = 'Data Deleted Successfully';
        }elseif ($type == 4) {
            $fmsg = 'Validation Error!';
        } elseif ($type == 5) {
            $fmsg = 'Operation Invalid!';
        } else {
            $fmsg = 'Message Code Error';
        }
        return $fmsg;
    }

    function isCustomer(){
        return auth()->user()->user_type == '2' ? true : false;
    }

    function isAdmin(){
        return auth()->user()->user_type == '1' ? true : false;
    }

    function adminMail(){
        $user = User::where('user_type', '1')->first();
        // return "shawonmahmodul12@gmail.com";
        return $user ? $user->email : '';
    }

    function statuses(){
        return [
            1 => 'Open',
            2 => 'In Progress',
            3 => 'Closed',
        ];
    }

    function getStatusBadge(){
        return [
            1 => 'bg-secondary',
            2 => 'bg-primary',
            3 => 'bg-success',
        ];
    }

    function getArrayData($datas, $key)
    {
        $result = isset($datas[$key]) ? $datas[$key] : '';
        return $result;
    }


?>