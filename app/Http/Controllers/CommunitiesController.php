<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\User;
use Illuminate\Http\Request;

class CommunitiesController extends Controller
{
    public function list()
    {
        $communities = auth()->user()->communities;

        return view('communities.list', compact('communities'));
    }

    public function admins(Community $community)
    {
        if (!$community->admins()->whereUserId(auth()->user()->id)->exists()) {
            abort(403);
        }

        return view('communities.admins', compact('community'));
    }

    public function addAdmin(Community $community, Request $request)
    {
        if (!$community->admins()->whereUserId(auth()->user()->id)->exists()) {
            abort(403);
        }

        $attributes = $request->validate([
            'username' => ['required', 'exists:users'],
        ]);

        $user = User::whereUsername($attributes['username'])->first();

        if ($community->admins()->whereUserId($user->id)->exists()) {
            return back()->withErrors([
                'name' => __('این کاربر قبلاً به‌عنوان مدیر به انجمن اضافه شده است.'),
            ]);
        }

        if (!$community->users()->whereUserId($user->id)->exists()) {
            $community->users()->attach($user);
        }
        $community->admins()->attach($user);

        return back();
    }

    public function deleteAdmin(Community $community, User $user)
    {
        if (!$community->admins()->whereUserId(auth()->user()->id)->exists()) {
            abort(403);
        }

        $community->admins()->detach($user);
        $community->users()->detach($user);

        return redirect()->route('community.admins', ['community' => $community->id]);
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
        $community->admins()->attach(auth()->user());

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

    public function show(Community $community, Request $request)
    {
        $q = $request->query('q') ?? $request->q;
        if ($q) {
            $q = strip_tags($q);
        }
        $sortType = $request->query('sort') ?? $request->sort ?? 'created_at';
        if (!in_array($sortType, ['created_at', 'comments_count', 'likes_count'])) {
            $sortType = 'created_at';
        }
        $posts = $community->posts()
            ->orderBy($sortType, 'desc')
            ->orderBy('id', 'desc');
        if ($q) {
            $posts = $posts->join('users', 'posts.user_id', '=', 'users.id')
                ->join('communities', 'posts.community_id', '=', 'communities.id')
                ->where('title', 'like', '%' . $q . '%')
                ->orWhere('body', 'like', '%' . $q . '%')
                ->orWhere('users.username', 'like', '%' . $q . '%')
                ->orWhere('communities.name', 'like', '%' . $q . '%');
        }
        $posts = $posts->paginate(12)->withQueryString();

        return view('communities.show', compact('community', 'posts', 'sortType', 'q'));
    }
}
