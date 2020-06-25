<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use App\Models\Role;
use Auth;
use Session;
use Hash;
use Exception;

class UserController extends Controller
{
    use \App\Http\Controllers\Traits\TraitMessage;
    use \App\Http\Controllers\Traits\TraitUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::exceptMe()->filter($request)->paginate(20);
        $view = [
            'items' => $data,
        ];

        return view('admin.user.index')->with($view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id');
        $view = [
            'method' => 'create',
            'roles' => $roles
        ];

        return view('admin.user.create_edit')->with($view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ($request->get('new_password') != $request->get('new_password2')) {
            return $this->passwordNotCorrect();
        }

        $photo = $this->photoUploaded($request->photo, 'user');

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'photo' => $photo,
            'password' => bcrypt($request->get('new_password')),
        ]);

        $user->syncRoles($request->get('role_id'));

        $this->message('User berhasil dibuat!');

        return redirect('admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::pluck('name','id');
        $user = User::findOrFail($id);
        $view = [
            'method' => 'edit',
            'item' => $user,
            'roles' => $roles
        ];

        $old = $user;
        $old = $old->toArray();
        $old = collect($old)->union(['role_id' => $user->roles->first()->id]);
        session()->flash('_old_input', $old);

        return view('admin.user.create_edit')->with($view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if ($this->checkUser($request, $id)) {
            return $this->passwordNotCorrect();
        }
        if ($request->get('new_password') != $request->get('new_password2')) {
            return $this->passwordNotCorrect();
        }

        $user = User::findOrFail($id);

        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
        ];

        if (isset($request->photo)) {
            $photo = $this->photoUploaded($request->photo, 'user', 1, $user->photo ?? null);
            $data['photo'] = $photo;
        }

        if ($request->get('new_password') != null && strlen($request->get('new_password')) >= 6) {
            $data['password'] = bcrypt($request->get('new_password'));
        }

        $user->syncRoles($request->get('role_id'));
        $user->update($data);

        $this->message('User berhasil diubah!');

        return redirect('admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);

        $this->deletePhoto('user', $data->photo);
        $data = $data->delete();

        $this->message('User berhasil dihapus!');

        return redirect()->back();
    }

    public function profileView()
    {
        return view('admin.user-profile.index');
    }

    public function profilePost(UserProfileRequest $request)
    {
        if ($request->get('new_password') != $request->get('new_password2')) {
            return $this->passwordNotCorrect();
        }

        if ($this->checkIfPasswordMatch($request, Auth::user()->id)) {
            return $this->passwordNotCorrect();
        }
        $user = User::findOrFail(Auth::user()->id);

        $ktp = $this->photoUploaded($request->ktp_user, 'user', 0);
        $selfie = $this->photoUploaded($request->ktp_selfie, 'user', 0);
        $sk = $this->photoUploaded($request->sk_photo, 'user', 0);

        if($ktp == null){
            $ktp = $user->ktp_user;
        }

        if($selfie == null){
            $selfie = $user->ktp_selfie;
        }

        if($sk == null){
            $sk = $user->sk_photo;
        }

        $data = [
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'ktp' => $ktp,
            'selfie' => $selfie,
            'sk' => $sk,
        ];

        User::find($user->id)->update([
        'ktp_user' => $ktp,
        'ktp_selfie' => $selfie,
        'sk_photo' => $sk
        ]);

        if (isset($request->photo)) {
            $photo = $this->photoUploaded($request->photo, 'user', 1, $user->photo ?? null);
            $data['photo'] = $photo;
        }

        if ($request->get('new_password') != null && strlen($request->get('new_password')) >= 6) {
            $data['password'] = bcrypt($request->get('new_password'));
        }

        $user->update($data);

        $this->message('Profile berhasil diubah!');

        return redirect()->back();
    }

    public function passwordNotCorrect()
    {
        $this->message('Pastikan kembali password Anda benar', 'danger');

        return redirect()->back();
    }

    public function checkUser($request, $id)
    {
        if (Auth::user()->id == $id) {
            throw new Exception('we cannot remove yourself!', 500);
        }
        
        if($this->checkIfPasswordMatch($request, $id) == false){
            return false;
        }

        return true;
    }

    public function checkIfPasswordMatch($request, $id)
    {
        $user = User::find($id);

        if (Hash::check($request->get('password'), $user->password)) {
            return false;
        }

        return true;
    }
}
