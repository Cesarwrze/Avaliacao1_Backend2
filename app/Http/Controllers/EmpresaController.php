<?php
namespace App\Http\Controllers;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{

    public function empresa()
    {
        $empresas = Empresa::all();
        return view('empresa', compact('empresas'));
    }

    public function cadastrarEmpresa(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:64',
            'cnpj' => 'required|digits:14|unique:empresas',
            'email' => 'required|email|unique:empresas'
        ]);
        try {
            Empresa::create($request->all());
            return redirect()->route('empresa')->with('success', 'Empresa criada com sucesso');
        } catch(\Exception $e) {
            return back()->with('fail', 'Algo falhou');
        }
    }

    public function empresaUpdate($id)
    {
        $empresa = Empresa::findOrFail($id);
        return view('empresaUpdate', compact('empresa'));
    }

    public function atualizarEmpresa(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:64',
            'cnpj' => 'required|digits:14|unique:empresas',
            'email' => 'required|email|unique:empresas'
        ]);
        try {
            $empresa = Empresa::findOrFail($id);
            $empresa->update($request->all());
            return redirect()->route('empresa')->with('success', 'Empresa atualizada com sucesso.');
        } catch(\Exception $e) {
            return back()->with('fail', 'Algo falhou');
        }
    }

    public function deletarEmpresa($id)
    {
        try {
            Empresa::destroy($id);
            return redirect()->route('empresa')->with('success', 'Empresa deletada com sucesso.');
        } catch(\Exception $e) {
            return back()->with('fail', 'Algo falhou');
        }
    }

}