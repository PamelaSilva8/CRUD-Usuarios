@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #F5F5F5; 
    }  

    .container {
        background-color: #E8EAF6; /* Azul lavanda suave */
        padding: 20px;
        border-radius: 10px;
        max-width: 1000px;
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
        background-color:rgba(154, 92, 192, 0.7); 
    }

    .btn:active {
    outline: 2px solidrgba(162, 107, 217, 0.57); 
}

    .form-control {
        border-radius: 5px;
        padding: 10px;
        border: 1px solid #BDBDBD; /
    }

    .form-control:focus {
        border-color: #7986CB; /* Cor da borda ao focar */
        box-shadow: 0 0 5px rgba(121, 134, 203, 0.5); /* Efeito de foco suave */
    }

    .table {
        background-color:  #E8EAF6;
        width: 100%;
        max-width: 100%;
    }

    .table th, .table td {
        padding: 8px;
        text-align: center;
    }
</style> 

<div class="container">
    <h2 style="color: #5C6BC0; font-weight: normal;">Lista de Usuários</h2>

    <a href="{{ route('users.create') }}" class="btn" style="background-color: #7986CB; color: white;">Novo Usuário</a>

    <table class="table table-bordered table-hover mt-3">
        <thead style="background-color:#9FA8DA; color: white;">
            <tr>
                <th style="font-weight: normal;">Nome</th>
                <th style="font-weight: normal;">Email</th>
                <th style="font-weight: normal;">CPF</th>
                <th style="font-weight: normal;">Telefone</th>
                <th style="font-weight: normal;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user['nome'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['cpf'] }}</td>
                <td>{{ $user['fone'] }}</td>
                <td class="text-center">
                    <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-sm" style="background-color:#90CAF9; color: white;">Editar</a>

                    <form action="{{ route('users.destroy', $user['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm" style="background-color:#EF9A9A; color: white;">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection