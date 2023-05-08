<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Ssh\Ssh;

class SSHController extends Controller
{
    public function tesSSH(Request $request)
    {
        
        $process = Ssh::create(env('SFTP_USERNAME'), env('SFTP_HOST'), intval(env('SFTP_PORT')))
            ->disablePasswordAuthentication()
            ->usePrivateKey(env('SFTP_KEY'))
            ->execute("{$request->cmd} /var/innasto/files/{$request->id}/{$request->folder}/{$request->fileName}");
        if ($process->isSuccessful()){
            return $process->getOutput();
        } else {
            return "gagal";
        }
    }
}
