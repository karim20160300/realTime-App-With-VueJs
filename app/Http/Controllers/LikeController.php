<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT');
    }
    public function likeIt(Reply $reply){
        if($reply != null){
            $reply->like()->create([
                'user_id' => auth()->id(),
                // 'user_id' => '1',
            ]);
            broadcast(new LikeEvent($reply->id,1))->toOthers();
            return response('Created!', Response::HTTP_CREATED)->header('Content-Type','text/plain');
        
        }
        }

    public function unlikeIt(Reply $reply){
        if($reply != null){
            $reply->like->where('user_id',auth()->id())->first()->delete();
            broadcast(new LikeEvent($reply->id,0))->toOthers();

      return response(null, Response::HTTP_NO_CONTENT);
        }
        
    }
}
