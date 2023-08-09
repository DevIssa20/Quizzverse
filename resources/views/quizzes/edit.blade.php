<x-qlayout>
  <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
  </a>
  <div class="mx-4">
    <x-card class="p-10">
      <div class="flex flex-col items-center justify-center text-center">
        <a href="/quizzes/{{$quizze->id}}/editConfig">
          <i class="fa-solid fa-cog"></i> Configure
        </a>

        <form method="POST" action="/quizzes/{{$quizze->id}}">
          @csrf
          @method('DELETE')
          <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
        </form>

        <a href = "/quizzes/{{$quizze->id}}">
          <i class="fa-regular fa-eye"></i> Preview
        </a>

        <h3 class="text-3xl mb-2">
          {{$quizze->title}}
        </h3>

        <x-qlisting-tags :tagsCsv="$quizze->tags" /> <br>
        <div class="text-lg space-y-6">
          {{$quizze->description}}
        </div>
    </x-card>
  </div>
  @foreach($questions as $question => $att)
  <x-card class="p-10 mt-2">
      <div class = "flex flex-col items-center justify-center text-center">
        <h3 class = "text-xl">{{$att['title']}}</h3>
        <p>{{$att['description']}}</p><br>
        @if($att['type'] == 'Text')
          <input class="border border-gray-200 rounded p-2 w-full" name = "userAnswer" type = "text" placeholder = "Put your answer here !">
          <br>
          <form method="POST" action="/questions/{{$att['id']}}">
            @csrf
            @method('DELETE')
            <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
          </form>
        @elseif($att['type'] == 'MSQ')
          <div>
            @foreach (array_map('trim', explode(',', $att['choices'])) as $choice)
              <input type = "checkbox" name = {{$att['id'] . 'answer'}} value = "{{$choice}}"> <?php echo $choice?>
            @endforeach
          </div>
          <br>
          <form method="POST" action="/questions/{{$att['id']}}">
            @csrf
            @method('DELETE')
            <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
          </form>
        @else
          <div>
          @foreach (array_map('trim', explode(',', $att['choices'])) as $choice)
            <input type = "radio" name = "userAnswer" value = "{{$choice}}"> <?php echo $choice?>
          @endforeach
          </div>
          <br>
          <form method="POST" action="/questions/{{$att['id']}}">
            @csrf
            @method('DELETE')
            <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
          </form>
        @endif
      </div>
  </x-card>
  @endforeach
  <x-card class="p-10 mt-2">
    <div class = "flex flex-col items-center justify-center text-center">
      <a class="bg-laravel text-center text-white rounded py-2 px-4 hover:bg-black" 
      href = "{{ route('/questions/create', ['quizze_id' => $quizze->id]);}}">Add Question</a>
    </div>
  </x-card>
  <x-card class="p-10 mt-10">
    <div class = "container">
      <a class="bg-laravel text-center text-white rounded py-2 px-4 hover:bg-black" 
      href = "/quizzes/manage">Done</a>
    </div>
  </x-card>
</x-qlayout>