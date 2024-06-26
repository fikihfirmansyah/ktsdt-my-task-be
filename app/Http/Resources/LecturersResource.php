<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LecturersResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'created_at' => $this->updated_at?->format('c'),
            'updated_at' => $this->updated_at?->format('c'),
        ];
    }

}
