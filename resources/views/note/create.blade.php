<x-app-layout>
    <div class="container py-5">
        <h1 class="display-4 text-center">Create Note</h1>
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <form action="{{ route('note.store') }}" method="POST">
                    @csrf
                    <textarea name="notes" class="form-control" rows="10">{{ old('notes') }}</textarea>
                    @error('notes')
                        <small class="text-danger">{{ $errors->first('notes') }}</small>
                    @enderror
                    <div class="mt-3">
                        <a class="btn btn-primary pe-3" href="{{ route('note.index') }}">Back</a>
                        <button class="btn btn-success pe-3" type="submit">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layo>
