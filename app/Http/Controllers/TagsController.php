<?php

namespace App\Http\Controllers;

use App\DTOs\App\ErrorDTO;
use App\DTOs\Posts\PostDTO;
use App\Exceptions\AppException;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\UserResourse;
use App\Models\Otp;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagsController extends Controller
{

    public function index(Request $request)
    {
        $tags = Tag::all();

        return ok(data:TagResource::collection($tags));

    }


}
