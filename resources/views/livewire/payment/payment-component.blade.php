<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Gestão de pagamentos</h4>
                    </p>

                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link {{ $action == 0 ? 'active' : '' }}"
                                wire:click='swiView'>
                                <i class="dripicons-checklist me-1 align-middle"></i> <span
                                    class="d-none d-md-inline-block">Listar</span>
                            </a>
                        </li>
                        @if (Auth::user()->type == '0' || Auth::user()->type == '1')
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link {{ $action == 1 ? 'active' : '' }}"
                                    wire:click='swiCreate'>
                                    <i class="mdi mdi-point-of-sale me-1 align-middle"></i> <span
                                        class="d-none d-md-inline-block">Criar/Editar</span>
                                </a>
                            </li>
                        @endif
                    </ul>

                    @if($action == 0)
                        <div class="tab-content mt-3">

                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (Auth::user()->type == '0' || Auth::user()->type == '1')
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
                            @endif

                            <table class="table table-bordered mb-0 mt-3">
                                <thead>
                                    <tr>
                                        <th style="width: 2cm">Ordem</th>
                                        <th>Consultor/Cliente</th>
                                        <th>Horas/Status</th>
                                        <th style="width: 2cm">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($payments as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>
                                                Consultor: {{ $item->consultant->user['name'] }} <br>
                                                <small>Cliente: {{ $item->customer }}</small>
                                            </td>
                                            <td>
                                                @switch($item->status)
                                                    @case(0)
                                                        <span class="badge bg-warning">Pendente</span>
                                                        @break
                                                    @case(1)
                                                        <span class="badge bg-success">Pagamento realizado</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-danger">Cancelado</span>
                                                @endswitch
                                                <br>
                                                <small>Apontamento: {{ $item->hours }} Horas - R$: {{ $item->payment }}</small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a href="{{ route('invoice', $item->id ) }}" class="btn btn-sm btn-outline-primary"><i class="dripicons-document"></i></a>
                                                    @if (Auth::user()->type == '0' || Auth::user()->type == '1')
                                                        <button type="button" wire:click='swiEdit({{ $item->id }})'
                                                            class="btn btn-sm btn-outline-primary">
                                                            <i class=" dripicons-document-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-primary">
                                                            <i class="dripicons-trash"></i>
                                                        </button>
                                                    @endif
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
                        <br>
                        {{ $payments->links('modules.paginate') }}
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
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" wire:model='consultant_id' id="floatingSelectGrid"
                                            aria-label="Floating label select example">
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


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" wire:model='type_service'
                                                id="floatingSelectGrid" aria-label="Floating label select example">
                                                <option selected="">Serviço</option>
                                                <option value="0">Senior</option>
                                                <option value="1">Particular</option>
                                            </select>
                                            <label for="floatingSelectGrid">Tipo de serviço</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" wire:model='customer' class="form-control"
                                                id="floatingLastnameInput" placeholder="E-mail usurio">
                                            <label for="floatingLastnameInput">Cliente</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" wire:model='hours' class="form-control"
                                                id="floatingLastnameInput" placeholder="Horas apontadas">
                                            <label for="">Horas apontadas</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" wire:model='payment' class="form-control"
                                                id="floatingLastnameInput" placeholder="Valor total" readonly>
                                            <label for="floatingLastnameInput">Valor total</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" wire:model='status' id="floatingSelectGrid"
                                                aria-label="Floating label select example">
                                                <option selected="">Serviço</option>
                                                <option selected value="0">Pendente</option>
                                                <option value="1">Pagamento realizado</option>
                                                <option value="2">Cancelado</option>
                                            </select>
                                            <label for="floatingSelectGrid">Status</label>
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
