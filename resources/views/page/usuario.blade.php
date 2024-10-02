@extends('base.base')
@section('gestao')

@if (Session::has('Sucesso'))
<div class="alert alert-success">
    <p>{{Session::get('Sucesso')}}</p>
        </div>
@endif
 
@if (Session::has('Error'))
<div class="alert alert-danger">
    <p>{{Session::get('Error')}}</p>
        </div>
@endif

    <div class="card">

        <div class="card-header">
            <h4>Lista de Usuario</h4>
            <input type="text" id="search" class="form-control w-25" placeholder="Buscar Usuarios...">
            <a href="#Cadastro" class="btn btn-outline-success btn-sm" 
            style="font-size: 20px; padding: 2px 6px; height: auto;" 
            onclick="limpar()" data-bs-toggle="modal"> <i class="fa fa-circle-plus"></i> Adicionar</a>
        </div>

        <div class="card-body">
              <table class="table table-striped table-hover" id="usersTable">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Tipo De usuario</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $use)
                        <tr>
                            <td>{{$use->id}}</td>
                            <td>{{$use->name}}</td>
                            <td>{{$use->email}}</td>
                            <td> <span class="badge {{ $use->tipo === 'Admin' ? ' bg-success' : 'bg-info' }}">
                                {{ $use->tipo }}</span></td>

                            <td>
                                <a href="#Cadastro" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" onclick="editar({{ $use }})">
                                    <i class="fa fa-edit"></i> Editar</a>
                                <a href="{{ route('user.apagar', $use->id) }}" class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-trash"></i> Excluir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Button trigger modal -->
    
    <!-- Modal -->
    <div
        class="modal fade"
        id="Cadastro"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalTitleId"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"> Cadastrar Nomo Usuario</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{route('user.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="">Nome</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tipo</label>
                              <select name="tipo" id="tipo" class="form-control">
                                <option value=""></option>
                                <option value="Admin">Admin</option>
                                <option value="Funcionario">Funcionario</option>
                              </select>
                                
                            </div>
                            
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"> Fechar </button>
                <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        var modalId = document.getElementById('modalId');
    
        modalId.addEventListener('show.bs.modal', function (event) {
              // Button that triggered the modal
              let button = event.relatedTarget;
              // Extract info from data-bs-* attributes
              let recipient = button.getAttribute('data-bs-whatever');
    
            // Use above variables to manipulate the DOM
        });
    </script>
    <script>
        function editar(valor){
        document.getElementById('id').value = valor.id
        document.getElementById('name').value = valor.name
        document.getElementById('email').value = valor.email
        document.getElementById('tipo').value = valor.tipo 
        }
        function limpar(){
        document.getElementById('id').value = ""
        document.getElementById('name').value = ""
        document.getElementById('email').value = ""
        document.getElementById('tipo').value = ""
        }

        document.getElementById('search').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#usersTable tbody tr');

        rows.forEach(row => {
            let nome = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            row.style.display = nome.includes(filter) ? '' : 'none';
        });
    });
    </script>
@endsection