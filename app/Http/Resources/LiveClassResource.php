<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LiveClassResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code' => $this->code,
			'name_tutor' => $this->tutor->code,
            'title' => $this->title,
            'date' => $this->date,
            'time' => $this->time,
            'link_zoom' => $this->link_zoom
        ];
    }
}
