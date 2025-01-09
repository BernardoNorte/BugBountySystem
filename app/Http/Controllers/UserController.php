<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function show(User $user): View
    {
        //dd($user);
        return view('users.show')->withUser($user);
    }

    public function update(Request $request, User $user): RedirectResponse
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'photo_filename' => 'nullable|image|max:2048',
        ]);


        $user = DB::transaction(function () use ($request, $user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            if ($request->hasFile('photo_filename')) {
                if ($user->photo_filename) {
                    Storage::delete('public/photos/' . $user->photo_filename);
                }

                $path = $request->photo_filename->store('photos', 'public');

                $user->photo_filename = basename($path);
                $user->save();
            }

            return $user;
        });

        return redirect()->route('home');
    }



    public function destroy_foto(User $user): RedirectResponse
    {
        if ($user->photo_filename) {
            Storage::delete('storage/photos/' . $user->photo_filename);
            $user->photo_filename = null;
            $user->save();
        }

        return redirect()->route('users.show')->withUser($user);
    }
}
