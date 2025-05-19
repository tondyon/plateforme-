<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-4">
    <!-- Total Verifications -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Total des vérifications</p>
                <p class="text-2xl font-semibold text-gray-700">{{ $totalVerifications }}</p>
            </div>
        </div>
    </div>

    <!-- Valid Verifications -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Vérifications valides</p>
                <p class="text-2xl font-semibold text-gray-700">{{ $validVerifications }}</p>
            </div>
        </div>
        <div class="mt-2">
            <div class="text-sm text-green-600">
                {{ number_format(($validVerifications / max($totalVerifications, 1)) * 100, 1) }}% du total
            </div>
        </div>
    </div>

    <!-- Invalid Verifications -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Vérifications invalides</p>
                <p class="text-2xl font-semibold text-gray-700">{{ $invalidVerifications }}</p>
            </div>
        </div>
        <div class="mt-2">
            <div class="text-sm text-red-600">
                {{ number_format(($invalidVerifications / max($totalVerifications, 1)) * 100, 1) }}% du total
            </div>
        </div>
    </div>

    <!-- Recent Verifications -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Vérifications récentes (7j)</p>
                <p class="text-2xl font-semibold text-gray-700">{{ $recentVerifications }}</p>
            </div>
        </div>
    </div>
</div>
