<div>
    <div class="relative">
        <!-- Barre d'expérience -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-900">
                        Niveau <span x-text="level"
                                   x-data="{ level: @entangle('level') }"
                                   @level-up.window="level = $event.detail.level"
                                   class="transition-all duration-500"></span>
                    </h3>
                    <p class="text-gray-600">
                        <span x-text="experience"
                              x-data="{ experience: @entangle('experience') }"
                              @experience-gained.window="experience = $event.detail.newTotal"
                              class="transition-all duration-500"></span> points d'expérience
                    </p>
                </div>
            </div>

            <div class="relative pt-1">
                <div class="flex mb-2 items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                            Progression
                        </span>
                    </div>
                    <div class="text-right">
                        <span x-text="progress + '%'"
                              x-data="{ progress: @entangle('progress') }"
                              @experience-gained.window="progress = $event.detail.newProgress"
                              class="text-xs font-semibold inline-block text-green-600">
                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200">
                    <div x-data="{ width: @entangle('progress') }"
                         x-bind:style="'width: ' + width + '%'"
                         @experience-gained.window="width = $event.detail.newProgress"
                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500 transition-all duration-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- Animation de gain d'expérience -->
        <div x-data="{ show: false, points: 0 }"
             @experience-gained.window="
                show = true;
                points = $event.detail.points;
                setTimeout(() => show = false, 2000)
             "
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-4"
             class="absolute top-0 right-0 mt-4 mr-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg"
             style="display: none;">
            <p class="font-semibold">
                +<span x-text="points"></span> XP
            </p>
        </div>

        <!-- Animation de niveau supérieur -->
        <div x-data="{ show: false, newLevel: 0 }"
             @level-up.window="
                show = true;
                newLevel = $event.detail.level;
                setTimeout(() => show = false, 3000)
             "
             x-show="show"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="fixed inset-0 flex items-center justify-center z-50"
             style="display: none;">
            <div class="bg-gradient-to-r from-green-400 to-blue-500 p-8 rounded-lg shadow-2xl text-white text-center">
                <h2 class="text-3xl font-bold mb-2">Niveau Supérieur !</h2>
                <p class="text-xl">Vous avez atteint le niveau <span x-text="newLevel"></span></p>
            </div>
        </div>
    </div>
</div>
