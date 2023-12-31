<?php

namespace App\Http\Controllers;

use App\Models\Blogpost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        $userBlogs = Blogpost::with('category', 'author')
            ->where('user_id', $user->id)
            ->latest()
            ->filter(request(['search', 'category', 'author']))
            ->paginate(6)
            ->withQueryString();
        
        $isProfilePage = true;
    
        return view('profile.index', [
            'blogposts' => $userBlogs,
            'isProfilePage' => $isProfilePage,
        ]);
    }

    public function edit(User $user)
    {
        return view('profile.editprofile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $formData = $request->validate([
            'name' => 'required|max:255|min:3',
            'email' => 'required|email',
            'username' => [
                'required',
                'max:255',
                'min:6',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'job' => 'max:255',
            'bio' => 'max:100',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        if ($request->hasFile('avatar')) {
            $formData['avatar'] = $request->file('avatar')->store('avatars');
        } else {
            $formData['avatar'] = $user->avatar;
        }

        $user->update($formData);

        return view('profile.editprofile');
    }

    public function editPassword(User $user)
    {
        return view('profile.editpassword', [
            'user' => $user,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect.'])->withInput();
        }

        auth()->user()->update([
            'password' => bcrypt($request->new_password),
        ]);

        return redirect('/blogposts/profile/editpassword')->with('success', 'Password updated successfully.');
    }

   public function admin_index(Request $request)
    {
        $search = $request->input('search');

        $users = User::searchUsers($search);

        return view('users.index', compact('users'));
    }


    public function giveAdmin(Request $request, $id)
    {
        $user = User::find($id);
        $user->is_admin = 'Admin';
        $user->save();

        return back();
    }

    public function removeAdmin(Request $request, $id)
    {
        $user = User::find($id);
        $user->is_admin = 'User';
        $user->save();

        return back();
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return back();
    }
}

