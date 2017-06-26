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

    <style>
        td {
            width: 33%;
            word-break: break-all;
        }
    </style>
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
            @foreach ($nodes as list($node, $groups))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>{{ $node }}</strong> | {{ count($groups) }} groups
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Group</th>
                            <th>Status</th>
                            <th>Queue size</th>
                        </thead>
                        <tbody>
                        @foreach ($groups as $group => $detail)
                            <?php
                            extract($detail);
                            ?>
                            <tr>
                                <td>{{ $group }}</td>
                                <td>
                                    @foreach ($statCount as $stat => $c)
                                        <span class="label label-{{ $stateMapping[$stat] ?? 'info' }}">{{ $c }} {{ $stat }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $queueSize }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
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
