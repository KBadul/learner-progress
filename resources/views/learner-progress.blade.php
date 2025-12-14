<x-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Learner Progress</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Track student enrollment and course completion</p>
        </div>

        <div class="mb-6">
            <form method="GET" action="{{ url()->current() }}" class="flex gap-2">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search courses..." 
                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-blue-600 dark:bg-blue-700 text-white font-medium rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 active:bg-blue-800 transition-colors cursor-pointer"
                >
                    Search
                </button>
                @if(request('search'))
                    <a 
                        href="{{ url()->current() }}" 
                        class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    >
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <div class="flex justify-between items-center">
            <div class="mb-6 flex flex-col justify-start gap-2 items-start">
                <span class="text-sm text-gray-500 dark:text-gray-300">Sort by Avg. Progress</span>
                <div>
                    <a 
                        href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('sort'), ['sort' => 'desc'])) }}" 
                        class="px-4 py-2 {{ request('sort', 'desc') === 'desc' ? 'bg-purple-600 dark:bg-purple-700 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} font-medium rounded-l-lg hover:opacity-90 transition-opacity"
                    >
                        ↓ High to Low
                    </a>
                    <a 
                        href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('sort'), ['sort' => 'asc'])) }}" 
                        class="px-4 py-2 {{ request('sort') === 'asc' ? 'bg-purple-600 dark:bg-purple-700 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} font-medium rounded-r-lg hover:opacity-90 transition-opacity"
                    >
                        ↑ Low to High
                    </a>
                </div>
            </div>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Showing <span class="font-semibold">{{ count($learners) }}</span> {{ count($learners) === 1 ? 'learner' : 'learners' }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($learners as $learner) 
                <x-learner-card :learner="$learner" />
            @endforeach
        </div>

        @if(count($learners) === 0)
            <div class="text-center py-12">
                <div class="text-gray-400 dark:text-gray-600 text-6xl mb-4">📚</div>
                <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-400 mb-2">No Learners Found</h3>
                <p class="text-gray-500 dark:text-gray-500">Start by adding learners to track their progress</p>
            </div>
        @endif
    </div>
</x-layout>