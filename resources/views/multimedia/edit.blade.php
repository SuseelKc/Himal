<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center">
                    <a href="{{ route('multimedia.index') }}" class="text-blue-600 hover:text-blue-700 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Edit Content</h1>
                        <p class="text-gray-600 mt-2">Update your portfolio content</p>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <form action="{{ route('multimedia.update', $multimedia) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Preview -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current File</label>
                        <div class="border border-gray-200 rounded-lg p-4">
                            @if($multimedia->type === 'image')
                                <img src="{{ asset('storage/' . $multimedia->file_path) }}" 
                                     alt="{{ $multimedia->title }}" 
                                     class="w-full max-h-64 object-cover rounded">
                            @else
                                <video class="w-full max-h-64 rounded" controls>
                                    <source src="{{ asset('storage/' . $multimedia->file_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                            <div class="mt-2 flex items-center justify-between text-sm text-gray-500">
                                <span>{{ ucfirst($multimedia->type) }}</span>
                                <span>Uploaded {{ $multimedia->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $multimedia->title) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter a descriptive title"
                               required>
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Describe your work, techniques used, or any relevant details">{{ old('description', $multimedia->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('multimedia.index') }}" 
                           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition duration-300">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
                            Update Content
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 