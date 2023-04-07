<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function editPassword()
    {
        $title  = "Edit Password";

        return view('admin.profile.change-password', compact('title'));
    }

    public function updatePassword(Request $request)
    {
        $title = "Update Password";

        $this->validate($request, [
            'current_password' => 'required|string',
            'password' => 'required|min:6|string',
            'confirmation_password' => 'required|min:6|string',
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if ($currentPasswordStatus) {
            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back()->with([Alert::success('Success','Password berhasil diupdate')]);
        } else {
            return redirect()->back()->with([Alert::error('Error', 'Password Salah')]);
        }

    }
}
