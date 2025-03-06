<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;

class UserController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'http://localhost:3000'; // URL do JSON Server
    }

    // Página inicial do CRUD de usuários
    public function index()
    {
        $users = $this->getAllUsers();
        return view('users.index', compact('users'));
    }

    // Página de criação de usuário
    public function create()
    {
        return view('users.create');
    }

    // Obtém todos os usuários
    public function getAllUsers()
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/users");
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("Erro ao buscar usuários: " . $e->getMessage());
            return [];
        }
    }

    // Obtém um usuário específico
    public function getUser($id)
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/users/{$id}");
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("Erro ao buscar usuário {$id}: " . $e->getMessage());
            return null;
        }
    }

    // Criação de usuário
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'dataNascimento' => 'required|date',
            'email' => 'required|email',
            'cpf' => 'required|string',
            'fone' => 'required|string',
            'endereco.rua' => 'required|string',
            'endereco.cep' => 'required|string',
            'endereco.bairro' => 'required|string',
            'endereco.numero' => 'required|string',
            'endereco.cidade' => 'required|string',
            'endereco.estado' => 'required|string',
        ]);

        try {
            $this->client->post("{$this->baseUrl}/users", [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $data
            ]);

            return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao criar usuário: " . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao criar usuário');
        }
    }

    // Página de edição de usuário
    public function edit($id)
    {
        $user = $this->getUser($id);
        return view('users.edit', compact('user'));
    }

    // Atualização de usuário
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'dataNascimento' => 'required|date',
            'email' => 'required|email',
            'cpf' => 'required|string',
            'fone' => 'required|string',
            'endereco.rua' => 'required|string',
            'endereco.cep' => 'required|string',
            'endereco.bairro' => 'required|string',
            'endereco.numero' => 'required|string',
            'endereco.cidade' => 'required|string',
            'endereco.estado' => 'required|string',
        ]);

        try {
            $this->client->put("{$this->baseUrl}/users/{$id}", [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $data
            ]);

            return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao atualizar usuário {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao atualizar usuário');
        }
    }

    // Exclusão de usuário
    public function destroy($id)
    {
        try {
            $this->client->delete("{$this->baseUrl}/users/{$id}");

            return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao excluir usuário {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao excluir usuário');
        }
  
    }
    public function checkCpf(Request $request)
{
    $cpf = $request->input('cpf');

    try {
        // Faz a requisição GET para o JSON Server para buscar usuários com o CPF fornecido
        $response = $this->client->get("{$this->baseUrl}/users?cpf={$cpf}");
        $users = json_decode($response->getBody(), true);

        // Verifica se existe algum usuário com o CPF fornecido
        $existe = count($users) > 0;

        return response()->json(['exists' => $existe]);
    } catch (\Exception $e) {
        Log::error("Erro ao verificar CPF: " . $e->getMessage());
        return response()->json(['exists' => false]); // Retorna falso se houver erro
    }
}


}
