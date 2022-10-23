<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use DB;

class ConsultationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->to(DB::table('consultations')->leftJoin('pets', 'consultations.pet_id', '=', 'pets.id')
        ->leftJoin('customers', 'customers.id', '=', 'pets.customer_id')
        ->leftJoin('users', 'users.id', '=', 'customers.user_id')            
        ->orderBy("consultations.created_at", "DESC")->pluck('users.email')->first());

        return $this->from('acmetpetclinic@gmail.com')->subject('new review')->view('mail')->with('info', $this->info);
    }
}
    