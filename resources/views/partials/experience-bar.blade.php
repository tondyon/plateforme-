<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h3 class="text-2xl font-semibold text-gray-900">Niveau {{ auth()->user()->level }}</h3>
            <p class="text-gray-600">{{ auth()->user()->experience_points }} points d'expérience</p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">Prochain niveau dans</p>
            <p class="font-medium">{{ auth()->user()->getNextLevelPoints() - auth()->user()->experience_points }} points</p>
        </div>
    </div>

    <div class="relative pt-1">
        <div class="flex mb-2 items-center justify-between">
            <div>
                <span class = "text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                    Progression
                </span>
            </div>
            <div class="text-right">
                <span class="text-xs font-semibold inline-block text-green-600">
                    {{ auth()->user()->getLevelProgressPercentage() }}%
                </span>
            </div>
        </div>
        <div class  = "overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200">
        <div class = "width:{{ auth()->user()->getLevelProgressPercentage() }}%">
        <div class  = "shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500 transition-all duration-500">
            </div>
        </div>
    </div>
</div>
