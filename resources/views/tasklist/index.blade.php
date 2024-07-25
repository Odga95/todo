@extends("layouts.app")
@section("content")
<div id="app">
    <nav class="flex p-4">
        <router-link to="/" class="text-xs text-white mx-3 p-2 font-semibold" active-class="font-bold" exact>HOME</router-link>
        <router-link to="/form" class="text-xs text-white mx-3 p-2 font-semibold" active-class="font-bold" exact>ADD TASK</router-link>
        <router-link to="/tasks" class="text-xs text-white mx-3 p-2 font-semibold" active-class="font-bold" exact>LIST TASK</router-link>
    </nav>
    <div class="flex justify-center mt-20">
        <router-view></router-view>
    </div>
</div>

@endsection