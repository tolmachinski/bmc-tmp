<div>
    <h3>{{$record->title}}</h3>
    <span>{{$record->position}}</span>
    @if ($record->image)
        <img style="max-width: 100%;" src="{{ "uploads/{$record->image}" }}" alt="{{ $record->title }}">
    @endif
    <p>{!! $record->description !!}</p>
</div>
