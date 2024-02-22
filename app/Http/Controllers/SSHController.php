<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Ssh\Ssh;
use Symfony\Component\Process\Exception\ProcessFailedException;

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

    public function getStorageFileSizes(Request $request) {
        $process = Ssh::create(env('SFTP_USERNAME'), env('SFTP_HOST'), intval(env('SFTP_PORT')))
            ->disablePasswordAuthentication()
            ->execute("du -hs /var/innasto/files/");
        if ($process->isSuccessful()){
            return $process->getOutput();
        } else {
            throw new ProcessFailedException($process);
        }
    }

    public function createFtpUser(Request $request)
    {
        $createUser = Ssh::create(env('SFTP_USERNAME'), env('SFTP_HOST'), intval(env('SFTP_PORT')))
        ->disablePasswordAuthentication()
            ->execute([
                "sudo useradd -d /home/innaadm/innasto/ftpdata/{$request->id}/{$request->folder} -m {$request->ftpUserName}",
                "echo '{$request->ftpUserName}:{$request->password}' | sudo chpasswd"
            ]);
        if ($createUser->isSuccessful()) {
            return $createUser->getOutput();
        } else {
            throw new ProcessFailedException($createUser);
        }
    }

    public function createFtpUser2(Request $request)
    {
        $createUser = Ssh::create(env('FTP_USERNAME'), env('FTP_HOST'), intval(env('FTP_PORT')))
        ->disablePasswordAuthentication()
            ->execute([
                "sudo useradd -d /home/innaadm/innasto/ftpdata/{$request->id}/{$request->folder} -m {$request->ftpUserName}",
                "{$request->password}"
            ]);
        if ($createUser->isSuccessful()) {
            return $createUser->getOutput();
        } else {
            throw new ProcessFailedException($createUser);
        }
    }
}
