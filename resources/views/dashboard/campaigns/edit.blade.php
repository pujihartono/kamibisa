<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Campaign') }}: {{ $campaign->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <form action="{{ route('dashboard.campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('Campaign Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $campaign->title)" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Short Description -->
                            <div>
                                <x-input-label for="short_description" :value="__('Short Description')" />
                                <x-text-input id="short_description" class="block mt-1 w-full" type="text" name="short_description" :value="old('short_description', $campaign->short_description)" required />
                                <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div>
                                <x-input-label for="description" :value="__('Full Description')" />
                                <textarea id="description" name="description" rows="6" class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm block mt-1 w-full" required>{{ old('description', $campaign->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Target Amount -->
                                <div>
                                    <x-input-label for="target_amount" :value="__('Target Amount (IDR)')" />
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">Rp</span>
                                        </div>
                                        <x-text-input id="target_amount" class="block w-full pl-10" type="number" name="target_amount" :value="old('target_amount', $campaign->target_amount)" required min="1000" step="1" />
                                    </div>
                                    <x-input-error :messages="$errors->get('target_amount')" class="mt-2" />
                                </div>

                                <!-- Deadline -->
                                <div>
                                    <x-input-label for="deadline" :value="__('Campaign Deadline')" />
                                    <x-text-input id="deadline" class="block mt-1 w-full" type="date" name="deadline" :value="old('deadline', $campaign->deadline->format('Y-m-d'))" required min="{{ date('Y-m-d') }}" />
                                    <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Status -->
                            <div>
                                <x-input-label for="status" :value="__('Campaign Status')" />
                                <select id="status" name="status" class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="active" {{ old('status', $campaign->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="finished" {{ old('status', $campaign->status) == 'finished' ? 'selected' : '' }}>Finished</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <!-- Image -->
                            <div>
                                <x-input-label for="image" :value="__('Campaign Image')" />
                                <div class="mt-2 flex items-center space-x-6">
                                    <div class="shrink-0">
                                        <img id="preview" class="h-16 w-16 object-cover rounded-lg bg-gray-100"
                                             src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/' . $campaign->image_path) }}"
                                             alt="Preview">
                                    </div>
                                    <label class="block">
                                        <span class="sr-only">Choose campaign image</span>
                                        <input type="file" name="image" id="image_input" onchange="previewImage(event)" class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-teal-50 file:text-teal-700
                                            hover:file:bg-teal-100 transition
                                        "/>
                                    </label>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF. Max 2MB. Leave empty to keep current.</p>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-8">
                                <a href="{{ route('dashboard.campaigns.index') }}" class="text-gray-500 hover:text-gray-700 mr-4 text-sm font-medium">Cancel</a>
                                <x-primary-button class="bg-teal-600 hover:bg-teal-700">
                                    {{ __('Update Campaign') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>
