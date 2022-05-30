<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class complain extends Mailable
{
    use Queueable, SerializesModels;




    protected $name;
    protected $product;
    protected $complaint;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$product,$complaint)
    {
        $this->name=$name;
        $this->product=$product;
        $this->complaint=$complaint;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $name= $this->name;
        $product= $this->product;
        $complaint=$this->complaint;
        return $this->view('frontend.complaints.displayCompaint',compact('name','product','complaint'));
    }
}
