@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h3>Edit data Customer of <span class="text-info">{{ $detail->user->name }}</span></h3>
                <div class="ibox-tools">

                </div>

            </div>
            <div class="ibox-content">
                <form role="form" action="{{ route('backend.customer.update', $detail->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>PDAM</label>
                        <select class="form-control" name="pdam_id">
                            <option value="0" selected>Choose a PDAM</option>
                            @foreach ($pdams as $pdam)
                                @if($detail->pdam_id == $pdam->id)
                                    <option selected value="{{ $pdam->id }}">{{ $pdam->name }}</option>
                                @else
                                    <option value="{{ $pdam->id }}">{{ $pdam->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Customer Number</label>
                        <input type="text" name="customer_number" placeholder="Enter Customer Number" class="form-control" required value="{{ $detail->customer_number }}">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address"
                            class="form-control"
                            style="resize:none;"
                            placeholder="Enter Address"
                            required
                        >{{ $detail->address }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description"
                            class="form-control"
                            style="resize:none;"
                            placeholder="Give any Description."
                            required
                        >{{ $detail->description }}</textarea>
                    </div>

                    <div>
                        <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="submit">
                            <strong>UPDATE</strong>
                        </button>
                    </div>

                </form>
                <div class="clearfix"></div>
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