<x-qlayout>
  @if (!Auth::check())
    @include('partials._hero')
  @endif

  @include('partials._qsearch')

  <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

    @unless(count($quizzes) == 0)

    @foreach($quizzes as $quizze)
    <x-qlisting-card :quizze="$quizze" />
    @endforeach

    @else
    <p>No quizzes Found</p>
    @endunless

  </div>

  <div class="mt-6 p-4">
    {{$quizzes->links()}}
  </div>
</x-qlayout>
