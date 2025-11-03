<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Busca todas as filiais do banco de dados
        $branches = Branch::all(); 

        // 2. Renderiza o componente Vue e passa os dados das filiais
        //    como uma "prop" chamada 'branches'
        return Inertia::render('Admin/Branches/Index', [
            'branches' => $branches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Branches/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validar os dados
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:branches', // Garante nome único
            'address' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        // 2. Criar a filial no banco de dados
        Branch::create($validated);

        // 3. Redirecionar de volta para a listagem (index)
        //    O Inertia vai intercetar este redirect e enviar uma mensagem flash
        return redirect()->route('admin.branches.index')
                        ->with('message', 'Filial criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch) // O Laravel automaticamente encontra a filial pelo ID
    {
        // Renderiza a página Edit.vue e passa a filial que queremos editar
        return Inertia::render('Admin/Branches/Edit', [
            'branch' => $branch
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch): RedirectResponse
    {
        // 1. Validar os dados
        //    (Note a regra 'unique' que agora ignora o ID da própria filial)
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:branches,name,' . $branch->id,
            'address' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        // 2. Atualizar a filial no banco
        $branch->update($validated);

        // 3. Redirecionar de volta para a listagem (index)
        return redirect()->route('admin.branches.index')
                        ->with('message', 'Filial atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
