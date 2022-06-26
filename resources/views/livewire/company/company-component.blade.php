<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Gestão de Empresas</h4>
                    </p>

                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link {{ $action == 0 ? 'active' : '' }}"
                                wire:click='swiView'>
                                <i class="dripicons-checklist me-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Listar</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link {{ $action == 1 ? 'active' : '' }}"
                                wire:click='swiCreate'>
                                <i class="mdi mdi-office-building-outline me-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Criar/Editar</span>
                            </a>
                        </li>
                    </ul>

                    @if($action == 0)
                        <div class="tab-content mt-3">

                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-search"></i></div>
                                <input type="text" wire:model='search' class="form-control" placeholder="Buscar">
                                <button type="button" class="btn btn-primary">Buscar</button>
                            </div>

                            <table class="table table-bordered mb-0 mt-3">
                                <thead>
                                    <tr>
                                        <th style="width: 3cm">#</th>
                                        <th>Empresa</th>
                                        <th>Status</th>
                                        <th style="width: 4cm">Data de término</th>
                                        <th style="width: 2cm">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($companies as $item)
                                        @if ($item->cpnj =! '20059106000178')
                                            <tr>
                                                <th scope="row">{{ $item->id }}</th>
                                                <td>
                                                    Razão social: {{ $item->company }}<br>
                                                    CNPJ: <small>{{ $item->cnpj }}</small>
                                                </td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <span class="badge bg-danger">Inativo</span>
                                                    @else
                                                        <span class="badge bg-success">Ativo</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->end }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <button type="button" wire:click='swiEdit({{ $item->id }})'
                                                            class="btn btn-sm btn-outline-primary">
                                                            <i class=" dripicons-document-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-primary">
                                                            <i class="dripicons-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <div class="alert alert-danger mb-0 mt-3" role="alert">
                                            Nenhum registro encontrado.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="tab-content mt-3">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" wire:model='cnpj' class="form-control"
                                                id="floatingFirstnameInput" placeholder="CNPJ" maxlength="14">
                                            <label for="floatingFirstnameInput">CNPJ</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" wire:model='company' class="form-control"
                                                id="floatingLastnameInput" placeholder="Razão social">
                                            <label for="floatingLastnameInput">Razão social</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" wire:model='start' class="form-control"
                                                id="floatingFirstnameInput" placeholder="Inicio">
                                            <label for="floatingFirstnameInput">Data de inicio</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" wire:model='end'
                                                class="form-control" id="floatingLastnameInput"
                                                placeholder="Término">
                                            <label for="floatingLastnameInput">Data de término</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" wire:model='status' id="floatingSelectGrid"
                                                aria-label="Floating label select example">
                                                <option selected="">Situação</option>
                                                <option value="1">Ativa</option>
                                                <option value="0">Inativa</option>
                                            </select>
                                            <label for="floatingSelectGrid">Situação</label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    @if($edit == 0)
                                        <button type="button" wire:click='save'
                                            class="btn btn-primary waves-effect waves-light">
                                            <i class="ri-check-line align-middle me-1"></i> Salvar
                                        </button>
                                    @else
                                        <button type="button" wire:click='update'
                                            class="btn btn-primary waves-effect waves-light">
                                            <i class="ri-check-line align-middle me-1"></i> Atualizar
                                        </button>
                                    @endif
                                    @if($edit == 0)
                                        <button type="button" wire:click='cancel'
                                            class="btn btn-danger waves-effect waves-light">
                                            <i class="ri-close-line align-middle me-1"></i> Cancelar
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
