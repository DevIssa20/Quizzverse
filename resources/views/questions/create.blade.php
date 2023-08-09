<x-qlayout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">New Question</h2>
      <p class="mb-4">Create a new Question</p>
    </header>

    <form method="POST" action="/questions" enctype="multipart/form-data">
      @csrf
      <div class="mb-6">
        <label for="type" class="inline-block text-lg mb-2">Question Type :</label><br>
        <div class="mx-8">
          <input type="radio" class="border border-gray-200 rounded p-2" name="type"
            value="Text" {{old('type') == 'Text' ? 'checked='.'"checked"' : ''}}/> Text <br>
          <input type="radio" class="border border-gray-200 rounded p-2" name="type"
            value="MCQ" {{old('type') == 'MCQ' ? 'checked='.'"checked"' : ''}}/> MCQ (Multiple Choice Question) <br>
          <input type="radio" class="border border-gray-200 rounded p-2" name="type"
            value="MSQ" {{old('type') == 'MSQ' ? 'checked='.'"checked"' : ''}}/> MSQ (Multiple Selection Question) <br><br>
        </div>
        @error('type')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="title" class="inline-block text-lg mb-2">Question Title</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
          placeholder="Example: What is my favorite movie ?" value="{{old('title')}}" />

        @error('title')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="description" class="inline-block text-lg mb-2">
          Question Description
        </label>
        <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
          placeholder="Optional: Include extra information about the question, or possible hints">{{old('description')}}</textarea>

        @error('description')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="choices" class="inline-block text-lg mb-2">
          Choices (Comma Separated, Only applicable for MCQ and MSQ)
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="choices"
          placeholder="Example: The Matrix, Interstellar, Avengers, etc" value="{{old('choices')}}" />

        @error('choices')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="answer" class="inline-block text-lg mb-2">True Answer</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="answer"
          placeholder="Interstellar" value="{{old('answer')}}" />

        @error('answer')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="grade" class="inline-block text-lg mb-2">Grade</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="grade"
          placeholder="10" value="{{old('grade')}}" />

        @error('grade')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <input type = "hidden" name = "quizze_id" value = "{{$quizze_id}}">

      <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Create Question
        </button>

        <a href="/quizzes{{$quizze_id}}/edit" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </x-card>
</x-qlayout>
