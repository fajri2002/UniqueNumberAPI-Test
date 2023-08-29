<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UniqueNumberApiController extends Controller
{
    public function index(Request $request)
    {
        $inputNumber = $request->input('number', 0);
        
        $uniqueNumber = $this->findNextUniqueNumber($inputNumber);

        return response()->json(['output' => $uniqueNumber]);
    }

    private function findNextUniqueNumber($inputNumber)
    {
        $uniqueNumber = $inputNumber + 1;

        while (cache()->has('unique_number_' . $uniqueNumber)) {
            $uniqueNumber++;
        }

        cache()->forever('unique_number_' . $uniqueNumber, true);

        return $uniqueNumber;}
}
