<div id="app-sidebar-container" class="drawer-side [&>*]:duration-225 z-40 top-16 h-[calc(100dvh-4rem)]">
    <label for="sidebar-drawer" aria-label="close sidebar" class="drawer-overlay bg-black/20"></label>
    <aside

    x-data="{
        activeModule: 'inicio',

        // Mapa de uri -> slug, generado desde Blade
        uriSlugMap: {{ collect($modules)->flatMap(function($m) {
            if ($m->children->isEmpty()) {
                return [['uri' => $m->uri, 'slug' => Str::slug($m->nombre)]];
            }
            return $m->children->map(fn($c) => ['uri' => $c->uri, 'slug' => Str::slug($c->nombre)]);
        })->keyBy('uri')->map(fn($v) => $v['slug'])->toJson() }},

        init() {
            const currentPath = window.location.pathname;
            const matchedSlug = this.uriSlugMap[currentPath];

            if (matchedSlug) {

                // La página cargó bien (estamos aquí), guardar

                this.activeModule = matchedSlug;
                localStorage.setItem('sidebar_active_module', matchedSlug);

            } else if (currentPath === '/home') {

                this.activeModule = 'inicio';
                localStorage.setItem('sidebar_active_module', 'inicio');

            } else {

                // uri desconocida (404 u otra) — restaurar el último válido

                const saved = localStorage.getItem('sidebar_active_module');
                this.activeModule = saved ?? 'inicio';
            }
        },

        isActive(slug) {
            return this.activeModule === slug;
        },

        hasActiveChild(childSlugs) {
            return childSlugs.includes(this.activeModule);
        }
    }"

    class="w-full 2xs:w-72 bg-base-100 h-full duration-300 border-r border-[#e9e9e9a6] dark:border-[#e9e9e90c] flex flex-col text-base-content">

        <div class="flex-1 overflow-y-auto no-scrollbar pt-4 px-4">
            <ul class="menu menu-md p-0 rounded-box w-full gap-1 pb-14.25">

                <!-- INICIO (Siempre visible) -->
                <li>
                    <a class="px-2.25 active:bg-neutral active:text-white dark:active:text-black" href="/inicio"
                        @click="setActive('inicio')"
                        :class="isActive('inicio') ? 'bg-black/5 dark:bg-white/10 font-medium' : ''">
                        <span class="material-symbols-rounded text-[20px]!">home</span>
                        Inicio
                    </a>
                </li>

                @if ($modules->isNotEmpty())
                    <li class="menu-title mt-4 px-3 text-xs font-bold uppercase tracking-wider text-base-content/50">
                        Módulos
                    </li>
                @endif

                {{--
                    $modules viene del SidebarComposer.
                    Cada elemento es un Modulo con su relación 'children' cargada.
                --}}
                @php
                    $iconoDefault      = '.';
                    $iconoDefaultHijo  = '.';
                @endphp

                @forelse ($modules as $module)
                    @php
                        $moduleSlug  = Str::slug($module->nombre);
                        $moduleIcono = filled($module->icono) ? $module->icono : $iconoDefault;
                    @endphp

                    {{-- Módulo SIN hijos --}}
                    @if ($module->children->isEmpty())
                       <li data-orden="{{ $module->orden }}">
                            <a class="text-[#0e1016] dark:text-[#d4dce7] text-[14.5px] active:bg-transparent hover:bg-black/5 dark:hover:bg-white/10"
                                href="{{ $module->uri ?? '#' }}"
                                data-ulid="{{ $module->ulid }}"
                                @click="setActive('{{ $moduleSlug }}')"
                                :class="isActive('{{ $moduleSlug }}') ? 'bg-black/5 dark:bg-white/10 font-medium' : ''">
                                <span class="material-symbols-rounded text-[20px]!">{{ $moduleIcono }}</span>
                                {{ $module->nombre }}
                            </a>
                        </li>

                    {{-- Módulo CON hijos --}}
                    @else
                        @php
                            $childSlugs = $module->children
                                ->map(fn($child) => Str::slug($child->nombre))
                                ->toJson();
                        @endphp

                        <li data-orden="{{ $module->orden }}">
                            <details :open="hasActiveChild({{ $childSlugs }})" class="grid gap-1">
                                <summary
                                    data-ulid="{{ $module->ulid }}"
                                    class="text-[#0e1016] dark:text-[#d4dce7] text-[14.5px] active:bg-transparent hover:bg-black/5 dark:hover:bg-white/10">
                                    <span class="material-symbols-rounded text-[20px]!">{{ $moduleIcono }}</span>
                                    {{ $module->nombre }}
                                </summary>
                                <ul>
                                    @foreach ($module->children as $child)
                                        @php
                                            $childSlug  = Str::slug($child->nombre);
                                            $childIcono = filled($child->icono) ? $child->icono : $iconoDefaultHijo;
                                        @endphp
                                        <li data-orden="{{ $child->orden }}">
                                            <a class="text-[#0e1016] dark:text-[#d4dce7] text-[14.5px] active:bg-transparent hover:bg-black/5 dark:hover:bg-white/10"
                                                href="{{ $child->uri ?? '#' }}"
                                                @click="setActive('{{ $childSlug }}')"
                                                :class="isActive('{{ $childSlug }}') ?
                                                    'bg-black/5 dark:bg-white/10 font-medium' : ''">
                                                <span class="material-symbols-rounded text-[20px]!">{{ $childIcono }}</span>
                                                {{ $child->nombre }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </details>
                        </li>
                    @endif

                @empty
                    <div class="p-3 text-center text-base-content/50">
                        <span class="material-symbols-rounded">info</span>
                        <p class="mt-2 mb-0 text-sm">No tienes módulos asignados.</p>
                    </div>
                @endforelse

            </ul>
        </div>

        <!-- VERSIÓN DEL SISTEMA -->
        <div
            class="fixed bottom-0 left-0 right-0 py-1.25 pb-5 pr-5 pl-3 2xs:pl-5 sm:px-7 bg-base-100 flex items-center justify-center 2xs:justify-start gap-5">
            <img src="{{ asset('/tmaz-logo-sidebar.png') }}" class="w-12.5 h-8" alt="LOGO TMAZ">
            <p class="relative top-[8.5px] m-0 text-xs text-base-content/70 font-medium">©2026 &nbsp; v1.0.0</p>
        </div>
    </aside>
</div>