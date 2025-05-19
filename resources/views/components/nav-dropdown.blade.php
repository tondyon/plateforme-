<div x-data="{ open: false }" class="relative">
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    <button @click="open = !open" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900">
        {{ $title }}
        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div x-show="open" @click.outside="open = false" class="absolute z-10 mt-2 w-48 bg-white rounded shadow-lg py-1">
        {{ $slot }}
    </div>
</div>