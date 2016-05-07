<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $email;
    protected $data;
    protected $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$email,$type)
    {
        //
        $this->email = $email;
        $this->data = $data;
        $this->type = $type;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->type == 'initial_reservation_mail') {
            Mail::send('emails.InitialRoomReservationMail', $this->data, function ($message) {
                $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $message->to($this->email)->subject('Welcome to Amalya Reach!');
            });
        } elseif($this->type == 'confirm_room_reservation_mail') {
            Mail::send('emails.RoomReservationMail', ["mail_detail"=>$this->data], function ($message) {
                $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $message->to($this->email)->subject('Welcome to Amalya Reach!');
            });
        } elseif($this->type == 'reject_room_reservation_mail') {
            Mail::send('emails.RoomReservationRejectMail', ["mail_detail"=>$this->data], function ($message) {
                $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $message->to($this->email)->subject('Welcome to Amalya Reach!');
            });
        }elseif($this->type == 'confirm_hall_reservation_mail') {
            Mail::send('emails.HallReservationMail', ["mail_detail"=>$this->data], function ($message) {
                $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $message->to($this->email)->subject('Welcome to Amalya Reach!');
            });
        } elseif($this->type == 'reject_hall_reservation_mail') {
            Mail::send('emails.HallReservationRejectMail', ["mail_detail"=>$this->data], function ($message) {
                $message->from(env('MAIL_FROM'), env('MAIL_NAME'));

                $message->to($this->email)->subject('Welcome to Amalya Reach!');
            });
        }



    }
}
