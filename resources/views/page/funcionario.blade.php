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
            <h4>Lista de Funcionario</h4>
            <input type="text" id="search" class="form-control w-25" placeholder="Buscar Funcionário...">
            <a href="#Cadastro" class="btn btn-outline-success btn-sm" 
            style="font-size: 20px; padding: 2px 6px; height: auto;" 
            onclick="limpar()" data-bs-toggle="modal"> <i class="fa fa-circle-plus"></i> Adicionar</a>
        </div>

        <div class="card-body">
            <table class="table table-striped table-hover" id="funcionariosTable">
                <thead class="table-dark">

                    <tr>
                        <th>N Agente</th>
                        <th>Imagem</th>
                        <th>Nome Completo</th>
                        <th>Cargo</th>
                        <th>Categoria</th>
                        <th>Nome de Usuario</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($funcionario as $func)
                        <tr>
                            <td>{{ $func->nAgente }}</td>
                            <td>
                                <!-- Exibição da imagem com melhorias -->
                                <div class="image-container">
                                    <img src="{{ asset('img/carregadas/'.$func->imagem) }}" 
                                         alt="Imagem de perfil" 
                                         class="profile-img rounded-circle img-thumbnail"
                                         onclick="showImageModal('{{ asset('img/carregadas/'.$func->imagem) }}')" 
                                         style="cursor: pointer;">
                                </div>
                            </td>
                            <td>{{ $func->nomeCompleto }}</td>
                            <td><span class="badge bg-info">{{ $func->cargo }}</span></td>
                            <td><span class="badge bg-success">{{ $func->categoria }}</span></td>
                            <td>{{ $func->user->name }}</td>
                            <td>{{ $func->user->email }}</td>
                            <td>
                                <a href="#Cadastro" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" onclick="editar({{ $func }})">
                                    <i class="fa fa-edit"></i> Editar</a>
                                <a href="{{ route('funcionario.apagar', $func->id) }}" class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-trash"></i> Excluir</a>
                            </td>
                        </tr>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para visualização ampliada da imagem -->


            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <!-- Corpo do modal com a imagem -->
                        <div class="modal-body text-center">
                            <img id="imageInModal" src="" alt="Imagem ampliada" class="img-fluid">
                        </div>
                    </div>
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
                    <h5 class="modal-title" id="modalTitleId">Cadastrar Novo Funcionario</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{route('funcionario.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="">Imagem</label>
                                <input type="file" name="imagem" id="imagem" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nome Completo</label>
                                <input type="text" required name="nomeCompleto" id="nomeCompleto" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Numero Agente</label>
                                <input type="text" name="nAgente" id="nAgente" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Cargo</label>
                                <input type="text" name="cargo" id="cargo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <input type="text" name="categoria" id="categoria" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
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
        document.getElementById('nomeCompleto').value = valor.nomeCompleto
        document.getElementById('cargo').value = valor.cargo
        document.getElementById('categoria').value = valor.categoria
        document.getElementById('nAgente').value = valor.nAgente
        document.getElementById('email').value = valor.user.email
        }
        function limpar(){
        document.getElementById('id').value = valor = ""
        document.getElementById('nomeCompleto').value = ""
        document.getElementById('cargo').value = ""
        document.getElementById('categoria').value = ""
        document.getElementById('nAgente').value = ""
        document.getElementById('email').value = ""
        }

            // Função para mostrar imagem no modal
    function showImageModal(imageUrl) {
        document.getElementById('imageInModal').src = imageUrl;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }

    // Função de busca para filtrar a tabela
    document.getElementById('search').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#funcionariosTable tbody tr');

        rows.forEach(row => {
            let nomeCompleto = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            row.style.display = nomeCompleto.includes(filter) ? '' : 'none';
        });
    });
</script>

<style>
    /* Melhorar exibição das imagens */
    .profile-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    .profile-img:hover {
        transform: scale(1.2); /* Ampliar ao passar o mouse */
    }

    /* Estilo para o modal de imagem */
    .modal-body img {
        max-width: 100%;
        height: auto;
    }
</style>

    </script>
@endsection