<div class="drawer-side [&>*]:duration-225 z-40 top-16 h-[calc(100dvh-4rem)]">
    <label for="sidebar-drawer" aria-label="close sidebar" class="drawer-overlay bg-black/20"></label>
    <aside 
    x-data="{
        activeModule: localStorage.getItem('sidebar_active_module') || 'inicio',

        setActive(slug) {
            this.activeModule = slug;
            localStorage.setItem('sidebar_active_module', slug);
        },

        isActive(slug) {
            return this.activeModule === slug;
        },

        hasActiveChild(childSlugs) {
            return childSlugs.includes(this.activeModule);
        }
    }"
    class="w-full 430:w-72 bg-base-100 h-full duration-300 border-r border-[#e9e9e9a6] dark:border-[#e9e9e90c] flex flex-col text-base-content">

        <div class="flex-1 overflow-y-auto no-scrollbar pt-4 px-4">
            <ul class="menu menu-md p-0 rounded-box w-full gap-1 pb-14.25">

                <!-- INICIO (Siempre visible) -->
                <li>
                    <a class="px-2.25 active:bg-neutral active:text-white dark:active:text-black" href="/home"
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
                @forelse ($modules as $module)
                    @php
                        $moduleSlug = Str::slug($module->nombre);
                    @endphp

                    {{-- Módulo SIN hijos --}}
                    @if ($module->children->isEmpty())
                        <li>
                            <a class="text-[#0e1016] dark:text-[#d4dce7] text-[14.5px] active:bg-transparent hover:bg-black/5 dark:hover:bg-white/10"
                                href="{{ $module->url ?? '#' }}"
                                @click="setActive('{{ $moduleSlug }}')"
                                :class="isActive('{{ $moduleSlug }}') ? 'bg-black/5 dark:bg-white/10 font-medium' : ''">
                                <span class="material-symbols-rounded text-[20px]!">{{ $module->icono ?? 'folder' }}</span>
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

                        <li>
                            <details :open="hasActiveChild({{ $childSlugs }})" class="grid gap-1">
                                <summary
                                    class="text-[#0e1016] dark:text-[#d4dce7] text-[14.5px] active:bg-transparent hover:bg-black/5 dark:hover:bg-white/10">
                                    <span class="material-symbols-rounded text-[20px]!">{{ $module->icono ?? 'folder' }}</span>
                                    {{ $module->nombre }}
                                </summary>
                                <ul>
                                    @foreach ($module->children as $child)
                                        @php
                                            $childSlug = Str::slug($child->nombre);
                                        @endphp
                                        <li>
                                            <a class="text-[#0e1016] dark:text-[#d4dce7] text-[14.5px] active:bg-transparent hover:bg-black/5 dark:hover:bg-white/10"
                                                href="{{ $child->url ?? '#' }}"
                                                @click="setActive('{{ $childSlug }}')"
                                                :class="isActive('{{ $childSlug }}') ?
                                                    'bg-black/5 dark:bg-white/10 font-medium' : ''">
                                                <span class="material-symbols-rounded text-[20px]!">{{ $child->icono ?? 'description' }}</span>
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
            class="fixed bottom-0 left-0 right-0 py-1.25 pb-5 pr-5 pl-3 430:pl-5 sm:px-7 bg-base-100 flex items-center justify-center 430:justify-start gap-5">
            <img src="{{ asset('/tmaz-logo-50.png') }}" alt="LOGO TMAZ">
            <p class="relative top-[8.5px] m-0 text-xs text-base-content/70 font-medium">©2026 &nbsp; v1.0.0</p>
        </div>
    </aside>
</div>