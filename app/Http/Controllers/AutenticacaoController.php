<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Hash;
use Session;

class AutenticacaoController extends Controller
{
    
    public function login() {
        return view ('autenticacao.login');
    }

    public function registrar() {
        return view ('autenticacao.registrar');
    }

    public function usuario() {
        return view ('autenticacao.usuario');
    }

    public function usuarioUpdate() {
        return view ('autenticacao.usuarioUpdate');
    }

    public function registrarUsuario(Request $request) {
        $request->validate([
            'nome'=>'required',
            'email'=>'required|email|unique:usuarios',
            'senha'=>'required|min:8|max:32',
            'cpf'=>'required|digits:11|unique:usuarios|cpf_valido',
            'telefone'=>'required|min:10|max:11',
            'estado'=>'required',
            'cidade'=>'required',
            'rua'=>'required',
        ]);
        $usuario = new Usuario();
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->senha = Hash::make($request->senha);
        $usuario->cpf = $request->cpf;
        $usuario->telefone = $request->telefone;
        $usuario->estado = $request->estado;
        $usuario->cidade = $request->cidade;
        $usuario->rua = $request->rua;
        $resultado = $usuario->save();
        if($resultado) {
            return redirect('eletrobuy/login')->with('success', 'Seu registro foi concluído com sucesso');
        } else {
            return back()->with('fail', 'Algo falhou');
        }
    }
    
    public function loginUsuario(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'senha'=>'required|min:8|max:32',
        ]);
        $usuario = Usuario::where('email', '=', $request->email)->first();
        if($usuario) {
            if(Hash::check($request->senha, $usuario->senha)) {
                $request->session()->put('loginId', $usuario->id);
                return redirect('eletrobuy');
            } else {
                return back()->with('fail', 'Senha incorreta');
            }
        } else {
            return back()->with('fail', 'O email não está registrado');
        }
    }

    public function logout() {
        if(Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('eletrobuy/login');
        }
    }

    public function atualizarUsuario(Request $request) {
        if(Session::has('loginId')) {
            $request->validate([
                'nome'=>'required|max:80',
                'email' => 'required|email|unique:usuarios,email,' . Session::get('loginId') . ',id',
                'senha'=>'nullable|min:8|max:32',
                'cpf' => 'required|digits:11|cpf_valido|unique:usuarios,cpf,' . Session::get('loginId') . ',id',
                'telefone'=>'required|min:10|max:11',
                'estado'=>'required',
                'cidade'=>'required',
                'rua'=>'required',
            ]);
            $usuario = Usuario::find(Session::get('loginId'));
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            if ($request->filled('senha')) {
                $usuario->senha = Hash::make($request->senha); 
            }
            $usuario->cpf = $request->cpf;
            $usuario->telefone = $request->telefone;
            $usuario->estado = $request->estado;
            $usuario->cidade = $request->cidade;
            $usuario->rua = $request->rua;
            $resultado = $usuario->save();
            if($resultado) {
                return redirect('eletrobuy/usuario')->with('success', 'Seus dados foram atualizados com sucesso');
            } else {
                return back()->with('fail', 'Algo falhou');
            }
        }
    }

    public function deletarUsuario(Request $request) {
        if(Session::has('loginId')) {
            $usuario = Usuario::find(Session::get('loginId'));
            $resultado = $usuario->delete();
            if($resultado) {
                Session::forget('loginId');
                return redirect('eletrobuy/login')->with('success', 'Conta deletada com sucesso');
            } else {
                return back()->with('fail', 'Algo falhou ao tentar deletar a conta');
            }
        }
    }

}
