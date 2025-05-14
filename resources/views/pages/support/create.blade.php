{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Support
@endsection

{{-- Page name --}}
@section('page-name')
    Support
@endsection

{{-- Page content --}}
@section('page-content')
    <!-- Add transaction category form -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="w-100 d-flex justify-content-between align-items-center">
            {{-- Page Title --}}
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dasboard /</span> Support</h4>
        </div>


        <div class="row">

            <div class="col-xxl">
                <div class="card mb-4">

                    <div class="card-body">
                        <form method="POST" action="{{ route('support.send') }}">
                            @csrf

                            {{-- Subject --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Subject</label>

                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-pencil"></i></span>
                                        <input type="text" name="subject" class="form-control" placeholder="Subject"
                                            id="basic-icon-default-fullname" aria-describedby="basic-icon-default-fullname2" />
                                    </div>
                                    
                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'subject'"></x-input-error>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-message">Description</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bx bx-comment"></i></span>
                                        <textarea name="description" id="basic-icon-default-message" class="form-control" placeholder="Description..." aria-describedby="basic-icon-default-message2" rows="2"></textarea>
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'description'"></x-input-error>
                                </div>
                            </div>

                            {{-- Submit button --}}
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Table with Header - Footer -->
@endsection