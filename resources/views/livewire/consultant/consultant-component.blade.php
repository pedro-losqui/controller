<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Gestão de Consultores</h4>
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
                                        <th>Nome Consultor</th>
                                        <th>Status</th>
                                        <th style="width: 2cm">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($consultants as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->user['name'] }}</td>
                                            <td>
                                                @if ($item->user['status'] == 1)
                                                    Ativo
                                                @else
                                                    Inativo
                                                @endif
                                            </td>
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
                        </div>
                        <div class="tab-content mt-3">
                            <form>
                                @if($edit == 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" wire:model='user_id' id="floatingSelectGrid"
                                                    aria-label="Floating label select example">
                                                    <option selected="">Usuários</option>
                                                    @forelse($users as $item)
                                                        @if($item->id <> in_array($item->id, $ids))
                                                            @if ($item->name <> 'Administrador Geral')
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endif
                                                    @empty
                                                        <div class="alert alert-danger mb-0 mt-3" role="alert">
                                                            Nenhum registro encontrado.
                                                        </div>
                                                    @endforelse
                                                </select>
                                                <label for="floatingSelectGrid">Usuário/Consultor</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="date" wire:model='bday' class="form-control" id="floatingFirstnameInput"
                                                placeholder="Data">
                                            <label for="floatingFirstnameInput">Data nascimento</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" wire:model='cpf' class="form-control"
                                                id="floatingFirstnameInput" placeholder="CPF" maxlength="11">
                                            <label for="floatingFirstnameInput">CPF</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" wire:model='rg' class="form-control"
                                                id="floatingLastnameInput" placeholder="RG">
                                            <label for="floatingLastnameInput">RG</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" wire:model='pix' class="form-control"
                                                id="floatingFirstnameInput" placeholder="PIX">
                                            <label for="floatingFirstnameInput">PIX</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                        <h4 class="card-title">Valor Hora</h4>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="number" wire:model='value' class="form-control" id="floatingLastnameInput"
                                                    placeholder="Valor Hora">
                                                <label for="floatingLastnameInput">Valor Hora</label>
                                            </div>
                                            @if ($edit == 1)
                                            <button type="button" wire:click='updateHour'
                                                class="btn btn-primary waves-effect waves-light">
                                                <i class="ri-check-line align-middle me-1"></i> Atualizar valor hora
                                            </button>
                                            @endif
                                        </div>
                                    <livewire:hour.hour-component />
                                </div>

                                @if ($edit == 1)

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-5">Histórico Valor Hora</h4>
                                                <ul class="verti-timeline list-unstyled">
                                                    @foreach ($hours as $item)
                                                        <li class="event-list">
                                                            <div>
                                                                <p class="text-primary">{{ $item->created_at->format('d/m/Y') }}</p>
                                                                <h5>R$: {{ $item->value }},00</h5>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
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
