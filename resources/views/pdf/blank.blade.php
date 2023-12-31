<?php


function asMoney($value)
{
    return number_format($value, 2);
}

?>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style type="text/css">

        table {
            max-width: 100%;
            background-color: transparent;
        }

        th {
            text-align: left;
        }

        .table {
            width: 100%;
            margin-bottom: 50px;
        }

        hr {
            margin-top: 1px;
            margin-bottom: 2px;
            border: 0;
            border-top: 2px dotted #eee;
        }

        .hr1 {
            display: block;
            height: 1px;
            width: 300px;
            border: 0;
            border-top: 1px solid #000;
            padding: 0;
        }

        .hr2 {
            display: block;
            height: 1px;
            width: 100px;
            margin-top: -100px;
            border: 0;
            border-top: 1px solid #000;
            padding: 0;
        }

        .hr3 {
            display: block;
            height: 1px;
            width: 100px;
            margin-top: -100px;
            border: 0;
            border-top: 1px solid #000;
            padding: 0;
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 12px;
            line-height: 1.428571429;
            color: #333;
            background-color: #fff;
        }


        @page {
            margin: 170px 30px;
        }

        .header {
            position: top;
            left: 0px;
            top: -150px;
            right: 0px;
            height: 150px;
            text-align: center;
        }

        .content {
            margin-top: -100px;
            margin-bottom: -150px
        }

        .footer {
            position: fixed;
            left: 0px;
            bottom: -180px;
            right: 0px;
            height: 50px;
        }

        .footer .page:after {
            content: counter(page, upper-roman);
        }


    </style>

</head>
<body>

<div class="header" style='margin-top:-150px;'>
    <table>
        <tr>

             <td style="width:150px">
                @if($organization->logo != NULL)
                    <img src="{{public_path().'/uploads/logo/'.$organization->logo}}" alt="logo"
                         style="height: 40px;">
                @endif


            </td>
           

            <td>
                <strong>
                    {{ strtoupper($organization->name)}}
                </strong>
                {{ $organization->phone}}<br>
                {{ $organization->email}}<br>
                {{ $organization->website}}<br>
                {{ $organization->address}}


            </td>


        </tr>


        <tr>

            <hr>
        </tr>


    </table>
</div>



</body>
</html>


