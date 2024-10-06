@section('title', 'ログイン')
@extends('layouts.app')
@section('content')
    <x-breadcrumb>ホーム</x-breadcrumb>
    <x-header-1>ホーム</x-header-1>
    <div class="pb-24">
        <form action="" method="POST"
              class="max-w-lg bg-white rounded-md shadow-default mx-4 lg:mx-auto">
            @csrf
            <div class="mx-auto py-10 px-6 lg:px-9 flex flex-col gap-6">
            </div>
        </form>
@endsection
