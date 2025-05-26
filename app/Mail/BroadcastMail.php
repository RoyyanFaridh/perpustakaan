<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BroadcastMail extends Mailable
{
    use Queueable, SerializesModels;

    public $judul;
    public $isi;

    /**
     * Create a new message instance.
     */
    public function __construct($judul, $isi)
    {
        $this->judul = $judul;
        $this->isi = $isi;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->judul)
                    ->view('emails.broadcast')
                    ->with([
                        'judul' => $this->judul,
                        'isi' => $this->isi,
                    ]);
    }
}
