# Laravel Supervisor Dashboard

Inspired by [supervisorphp/monitor](https://github.com/supervisorphp/monitor)

- Display status of subprocesses in [Supervisor](http://supervisord.org/).
- Display queue length consumed by Supervisor subprocess.

## Install

Via composer

``` bash
$ composer create-project suren/laravel-supervisor-dashboard
```

## Usage

- Config your supervisor service. Add `[inet_http_server]` to supervisor config file, like  
```
port = 127.0.0.1:9001
username = user
password = 123
```
- Copy [config/supervisor.php.example](config/supervisor.php.example) to supervisor.php, change your Supervisor node configuration. 
- Config your web server, point to `path/to/your/project/public`
- Enjoy