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
        $groups = [];
        foreach (config('supervisor') as list($groupName, $url, $username, $password)) {
            $transport = new StreamSocketTransport();
            $transport->setHeader(
                'Authorization',
                'Basic ' . base64_encode(sprintf('%s:%s', $username, $password))
            );

            $client = new Client($url, $transport);
            $connector = new XmlRpc($client);
            $supervisor = new Supervisor($connector);
            $groups[] = [
                $groupName,
                $supervisor,
            ];
        }

        return view('dashboard', [
            'groups' => $groups,
        ]);
    }
}
