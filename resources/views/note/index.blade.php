    <x-app-layout>
        <div class="container py-5">
            <h1 class="display-4 text-center">Notes</h1>
            <div class="my-3 d-flex justify-content-end">
                <a href="{{ route('note.create') }}" class="btn btn-primary rounded-3 z-1">Add Note</a>
            </div>
            <div class="row gy-3">
                @foreach ($notes as $note)
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <p>{{ Str::words($note->notes, 20) }}</p>
                            </div>
                        </div>
                        <p>Created by: {{$note->user->email}}</p>
                        <div class="mt-3 d-flex gap-1 align-items-center">
                            <a class="btn btn-secondary btn-sm pe-3" href="{{ route('note.show', $note) }}">View</a>
                            <a class="btn btn-success btn-sm pe-3" href="{{ route('note.edit', $note) }}">Edit</a>
                            <form action="{{ route('note.destroy', $note) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $notes->links('vendor.pagination.default') }}
            </div>
        </div>
    </x-app-layout>



