<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    protected $contact;
    
    public function __construct($contact)
    {
        //
        $this->contact=$contact;
        
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
        ->with(['contact'=>$this->contact]);
    }
}
