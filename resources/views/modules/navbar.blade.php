<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                @if (Auth::user()->type == '0' || Auth::user()->type == '1')
                    <li class="menu-title">Menu</li>
                    <li>
                        <a href="{{ route('home') }}" class="waves-effect">
                            <i class="mdi mdi-home-variant-outline"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-title">Cadastro</li>

                    <li>
                        <a href="{{ route('user') }}" class=" waves-effect">
                            <i class="mdi mdi-account-plus"></i>
                            <span>Usuário</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('consultant') }}" class=" waves-effect">
                            <i class="mdi mdi-account-supervisor"></i>
                            <span>Consultor</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('product') }}" class=" waves-effect">
                            <i class="mdi mdi-animation-outline"></i>
                            <span>Produtos</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('block') }}" class=" waves-effect">
                            <i class="mdi mdi-sitemap"></i>
                            <span>Blocos</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('iten') }}" class=" waves-effect">
                            <i class="mdi mdi-view-list"></i>
                            <span>Itens</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->type == '0' || Auth::user()->type == '1' || Auth::user()->type == '2')
                    <li class="menu-title">Lançamentos</li>

                    <li>
                        <a href="{{ route('certification') }}" class=" waves-effect">
                            <i class="mdi mdi-certificate"></i>
                            <span>Certificações</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('payament') }}" class=" waves-effect">
                            <i class="mdi mdi-point-of-sale"></i>
                            <span>Ordem de Serviço</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->type == '0')
                    <li class="menu-title">Administração</li>

                    <li>
                        <a href="{{ route('company') }}" class=" waves-effect">
                            <i class="mdi mdi-office-building-outline"></i>
                            <span>Empresas</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
