<?php

namespace App\Http\Resources;

use App\Models\Genre;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'photo' => $this->ImageRec,
            'sampleText' => $this->sample,
            'slug' => $this->slug,
            'date' => $this->created_at->format('d M Y'),
            'views' => $this->countUser,
            'category' => $this->categoryName->name,
        ];
    }
}
