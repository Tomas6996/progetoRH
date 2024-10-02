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
            <h4>Ferias</h4>
            <input type="text" id="search" class="form-control w-25" placeholder="Buscar Funcionario...">
            <a href="#Cadastro" class="btn btn-outline-success btn-sm" 
            style="font-size: 20px; padding: 2px 6px; height: auto;" 
            onclick="limpar()" data-bs-toggle="modal"> <i class="fa fa-circle-plus"></i> Adicionar</a>
        </div>

        <div class="card-body">
              <table class="table table-striped table-hover" id="funcionarioTable">
                <thead class="table-dark">
                    <tr>
                        <th>Data Inicio</th>
                        <th>Data de Termino</th>
                        <th>Aprovado Por:</th>
                        <th>Estado</th>
                        <th>Funcionario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ferias as $fer)
                        <tr>
                            <td>{{$fer->data_inicio}}</td>
                            <td>{{$fer->data_fim}}</td> 
                            <td>{{$fer->aporvador_por}}</td>
                            <td> <span class="badge {{ $fer->estado === 'Aprovado' ? ' bg-success' : 'bg-danger' }}">
                                {{ $fer->estado }}</span></td>
                            <td>{{$fer->funcionario->nomeCompleto}}</td>
                          

                            <td>
                                @if($fer->estado == "Pendente")
                                   
                                <a href="{{ route('ferias.aprovado', $fer->id) }}" class="btn btn-outline-success btn-sm">
                                    <i class="fa fa-check"></i> Aprovado</a>

                                    <a href="{{ route('ferias.recusado', $fer->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fa fa-circle-xmark"></i> Recusado</a>
                                        @endif

                                <a href="#Cadastro" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" onclick="editar({{ $fer }})">
                                    <i class="fa fa-edit"></i> Editar</a>
                                <a href="{{ route('ferias.apagar', $fer->id) }}" class="btn btn-outline-danger btn-sm">
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
                    <h5 class="modal-title" id="modalTitleId"> Adicionar ferias</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{route('ferias.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="">Funcionario</label>
                               <select name="funcionario_id" id="funcionario_id" class="form-control">
                                    @foreach (App\Models\Funcionario::all() as $func)
                                        <option value="{{$func->id}}">{{$func->nomeCompleto}}</option>
                                    @endforeach
                               </select>
                            </div>
                            <div class="form-group">
                                <label for="">Data Inicio</label>
                                <input type="date" name="data_inicio" id="data_inicio" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Data de Terminio</label>
                                <input type="date" name="data_fim" id="data_fim" class="form-control" required>
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
            document.getElementById('data_inicio').value = valor.data_inicio
        document.getElementById('data_fim').value = valor.data_fim
        document.getElementById('funcionario_id').value = valor.funcionario_id
        }
        function limpar(){
             document.getElementById('id').value = ""
            document.getElementById('data_inicio').value = ""
        document.getElementById('data_fim').value = ""
        document.getElementById('funcionario_id').value = ""
        }

        document.getElementById('search').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#funcionarioTable tbody tr');

        rows.forEach(row => {
            let nome = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
            row.style.display = nome.includes(filter) ? '' : 'none';
        });
    });
    </script>
@endsection