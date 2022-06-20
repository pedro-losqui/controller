<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Gestão de itens de estudos</h4>
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
                                <i class="mdi mdi-view-list me-1 align-middle"></i> <span
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
                                        <th>Bloco</th>
                                        <th style="width: 2cm">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($itens as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>
                                                {{ $item->description }} <span class="badge bg-danger">{{ $item->product['description'] }}</span> <span class="badge bg-danger">{{ $item->block['description'] }}</span>
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
                                <div class="form-floating mb-3">
                                    <select class="form-select" wire:model='product_id' id="floatingSelectGrid"
                                        aria-label="Floating label select example">
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

                                <div class="form-floating mb-3">
                                    <select class="form-select" wire:model='block_id' id="floatingSelectGrid"
                                        aria-label="Floating label select example">
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

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" wire:model='description' class="form-control" id="floatingFirstnameInput"
                                                placeholder="Data">
                                            <label for="floatingFirstnameInput">Descrição</label>
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
