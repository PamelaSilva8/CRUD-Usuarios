@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #F5F5F5;
    }

    .container {
        background-color: #E8EAF6;
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
        background-color: #5C6BC0;
    }

    .form-control {
        border-radius: 5px;
        padding: 10px;
        border: 1px solid #BDBDBD;
    }

    .form-control:focus {
        border-color: rgb(154, 158, 181);
        box-shadow: 0 0 5px rgba(121, 134, 203, 0.5);
        outline: 2px solid #7986CB;
    }

    .btn-container {
        display: flex;
        justify-content: space-between;
    }

    #cpf-error {
        color: red;
        display: none;
        font-size: 14px;
    }
</style>

<div class="container">
    <h2 style="color: #5C6BC0; font-weight: normal;">Criar Novo Usuário</h2>
    
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Data de Nascimento:</label>
            <input type="date" name="dataNascimento" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>CPF:</label>
            <input type="text" name="cpf" id="cpf" class="form-control" required>
            <small id="cpf-error">CPF já cadastrado!</small>
        </div>

        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="fone" id="telefone" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Rua:</label>
            <input type="text" name="endereco[rua]" class="form-control" required>
        </div>

        <div class="form-group">
            <label>CEP:</label>
            <input type="text" name="endereco[cep]" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Bairro:</label>
            <input type="text" name="endereco[bairro]" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Número:</label>
            <input type="text" name="endereco[numero]" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Estado:</label>
            <input type="text" name="endereco[estado]" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Cidade:</label>
            <input type="text" name="endereco[cidade]" class="form-control" required>
        </div>

        <div class="btn-container">
            <a href="{{ route('users.index') }}" class="btn" style="background-color: #90CAF9;">Voltar</a>
            <button type="submit" class="btn">Salvar</button>
        </div>
    </form>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let cpfDuplicado = false;

        // Máscara de CPF (000.000.000-00)
        $('#cpf').on('input', function () {
            let cpf = $(this).val().replace(/\D/g, ''); // Remove tudo que não for número
            if (cpf.length > 11) cpf = cpf.substring(0, 11); // Limita a 11 dígitos

            cpf = cpf.replace(/^(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/^(\d{3})\.(\d{3})(\d)/, "$1.$2.$3");
            cpf = cpf.replace(/\.(\d{3})(\d)/, ".$1-$2");

            $(this).val(cpf);
        });

        // Máscara de telefone (XX) XXXXX-XXXX
        $('#telefone').on('input', function () {
            let telefone = $(this).val().replace(/\D/g, ''); // Remove tudo que não for número
            if (telefone.length > 11) telefone = telefone.substring(0, 11); // Limita a 11 dígitos

            telefone = telefone.replace(/^(\d{2})(\d)/, "($1) $2");
            telefone = telefone.replace(/(\d{5})(\d)/, "$1-$2");

            $(this).val(telefone);
        });

        // Verificação de CPF duplicado
        $('#cpf').blur(function () {
            let cpf = $(this).val().replace(/\D/g, ''); // Remove os pontos e traços
            if (cpf.length === 11) {
                $.ajax({
                    url: "{{ route('users.checkCpf') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        cpf: cpf
                    },
                    success: function (response) {
                        if (response.exists) {
                            $('#cpf-error').show();
                            cpfDuplicado = true; // Marca como duplicado
                        } else {
                            $('#cpf-error').hide();
                            cpfDuplicado = false; // Marca como não duplicado
                        }
                    }
                });
            }
        });

        // Impede o envio do formulário se o CPF for duplicado
        $('form').submit(function (e) {
            if (cpfDuplicado) {
                alert("Este CPF já está cadastrado!");
                e.preventDefault(); // Impede o envio do formulário
            }
        });
    });
</script>
@endsection
