<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 dark:text-gray-100" id="posts" >
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let posts;
    $.ajax({
        type: 'GET',
        url: '{{ route('posts.index') }}',
        success: function(response) {
            response.data.forEach(element => {
                $('#posts').append(card(element.title,element.image, element.description, element.created_at, element.updated_at, element.user.name));
            });
        },
        error: function(data) {
            console.log(data);
        }
    })


    function card (title, image, description, created_at, updated_at, name) {
        return (
            `<div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-full" src="{{ asset('storage/posts/${image}') }}" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">@${name}</span>
                    <div class="font-bold text-xl mb-2">${title}</div>
                    <p class="text-gray-700 text-base">
                        ${description}
                    </p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#${created_at}</span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#${updated_at}</span>
                </div>
            </div>`
        )
    }

    console.log(posts)
</script>
