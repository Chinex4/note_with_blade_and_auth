<x-app-layout>
    <div class="container py-5">
        <h1 class="display-4 text-center">View Note</h1>
        <div class="row">
            <div class="col-lg-6 mx-auto">
                    <p class="fw-bold">Created at: {{ $note->created_at->format('h:iA, d F, Y') }}</p>
                    <div class="card">
                        <img src="{{asset('storage/' . $note->image)}}" alt="">
                        <div class="card-body">
                            
                            <p>{{ $note->notes }}</p>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-1">
                        <a class="btn btn-primary pe-3" href="{{ route('note.index') }}">Back</a>
                        <a class="btn btn-success pe-3" href="{{ route('note.edit', $note) }}">Edit</a>
                        <form action="{{ route('note.destroy', $note) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>




