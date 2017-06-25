<?php

namespace App\Http\Controllers;

use fXmlRpc\Client;
use fXmlRpc\Transport\StreamSocketTransport;
use Supervisor\Connector\XmlRpc;
use Supervisor\Supervisor;

class SupervisorController extends Controller
{
    public function dashboard()
    {

        $queueManager = app('queue');

        $nodes = [];
        foreach (config('supervisor') as list($node, $url, $username, $password)) {
            $transport = new StreamSocketTransport();
            $transport->setHeader(
                'Authorization',
                'Basic ' . base64_encode(sprintf('%s:%s', $username, $password))
            );

            $client = new Client($url, $transport);
            $connector = new XmlRpc($client);
            $supervisor = new Supervisor($connector);
            $processes = $supervisor->getAllProcessInfo();

            $groups = [];
            foreach ($processes as $process) {
                $group = $process['group'];
                $statename = $process['statename'];
                $groups[$group]['count'] = ($groups[$group]['count'] ?? 0) + 1;
                $groups[$group]['statCount'][$statename] = ($groups[$group]['stat'][$statename] ?? 0) + 1;
            }

            foreach (array_keys($groups) as $group) {
                $queueSize = 0;
                if (preg_match('/^laravel-queue-(.+)$/', $group, $match)) {
                    $queueSize = $queueManager->size($match[1]);
                }

                $groups[$group]['queueSize'] = $queueSize;
            }

            $nodes[] = [
                $node,
                $groups,
            ];
        }

        return view('dashboard', [
            'nodes' => $nodes,
        ]);
    }
}
