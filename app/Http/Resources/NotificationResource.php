<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'id' => $this->id,
            'replyBy' => $this->data['replyBy'],
            'questionTitle' => $this->data['questionTitle'],
            'questionPath' => $this->data['questionPath']
        ];
    }
}