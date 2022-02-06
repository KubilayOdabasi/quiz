<x-app-layout>
    <x-slot name="header">Quiz Güncelle</x-slot>
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('quizzes.update', $quiz->id) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Başlık</label>
                    <input type="text" name="title" class="form-control" value="@if(old('title')){{ old('title') }}@else{{ $quiz->title }}@endif">
                </div>
                <div class="form-group">
                    <label>Açıklama</label>
                    <textarea name="description" class="form-control" rows="4">@if(old('description')){{ old('description') }}@else{{ $quiz->description }}@endif</textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="isFinished" @if( $quiz->finished_at ) checked @endif>
                    <label>Biriş Tarihi Olacak Mı?</label>
                </div>
                <div class="form-group" @if( !$quiz->finished_at ) style="display: none;" @endif id="finished_at_div">
                    <label>Biriş Tarihi</label>
                    <input type="datetime-local" name="finished_at" class="form-control" value="@if(old('finished_at')){{ old('finished_at') }}@else@if($quiz->finished_at){{ date('Y-m-d\TH:i', strtotime($quiz->finished_at)) }}@endif@endif">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block">Quiz Güncelle</button>
                </div>

            </form>
        </div>
    </div>

    <x-slot name="js">
        <script>
            $('#isFinished').change(function (){
                if($('#isFinished').is(':checked')){
                    $('#finished_at_div').show();
                }
                else
                {
                    $('#finished_at_div').hide();
                }
            });
        </script>
    </x-slot>
</x-app-layout>
