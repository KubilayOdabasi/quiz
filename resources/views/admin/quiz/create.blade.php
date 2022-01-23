<x-app-layout>
    <x-slot name="header">Quiz Oluştur</x-slot>
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('quizzes.store') }}">
                @csrf
                <div class="form-group">
                    <label>Başlık</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label>Açıklama</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="isFinished" @if(old('finished_at')) checked @endif>
                    <label>Biriş Tarihi Olacak Mı?</label>
                </div>
                <div class="form-group" @if(!old('finished_at')) style="display: none;" @endif id="finished_at_div">
                    <label>Biriş Tarihi</label>
                    <input type="datetime-local" name="finished_at" class="form-control" value="{{ old('finished_at') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block">Quiz Oluştur</button>
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
