<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Multimedia Management</h1>
                        <p class="text-gray-600 mt-2">Manage your portfolio content</p>
                    </div>
                    <a href="{{ route('multimedia.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Upload New
                    </a>
                </div>
            </div>

            <!-- Success Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Statistics -->
            <div class="mb-8 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Images</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $media->where('type', 'image')->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Videos</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $media->where('type', 'video')->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Items</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $media->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Latest Upload</p>
                            <p class="text-sm font-bold text-gray-900">{{ $media->first() ? $media->first()->created_at->diffForHumans() : 'None' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            @if($media->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($media as $item)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <!-- Preview -->
                            <div class="relative h-48 bg-gray-200">
                                @if($item->type === 'image')
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $item->file_path) }}" 
                                             alt="{{ $item->title }}" 
                                             class="w-full h-full object-cover"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                             onload="this.style.display='block'; this.nextElementSibling.style.display='none';">
                                        <!-- Fallback for when image fails to load -->
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600" style="display: none;">
                                            <div class="text-center text-white">
                                                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <p class="text-xs font-medium">{{ $item->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full h-full bg-gray-700 flex items-center justify-center relative">
                                        <video class="w-full h-full object-cover" controls preload="metadata">
                                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/webm">
                                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>
                                        <!-- Video overlay with play icon -->
                                        <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M8 5v10l8-5-8-5z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="absolute top-2 right-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $item->type === 'image' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ ucfirst($item->type) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $item->title }}</h3>
                                @if($item->description)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $item->description }}</p>
                                @endif
                                
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <span>Uploaded {{ $item->created_at->diffForHumans() }}</span>
                                    <span>{{ $item->created_at->format('M d, Y') }}</span>
                                </div>

                                <!-- Actions -->
                                <div class="flex space-x-2">
                                    <button onclick="viewMultimedia({{ $item->id }}, '{{ $item->title }}', '{{ $item->description ?? '' }}', '{{ asset('storage/' . $item->file_path) }}', '{{ $item->type }}', '{{ $item->created_at->format('M d, Y') }}')" 
                                            class="flex-1 bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded text-sm font-medium transition duration-300">
                                        View
                                    </button>
                                    <a href="{{ route('multimedia.edit', $item) }}" 
                                       class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded text-sm font-medium text-center transition duration-300">
                                        Edit
                                    </a>
                                    <form action="{{ route('multimedia.destroy', $item) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this item?')"
                                                class="w-full bg-red-100 hover:bg-red-200 text-red-700 px-3 py-2 rounded text-sm font-medium transition duration-300">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Content Yet</h3>
                    <p class="text-gray-600 mb-6">Start building your portfolio by uploading your first multimedia file.</p>
                    <a href="{{ route('multimedia.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                        Upload Your First File
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h2 id="modalTitle" class="text-2xl font-bold text-gray-900"></h2>
                <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Content -->
            <div class="p-6">
                <div class="mb-6">
                    <div id="modalMediaContainer" class="relative">
                        <!-- Loading spinner -->
                        <div id="modalLoading" class="hidden absolute inset-0 flex items-center justify-center bg-gray-100 rounded-lg">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
                        </div>
                        
                        <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[60vh] object-contain rounded-lg hidden">
                        <video id="modalVideo" class="w-full h-auto max-h-[60vh] rounded-lg hidden" controls>
                            <source id="modalVideoSource" src="" type="video/mp4">
                            <source id="modalVideoSource2" src="" type="video/webm">
                            <source id="modalVideoSource3" src="" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                        <p id="modalDescription" class="text-gray-600 leading-relaxed"></p>
                    </div>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div class="flex items-center space-x-4">
                            <span id="modalType" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium"></span>
                            <span id="modalDate" class="text-gray-500 text-sm"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function viewMultimedia(id, title, description, filePath, type, date) {
            const modal = document.getElementById('viewModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');
            const modalImage = document.getElementById('modalImage');
            const modalVideo = document.getElementById('modalVideo');
            const modalVideoSource = document.getElementById('modalVideoSource');
            const modalVideoSource2 = document.getElementById('modalVideoSource2');
            const modalVideoSource3 = document.getElementById('modalVideoSource3');
            const modalType = document.getElementById('modalType');
            const modalDate = document.getElementById('modalDate');
            const modalLoading = document.getElementById('modalLoading');
            
            // Set modal content
            modalTitle.textContent = title;
            modalDescription.textContent = description || 'No description available.';
            modalDate.textContent = date;
            
            // Set type badge
            modalType.textContent = type.charAt(0).toUpperCase() + type.slice(1);
            modalType.className = `inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${
                type === 'image' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800'
            }`;
            
            // Show loading spinner initially
            modalLoading.classList.remove('hidden');
            modalImage.classList.add('hidden');
            modalVideo.classList.add('hidden');
            
            // Show image or video
            if (type === 'image') {
                modalImage.onload = function() {
                    modalLoading.classList.add('hidden');
                    modalImage.classList.remove('hidden');
                };
                modalImage.onerror = function() {
                    modalLoading.classList.add('hidden');
                    alert('Failed to load image.');
                };
                modalImage.src = filePath;
            } else {
                modalVideoSource.src = filePath;
                modalVideoSource2.src = filePath;
                modalVideoSource3.src = filePath;
                modalVideo.onloadeddata = function() {
                    modalLoading.classList.add('hidden');
                    modalVideo.classList.remove('hidden');
                };
                modalVideo.onerror = function() {
                    modalLoading.classList.add('hidden');
                    alert('Failed to load video.');
                };
                modalVideo.load();
            }
            
            // Show modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }
        
        function closeViewModal() {
            const modal = document.getElementById('viewModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            
            // Restore body scroll
            document.body.style.overflow = 'auto';
            
            // Stop video if playing
            const modalVideo = document.getElementById('modalVideo');
            if (modalVideo) {
                modalVideo.pause();
                modalVideo.currentTime = 0;
            }
        }
        
        // Close modal when clicking outside
        document.getElementById('viewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeViewModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeViewModal();
            }
        });
    </script>
</x-app-layout> 