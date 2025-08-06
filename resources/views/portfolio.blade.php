<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-5xl md:text-7xl font-bold text-white mb-6">
                        Himal Gyawaly
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-300 mb-8">
                        3D Artist | Environment & Prop Design
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#portfolio" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                            View Portfolio
                        </a>
                        <a href="{{ route('login') }}" class="border border-gray-400 text-gray-300 hover:bg-gray-800 px-8 py-3 rounded-lg font-semibold transition duration-300">
                            Admin Login
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Portfolio Section -->
        <div id="portfolio" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-4">My Work</h2>
                <p class="text-gray-400 text-lg">Explore my latest 3D creations and environments</p>
            </div>

            @if($media->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($media as $item)
                        <div class="group relative bg-gray-800 rounded-lg overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer modal-trigger" 
                             data-id="{{ $item->id }}"
                             data-title="{{ $item->title }}"
                             data-description="{{ $item->description ?? '' }}"
                             data-file-path="{{ asset('storage/' . $item->file_path) }}"
                             data-type="{{ $item->type }}"
                             data-date="{{ $item->created_at->format('M d, Y') }}">
                            <div class="relative overflow-hidden">
                                @if($item->type === 'image')
                                    <div class="w-full h-64 bg-gray-700 flex items-center justify-center relative">
                                        <img src="{{ asset('storage/' . $item->file_path) }}" 
                                             alt="{{ $item->title }}" 
                                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                             onload="this.style.display='block'; this.nextElementSibling.style.display='none';">
                                        <!-- Fallback for when image fails to load -->
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-600 to-purple-600" style="display: none;">
                                            <div class="text-center text-white">
                                                <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <p class="text-sm font-medium">{{ $item->title }}</p>
                                                <p class="text-xs opacity-75">Image Preview</p>
                                            </div>
                                        </div>
                                        <!-- Click indicator overlay -->
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                            <div class="bg-white bg-opacity-90 rounded-full p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Debug info for images -->
                                    @if(config('app.debug'))
                                        <div class="absolute top-2 left-2 bg-black bg-opacity-75 text-white text-xs p-1 rounded">
                                            Path: {{ $item->file_path }}
                                        </div>
                                    @endif
                                @else
                                    <div class="relative w-full h-64 bg-gray-700 flex items-center justify-center">
                                        <video class="w-full h-full object-cover" controls>
                                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
                                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M8 5v10l8-5-8-5z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- Click indicator overlay -->
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                            <div class="bg-white bg-opacity-90 rounded-full p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-white mb-2">{{ $item->title }}</h3>
                                @if($item->description)
                                    <p class="text-gray-400 text-sm leading-relaxed">{{ $item->description }}</p>
                                @endif
                                <div class="mt-4 flex items-center justify-between">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $item->type === 'image' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ ucfirst($item->type) }}
                                    </span>
                                    <span class="text-gray-500 text-xs">{{ $item->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-700 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-2">No Content Yet</h3>
                    <p class="text-gray-400">Check back soon for amazing 3D artwork!</p>
                </div>
            @endif
        </div>

        <!-- About Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-white mb-6">About My Work</h2>
                    <p class="text-gray-400 text-lg leading-relaxed mb-6">
                        I specialize in creating immersive 3D environments and detailed prop designs. 
                        My work combines technical expertise with artistic vision to bring virtual worlds to life.
                    </p>
                    <p class="text-gray-400 text-lg leading-relaxed mb-8">
                        From fantasy landscapes to sci-fi environments, I focus on creating compelling 
                        visual experiences that tell stories and evoke emotions.
                    </p>
                    <div class="flex space-x-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-400">{{ $media->where('type', 'image')->count() }}</div>
                            <div class="text-gray-400 text-sm">Images</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-400">{{ $media->where('type', 'video')->count() }}</div>
                            <div class="text-gray-400 text-sm">Videos</div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-gradient-to-r from-blue-600/20 to-purple-600/20 rounded-lg p-8">
                        <h3 class="text-2xl font-semibold text-white mb-4">Skills & Expertise</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-400 rounded-full mr-3"></div>
                                <span class="text-gray-300">3D Modeling & Texturing</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-purple-400 rounded-full mr-3"></div>
                                <span class="text-gray-300">Environment Design</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-400 rounded-full mr-3"></div>
                                <span class="text-gray-300">Prop & Asset Creation</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-400 rounded-full mr-3"></div>
                                <span class="text-gray-300">Lighting & Rendering</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-white mb-4">Himal Gyawaly</h3>
                    <p class="text-gray-400 mb-6">3D Artist & Environment Designer</p>
                    <div class="flex justify-center space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <span class="sr-only">Portfolio</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </a>
                    </div>
                    <p class="text-gray-500 text-sm mt-6">&copy; 2024 Himal Gyawaly. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-0 z-50 hidden flex items-center justify-center p-4 transition-all duration-300">
        <div class="bg-gray-900 rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto relative transform scale-95 transition-all duration-300">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-700 sticky top-0 bg-gray-900 z-10">
                <h2 id="modalTitle" class="text-xl md:text-2xl font-bold text-white"></h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-white transition-colors duration-200 p-2 hover:bg-gray-800 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Content -->
            <div class="p-6">
                <div class="mb-6">
                    <div id="modalImageContainer" class="relative">
                        <!-- Loading spinner -->
                        <div id="modalLoading" class="hidden absolute inset-0 flex items-center justify-center bg-gray-800 rounded-lg">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
                        </div>
                        
                        <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[60vh] object-contain rounded-lg hidden">
                        <video id="modalVideo" class="w-full h-auto max-h-[60vh] rounded-lg hidden" controls>
                            <source id="modalVideoSource" src="" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Description</h3>
                        <p id="modalDescription" class="text-gray-300 leading-relaxed"></p>
                    </div>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-gray-700">
                        <div class="flex items-center space-x-4">
                            <span id="modalType" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium"></span>
                            <span id="modalDate" class="text-gray-400 text-sm"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add click event listeners to modal triggers
        document.addEventListener('DOMContentLoaded', function() {
            const modalTriggers = document.querySelectorAll('.modal-trigger');
            modalTriggers.forEach(trigger => {
                trigger.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const title = this.dataset.title;
                    const description = this.dataset.description;
                    const filePath = this.dataset.filePath;
                    const type = this.dataset.type;
                    const date = this.dataset.date;
                    
                    openModal(id, title, description, filePath, type, date);
                });
            });
        });

        function openModal(id, title, description, filePath, type, date) {
            const modal = document.getElementById('imageModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');
            const modalImage = document.getElementById('modalImage');
            const modalVideo = document.getElementById('modalVideo');
            const modalVideoSource = document.getElementById('modalVideoSource');
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
            
            // Show modal with smooth transition
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Trigger transition after a small delay
            setTimeout(() => {
                modal.style.backgroundColor = 'rgba(0, 0, 0, 0.75)';
                modal.querySelector('.bg-gray-900').style.transform = 'scale(1)';
            }, 10);
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            const modal = document.getElementById('imageModal');
            const modalContent = modal.querySelector('.bg-gray-900');
            
            // Start transition
            modal.style.backgroundColor = 'rgba(0, 0, 0, 0)';
            modalContent.style.transform = 'scale(0.95)';
            
            // Hide modal after transition
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                
                // Reset styles
                modal.style.backgroundColor = '';
                modalContent.style.transform = '';
                
                // Restore body scroll
                document.body.style.overflow = 'auto';
                
                // Stop video if playing
                const modalVideo = document.getElementById('modalVideo');
                if (modalVideo) {
                    modalVideo.pause();
                    modalVideo.currentTime = 0;
                }
            }, 300);
        }
        
        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</x-app-layout> 