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
                        <h1 class="text-3xl font-bold text-gray-900">Upload New File</h1>
                        <p class="text-gray-600 mt-2">Add new content to your portfolio</p>
                    </div>
                </div>
            </div>

            <!-- Upload Form -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <form action="{{ route('multimedia.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    
                    <!-- File Type Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="image" class="sr-only" required>
                                <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-blue-500 transition-colors duration-200">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="font-medium">Image</span>
                                    <p class="text-sm text-gray-500 mt-1">JPG, PNG, WebP (max 20MB, 1920x1080)</p>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="video" class="sr-only" required>
                                <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-blue-500 transition-colors duration-200">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="font-medium">Video</span>
                                    <p class="text-sm text-gray-500 mt-1">MP4, MOV, AVI, WebM (max 200MB)</p>
                                </div>
                            </label>
                        </div>
                        @error('type')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
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
                                  placeholder="Describe your work, techniques used, or any relevant details">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload with Drag & Drop -->
                    <div class="mb-6">
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">File</label>
                        <div id="dropZone" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-500 transition-all duration-300 bg-gray-50 hover:bg-blue-50">
                            <div id="dropZoneContent">
                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-gray-600 mb-2 font-medium">Drag and drop your file here</p>
                                <p class="text-sm text-gray-500 mb-4">or click to browse</p>
                                <button type="button" id="browseBtn" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                                    Choose File
                                </button>
                            </div>
                            <input type="file" 
                                   id="file" 
                                   name="file" 
                                   class="hidden"
                                   required>
                        </div>
                        @error('file')
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
                            Upload File
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Drag and Drop functionality
    const dropZone = document.getElementById('dropZone');
    const dropZoneContent = document.getElementById('dropZoneContent');
    const fileInput = document.getElementById('file');
    const browseBtn = document.getElementById('browseBtn');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop zone when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    dropZone.addEventListener('drop', handleDrop, false);

    // Handle file input change
    fileInput.addEventListener('change', handleFileSelect);

    // Browse button click
    browseBtn.addEventListener('click', () => fileInput.click());

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight(e) {
        dropZone.classList.add('border-blue-500', 'bg-blue-50');
        dropZone.classList.remove('border-gray-300', 'bg-gray-50');
    }

    function unhighlight(e) {
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        dropZone.classList.add('border-gray-300', 'bg-gray-50');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFileSelect(e) {
        const files = e.target.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            displayFileInfo(file);
        }
    }

    function displayFileInfo(file) {
        const fileSize = (file.size / 1024 / 1024).toFixed(2);
        const fileType = file.type.startsWith('image/') ? 'Image' : 'Video';
        const selectedType = document.querySelector('input[name="type"]:checked')?.value;
        
        // Validate file type matches selected type
        if (selectedType && 
            ((selectedType === 'image' && !file.type.startsWith('image/')) || 
             (selectedType === 'video' && !file.type.startsWith('video/')))) {
            alert(`Please select a ${selectedType} file. You selected a ${fileType.toLowerCase()} file.`);
            resetFileInput();
            return;
        }
        
        let previewHtml = '';
        
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewHtml = `
                    <div class="text-center">
                        <img src="${e.target.result}" alt="Preview" class="w-32 h-32 object-cover rounded-lg mx-auto mb-4">
                        <p class="text-green-600 font-medium">${file.name}</p>
                        <p class="text-sm text-gray-500">${fileSize} MB • Image</p>
                        <button type="button" onclick="resetFileInput()" class="mt-2 text-red-500 hover:text-red-700 text-sm">
                            Remove file
                        </button>
                    </div>
                `;
                dropZoneContent.innerHTML = previewHtml;
            };
            reader.readAsDataURL(file);
        } else if (file.type.startsWith('video/')) {
            previewHtml = `
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-purple-600 font-medium">${file.name}</p>
                    <p class="text-sm text-gray-500">${fileSize} MB • Video</p>
                    <button type="button" onclick="resetFileInput()" class="mt-2 text-red-500 hover:text-red-700 text-sm">
                        Remove file
                    </button>
                </div>
            `;
            dropZoneContent.innerHTML = previewHtml;
        } else {
            previewHtml = `
                <div class="text-center">
                    <svg class="w-12 h-12 mx-auto mb-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-green-600 font-medium">${file.name}</p>
                    <p class="text-sm text-gray-500">${fileSize} MB • ${fileType}</p>
                    <button type="button" onclick="resetFileInput()" class="mt-2 text-red-500 hover:text-red-700 text-sm">
                        Remove file
                    </button>
                </div>
            `;
            dropZoneContent.innerHTML = previewHtml;
        }
    }

    function resetFileInput() {
        fileInput.value = '';
        dropZoneContent.innerHTML = `
            <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
            <p class="text-gray-600 mb-2 font-medium">Drag and drop your file here</p>
            <p class="text-sm text-gray-500 mb-4">or click to browse</p>
            <button type="button" id="browseBtn" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                Choose File
            </button>
        `;
        // Reattach event listener to new browse button
        document.getElementById('browseBtn').addEventListener('click', () => fileInput.click());
    }

    // Type selection styling
    document.querySelectorAll('input[name="type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('input[name="type"]').forEach(r => {
                r.closest('label').querySelector('div').classList.remove('border-blue-500', 'bg-blue-50');
                r.closest('label').querySelector('div').classList.add('border-gray-200');
            });
            this.closest('label').querySelector('div').classList.remove('border-gray-200');
            this.closest('label').querySelector('div').classList.add('border-blue-500', 'bg-blue-50');
        });
    });
    </script>
</x-app-layout> 