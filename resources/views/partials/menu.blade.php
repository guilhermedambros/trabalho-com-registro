<div id="sidebar-disable" class="sidebar-disable hidden"></div>

<div id="sidebar" class="sidebar-menu transform -translate-x-full ease-in">
    <div class="flex items-center justify-center mt-4">
        <div class="flex items-center">
            <span class="text-white text-2xl mx-2 font-semibold">{{ trans('panel.site_title') }}</span>
        </div>
    </div>
    <nav class="mt-4">
        <a class="nav-link{{ request()->is('admin') ? ' active' : '' }}" href="{{ route("admin.home") }}">
            <i class="fas fa-fw fa-tachometer-alt">

            </i>

            <span class="mx-4">Painel</span>
        </a>

        @can('gerenciamento_usuario')
            <div class="nav-dropdown">
                <a class="nav-link" href="#">
                    <i class="fa-fw fas fa-users">

                    </i>

                    <span class="mx-4">{{ trans('cruds.userManagement.title') }}</span>
                    <i class="fa fa-caret-down ml-auto" aria-hidden="true"></i>
                </a>
                <div class="dropdown-items mb-1 hidden">
                        @can('permissao_acessar')
                        <a class="nav-link{{ request()->is('admin/permissions*') ? ' active' : '' }}" href="{{ route('admin.permissions.index') }}">
                            <i class="fa-fw fas fa-unlock-alt">

                            </i>

                            <span class="mx-4">{{ trans('cruds.permission.title') }}</span>
                        </a>
                    @endcan
                    @can('perfil_acessar')
                        <a class="nav-link{{ request()->is('admin/roles*') ? ' active' : '' }}" href="{{ route('admin.roles.index') }}">
                            <i class="fa-fw fas fa-briefcase">

                            </i>

                            <span class="mx-4">{{ trans('cruds.role.title') }}</span>
                        </a>
                    @endcan
                    @can('usuario_acessar')
                        <a class="nav-link{{ request()->is('admin/users*') ? ' active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="fa-fw fas fa-user">

                            </i>

                            <span class="mx-4">{{ trans('cruds.user.title') }}</span>
                        </a>
                    @endcan
                </div>
            </div>
        @endcan
        @can('pessoa_acessar')
            <a class="nav-link{{ request()->is('pessoas*') ? ' active' : '' }}" href="{{ route('pessoas.index') }}">
                <i class="fa-fw fas fa-users">

                </i>

                <span class="mx-4">{{ trans('cruds.pessoa.title') }}</span>
            </a>
        @endcan
            <a class="nav-link{{ request()->is('ponto*') ? ' active' : '' }}" href="{{ route('ponto.index') }}">
                <i class="fa-fw fas fa-clock-o">

                </i>

                <span class="mx-4">ePonto</span>
            </a>
        @can('demanda_acessar')
            <a class="nav-link{{ request()->is('demandas*') ? ' active' : '' }}" href="{{ route('demandas.index') }}">
                <i class="fa-fw fas fa-users">

                </i>

                <span class="mx-4">{{ trans('cruds.demanda.title') }}</span>
            </a>
        @endcan
        @can('demanda_acessar')
            <a class="nav-link{{ request()->is('relatorios*') ? ' active' : '' }}" href="{{ route('relatorios.demandas.index') }}">
                <i class="fa-fw fas fa-users">

                </i>

                <span class="mx-4">{{ trans('cruds.relatorios.title') }}</span>
            </a>
        @endcan
        
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            <a class="nav-link{{ request()->is('profile/password') ? ' active' : '' }}" href="{{ route('profile.password.edit') }}">
                <i class="fa-fw fas fa-key">

                </i>

                <span class="mx-4">{{ trans('global.change_password') }}</span>
            </a>
        @endif
        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="fa-fw fas fa-sign-out-alt">

            </i>

            <span class="mx-4">{{ trans('global.logout') }}</span>
        </a>
    </nav>
</div>
