<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Storage;
use File;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use App\Models\Biorun;
use App\Models\FtpUser;

class UploaderController extends Controller
{
 /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function __construct()
 {
     $this->middleware('auth');
 }

 /**
  * Handles the file upload
  *
  * @param Request $request
  *
  * @return JsonResponse
  *
  * @throws UploadMissingFileException
  * @throws UploadFailedException
  */
 public function upload(Request $request) {  //from web route
   // create the file receiver
   $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

   // check if the upload is success, throw exception or return response you need
   if ($receiver->isUploaded() === false) {
     throw new UploadMissingFileException();
   }

   // receive the file
   $save = $receiver->receive();

   // check if the upload has finished (in chunk mode it will send smaller files)
   if ($save->isFinished()) {
     // save the file and return any response you need, current example uses `move` function. If you are
     // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
     return $this->saveFile($save->getFile(), $request);
   }

   // we are in chunk mode, lets send the current progress
   /** @var AbstractHandler $handler */
   $handler = $save->handler();

   return response()->json([
     "done" => $handler->getPercentageDone(),
     'status' => true
   ]);
 }

 /**
  * Saves the file
  *
  * @param UploadedFile $file
  *
  * @return JsonResponse
  */
  protected function saveFile(UploadedFile $file, Request $request) {
    $user_obj = auth()->user();
    // $fileName = $this->createFilename($file);
    $fileName = $file->getClientOriginalName();

    // Get file mime type
    $mime_original = $file->getMimeType();
    $mime = str_replace('/', '-', $mime_original);

    $fileSize = $file->getSize();

    $ftp_user = FtpUser::where("username", $request->mainFolder)->first();
    // move the file name
    // $file->move($finalPath, $fileName);
    try {
         $disk = Storage::build([
            'driver' => 'sftp',
            'host' => env('FTP_HOST'),
            'username' => "{$request->mainFolder}",
            'password' =>  "{$ftp_user->password}",
            'root'=> "/"
        ]);
        $filePath = $disk->put("/innasto/temp/{$request->mainFolder}/{$request->subFolder}/{$fileName}", file_get_contents($file));
    } catch (\Throwable $th) {
        throw $th;
    }
    // $biorun = new BioRun;
    // $biorun->bioexperiment_id = $request->bioexperiment_id;
    // $biorun->alias = $request->subFolder;
    // $biorun->filename = $fileName;
    // $biorun->filetype_id = $request->filetype;
    // $biorun->save();

    return response()->json([
     'path' => $filePath,
     'name' => $fileName,
     'mime_type' => $mime
    ]);
 }

 /**
  * Create unique filename for uploaded file
  * @param UploadedFile $file
  * @return string
  */
  protected function createFilename(UploadedFile $file) {
    $extension = $file->getClientOriginalExtension();
    $filename = str_replace(".".$extension, "", $file->getClientOriginalName()); // Filename without extension

    //delete timestamp from file name
    $temp_arr = explode('_', $filename);
    if ( isset($temp_arr[0]) ) unset($temp_arr[0]);
    $filename = implode('_', $temp_arr);

    //here you can manipulate with file name e.g. HASHED
    return $filename.".".$extension;
  }

 /**
  * Delete uploaded file WEB ROUTE
  * @param Request request
  * @return JsonResponse
  */
  public function delete (Request $request){

    if (isset($request->source) && $request->source == 'sftp') {
      // dd($request);
    //   Biorun::where([
    //     ['alias', $request->alias],
    //     ['filename',array_reverse(explode("/",$request->file))[0]]
    //   ])->delete();

    // move the file name
    // $file->move($finalPath, $fileName);
        $delete = false;

        $ftp_user = FtpUser::where("username", $request->accession)->first();
        try {
            $disk = Storage::build([
                'driver' => 'sftp',
                'host' => env('FTP_HOST'),
                'username' => "{$request->accession}",
                'password' =>  "{$ftp_user->password}",
                'root'=> "/"
            ]);
            $delete = $disk->delete($request->file);
        } catch (\Throwable $th) {
            throw $th;
        }
        if ($delete) {
            return back()->with('success', array_reverse(explode("/",$request->file))[0]. " Deleted Successfully");
        } else {
            return back()->with('error', 'Something went wrong, please try again later!');
        }
    } else {
        $user_obj = auth()->user();
        $file = $request->filename;
        $filePath = "public/{$request->mainFolder}/{$request->subFolder}/";
        //delete timestamp from filename
        $temp_arr = explode('_', $file);
        if ( isset($temp_arr[0]) ) unset($temp_arr[0]);
        $file = implode('_', $temp_arr);

        $dir = $request->date;

        $filePath = "public/upload/medialibrary/{$user_obj->id}/{$dir}/";
        $finalPath = storage_path("app/".$filePath);

        if ( unlink($finalPath.$file) ){
            return response()->json([
            'status' => 'ok'
            ], 200);
        }
        else{
            return response()->json([
            'status' => 'error'
            ], 403);
        }
        }
    }

    public function download(Request $request)
    {
        $ftp_user = FtpUser::where("username", $request->accession)->first();
        // move the file name
        // $file->move($finalPath, $fileName);
        $password = $ftp_user->password ?? null; 
        if ($password) {
             $diskConfig = [
                 'driver' => 'sftp',
                 'host' => env('FTP_HOST'),
                 'username' => "{$request->accession}",
                 'password' =>  $password,
                 'root'=> "/"
             ];
        } else {
            // If no password, attempt to use key-based authentication
            $diskConfig = [
                 'driver' => 'sftp',
                 'host' => env('FTP_HOST'),
                 'username' =>  env('FTP_USERNAME'),
                 'privateKey' => env('FTP_KEY'),
                 'root'=> "/"
             ];
        }
        try {
            $disk = Storage::build($diskConfig);
        } catch (\Throwable $th) {
            throw $th;
        }
        // return $disk->download($request->file);
        $file = $request->file;

        // Get file size and mime type without loading the file
        $mimeType = $disk->mimeType($file);
        $fileSize = $disk->size($file);
        $fileName = basename($file);

        // Stream the file directly to the response
        $stream = $disk->readStream($file);

        return response()->stream(
            function () use ($stream) {
                fpassthru($stream);
                if (is_resource($stream)) {
                    fclose($stream);
                }
            },
            200,
            [
                'Content-Type'              => $mimeType,
                'Content-Length'            => $fileSize,
                'Content-Disposition'       => 'attachment; filename="' . $fileName . '"',
                'X-Accel-Buffering'         => 'no',  // important for nginx
                'Cache-Control'             => 'no-cache',
            ]
        );
    }

}

