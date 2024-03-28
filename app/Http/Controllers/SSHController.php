<?php

namespace App\Http\Controllers;

use App\Models\Bioarchive;
use App\Models\FtpUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Ssh\Ssh;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Str;

class SSHController extends Controller
{
    public function tesSSH(Request $request)
    {

        $process = Ssh::create(env('SFTP_USERNAME'), env('SFTP_HOST'), intval(env('SFTP_PORT')))
            ->disablePasswordAuthentication()
            ->usePrivateKey(env('SFTP_KEY'))
            ->execute("{$request->cmd} /var/innasto/files/{$request->id}/{$request->folder}/{$request->fileName}");
        if ($process->isSuccessful()) {
            return $process->getOutput();
        } else {
            return "gagal";
        }
    }

    public function getStorageFileSizes(Request $request)
    {
        $process = Ssh::create(env('SFTP_USERNAME'), env('SFTP_HOST'), intval(env('SFTP_PORT')))
            ->disablePasswordAuthentication()
            ->execute("du -hs /var/innasto/files/");
        if ($process->isSuccessful()) {
            return $process->getOutput();
        } else {
            throw new ProcessFailedException($process);
        }
    }

    public function createFtpUser($accession)
    {
        // cara panggil dari controller lain:
        // $SSHController = new SSHController();
        // $password = $SSHController->createFtpUser($accession); // $accession number atau yang akan digunakan sebagai username
        // $password adalah return 8 karakter password yang bisa di simpan di database
        // bisa juga pakai try/catch untuk handle kalau error


        $password = Str::random(8, true, true, true, false);
        $psw = crypt($password, "password");
        $createUser = Ssh::create(env('FTP_USERNAME'), env('FTP_HOST'), intval(env('FTP_PORT')))
            ->disablePasswordAuthentication()
            ->usePrivateKey(env('SFTP_KEY'))
            ->execute([
                "sudo useradd --password {$psw} --home /innasto/ftpdata/{$accession} {$accession}"
            ]);
        if ($createUser->isSuccessful()) {
            // storing data ftp user to database
            return $password;
        } else {
            throw new ProcessFailedException($createUser);
        }
    }
}
