@props(['quizze'])
<?php
  use App\Models\User;
  $ownerID = $quizze->user_id;
  $owner= User::find($ownerID);
  $ownerName = $owner->name;
?>

<x-card>
  <div class="flex">
    <div>
      <h3 class="text-2xl">
        <a href="/quizzes/{{$quizze->id}}">{{$quizze->title}}</a>
      </h3>
      <div> Created by : {{$ownerName}} </div>
      <x-qlisting-tags :tagsCsv="$quizze->tags" />
      <div class="text-xl font-bold mb-4">{{$quizze->description}}</div>
    </div>
  </div>
</x-card>