<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function showEditForm()
    {
        return view('account');
    }

    public function edit(Request $request)
    {
        $rules = [
            'email' => ['email'],
        ];
        if (!empty($request->password)) {
            $rules['password'] = ['sometimes', 'confirmed', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'];
        }
        $credentials = $request->validate($rules);

        $user = auth()->user();

        if (!empty($request->username) && $request->username != $user->username && User::whereUsername($request->username)->exists()) {
            return back()->withErrors([
                'username' => __('نام کاربری واردشده قبلاً استفاده شده است.'),
            ]);
        }

        if (!empty($request->email) && $request->email != $user->email && User::whereUsername($request->email)->exists()) {
            return back()->withErrors([
                'email' => __('ایمیل واردشده قبلاً استفاده شده است.'),
            ]);
        }

        if ($request->username) {
            $user->username = $request->username;
        }
        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect(route('account'));
    }
}
