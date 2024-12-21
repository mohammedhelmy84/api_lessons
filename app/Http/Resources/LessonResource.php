<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
             'id'=>$this->id,
             'lesson_title'=>$this->lesson_title,
             'lesson_notes'=>$this->lesson_notes,
             'created_at'=>$this->created_at
        ];
    }
}
