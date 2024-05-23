<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobResource;
use App\Http\Resources\TagsResource;
use App\Models\Tag;
use App\Traits\Api\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TagController extends Controller
{
    use Response;

    public function index(){
        return TagsResource::collection(Tag::get());
    }

    public function show($tag_id){
        try{
            $tag = Tag::findOrFail($tag_id);
            return new TagsResource($tag);
        }
        catch(ModelNotFoundException $exception){
            return $this->error('Tag not found', 404);
        }
    }
}
