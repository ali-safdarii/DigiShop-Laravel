<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function redirect;
use function view;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     return view('layouts.admin.user.admin-user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('layouts.admin.user.admin-user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,ImageService $imageService)
    {
        $user = new User();
        $images = [];
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images/user-avatar');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false) {
                return redirect()->route('admin.admin.index');
            }
            $images = $request->image = $result;

        }


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        // $user->password_confirmation = $request->password_confirmation;
        $user->status = $request->status;
        $user->user_type = 1; // [1 => Admin , 0 => user ]
        $user->image = $images;
        $user->save();


        return redirect()->route('admin.admin.index')
            ->with('success', 'UserAdmin Succesfull created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        return view('layouts.admin.user.admin-user.show',['user'=>$admin]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin,ImageService $imageService)
    {
        $images = $admin->image;

        if ($request->hasFile('image')) {
            if (!empty($admin->image)) {
                $imageService->deleteDirectoryAndFiles($admin->image['directory']);
            }
            $imageService->setExclusiveDirectory('images/user-avatar');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result) {
                return redirect()->route('admin.admin.index');
            }
            $images = $request->images = $result;
        } elseif ($request->has('currentImage') && $admin->image) {
            $images = $request->images = array_merge($admin->image, [
                'currentImage' => $request->input('currentImage')
            ]);
        }

        $admin->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'status' => $request->status,
            'activation' => $request->activation,
            'image' => $images
        ]);


        return redirect()->route('admin.admin.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin,ImageService $imageService)
    {
        $imageService->deleteDirectoryAndFiles($admin->image['directory']);
        $admin->delete();
        return redirect()->route('admin.admin.index')
            ->with('success', 'The Admin-User deleted successfully.');
    }
}
