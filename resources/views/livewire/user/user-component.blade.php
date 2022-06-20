<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Gestão de Usuários</h4>
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
                                <i class="dripicons-user me-1 align-middle"></i> <span
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
                                        <th>Nome usuário</th>
                                        <th>Perfil</th>
                                        <th style="width: 2cm">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->type }}</td>
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
                                            <input type="text" wire:model='name' class="form-control"
                                                id="floatingFirstnameInput" placeholder="Nome completo">
                                            <label for="floatingFirstnameInput">Nome completo</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" wire:model='email' class="form-control"
                                                id="floatingLastnameInput" placeholder="E-mail usurio">
                                            <label for="floatingLastnameInput">E-mail usuário</label>
                                        </div>
                                    </div>
                                </div>

                                @if($edit == 0)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="password" wire:model='password' class="form-control"
                                                    id="floatingFirstnameInput" placeholder="Senha">
                                                <label for="floatingFirstnameInput">Senha</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="password" wire:model='password_confirm'
                                                    class="form-control" id="floatingLastnameInput"
                                                    placeholder="Confirmação de senha">
                                                <label for="floatingLastnameInput">Confirmação de senha</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" wire:model='type' id="floatingSelectGrid"
                                                aria-label="Floating label select example">
                                                <option selected="">Perfil de usuário</option>
                                                <option value="1">Administrador</option>
                                                <option value="0">Consultor</option>
                                            </select>
                                            <label for="floatingSelectGrid">Acesso</label>
                                        </div>
                                    </div>
                                </div>

                                @if($edit == 1)
                                    <div class="mb-3">
                                        <button type="button"
                                            {{ $resPass == 1 ? 'disabled' : '' }}
                                            wire:click='resPass' class="btn btn-primary waves-effect waves-light">
                                            Atualizar Senha <i class="ri-lock-unlock-line align-middle ms-1"></i>
                                        </button>
                                        @if($resPass == 1)
                                            {{ $password }}
                                        @endif
                                    </div>
                                @endif

                                @if($edit == 1)
                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model='status'
                                                id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">Ativo</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model='status'
                                                id="inlineRadio2" value="0">
                                            <label class="form-check-label" for="inlineRadio2">Inativo</label>
                                        </div>
                                    </div>
                                @endif

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
