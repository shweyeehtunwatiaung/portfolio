<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfilesController extends Controller
{
    public function index()
    {

        $users = User::all();

        return view('admin.profiles.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }


    public function edit(User $user)
    {
        $users = User::all();

        return view('admin.profiles.edit', compact('users'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        $user = User::find(auth()->id());
        $user->update($request->all());
        if($request->hasFile('image')) {
            $img = $request->file('image');
            $folder = public_path('upload/profile/');
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $img->move($folder, $imgName);
            $old_folder=$folder.$user->image;
            if(file_exists($old_folder)){
                @unlink($old_folder);
            }
            $user->image = $imgName;
        }

        if($request->password !== null) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('admin.profiles.index')->with('status', 'User was updated successfully.');
    }

    public function show(User $user)
    {
       // abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        //abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
