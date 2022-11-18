<?php

namespace App\Http\Livewire;

use App\Message;
use App\User;
use Livewire\Component;

class Messages extends Component
{
    public $message;
    public $allmessages;
    public $sender;

    public function render()
    {

        $sender_receiver = Message::getUsers();
        $getUser = User::whereIn('id',  $sender_receiver)->get();
        $users= auth()->user()->user_type != 2 ? User::all() :  $getUser;
        $sender=$this->sender;
        $this->allmessages;
        return view('livewire.messages',compact('users','sender'));
    }

    public function mountdata()
    {
        if(isset($this->sender->id))
        {
            $this->allmessages= Message::where('user_id',auth()->id())
                                    ->where('receiver_id',$this->sender->id)
                                        ->orWhere('user_id',$this->sender->id)
                                    ->where('receiver_id',auth()->id())
                                    ->orderBy('id','asc')->get();

            $not_seen= Message::where('user_id',$this->sender->id)->where('receiver_id',auth()->id());
            $not_seen->update(['is_seen'=> true]);
        }

    }

    public function resetForm()
    {
        $this->message='';
    }

    public function SendMessage()
    {
        $data=new Message;
        $data->message=$this->message;
        $data->user_id=auth()->id();
        $data->receiver_id=$this->sender->id;
        $data->save();

        $this->resetForm();


    }

    public function getUser($userId)
    {
        $user=User::find($userId);
        $this->sender=$user;
        $this->allmessages=Message::where('user_id',auth()->id())->where('receiver_id',$userId)->orWhere('user_id',$userId)->where('receiver_id',auth()->id())->orderBy('id','asc')->get();
    }
}
