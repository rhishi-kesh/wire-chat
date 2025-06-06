<x-app-layout>
    <div class="flex h-[calc(100vh_-_4.2rem)] antialiased text-gray-800">
        <div class="flex flex-row w-full h-auto overflow-x-hidden">
            <div class="flex flex-col flex-shrink-0 w-64 py-8 pt-0 pb-0 pl-2 pr-2 bg-white">
                <div class="flex flex-col items-center w-full p-2 mt-2 bg-indigo-100 border border-gray-200 rounded-lg">
                    <div class="w-20 h-20 overflow-hidden border rounded-full">
                        <img
                            src="{{ asset($otherUser->avatar ?? 'https://static.vecteezy.com/system/resources/previews/036/280/650/non_2x/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg') }}">
                        alt="Avatar" class="w-full h-full" />
                    </div>
                    <div class="mt-2 text-sm font-semibold">{{ $otherUser->name }}</div>
                </div>
                <div class="flex flex-col mt-8">
                    <div class="flex flex-row items-center justify-between text-xs">
                        <span class="font-bold">Active Conversations</span>
                        <span
                            class="flex items-center justify-center w-4 h-4 bg-gray-300 rounded-full">{{ count($conversations) }}</span>
                    </div>
                    @foreach ($conversations as $conversation)
                        @if (!empty($conversation->participants) && isset($conversation->participants[0]->participantable->name))
                            <div class="flex flex-col mt-4 -mx-2 space-y-1 overflow-y-auto">
                                <a class="flex flex-row items-center p-2 hover:bg-gray-100 rounded-xl"
                                    href="{{ route('dashboard.chat', $conversation->participants[0]->participantable->id) }}">
                                    <img class="flex items-center justify-center object-contain text-white bg-indigo-200 rounded-full w-11 h-11"
                                        src="{{ asset($conversation->participants[0]->participantable->avatar ?? 'https://static.vecteezy.com/system/resources/previews/036/280/650/non_2x/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg') }}">
                                    <div class="w-full ml-2">
                                        <p class="font-semibold text-md">
                                            {{ $conversation->participants[0]->participantable->name }}</p>
                                        <p class="flex items-center justify-start w-full gap-2 text-sm font-normal">
                                            <span class="block">
                                                @if ($conversation->lastMessage->sendable_id == auth()->user()->id)
                                                    <span class="mr-1">You:</span>
                                                @endif
                                                {{ $conversation->lastMessage->type == 'file'
                                                    ? 'File'
                                                    : Str::limit($conversation->lastMessage->body, 15, '...') }}
                                            </span>
                                            <span class="block text-green-500">
                                                {{-- {{ $conversation->lastMessage->created_at->diffForHumans() }} --}} now
                                            </span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col flex-auto h-full p-6">
                <div class="flex flex-col flex-auto flex-shrink-0 h-full p-4 bg-gray-100 rounded-2xl">
                    <div class="flex flex-col h-full mb-4 overflow-x-auto">
                        <div class="flex flex-col h-full">
                            <div class="grid grid-cols-12 gap-y-2">
                                <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                    <div class="flex flex-row items-center">
                                        <div
                                            class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-full">
                                            A
                                        </div>
                                        <div class="relative px-4 py-2 ml-3 text-sm bg-white shadow rounded-xl">
                                            <div>Hey How are you today?</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                    <div class="flex flex-row-reverse items-center justify-start">
                                        <div
                                            class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white bg-indigo-500 rounded-full">
                                            A
                                        </div>
                                        <div class="relative px-4 py-2 mr-3 text-sm bg-indigo-100 shadow rounded-xl">
                                            <div>I'm ok what about you?</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @dd($user->id) --}}
                    <div class="h-16 px-4 bg-white rounded-xl">
                        <form action="{{ route('send', $otherUser->id) }}" method="POST" enctype="multipart/form-data"
                            class="flex flex-row items-center w-full h-full space-x-4">
                            @csrf
                            <div>
                                <button class="flex items-center justify-center text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex-grow ml-4">
                                <div class="relative w-full">
                                    <input type="text"
                                        class="flex w-full h-10 pl-4 border rounded-xl focus:outline-none focus:border-indigo-300"
                                        name="message" required />
                                    <button
                                        class="absolute top-0 right-0 flex items-center justify-center w-12 h-full text-gray-400 hover:text-gray-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="ml-4">
                                <button type="submit"
                                    class="flex items-center justify-center flex-shrink-0 px-4 py-1 text-white bg-indigo-500 hover:bg-indigo-600 rounded-xl">
                                    <span>Send</span>
                                    <span class="ml-2">
                                        <svg class="w-4 h-4 -mt-px transform rotate-45" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            userId = @js(auth()->id());
            encodedType = @js(Namu\WireChat\Helpers\MorphClassResolver::encode(auth()->user()->getMorphClass()));
        </script>
        <script type="module">
            Echo.private(`participant.${encodedType}.${userId}`)
                .listen('.Namu\\WireChat\\Events\\NotifyParticipant', (e) => {
                    console.log(e);
                });
        </script>
    @endpush
</x-app-layout>
