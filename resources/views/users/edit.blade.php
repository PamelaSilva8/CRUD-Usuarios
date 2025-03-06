@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #F5F5F5; /* Cinza bem claro para o fundo */
    }

    .container {
        background-color: #E8EAF6; /* Azul lavanda suave */
        padding: 20px;
        border-radius: 10px;
        max-width: 800px;
        margin: auto;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .label {
        font-weight: normal;
        color: #5C6BC0;
    }

    .btn {
        background-color: #7986CB;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #5C6BC0; /* Alterar a cor ao passar o mouse */
    }

    .btn:active {
        outline: 2px solid rgba(154, 92, 192, 0.52); 
    }

    .form-control {
        border-radius: 5px;
        padding: 10px;
        border: 1px solid #BDBDBD; /* Cor de borda suave */
    }

    .form-control:focus {
        border-color: #7986CB; /* Cor da borda ao focar */
        box-shadow: 0 0 5px rgba(121, 134, 203, 0.5); /* Efeito de foco suave */
    }

    /* Estilo da tabela com fundo azul lavanda */
    .table {
        width: 100%;
        background-color: #E8EAF6 !important; /* Garantir fundo azul lavanda */
        border-radius: 5px;
        border-collapse: collapse;
    }

    .table th, table td {
        padding: 10px;
        text-align: left;
    }

    .table th {
        background-color: #9FA8DA; /* Azul mais forte para o cabeçalho */
        color: white;
    }

    .btn-container {
        display: flex;
        justify-content: space-between;
    }
</style>

<div class="container">
    <h2 style="color: #5C6BC0; font-weight: normal;">Editar Usuário</h2>
    <form action="{{ route('users.update', $user['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" value="{{ $user['nome'] }}" required>
        </div>
        <div class="form-group">
            <label>Data de Nascimento:</label>
            <input type="date" name="dataNascimento" class="form-control" value="{{ $user['dataNascimento'] }}" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $user['email'] }}" required>
        </div>
        <div class="form-group">
            <label>CPF:</label>
            <input type="text" name="cpf" class="form-control" value="{{ $user['cpf'] }}" required>
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="fone" class="form-control" value="{{ $user['fone'] }}" required>
        </div>
        <div class="form-group">
            <label>Rua:</label>
            <input type="text" name="endereco[rua]" class="form-control" value="{{ $user['endereco']['rua'] }}" required>
        </div>
        <div class="form-group">
            <label>CEP:</label>
            <input type="text" name="endereco[cep]" class="form-control" value="{{ $user['endereco']['cep'] }}" required>
        </div>
        <div class="form-group">
            <label>Bairro:</label>
            <input type="text" name="endereco[bairro]" class="form-control" value="{{ $user['endereco']['bairro'] }}" required>
        </div>
        <div class="form-group">
            <label>Número:</label>
            <input type="text" name="endereco[numero]" class="form-control" value="{{ $user['endereco']['numero'] }}" required>
        </div>
        <div class="form-group">
            <label>Cidade:</label>
            <input type="text" name="endereco[cidade]" class="form-control" value="{{ $user['endereco']['cidade'] }}" required>
        </div>
        <div class="form-group">
            <label>Estado:</label>
            <input type="text" name="endereco[estado]" class="form-control" value="{{ $user['endereco']['estado'] }}" required>
        </div>

        <!-- Botões alinhados -->
        <div class="btn-container">
            <a href="{{ route('users.index') }}" class="btn" style="background-color: #90CAF9; color: white;">Voltar</a>
            <button type="submit" class="btn">Atualizar</button>
        </div>
    </form>
</div>
@endsection
