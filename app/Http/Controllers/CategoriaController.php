<?php
namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function categoria()
    {
        $categorias = Categoria::all();
        return view('categoria', compact('categorias'));
    }

    public function cadastrarCategoria(Request $request)
    {
        $request->validate([
            'nome' => 'required'
        ]);
        try {
            Categoria::create($request->all());
            return redirect()->route('categoria')->with('success', 'Categoria criada com sucesso');
        } catch(\Exception $e) {
            return back()->with('fail', 'Algo falhou');
        }
    }

    public function categoriaUpdate($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categoriaUpdate', compact('categoria'));
    }

    public function atualizarCategoria(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required'
        ]);
        try {
            $categoria = Categoria::findOrFail($id);
            $categoria->update($request->all());
            return redirect()->route('categoria')->with('success', 'Categoria atualizada com sucesso.');
        } catch(\Exception $e) {
            return back()->with('fail', 'Algo falhou');
        }
    }

    public function deletarCategoria($id)
    {
        try {
            Categoria::destroy($id);
            return redirect()->route('categoria')->with('success', 'Categoria deletada com sucesso.');
        } catch(\Exception $e) {
            return back()->with('fail', 'Algo falhou');
        }
    }

}