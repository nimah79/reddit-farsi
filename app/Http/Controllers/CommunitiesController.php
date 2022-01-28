<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;

class CommunitiesController extends Controller
{
    public function list()
    {
        $communities = auth()->user()->communities;

        return view('communities.list', compact('communities'));
    }

    public function showCreateForm()
    {
        return view('communities.create');
    }

    public function create(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'unique:communities'],
            'description' => ['required'],
        ]);

        $attributes['creator_id'] = auth()->user()->id;

        $community = Community::create($attributes);
        $community->users()->attach(auth()->user());

        return redirect(route('community.list'));
    }
}
