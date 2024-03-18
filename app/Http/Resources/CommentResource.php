<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $decodedValue = json_decode($this->commentable_type, true); // Decode the JSON-encoded value

        return [
            'id' => $this->id,
            'body' => $this->body,
            'parent_id' => $this->parent_id,
            'user_id' => $this->user_id,
            'commentable_id' => $this->commentable_id,
            'commentable_type' => $this->commentable_type,
            'seen' => $this->seen,
            'approved' => $this->approved,
            'commentable' => $this->whenLoaded('commentable'),
            //'user' => new UserResource($this->whenLoaded('user')),

        ];
    }
}
