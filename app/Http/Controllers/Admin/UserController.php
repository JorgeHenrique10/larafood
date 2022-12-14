<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->tenantUser()->paginate(10);

        return view('admin.pages.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['tenant_id'] = Auth::user()->tenant_id;
        $data['password'] = bcrypt($request->password);

        $this->repository->create($data);

        return redirect()
            ->route('users.index')
            ->with('message', 'Usuário criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->query()->tenantUser()->findOrFail($id);

        if (!$user)
            return redirect()->back();

        return view('admin.pages.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->query()->tenantUser()->findOrFail($id);
        if (!$user)
            return redirect()->back();

        return view('admin.pages.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->repository->query()->tenantUser()->findOrFail($id);

        if (!$user)
            return redirect()->back();

        $data = $request->only('name', 'email');

        if ($request->password)
            $data['password'] = bcrypt($request->password);
        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('message', 'Usuário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->repository->query()->tenantUser()->findOrFail($id);

        if (!$user)
            return redirect()->back();

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('message', 'Usuário deletado com sucesso.');
    }

    public function search(Request $request)
    {
        $users = $this->repository->search($request->get('filter'));
        $filters = $request->get('filter') ? $request->except('_token') : ['filter' => null];
        return view('admin.pages.users.index', [
            'users' => $users,
            'filters' => $filters
        ]);
    }
}
