@extends('layouts.main_hr')
<?php

function asMoney($value)
{
    return number_format($value, 2);
}

?>

@section('xara_cbs')
    <link href="{{asset('jquery-ui-1.11.4.custom/jquery-ui.css')}}" rel="stylesheet">

    <style>
        label, input {
            display: block;
        }

        input.text {
            margin-bottom: 12px;
            width: 95%;
            padding: .4em;
        }

        fieldset {
            padding: 0;
            border: 0;
            margin-top: 25px;
        }

        h1 {
            font-size: 1.2em;
            margin: .6em 0;
        }

        div#users-contain {
            width: 350px;
            margin: 20px 0;
        }

        div#users-contain table {
            margin: 1em 0;
            border-collapse: collapse;
            width: 100%;
        }

        div#users-contain table td, div#users-contain table th {
            border: 1px solid #eee;
            padding: .6em 10px;
            text-align: left;
        }

        .ui-dialog .ui-state-error {
            padding: .3em;
        }

        .validateTips {
            border: 1px solid transparent;
            padding: 0.3em;
        }

        .ui-dialog {
            position: fixed;
            margin-bottom: 950px;
        }


        .ui-dialog-titlebar-close {
            background: url("{{ URL::asset('jquery-ui-1.11.4.custom/images/ui-icons_888888_256x240.png'); }}") repeat scroll -93px -128px rgba(0, 0, 0, 0);
            border: medium none;
        }

        .ui-dialog-titlebar-close:hover {
            background: url("{{ URL::asset('jquery-ui-1.11.4.custom/images/ui-icons_222222_256x240.png'); }}") repeat scroll -93px -128px rgba(0, 0, 0, 0);
        }

    </style>
    @include('partials.breadcrumbs')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Update Employee Earning</h3>

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


                                    <div id="dialog-form" title="Create new earning type">
                                        <p class="validateTips">Please insert Earning Type.</p>

                                        <form>
                                            <fieldset>
                                                <label for="name">Name <span style="color:red">*</span></label>
                                                <input type="text" name="name" id="name" value=""
                                                       class="text ui-widget-content ui-corner-all">

                                                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                                                <input type="submit" tabindex="-1"
                                                       style="position:absolute; top:-1000px">
                                            </fieldset>
                                        </form>
                                    </div>

                                    <form method="POST" action="{{{ url('other_earnings/update/'.$earning->id) }}}"
                                          accept-charset="UTF-8">
                                        @csrf
                                        <fieldset>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="username">Employee</label>
                                                    <input class="form-control" placeholder="" type="text" readonly
                                                           name="employee"
                                                           id="employee"
                                                           value="{{ $earning->first_name.' '.$earning->last_name }}">
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <label for="username">Earning Type <span
                                                        style="color:red">*</span></label>
                                                <select name="earning" id="earning" class="form-control">
                                                    <option></option>
                                                    <option value="cnew">Create New</option>
                                                    @foreach($earningsettings as $earningsetting)
                                                        <option
                                                            value="{{ $earningsetting->id }}"<?= ($earning->earning_id == $earningsetting->id) ? 'selected="selected"' : ''; ?>> {{ $earningsetting->earning_name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label for="username">Narrative <span style="color:red">*</span></label>
                                                <input class="form-control" placeholder="" type="text" name="narrative"
                                                       id="narrative"
                                                       value="{{ $earning->narrative}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="username">Formular <span style="color:red">*</span></label>
                                                <select name="formular" id="formular" class="form-control forml">
                                                    <option></option>
                                                    <option
                                                        value="One Time"<?= ($earning->formular == 'One Time') ? 'selected="selected"' : ''; ?>>
                                                        One Time
                                                    </option>
                                                    <option
                                                        value="Recurring"<?= ($earning->formular == 'Recurring') ? 'selected="selected"' : ''; ?>>
                                                        Recurring
                                                    </option>
                                                    <option id="instals"
                                                            value="Instalments"<?= ($earning->formular == 'Instalments') ? 'selected="selected"' : ''; ?>>
                                                        Instalments
                                                    </option>
                                                </select>

                                            </div>

                                            <div class="form-group" id="insts">
                                                <label for="username">Instalments </label>
                                                <input class="form-control" placeholder="" onkeypress="totalB()"
                                                       onkeyup="totalB()" type="text"
                                                       name="instalments" id="instalments"
                                                       value="{{ $earning->instalments}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="username">Amount <span style="color:red">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">{{$currency->shortname}}</span>
                                                    <input class="form-control" placeholder=""
                                                           onkeypress="totalBalance()"
                                                           onkeyup="totalBalance()" type="text" name="amount"
                                                           id="amount"
                                                           value="{{ asMoney($earning->earnings_amount)}}">
                                                </div>
                                            </div>

                                            <div class="form-group bal_amt" id="bal">
                                                <label for="username">Total </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">{{$currency->shortname}}</span>
                                                    <input class="form-control" placeholder="" readonly="readonly"
                                                           type="text" name="balance"
                                                           id="balance"
                                                           value="{{ asMoney((double)$earning->earnings_amount * (double)$earning->instalments)}}">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="username">Earning Date <span
                                                        style="color:red">*</span></label>
                                                <div class="right-inner-addon ">
                                                    <i class="glyphicon glyphicon-calendar"></i>
                                                    <input class="form-control earningdate" readonly="readonly"
                                                           placeholder="" type="text"
                                                           name="ddate" id="ddate" value="{{ $earning->earning_date }}">
                                                </div>
                                            </div>
                                            <div class="form-actions form-group">

                                                <button type="submit" class="btn btn-primary btn-sm">Update Employee
                                                    Earning
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
    <script src="{{asset('media/jquery-1.8.0.min.js')}}"></script>
    <script src="{{asset('jquery-ui-1.11.4.custom/jquery-ui.js')}}"></script>
    <script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript">
        console.log(document.getElementById("instalments").value * document.getElementById("amount").value.replace(/,/g, ''));

        function totalBalance() {
            var instals = document.getElementById("instalments").value;
            var amt = document.getElementById("amount").value.replace(/,/g, '');
            var total = instals * amt * 10;

            total = total.toLocaleString('en-US', {minimumFractionDigits: 2});
            document.getElementById("balance").value = total;

        }

        function totalB() {
            var instals = document.getElementById("instalments").value;
            var amt = document.getElementById("amount").value.replace(/,/g, '');
            var total = instals * amt;
            total = total.toLocaleString('en-US', {minimumFractionDigits: 2});
            document.getElementById("balance").value = total;

        }

    </script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#formular option#instals').each(function () {
                if (this.selected) {
                    $('#insts').show();
                    $('#bal').show();
                } else {
                    $('#insts').hide();
                    $('#bal').hide();
                }
            });

            $('#formular').change(function () {
                if ($(this).val() == "Instalments") {
                    $('#insts').show();
                    $('#bal').show();
                } else {
                    $('#insts').hide();
                    $('#bal').hide();
                }
            });


        });
    </script>
    <script type="text/javascript">
        $(function () {

            $('.earningdate').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '-60y',
                autoclose: true
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#amount').Intl.NumberFormat('en-Ke', {
                style: 'currency',
                currency: 'KES'
            }).format();
        });
    </script>
    <script>
        $(function () {
            var dialog, form,

                // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
                name = $("#name"),

                allFields = $([]).add(name),
                tips = $(".validateTips");

            function updateTips(t) {
                tips
                    .text(t)
                    .addClass("ui-state-highlight");
                setTimeout(function () {
                    tips.removeClass("ui-state-highlight", 1500);
                }, 500);
            }

            function checkLength(o) {
                if (o.val().length == 0) {
                    o.addClass("ui-state-error");
                    updateTips("Please insert earning type!");
                    return false;
                } else {
                    return true;
                }
            }

            function checkRegexp(o, regexp, n) {
                if (!(regexp.test(o.val()))) {
                    o.addClass("ui-state-error");
                    updateTips(n);
                    return false;
                } else {
                    return true;
                }
            }

            function addUser() {
                var valid = true;
                allFields.removeClass("ui-state-error");

                valid = valid && checkLength(name);

                valid = valid && checkRegexp(name, /^[a-z]([0-9a-z_\s])+$/i, "Please insert a valid name for earning type.");

                if (valid) {

                    /* displaydata();

                    function displaydata(){
                     $.ajax({
                                    url     : "{{URL::to('reloaddata')}}",
                      type    : "POST",
                      async   : false,
                      data    : { },
                      success : function(s){
                        var data = JSON.parse(s)
                        //alert(data.id);
                      }
       });
       }*/

                    $.ajax({
                        url: "{{URL::to('createEarning')}}",
                        type: "POST",
                        async: false,
                        data: {
                            'name': name.val()
                        },
                        success: function (s) {

                            $('#earning').append($('<option>', {
                                value: s,
                                text: name.val(),
                                selected: true
                            }));

                        }
                    });

                    dialog.dialog("close");
                }
                return valid;
            }

            dialog = $("#dialog-form").dialog({
                autoOpen: false,
                height: 250,
                width: 350,
                modal: true,
                buttons: {
                    "Create": addUser,
                    Cancel: function () {
                        dialog.dialog("close");
                    }
                },
                close: function () {
                    form[0].reset();
                    allFields.removeClass("ui-state-error");
                }
            });

            form = dialog.find("form").on("submit", function (event) {
                event.preventDefault();
                addUser();
            });

            $('#earning').change(function () {
                if ($(this).val() == "cnew") {
                    dialog.dialog("open");
                }

            });
        });
    </script>
@stop
