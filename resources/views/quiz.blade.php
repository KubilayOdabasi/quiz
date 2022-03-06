<x-app-layout>
    <x-slot name="header">{{ $quiz->title }}</x-slot>

    <div class="card">
        <div class="card-body">
            <div class="card-text">
                <form method="POST" action="#">
                @csrf

                @foreach($quiz->questions as $question)
                    <strong># {{ $loop->iteration }} - </strong>{{ $question->question }}
                    @if( $question->image )
                        <img src="{{asset($question->image)}}" class="img-responsive">
                    @endif

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{ $question->id }}" id="quiz_{{ $question->id }}_answer1" value="answer1" required>
                        <label class="form-check-label" for="quiz_{{ $question->id }}_answer1">
                            {{ $question->answer1 }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{ $question->id }}" id="quiz_{{ $question->id }}_answer2" value="answer2" required>
                        <label class="form-check-label" for="quiz_{{ $question->id }}_answer2">
                            {{ $question->answer2 }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{ $question->id }}" id="quiz_{{ $question->id }}_answer3" value="answer3" required>
                        <label class="form-check-label" for="quiz_{{ $question->id }}_answer3">
                            {{ $question->answer3 }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{ $question->id }}" id="quiz_{{ $question->id }}_answer4" value="answer4" required>
                        <label class="form-check-label" for="quiz_{{ $question->id }}_answer4">
                            {{ $question->answer4 }}
                        </label>
                    </div>
                    <hr>
                @endforeach
                    <button type="submit" class="btn btn-sm btn-success col-12">Sınavı Bitir</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
