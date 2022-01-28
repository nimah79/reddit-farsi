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

    public function showEditForm(Community $community)
    {
        return view('communities.edit', compact('community'));
    }

    public function edit(Community $community, Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
        ]);

        if ($attributes['name'] != $community->name && Community::whereName($attributes['name'])->exists()) {
            return back()->withErrors([
                'name' => __('نام قبلاً انتخاب شده است.'),
            ]);
        }

        $community->fill($attributes);
        $community->save();

        return redirect(route('community.list'));
    }
}
