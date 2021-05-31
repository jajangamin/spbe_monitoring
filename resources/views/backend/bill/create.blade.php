@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h5>Create Customer Data</h5>
                <div class="ibox-tools">

                    {{-- <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a> --}}
                </div>

            </div>
            <div class="ibox-content">
                <form role="form" action="{{ route('backend.customer.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>PDAM</label>
                        <select class="form-control" name="pdam_id">
                            <option value="0" selected>Choose a PDAM</option>
                            @foreach ($pdams as $pdam)
                                <option value="{{ $pdam->id }}">{{ $pdam->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Customer Number</label>
                        <input type="text" name="customer_number" placeholder="Enter Customer Number" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address"
                            class="form-control"
                            style="resize:none;"
                            placeholder="Enter Address"
                            required
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description"
                            class="form-control"
                            style="resize:none;"
                            placeholder="Give any Description."
                            required
                        ></textarea>
                    </div>

                    <div>
                        <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="submit">
                            <strong>SUBMIT</strong>
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