<?php
  $totalGrade = 0;
  $userGrade = 0;
?>

<x-qlayout>
  <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
  </a>
  <div class="mx-4">
    <x-card class="p-10">
      <div class="flex flex-col items-center justify-center text-center">

        <h3 class="text-3xl mb-2">
          {{$quizze->title}}
        </h3>

        <x-qlisting-tags :tagsCsv="$quizze->tags" /> <br>
        <div class="text-lg space-y-6">
          {{$quizze->description}}
        </div>
      </div>
    </x-card>
  </div>
  <div class = "mx-4">
  <x-card class="p-10 mt-5">
    <h4 class = "text-2xl mb-3 text-center">Response of User : {{auth()->user()->name}}</h4>
    <form method="POST" action="/responses" enctype="multipart/form-data">
      @csrf
      @foreach($questions as $question => $att)
        <input type = "hidden" name = "question_id {{$att['id']}}" value = {{$att['id']}}>
          <x-card class="p-10 mt-2">
            <div class = "flex flex-col items-center justify-center text-center">
              <h3 class = "text-xl">{{$att['title']}}</h3>
              <p>{{$att['description']}}</p><br>
              @if($att['type'] == 'Text')
                <input class="border border-gray-200 rounded p-2 w-full" name = {{'q' . $att['id'] . 'answer'}} type = "text" placeholder = "Put your answer here !"
                disabled>
              @elseif($att['type'] == 'MSQ')
                <div>
                  <?php $i = 0;?>
                  @foreach (array_map('trim', explode(',', $att['choices'])) as $choice)                    <input type = "checkbox" name = {{'q' . $att['id'] . 'answer' . $i}} value = "{{$choice}}" disabled> <?php echo $choice?>
                    <?php $i = $i + 1;?>
                  @endforeach
                </div>
              @else
                <div>
                @foreach (array_map('trim', explode(',', $att['choices'])) as $choice)
                  <input type = "radio" name = {{'q' . $att['id'] . 'answer'}} value = "{{$choice}}" disabled> <?php echo $choice?>
                @endforeach
                </div>
              @endif
              <br>
              <div class = "container flex flex-col items-center bg-{{$questionResponses[$att['id']][0]['correct'] == 1 ? 'green-300' : 'red-400'}}">
                <p class = 'text-lg'>Your Answer : {{$questionResponses[$att['id']][0]['answer']}}</p>
                <p class = 'text-lg'>Correct Answer : {{$questionResponses[$att['id']][0]['true_answer']}}</p>
                <p class = 'text-lg'>Grade : {{$questionResponses[$att['id']][0]['correct'] == 1 ? $questionResponses[$att['id']][0]['grade'] : 0}} / {{$questionResponses[$att['id']][0]['grade']}}</p>
                <?php $totalGrade += $questionResponses[$att['id']][0]['grade']?>
                <?php
                  if($questionResponses[$att['id']][0]['correct'] == 1) $userGrade += $questionResponses[$att['id']][0]['grade'];
                ?>
              </div>
            </div>
          </x-card>
      @endforeach
    </form>
  </x-card>
  </div>
  <x-card class="p-10 mt-2">
    <div class = "flex flex-col items-center justify-center text-center">
      <h3 class="text-2xl"> Total Grade : {{$userGrade}} / {{$totalGrade}}</h3>
    </div>
  </x-card>
</x-qlayout>