<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'reply' => $this->body,
            'questionSlug' => $this->question->slug,
            'likesCount' => $this->like->count(),
            'liked' => $this->like->where('user_id', auth()->id())->count(),
            'user' => $this->user->name,
            'user_id' => $this->user->id,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
