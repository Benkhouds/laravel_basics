<?php


namespace App\Services;


class MailingServiceNewsletter implements Newsletter
{

    public function subscribe(string $email , string $list=null) : void
    {
       echo "test" ;
    }
}
