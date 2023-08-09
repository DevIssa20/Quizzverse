<x-qlayout>
  <form method="POST" action="/quizzes" enctype="multipart/form-data">
    @csrf
    <x-card class="p-10 max-w-lg mx-auto mt-24">
      <header class="text-center">
        <h2 class="text-3xl font-bold uppercase mb-1">Create a Quizz</h2>
        <p class="mb-4">Create a Quizz for others to solve</p>
      </header>

      <div class="mb-6">
        <label for="title" class="inline-block text-lg mb-2">Quizz Name</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
          value="{{old('title')}}" />

        @error('title')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>


      <div class="mb-6">
        <label class="inline-block text-lg mb-2">
          Quizz Attributes :
        </label><br>
        <label class="relative inline-flex items-center cursor-pointer">
          <input type="checkbox" value="1" class="sr-only peer" name = "private">
          <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
          <span class = "mx-3">Private</span>
        </label><br>
      </div>

      <div class="mb-6">
        <label for="description" class="inline-block text-lg mb-2">
          Quizz Description
        </label>
        <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
          placeholder="Include tasks, requirements, salary, etc">{{old('description')}}</textarea>

        @error('description')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="tags" class="inline-block text-lg mb-2">
          Tags (Comma Separated)
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
          placeholder="Example: Laravel, Backend, Postgres, etc" value="{{old('tags')}}" />

        @error('tags')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>
    </x-card>

    <x-card class="p-10 max-w-lg mx-auto mt-24">
      <div class = "mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Create Quizz
        </button>


        <a href="/" class="text-black ml-4"> Back </a>
      </div>
    </x-card>
  </form>
</x-qlayout>
