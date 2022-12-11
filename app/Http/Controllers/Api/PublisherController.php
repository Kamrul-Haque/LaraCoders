<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function __invoke(Request $request)
    {
        $publishers = Publisher::orderBy('name')->get();

        return PublisherResource::collection($publishers);
    }
}
