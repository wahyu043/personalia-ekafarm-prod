@if (session('success'))
<div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 border border-green-300">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 border border-red-300">
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif