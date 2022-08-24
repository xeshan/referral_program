@php
    use App\Http\Controllers\HomeController;
@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('') }}
                </div>
                 <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">referrer</th>
                            <th scope="col">email referred</th>
                            <th scope="col">date</th>
                            <th scope="col">status</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($detail_data as $data)
                         @php
                            if($data->status == 1){$data->status = "Invitation sent";}
                            elseif($data->status == 2){$data->status = "User Registered";}
                         @endphp
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ HomeController::UserName($data->user_id) }}</td>
                            <td>{{ $data->referral_email }}</td>
                            <td>{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                            <td>{{ $data->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
