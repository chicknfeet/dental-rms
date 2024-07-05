<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\CommunityForum;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $communityforums = CommunityForum::all();
        $communityforums = CommunityForum::paginate(2);
        return view('welcome', compact('communityforums'));
    }

    public function storeCommunityforum(Request $request){
        $request->validate([
            'topic' => 'required|string',
        ]);

        $communityforum = CommunityForum::create([
            'topic' => $request->input('topic'),
        ]);

        return redirect()->route('admin.communityforum')
            ->with('success', 'Topic added successfully!');
    }

    public function showComment($communityforumId)
    {
        $communityforums = CommunityForum::findOrFail($communityforumId);
        $comments = $communityforums->comments;

        return view('admin.communityforum.showComment', compact('communityforums', 'comments'));
    }
}
