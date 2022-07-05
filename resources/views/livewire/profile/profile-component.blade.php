<div>
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card text-center">
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <img src="{{ asset('assets/images/users/user.png') }}"
                        class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                    <h4 class="mb-0">{{ Auth::user()->name }}</h4>

                    @if(Auth::user()->status == 1)
                        <p class="text-muted">Status: <span class="badge badge-soft-success">Ativo</span></p>
                    @endif

                    <button type="button" wire:click='swiEdit'
                        class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Alterar
                        senha</button>

                    <div class="text-start mt-3">
                        <h4 class="font-12 text-uppercase">Perfil:</h4>
                        <p class="text-muted mb-2 font-13"><strong>Nome completo:</strong> <span
                                class="ms-2">{{ Auth::user()->name }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>E-mail:</strong><span
                                class="ms-2">{{ Auth::user()->email }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>PIX:</strong> <span
                                class="ms-2">{{ Auth::user()->consultant->pix }}</span></p>
                        @switch(Auth::user()->type)
                            @case(1)
                                <p class="text-muted">Perfil de acesso: <span
                                        class="badge badge-soft-success">Administrador</span></p>
                                @break
                            @case(2)
                                <p class="text-muted">Perfil de acesso: <span
                                        class="badge badge-soft-success">Consultor</span></p>
                                @break
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($edit == 1)
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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
                                    <input type="password" wire:model='password_confirm' class="form-control"
                                        id="floatingLastnameInput" placeholder="Confirmação de senha">
                                    <label for="floatingLastnameInput">Confirmação de senha</label>
                                </div>
                            </div>
                            <div>
                                <button type="button" wire:click='updatePass'
                                    class="btn btn-primary waves-effect waves-light">
                                    <i class="ri-check-line align-middle me-1"></i> Atualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
