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
            <h4>Lista de GRG</h4>
            <input type="text" id="search" class="form-control w-25" placeholder="Buscar Recrutas...">
            <a href="#Cadastro" class="btn btn-outline-success btn-sm" 
            style="font-size: 20px; padding: 2px 6px; height: auto;" 
            onclick="limpar()" data-bs-toggle="modal"> <i class="fa fa-circle-plus"></i> Adicionar</a>
        </div>

        <div class="card-body">
            <table class="table table-striped table-hover" id="recrutamentoTable">
                <thead class="table-dark">
                    <tr>
                        <th>Nome Completo</th>
                        <th>Categoria</th>
                        <th>Data de Nascimento</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Numero bilhete de Identidade</th>
                        <th>Genero</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recrutamento as $recru)
                        <tr>
                            <td>{{$recru->nome}}</td>
                            <td>{{$recru->categoria}}</td>
                            <td>{{$recru->datanascimento}}</td>
                            <td>{{$recru->telefone}}</td>
                            <td>{{$recru->email}}</td>
                            <td>{{$recru->nbi}}</td>
                            <td>{{$recru->genero}}</td>
                            
                            <td>
                                <a href="#Cadastro" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" onclick="editar({{ $recru}}})">
                                    <i class="fa fa-edit"></i> Editar</a>
                                <a href="{{ route('recrutamento.apagar', $recru->id) }}" class="btn btn-outline-danger btn-sm">
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
                    <h5 class="modal-title" id="modalTitleId"> Gestão de Recursos Humanos</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{route('recrutamento.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                          
                            <div class="form-group">
                                <label for="">Nome Completo</label>
                                <input type="text" required name="nome" id="nome" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <input type="text" name="categoria" id="categoria" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Data De Nascimento</label>
                                <input type="date" name="datanascimento" id="datanascimento" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Telefone</label>
                                <input type="tel" name="telefone" id="telefone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Número Bilhete de Identidade</label>
                                <input type="text" name="nbi" id="nbi" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Genero</label>
                                <input type="text" name="genero" id="genero" class="form-control" required>
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
        document.getElementById('nome').value = valor.nome
        document.getElementById('categoria').value = valor.categoria
        document.getElementById('datanascimento').value = valor.datanascimento
        document.getElementById('telefone').value = valor.telefone
        document.getElementById('email').value = valor.email
        document.getElementById('nbi').value = valor.nbi
        document.getElementById('genero').value = valor.genero
        }
        function limpar(){
        document.getElementById('id').value = valor= ""
        document.getElementById('nome').value = valor = ""
        document.getElementById('categoria').value = valor = ""
        document.getElementById('datanascimento').value = valor = ""
        document.getElementById('telefone').value = valor = ""
        document.getElementById('email').value = valor.user = ""
        document.getElementById('nbi').value = valor = ""
        document.getElementById('genero').value = valor = ""
        }
       
        document.getElementById('search').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#recrutamentoTable tbody tr');

        rows.forEach(row => {
            let nbi = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            row.style.display = nbi.includes(filter) ? '' : 'none';
        });
    });
    </script>
@endsection