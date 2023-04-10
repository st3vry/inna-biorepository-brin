<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Ssh\Ssh;

class SSHController extends Controller
{
    public function tesSSH(Request $request)
    {
        $process = Ssh::create('stevry', '192.168.248.18', 22)
            ->disablePasswordAuthentication()
            ->usePrivateKey('/home/stevrt/.ssh/id_rsa')
            ->execute("{$request->cmd} FTP/files/{$request->id}/{$request->folder}");
        if ($process->isSuccessful()){
            return $process->getOutput();
        } else {
            return "gagal";
        }
    }
}
