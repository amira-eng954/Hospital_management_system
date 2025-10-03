<?php

namespace App\Events;
use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoiceEvent  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public  $doctor_id,$patient,$message,$invoice_id,$created_at;
    /**
     * Create a new event instance.
     */
    public function __construct($data)
    {
       

        $patient = Patient::find($data['patient']);
        $this->patient = $patient->name;
        $this->doctor_id = $data['doctor_id'];
        $this->invoice_id = $data['invoice_id'];
        $this->message = "كشف جديد : ";
        $this->created_at =date('Y-m-d H:i:s');

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('create-invoice'.$this->doctor_id),
        ];
    }
}
