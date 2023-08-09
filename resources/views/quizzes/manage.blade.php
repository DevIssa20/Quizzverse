<x-qlayout>
  <x-card class="p-10">
    <header>
      <a href="/" class="block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
      </a>
      <h1 class="text-3xl text-center font-bold my-6 uppercase">
        Manage Quizzes
      </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
      <tbody>
        @unless($quizzes->isEmpty())
        @foreach($quizzes as $quizze)
        <tr class="border-gray-300">
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <a href="/quizzes/{{$quizze->id}}"> {{$quizze->title}} </a>
          </td>
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <a href="/quizzes/{{$quizze->id}}/viewResponses/0" class="text-green-400 px-6 py-2 rounded-xl">
              <i class="fa fa-book" aria-hidden="true"></i>
              Responses</a>
          </td>
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <a href="/quizzes/{{$quizze->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                class="fa-solid fa-pen-to-square"></i>
              Edit</a>
          </td>
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <form method="POST" action="/quizzes/{{$quizze->id}}">
              @csrf
              @method('DELETE')
              <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
        @else
        <tr class="border-gray-300">
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <p class="text-center">No Quizzes Found</p>
          </td>
        </tr>
        @endunless

      </tbody>
    </table>
  </x-card>
</x-qlayout>
