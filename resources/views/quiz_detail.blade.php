<x-app-layout>
    <x-slot name="header">{{ $quiz->title }}</x-slot>

    <div class="card">
        <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-group">
                            @if($quiz->my_result)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Puan
                                <span class="badge alert-primary badge-pill">{{ $quiz->my_result->point }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Doğru / Yanlış
                                <div class="float-right">
                                    <span class="badge alert-success badge-pill">{{ $quiz->my_result->correct }} Doğru</span>
                                    <span class="badge alert-danger badge-pill">{{ $quiz->my_result->wrong }} Yanlış</span>
                                </div>
                            </li>
                            @endif
                            @if($quiz->finished_at)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Son Katılım Tarihi
                                <span title="{{ $quiz->finished_at }}" class="badge alert-secondary badge-pill">{{ $quiz->finished_at->diffForHumans() }}</span>
                            </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Soru Sayısı
                                <span class="badge alert-secondary badge-pill">{{ $quiz->questions_count }}</span>
                            </li>
                            @if($quiz->details->join_count>0)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Katılımcı Sayısı
                                <span class="badge alert-warning badge-pill">{{ $quiz->details->join_count }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ortalama Puan
                                <span class="badge alert-light badge-pill">{{ $quiz->details->average }}</span>
                            </li>
                            @endif
                        </ul>

                        @if(count($quiz->top_ten)>0)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">En iyi 10</h5>
                                <ul class="list-group">
                                    @foreach($quiz->top_ten as $topten)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong class="h4">{{ $loop->iteration }}.</strong>
                                        <img class="w-8 h-8 rounded-full ml-2 mr-2" src="{{ asset($topten->user->profile_photo_url) }}">
                                        {{ $topten->user->name }}
                                        <span class="badge alert-success badge-pill">{{ $topten->point }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p class="card-text">
                            {{ $quiz->description }}
                        </p>
                        @if(!$quiz->my_result)
                        <a href="{{ route('quiz.join', $quiz->slug) }}" class="btn btn-primary btn-sm col-12">Sınava Katıl</a>
                        @else
                        <a href="{{ route('quiz.detail', $quiz->slug) }}" class="btn btn-warning btn-sm col-12">Sınavı Görüntüle</a>
                        @endif
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
