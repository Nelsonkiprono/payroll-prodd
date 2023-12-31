@extends('layouts.main_hr')
@section('xara_cbs')
    @include('partials.breadcrumbs')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Update Paye Rate</h3>

                            <hr>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">
                                                {{ $error }}<br>
                                            </div>
                                        @endforeach
                                    @endif
                                    <form method="POST" action="{{{ URL::to('paye/update/'.$prate->id) }}}"
                                          accept-charset="UTF-8">
                                        @csrf
                                        <fieldset>

                                            <div class="form-group">
                                                <label for="incomeFrom">Income From <span
                                                        style="color:red">*</span></label>
                                                <input class="form-control" placeholder="" type="text" name="i_from"
                                                       id="i_from"
                                                       value="{{ $prate->income_from}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="incomeTo">Income To <span style="color:red">*</span></label>
                                                <input class="form-control" placeholder="" type="text" name="i_to"
                                                       id="i_to"
                                                       value="{{ $prate->income_to}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="percentage">Percentage<span style="color:red">*</span></label>
                                                <input class="form-control" placeholder="" type="text" name="percentage"
                                                       id="percentage"
                                                       value="{{ $prate->percentage}}">
                                            </div>
                                            <div class="form-actions form-group">

                                                <button type="submit" class="btn btn-primary btn-sm">Update Paye Rate
                                                </button>
                                            </div>

                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
