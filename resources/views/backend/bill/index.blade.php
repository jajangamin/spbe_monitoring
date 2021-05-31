@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h5>Your Bill</h5>
                <div class="ibox-tools">
                    {{-- <a class="btn btn-default btn-xs" type="button" href="{{ route('backend.bill.create') }}">
                        <i class="fa fa-plus"></i>
                        <strong>New</strong>
                    </a> --}}
                </div>

            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Customer Number</th>
                                <th>PDAM</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Created Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td><a href="{{ route('backend.customer.edit', $customer->id) }}" class="font-bold">
                                        {{ $customer->user->name }}
                                    </a></td>
                                    <td>{{ $customer->customer_number }}</td>
                                    <td>{{ $customer->pdam->name }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->description }}</td>
                                    <td>{{ $customer->created_at }}</td>
                                    <td>
                                        <a class=""
                                            href="#"
                                            onclick="
                                                event.preventDefault();
                                                document.getElementById('form-toggle-{{ $customer->id }}').submit();"
                                        >
                                            {!! ($customer->status == config('setting.status.active') ?
                                                    $SPAN_ACTIVE_START.$status[$customer->status].$SPAN_ACTIVE_END
                                                :
                                                    $SPAN_NOTACTIVE_START.$status[$customer->status].$SPAN_NOTACTIVE_END
                                                )
                                            !!}
                                        </a>

                                        <form id="form-toggle-{{ $customer->id }}"
                                            action="{{ route('backend.customer.toggle') }}"
                                            method="POST"
                                            style="display: none;"
                                        >
                                            @csrf
                                            <input type="hidden" name="customer" id="customer" value="{{ $customer->id }}">
                                            <input
                                                type="hidden"
                                                name="status"
                                                id="status"
                                                value="{{ ($customer->status == config('setting.status.active')) ? 0 : 1  }}"
                                            >
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('onpage-js')

    @include('backend.layouts.message')
    
    <script>
        $(document).ready(function () {
            
        });
    </script>

@endsection
