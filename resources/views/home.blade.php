@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div id="flash-message" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    @foreach (['danger', 'warning', 'success', 'info'] as $message)
                        @if(session()->has($message))
                            <div id="flash-message" class="alert alert-{{ $message }}" role="alert">
                                @foreach(Session::get('success') as $msg)
                                    {{$msg}}</br>
                                @endforeach    
                            </div>
                        @endif
                    @endforeach
                </div> 
                <div class="row ms-4">
                    <p><b>Number of referrals Completed :</b> {{ $referral_count }}</p>
                </div>
                <div id="example"> </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Referral</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($referral_data as $data)
                         @php
                            if($data->status == 1){$data->status = "Invitation sent";}
                            elseif($data->status == 2){$data->status = "User Registered";}
                         @endphp
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$data->referral_email}}</td>
                            <td>{{$data->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
