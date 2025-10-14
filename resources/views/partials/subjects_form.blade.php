@foreach ($subjects as $subject)
<div class="card mb-3 border border-secondary-subtle shadow-sm">
    <div class="card-header bg-light">
        <h6 class="mb-0 text-primary">{{ $subject->title }}</h6>
    </div>
    <div class="card-body">
        <input type="hidden" name="subjects[{{ $subject->id }}][subject_id]" value="{{ $subject->id }}">

        <div class="row mb-3 align-items-center">
            <label for="start_time_{{ $subject->id }}" class="col-sm-3 col-form-label text-end">Start Time</label>
            <div class="col-sm-9">
                <input type="time" name="subjects[{{ $subject->id }}][start_time]"
                    id="start_time_{{ $subject->id }}"
                    class="form-control" value="{{ old('subjects.' . $subject->id . '.start_time') }}">
            </div>
        </div>

        <div class="row mb-3 align-items-center">
            <label for="end_time_{{ $subject->id }}" class="col-sm-3 col-form-label text-end">End Time</label>
            <div class="col-sm-9">
                <input type="time" name="subjects[{{ $subject->id }}][end_time]"
                    id="end_time_{{ $subject->id }}"
                    class="form-control" value="{{ old('subjects.' . $subject->id . '.end_time') }}">
            </div>
        </div>
    </div>
</div>
@endforeach
