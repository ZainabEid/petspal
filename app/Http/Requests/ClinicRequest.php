<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ClinicRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $workdays = request()->workDays;


        foreach ( $workdays as $day =>$periods ) {
            foreach ( $periods as  $index => $period ) {


                $open = Carbon::parse($period['open_at']);
                $close = Carbon::parse($period["close_at"]);

                // validate that the close is after open
               if($open->greaterThan($close)) {

                throw ValidationException::withMessages(['workDays' =>'closing time should be after opening time']);
               }

               
               // compare this with all other periods in same day
               foreach ($periods as $a_period) {   

                    $other_open = Carbon::parse($a_period['open_at']);
                    $other_close = Carbon::parse($a_period['close_at']);

                    if( $open->greaterThan($other_open) && $open->lessThan($other_close) ){

                        throw ValidationException::withMessages(['workDays'=>'working hours of day '.$day.' is overlapped']);
                    }

                    if( $open->lessThan($other_open) && $close->greaterThan($other_open) ){
                        throw ValidationException::withMessages(['workDays'=>'working hours of day '.$day.' is overlapped']);
                    }
                }
               
               

            }
        }


       

        return [
            'category_id' => 'required' ,
            'name' => 'required|array|min:1',
            'description' => 'required|array|min:1',
            'address' => 'nullable|string' ,
            'phones' => ['required', 'array', 'min:1'],
            'phones.0' => ['required'],
            'phones.*' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',
            'social' =>'' ,
            'rate' =>'' ,
            
            'workDays.*.open_at' =>'date_format:H:i' ,
            'workDays.*.close_at' =>'date_format:H:i' ,

            'off_days.date' =>'date' ,
            'off_days.title' =>'nullable|string' ,
            'medias.*' => 'image' ,
        ];
    }
}
