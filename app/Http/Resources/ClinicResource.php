<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClinicResource extends JsonResource
{
    
    public function toArray($request)
    {
       
        return[
            'category' => $this->clinics_category_id,
            'name' =>  $this->name,
            'description' =>  $this->description,
            'address' => $this->address,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            
            'rate' => $this->rate ,
            
            'phones' => $this->phones ,
            'workingDays'=>$this->workDays,
            'off_days'=>$this->off_days,
            'medias'=>$this->medias,

        ];

        // return parent::toArray($this);
    }
}
