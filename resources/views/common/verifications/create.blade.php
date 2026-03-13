@extends('layouts.dashboard')

@section('title', 'Submit Verification')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('verifications.index') }}" class="text-sm font-semibold text-primary hover:underline flex items-center gap-2 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to List
        </a>
        <h1 class="text-2xl font-bold text-text-primary">Submit Document</h1>
        <p class="text-text-secondary">Upload a clear photo of your ID for manual verification.</p>
    </div>

    <form action="{{ route('verifications.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-bold text-text-primary mb-2">ID Type</label>
            <select name="id_type" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none" required>
                <option value="">Select ID Type</option>
                <option value="aadhaar">Aadhaar Card</option>
                <option value="pan">PAN Card</option>
                <option value="driving_license">Driving License</option>
            </select>
            @error('id_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-text-primary mb-2">ID Number</label>
            <input type="text" name="id_number" value="{{ old('id_number') }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none" placeholder="Enter number on the ID" required>
            @error('id_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-text-primary mb-2">ID Photo (Image)</label>
            <div class="relative group">
                <input type="file" name="id_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required accept="image/*">
                <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-8 text-center group-hover:border-primary transition-all">
                    <svg class="w-10 h-10 text-gray-400 mx-auto mb-3 group-hover:text-primary transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class="text-sm font-medium text-text-secondary">Click or drag a photo to upload</p>
                    <p class="text-xs text-text-secondary mt-1">PNG, JPG or JPEG (Max 2MB)</p>
                </div>
            </div>
            @error('id_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full btn-primary py-4 rounded-2xl font-bold shadow-lg shadow-primary/20">
            Submit Document
        </button>
    </form>
</div>
@endsection
