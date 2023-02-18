<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableRequest;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    private $repository;

    public function __construct(Table $table)
    {
        $this->repository = $table;
        $this->middleware(['can:table']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->repository->query()->orderby('identity')->paginate(10);

        return view('admin.pages.tables.index', ['tables' => $tables]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TableRequest $request)
    {
        $table = $this->repository->create($request->all());
        return redirect()->route('tables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = $this->repository->query()->findOrFail($id);

        if (!$table)
            return redirect()->back();

        return view('admin.pages.tables.show', ['table' => $table]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = $this->repository->query()->findOrFail($id);

        if (!$table)
            return redirect()->back();

        return view('admin.pages.tables.edit', ['table' => $table]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TableRequest $request, $id)
    {
        $table = $this->repository->query()->findOrFail($id);

        if (!$table)
            return redirect()->back();

        $table->update($request->only(['name', 'description']));

        return redirect()->route('tables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = $this->repository->query()->findOrFail($id);

        if (!$table)
            return redirect()->back();

        $table->delete();

        return redirect()
            ->route('tables.index')
            ->with('message', 'Mesa deletado com sucesso.');
    }

    public function search(Request $request)
    {
        $tables = $this->repository->search($request->get('filter'));
        $filters = $request->get('filter') ? $request->except('_token') : ['filter' => null];
        return view('admin.pages.tables.index', [
            'tables' => $tables,
            'filters' => $filters
        ]);
    }
}
