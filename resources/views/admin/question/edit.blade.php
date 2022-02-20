<x-app-layout>
    <x-slot name="header">{{ $question->question }} Düzenle</x-slot>
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('questions.update', [$question->quiz_id, $question->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Quiz Başlığı</label>
                    <textarea name="question" class="form-control" rows="4">@if(old('question')){{ old('question') }}@else{{ $question->question }}@endif</textarea>
                </div>
                <div class="form-group">
                    @if($question->image)
                    <a href="{{asset($question->image)}}" target="_blank">
                        <img src="{{asset($question->image)}}" class="img-responsive" style="max-width: 200px;">
                    </a>
                    @endif
                    <label>Fotoğraf</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cevap 1</label>
                            <textarea name="answer1" class="form-control" rows="2">@if(old('answer1')){{ old('answer1') }}@else{{ $question->answer1 }}@endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cevap 2</label>
                            <textarea name="answer2" class="form-control" rows="2">@if(old('answer2')){{ old('answer2') }}@else{{ $question->answer2 }}@endif</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cevap 3</label>
                            <textarea name="answer3" class="form-control" rows="2">@if(old('answer3')){{ old('answer3') }}@else{{ $question->answer3 }}@endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cevap 4</label>
                            <textarea name="answer4" class="form-control" rows="2">@if(old('answer4')){{ old('answer4') }}@else{{ $question->answer4 }}@endif</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Cevap </label>
                    <select name="correct_answer" class="form-control">
                        <option value="">Doğru Cevap Seçiniz</option>
                        <option @if($question->correct_answer==='answer1') selected @endif value="answer1">Cevap 1</option>
                        <option @if($question->correct_answer==='answer2') selected @endif value="answer2">Cevap 2</option>
                        <option @if($question->correct_answer==='answer3') selected @endif value="answer3">Cevap 3</option>
                        <option @if($question->correct_answer==='answer4') selected @endif value="answer4">Cevap 4</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block">Soru Oluştur</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
