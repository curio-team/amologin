<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadCsvRequest;
use Excel;
use App\Models\User;
use App\Models\Group;
use Carbon\Carbon;

class ImportController extends Controller
{
    public $duplicates = 0;

    public $updated = 0;

    public $imports = 0;

    public function show()
    {
        // Version 3+ of Laravel Excel is not compatible with the below code from 2.x
        throw new \Exception("This method is not implemented");
        return view('users.import');
    }

    public function upload(UploadCsvRequest $request)
    {
        // $file = $request->file('csv');

        // Excel::load($file, function ($reader) {

        //     $working_date = Carbon::now();
        //     if (request('fake_date')) {
        //         $working_date = new Carbon(request('fake_date'));
        //     }

        //     $results = $reader->select(['userid', 'loginid', 'achternaam', 'tussen', 'voornaam', 'grep_groepscode', 'afdeling', 'logincode'])->get();

        //     foreach ($results as $result) {

        //         if ($result->afdeling == 'ICO RC') {
        //             $id = $result->logincode;
        //             $user = User::find($id);
        //             if ($user == null) {
        //                 $naam = $result->voornaam;
        //                 if (!empty($result->tussen)) {
        //                     $naam .= ' ' . $result->tussen;
        //                 }
        //                 $naam .= ' ' . $result->achternaam;

        //                 $user = new User;
        //                 $user->id = $id;
        //                 $user->name = $this->stripAccents($naam) . "\n";
        //                 $user->email = $id . '@edu.rocwb.nl';
        //                 $user->type = 'student';
        //                 $user->password = bcrypt(bin2hex(random_bytes(10)));
        //                 $user->save();

        //                 $group = Group::findOnlyCurrent($result->grep_groepscode, $working_date);
        //                 if ($group != null) {
        //                     $user->groups()->attach($group);
        //                 }

        //                 $this->imports++;
        //             } else {
        //                 $group = Group::findOnlyCurrent($result->grep_groepscode, $working_date);
        //                 if ($group != null) {
        //                     $result = $user->groups()->syncWithoutDetaching($group);
        //                     if (count($result['attached']) || count($result['detached']) || count($result['updated'])) {
        //                         $this->updated++;
        //                     }
        //                 }

        //                 $this->duplicates++;
        //             }
        //         }
        //     }
        // });

        // return redirect('/users')->with('notice', 'Import successful: ' . $this->imports . ' added, ' . $this->duplicates . ' duplicates were found, of which ' . $this->updated . ' have been updated');
    }

    public static function stripAccents($string)
    {
        $unwanted = [
            'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
            'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y'
        ];

        return strtr($string, $unwanted);
    }
}
