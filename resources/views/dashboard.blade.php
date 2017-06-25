<?php
$stateMapping = [
    'STOPPED'  => 'danger',
    'STOPPING' => 'danger',
    'EXITED'   => 'danger',
    'FATAL'    => 'danger',
    'UNKNOWN'  => 'danger',
    'STARTING' => 'success',
    'RUNNING'  => 'success',
    'BACKOFF'  => 'warning',
];
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Supervisor Dashboard</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 70px;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Laravel Supervisor Monitor</a>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                @foreach ($groups as list($groupName, $supervisor))
                    <?php
                    $processes = $supervisor->getAllProcessInfo();
                    ?>
                    <div class="panel-heading">
                        <strong>{{ $groupName }}</strong> | {{ count($processes) }} process
                    </div>
                    <table class="table table-striped table-bordered">
                        @foreach ($processes as $process)
                            <tr>
                                <td>{{ $process['name'] }}</td>
                                <td>
                                    <span class="label label-{{ $stateMapping[$process['statename']] }}">{{ $process['statename'] }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>
