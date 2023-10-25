@extends('dashboard.main')

<div class="flex items-center justify-center pt-32">
    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <form action="/sesi/login" method="POST" class="m-0 p-0">
        {{-- Section 1 --}}
        @csrf
        <div class="border border-black rounded-md p-5">
            <div class="bg-teknik rounded-md p-5">
                <div class="">
                    {{-- Username --}}
                    <div class="">
                        <div class="py-1 mb-2">
                            <label class="font-bold text-white">Username</label>
                        </div>
                        <div class="mb-2">
                            <input class="w-108 rounded-md text-base" type="text" placeholder="Enter Username" name="username" required>
                        </div>
                    </div>
                    {{-- End Username --}}
                    {{-- Password --}}
                    <div>
                        <div class="py-1 mb-2">
                            <label class="font-bold text-white">Password</label>
                        </div>
                        <div class="mb-2">
                            <input class="w-108 rounded-md text-base" type="password" placeholder="Enter Password" name="password" required>
                        </div>
                    </div>
                    {{-- End Password --}}
                </div>
                <div class="py-2.5">
                    <button href="/welcome" type="submit" class="bg-amber-600 text-base font-bold p-2.5 rounded-md mr-2">Masuk</button>
                    <button class="bg-amber-600 text-base font-bold p-2.5 rounded-md">Home</button>
                </div>
            </div>
        </div>
        {{-- End Section 1 --}}
    </form>
</div>
