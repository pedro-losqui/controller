<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Gestão de Certificação</h4>
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
                                <i class="mdi mdi-certificate me-1 align-middle"></i> <span
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

                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select" wire:model='cons_id'
                                        id="floatingSelectGrid" aria-label="Floating label select example">
                                        <option>Selecione um consultor</option>
                                        @forelse($consultants as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->user['name'] }}
                                            </option>
                                        @empty
                                            <div class="alert alert-danger mb-0 mt-3" role="alert">
                                                Selecione um consultor.
                                            </div>
                                        @endforelse
                                    </select>
                                    <label for="floatingSelectGrid">Usuário/Consultor</label>
                                </div>
                            </div>

                            <table class="table table-bordered mb-0 mt-3">
                                <thead>
                                    <tr>
                                        <th style="width: 3cm">#</th>
                                        <th>Consultor/Item</th>
                                        <th>Bloco/Progresso</th>
                                        <th style="width: 2cm">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($certifications as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>
                                                {{ $item->consultant->user['name'] }} <br>
                                                <small>{{ $item->iten['description'] }}</small>
                                                @if($item->status_iten == 0)
                                                    <span class="badge bg-warning">Pendente</span>
                                                @else
                                                    <span class="badge bg-success">Aprovado</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->iten->block['description'] }}
                                                <small>
                                                    <div class="progress mt-2">
                                                        <div class="progress-bar progress-bar-striped bg-warning"
                                                            role="progressbar"
                                                            style="width: {{ $item->percent_block }}%"
                                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                            {{ $item->percent_block }}%
                                                        </div>
                                                    </div>
                                                </small>
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
                                                <select class="form-select" wire:model='consultant_id'
                                                    id="floatingSelectGrid" aria-label="Floating label select example">
                                                    <option selected="">Consultor</option>
                                                    @forelse($consultants as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->user['name'] }}
                                                        </option>
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" wire:model='product_id'
                                                    id="floatingSelectGrid" aria-label="Floating label select example">
                                                    <option selected="">Produto</option>
                                                    @forelse($products as $item)
                                                        <option value="{{ $item->id }}">{{ $item->description }}
                                                        </option>
                                                    @empty
                                                        <div class="alert alert-danger mb-0 mt-3" role="alert">
                                                            Nenhum registro encontrado.
                                                        </div>
                                                    @endforelse
                                                </select>
                                                <label for="floatingSelectGrid">Produto</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" wire:model='block_id'
                                                    id="floatingSelectGrid" aria-label="Floating label select example">
                                                    <option selected="">Bloco</option>
                                                    @forelse($blocks as $item)
                                                        <option value="{{ $item->id }}">{{ $item->description }}
                                                        </option>
                                                    @empty
                                                        <div class="alert alert-danger mb-0 mt-3" role="alert">
                                                            Nenhum registro encontrado.
                                                        </div>
                                                    @endforelse
                                                </select>
                                                <label for="floatingSelectGrid">Bloco</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" wire:model='iten_id' id="floatingSelectGrid"
                                                    aria-label="Floating label select example">
                                                    <option selected="">Item</option>
                                                    @if($block_id && $product_id)
                                                        <option value="0">Todos</option>
                                                        @forelse($itens as $item)
                                                            <option value="{{ $item->id }}">{{ $item->description }}
                                                            </option>
                                                        @empty
                                                            <div class="alert alert-danger mb-0 mt-3" role="alert">
                                                                Nenhum registro encontrado.
                                                            </div>
                                                        @endforelse
                                                    @endif
                                                </select>
                                                <label for="floatingSelectGrid">Item</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($edit == 1)
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" wire:model='status_iten' id="floatingSelectGrid"
                                                aria-label="Floating label select example">
                                                <option selected="">Status</option>
                                                    <option value="0">Pendente</option>
                                                    <option value="1">Aprovado</option>
                                            </select>
                                            <label for="floatingSelectGrid">Status do item</label>
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
