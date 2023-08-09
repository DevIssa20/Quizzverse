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
    </x-card>
    <form method="POST" action="/responses" enctype="multipart/form-data">
      @csrf
      @foreach($questions as $question => $att)
      <input type = "hidden" name = "question_id {{$att['id']}}" value = {{$att['id']}}>
        <x-card class="p-10 mt-2">
            <div class = "flex flex-col items-center justify-center text-center">
              <h3 class = "text-xl">{{$att['title']}}</h3>
              <p>{{$att['description']}}</p><br>
              @if($att['type'] == 'Text')
                <input class="border border-gray-200 rounded p-2 w-full" name = {{'q' . $att['id'] . 'answer'}} type = "text" placeholder = "Put your answer here !">
              @elseif($att['type'] == 'MSQ')
                <div>
                  <?php $i = 0;?>
                  @foreach (array_map('trim', explode(',', $att['choices'])) as $choice)
                    <input type = "checkbox" name = {{'q' . $att['id'] . 'answer' . $i}} value = "{{$choice}}"> <?php echo $choice?>
                    <?php $i = $i + 1;?>
                  @endforeach
                </div>
              @else
                <div>
                @foreach (array_map('trim', explode(',', $att['choices'])) as $choice)
                  <input type = "radio" name = {{'q' . $att['id'] . 'answer'}} value = "{{$choice}}"> <?php echo $choice?>
                @endforeach
                </div>
              @endif
            </div>
        </x-card>
    @endforeach
    <input type = "hidden" name = "quizze_id" value = "{{$quizze->id}}">
    <x-card class="p-10 mt-2">
      <div class = "flex flex-col items-center justify-center text-center">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Submit
        </button>
      </div>
    </x-card>
  </div>
</x-qlayout>