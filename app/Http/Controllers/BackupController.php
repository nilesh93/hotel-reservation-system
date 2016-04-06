<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\BACKUP_LOG;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class BackupController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Backup Controller
    |--------------------------------------------------------------------------
    |
    |This controller provides features to backup/ restore the contents of the website
    |databases.
    |
    */



    /**
     * Constructor for the BackupController class. Checks if a user has sufficient permission
     * to access the Backup/ restore function.
     *
     */
    public function __construct()
    {
        // Check if User is Authenticated
        $this->middleware('auth', ['except' => []]);

        // Check if the authenticated user is an admin
        $this->middleware('isAdmin', ['except' => []]);
    }

    public function getView()
    {
        return view("Website.backup");
    }

    public function getBackupData()
    {
        $directory = "Backups";
        $files = Storage::files($directory);
        $json_array = array();

        foreach ($files as $file) {
            $temp_arr = array("path" => $file);
            array_push($json_array, $temp_arr);
        }

        return response()->json(['data' => $json_array]);
    }

    public function makeBackup()
    {
        $serial_num = BACKUP_LOG::max('serial_num');
        $newSerial_num = sprintf('%08d', $serial_num + 1);

        $currentSerialNum = BACKUP_LOG::find($serial_num);
        $currentSerialNum->serial_num = $newSerial_num;
        $currentSerialNum->save();

        shell_exec('mysqldump -u'.env('DB_USERNAME').' -p'.env('DB_PASSWORD').' '.env('DB_DATABASE').' > '.env('BACKUP_PATH').$newSerial_num."_user_backup_`date`".'.sql');

    }

    public function downloadBackup($serial_num)
    {
        // TODO: put this in the constants file
        $path = storage_path()."/app/Backups/";

        // Search for the required file. Returns matching files.
        $sqldump = File::glob($path.$serial_num.'_*.sql');

        if ($sqldump == false) {
            abort(404);
        }
        else {
            return response()->download($sqldump[0]);
        }
    }

    public function restoreView($serial_num)
    {
        return view('Website.restore', compact('serial_num'));
    }

    public function restoreDatabase(Request $request)
    {
        // TODO: put this in the constants file
        $path = storage_path()."/app/Backups/";
        $password = $request->password;
        $serial_num = sprintf('%08d', $request->serial_num);


        if (Hash::check($password,Auth::user()->password)) {

            // Search for the required file. Returns matching files.
            $sqldump = File::glob($path.$serial_num.'_*.sql');
            // Surround the expression with quotes for Shell execution
            $formattedString = escapeshellarg($sqldump[0]);

            if ($sqldump == false) {
                abort(404);
            }
            else {
                // TODO: Remove the comment and change the DB before deploying.
                // THIS LINE IS DANGEROUS. THEREFORE IT REMAINS COMMENTED DURING PRODUCTION.
                // AlSO THE DB THE FILE RESTORES IS DIFFERENT FROM THE PRODUCTION DB.
                shell_exec('mysql -u'.env('DB_USERNAME').' -p'.env('DB_PASSWORD').' TEST < '.$formattedString);

                return redirect('get_backup')->with('status', 'Database successfully restored.');
            }
        }
        else {
            return redirect('get_backup')->with('wrong_pass', 'Incorrect password! Database restore aborted.');
        }
    }
}
