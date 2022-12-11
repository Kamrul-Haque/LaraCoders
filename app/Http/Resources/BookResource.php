<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
//    public static $wrap = 'book';
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'authors' => AuthorResource::collection($this->authors),
            'publisher' => new PublisherResource($this->publisher),
            'publishing_date' => $this->when(request()->is('api/books/*'), $this->publishing_date),
            'isbn' => $this->isbn,
            'edition' => $this->edition,
            'pages' => $this->pages,
            'image' => route('books.image', $this->id),
        ];
    }
}
