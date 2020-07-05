<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $register;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($register)
    {
        $this->register = $register;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $register = $this->register;
        $identitas = \App\Models\Identitas::where('id', 1)->first();

        //render meta data
        $text = $register->thisFormRegister->register_email_confirm;
        $register_data = $register->hasRegisterData;
        foreach ($register_data as $row) {
           $field = $row->thisFormStep->metadata;
           $field = json_decode($field);
           $data = $row->data;
           $data = json_decode($data);
           
           foreach($field as $key => $this_field)
           {
                $this_value = '';
                foreach ($data as $this_data) {
                    if($this_field->field_name == $this_data->field_name)
                    {
                        if($this_field->type == 'file')
                        {
                            $this_value = $this_data->path;
                        }else{
                            $this_value = $this_data->value;
                        }
                    }
                }
                if(!empty($this_value)){
                    switch ($this_field->type) {
                        case 'text':
                        case 'title':
                        case 'number':
                        case 'date':
                        case 'select':
                        case 'radio':
                        case 'textarea':
                            $value = htmlentities($this_value);
                            $text = str_replace('${'.$this_field->field_name.'}',$value, $text);
                            break;
                        case 'checkbox':
                        case 'multitext':
                            $values = '';
                            foreach ($this_value as $d => $i) {
                                $values .= ($d+1)."). ".$i;
                            }
                            $value = htmlentities($value);
                            $text = str_replace('${'.$this_field->field_name.'}',$value, $text);
                            break;
                        case 'address':
                        case 'address_autocomplete':
                            $value = end($this_value);
                            $value = htmlentities($value);
                            $text = str_replace('${'.$this_field->field_name.'}',$value, $text);
                            break;
                        default:
                            break;
                    }
                }
           }

        }

        return $this->subject(''.$register->thisFormRegister->form_name)->view('emails.register',compact('register','identitas','text'));
    }
}
