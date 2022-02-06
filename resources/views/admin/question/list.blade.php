<x-app-layout>
    <x-slot name="header">{{ $quiz->title }} Quizine ait sorular</x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('questions.create', $quiz->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Soru Oluştur</a>
            </h5>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Soru</th>
                    <th scope="col">Fotoğraf</th>
                    <th scope="col">Cevap 1</th>
                    <th scope="col">Cevap 2</th>
                    <th scope="col">Cevap 3</th>
                    <th scope="col">Cevap 4</th>
                    <th scope="col">Doğru Cevap</th>
                    <th scope="col">İşlemler</th>
                </tr>
                </thead>
                <tbody>

                @foreach($quiz->questions as $question)
                    <tr>
                        <td scope="col">{{ $question->question }}</td>
                        <td scope="col">{{ $question->image }}</td>
                        <td scope="col">{{ $question->answer1 }}</td>
                        <td scope="col">{{ $question->answer2 }}</td>
                        <td scope="col">{{ $question->answer3 }}</td>
                        <td scope="col">{{ $question->answer4 }}</td>
                        <td scope="col" class="text-success">{{ substr($question->correct_answer, -1) }}. Cevap</td>
                        <td scope="col" style="width: 90px;">
                            <a href="{{ route('questions.edit', [$quiz->id, $question->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{ route('questions.destroy', [$quiz->id, $question->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
