<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
        <a href="/">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>
    <div class="list-group list-group-flush">
        <a data-toggle="collapse" href="#config" role="button" aria-expanded="false" aria-controls="config"
           class=" list-group-item list-group-item-action bg-light
           {{ !request()->is('admin/roles*') ?'': ' active-light '}}
           {{ !request()->is('admin/users*') ?'': ' active-light '}}
           "
        >
            Configuraciones <i class="fas fa-chevron-down float-right mt-1"></i>
        </a>
        <div class="
            collapse
            {{ !request()->is('admin/roles*') ?'': ' show '}}
            {{ !request()->is('admin/users*') ?'': ' show '}}


        " id="config">
            <a href="{{ route('admin.roles') }}"
               class="{{ !request()->is('admin/roles*') ?: 'active'}} list-group-item list-group-item-action bg-light"
            >
                Roles
            </a>
            <a href="{{ route('admin.users') }}"
               class="{{ !request()->is('admin/users*') ?: 'active'}} list-group-item list-group-item-action bg-light"
            >
                Usuarios
            </a>
        </div>

        <a data-toggle="collapse" href="#catalog" role="button" aria-expanded="false" aria-controls="catalog"
           class=" list-group-item list-group-item-action bg-light
            {{ !request()->is('admin/brands*') ?'': ' active-light '}}
            {{ !request()->is('admin/models*') ?'': ' active-light '}}
            {{ !request()->is('admin/versions*') ?'': ' active-light '}}
            {{ !request()->is('admin/transmissions*') ?'': ' active-light '}}
            {{ !request()->is('admin/cylinders*') ?'': ' active-light '}}
            {{ !request()->is('admin/accessory-types*') ?'': ' active-light '}}
            {{ !request()->is('admin/accessories*') ?'': ' active-light '}}
            {{ !request()->is('admin/fuels*') ?'': ' active-light '}}
            {{ !request()->is('admin/body-types*') ?'': ' active-light '}}
            {{ !request()->is('admin/colors*') ?'': ' active-light '}}
            {{ !request()->is('admin/drives*') ?'': ' active-light '}}
            {{ !request()->is('admin/inspections*') ?'': ' active-light '}}
           "
        >
            Catalogos <i class="fas fa-chevron-down float-right mt-1"></i>
        </a>
        <div class="
            collapse
            {{ !request()->is('admin/brands*') ? '': ' show '}}
            {{ !request()->is('admin/models*') ? '': ' show '}}
            {{ !request()->is('admin/versions*') ? '': ' show '}}
            {{ !request()->is('admin/transmissions*') ? '': ' show '}}
            {{ !request()->is('admin/cylinders*') ? '': ' show '}}
            {{ !request()->is('admin/accessory-types*') ? '': ' show '}}
            {{ !request()->is('admin/accessories*') ? '': ' show '}}
            {{ !request()->is('admin/fuels*') ? '': ' show '}}
            {{ !request()->is('admin/body-types*') ? '': ' show '}}
            {{ !request()->is('admin/colors*') ? '': ' show '}}
            {{ !request()->is('admin/drives*') ? '': ' show '}}
            {{ !request()->is('admin/inspections*') ? '': ' show '}}
            {{ !request()->is('admin/affiliates/levels*') ? '': ' show '}}
        "  id="catalog">
            <a href="{{ route('admin.brands') }}" class="{{ !request()->is('admin/brands*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Marcas
            </a>
            <a href="{{ route('admin.models') }}"class="{{ !request()->is('admin/models*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Modelos
            </a>
            <a href="{{ route('admin.versions') }}" class="{{ !request()->is('admin/versions*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Versiones
            </a>
            <a href="{{ route('admin.transmissions') }}" class="{{ !request()->is('admin/transmissions*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Transmisiones
            </a>
            <a href="{{ route('admin.cylinders') }}" class="{{ !request()->is('admin/cylinders*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Cilindros
            </a>
            <a href="{{ route('admin.accessory_types') }}" class="{{ !request()->is('admin/accessory-types*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Tipos de Accesorios
            </a>
            <a href="{{ route('admin.accessories') }}" class="{{ !request()->is('admin/accessories*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Accesorios
            </a>
            <a href="{{ route('admin.fuels') }}" class="{{ !request()->is('admin/fuels*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Combustibles
            </a>
            <a href="{{ route('admin.body_types') }}" class="{{ !request()->is('admin/body-types*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Tipo de Carrocerias
            </a>
            <a href="{{ route('admin.colors') }}" class="{{ !request()->is('admin/colors*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Colores
            </a>
            <a href="{{ route('admin.drives') }}" class="{{ !request()->is('admin/drives*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Tracciones
            </a>
            <a href="{{ route('admin.inspections') }}" class="{{ !request()->is('admin/inspections*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Inspecciones
            </a>
            <a href="/admin/affiliates/levels" class="{{ !request()->is('admin/affiliates/levels*') ?: 'active'}} list-group-item list-group-item-action bg-light">
                Niveles de Afiliados
            </a>
        </div>

        <a data-toggle="collapse" href="#affiliates" role="button" aria-expanded="false" aria-controls="affiliates"
           class=" list-group-item list-group-item-action bg-light
           {{ !request()->is('admin/affiliates*') ?'': ' active-light '}}
           {{ !request()->is('admin/affiliates/vehicles*') ?'': ' active-light '}}
               "
        >
            Afiliados <i class="fas fa-chevron-down float-right mt-1"></i>
        </a>
        <div class="
            collapse
            {{ !request()->is('admin/affiliates') ?'': ' show '}}
            {{ !request()->is('admin/affiliates/vehicles') ?'': ' show '}}


            " id="affiliates">
            <a href="/admin/affiliates"
               class="{{ !request()->is('admin/affiliates') ?: 'active'}} list-group-item list-group-item-action bg-light"
            >
                Afiliados
            </a>
            <a href="/admin/affiliates/vehicles"
               class="{{ !request()->is('admin/affiliates/vehicles') ?: 'active'}} list-group-item list-group-item-action bg-light"
            >
                Vehículos
            </a>
        </div>

        <a href="{{ route('admin.clients') }}"
           class="{{ !request()->is('admin/clients*') ?: 'active'}} list-group-item list-group-item-action bg-light"
        >
            Clientes
        </a>

        <a href="{{ route('admin.vehicles.index') }}"
           class="{{ !request()->is('admin/vehicles*') ?: 'active'}} list-group-item list-group-item-action bg-light"
        >
            Vehículos
        </a>

        <a href="{{ route('admin.quote_requests') }}"
           class="{{ !request()->is('admin/quote-requests') ?: 'active'}} list-group-item list-group-item-action bg-light"
        >
            Peticiones de Citas
        </a>
        <a href="{{ route('admin.sell_requests') }}"
           class="{{ !request()->is('admin/sell-requests') ?: 'active'}} list-group-item list-group-item-action bg-light"
        >
            Peticiones de Ventas
        </a>

        <a data-toggle="collapse" href="#config" role="button" aria-expanded="false" aria-controls="config"
           class=" list-group-item list-group-item-action bg-light
           {{ !request()->is('admin/blog/posts*') ?'': ' active-light '}}
           {{ !request()->is('admin/blog/categories*') ?'': ' active-light '}}
           "
        >
            Blog <i class="fas fa-chevron-down float-right mt-1"></i>
        </a>
        <div class="
            collapse
            {{ !request()->is('admin/blog/posts*') ?'': ' show '}}
            {{ !request()->is('admin/blog/categories*') ?'': ' show '}}

        " id="config">
            <a href="{{ route('admin.blog.posts') }}"
               class="{{ !request()->is('admin/blog/posts*') ?: 'active'}} list-group-item list-group-item-action bg-light"
            >
                Posts
            </a>
            <a href="{{ route('admin.blog.categories') }}"
               class="{{ !request()->is('admin/blog/categories*') ?: 'active'}} list-group-item list-group-item-action bg-light"
            >
                Categorias
            </a>
        </div>

        <a href="{{ route('admin.prices') }}"
           class="{{ !request()->is('admin/prices') ?: 'active'}} list-group-item list-group-item-action bg-light"
        >
            Precios
        </a>
    </div>
</div>
