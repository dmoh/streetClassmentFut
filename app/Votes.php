<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Votes extends Model
{
    use Notifiable;
    //

    public function matchs(){
        return $this->belongsToMany('App\Matchs');
    }

    public function user(){
        return $this->belongsToMany('App\User');
    }


    public static function sendMailToVoters($mail) {
        $mailUser = '';
        if(is_array($mail)){
            $mailUser = implode(', ', $mail);
        }else {
            $mailUser = $mail;
        }
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: StatFutCity' . "\r\n";
        $subject = "VOTE: STATFUTCITY";


        $messageToSend = view('emails.invite-to-vote')->render();

        \mail($mailUser, $subject, $messageToSend, $headers);
        return true;

    }
}
