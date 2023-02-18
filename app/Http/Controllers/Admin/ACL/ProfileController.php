<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $repository;

    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
        $this->middleware(['can:profile']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = $this->repository->paginate(10);

        return view('admin.pages.profiles.index', ['profiles' => $profiles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()
            ->route('profiles.index')
            ->with('message', 'Perfil criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = $this->repository->query()->findOrFail($id);

        if (!$profile)
            return redirect()->back();

        return view('admin.pages.profiles.show', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = $this->repository->query()->findOrFail($id);
        if (!$profile)
            return redirect()->back();

        return view('admin.pages.profiles.edit', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $profile = $this->repository->query()->findOrFail($id);

        if (!$profile)
            return redirect()->back();

        $profile->update($request->all());

        return redirect()
            ->route('profiles.index')
            ->with('message', 'Perfil atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = $this->repository->query()->findOrFail($id);

        if (!$profile)
            return redirect()->back();

        $profile->delete();

        return redirect()
            ->route('profiles.index')
            ->with('message', 'Perfil deletado com sucesso.');
    }

    public function search(Request $request)
    {
        $profiles = $this->repository->search($request->get('filter'));
        $filters = $request->get('filter') ? $request->except('_token') : ['filter' => null];
        return view('admin.pages.profiles.index', [
            'profiles' => $profiles,
            'filters' => $filters
        ]);
    }
}
