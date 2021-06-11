<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OliviaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = session('email');
        return $this->subject('Jawaban dari pertanyaan Anda.')
                   ->view('email.view')
                   ->with(
                    [
                        'nama' => $data['nama'],
                        'pertanyaan' => $data['pertanyaan'],
                        'jawaban' => $data['jawaban'],
                    ]);
        // return $this->view('view.name');
    }
}
