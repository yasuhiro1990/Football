<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuthContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    protected $acount;
    
    public function __construct($acount)
    {
        //
        $this->acount=$acount;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('higuain20@hotmail.co.jp')//送信元
        ->subject('試合がしたい')//標題タイトル
        ->view('mail.contact')//メッセージテンプレ
        ->with(['acount'=>$this->acount]);
    }
}
