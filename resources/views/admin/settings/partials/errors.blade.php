@if ($errors->any())
    <div class="mb-6 rounded-2xl border border-red-100 bg-red-50 p-4 text-red-700">
        <p class="mb-2 text-sm font-bold">Please fix the following:</p>
        <ul class="list-inside list-disc space-y-1 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
