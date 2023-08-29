<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UniqueNumberController extends Controller
{
    public function index(Request $request)
    {
        $inputNumber = (int) $request->input('input_number', 0);
        
        $uniqueNumber = $this->findNextUniqueNumber($inputNumber);

        return response()->json(['output' => $uniqueNumber]);
    }

    private function findNextUniqueNumber($inputNumber)
    {
        $uniqueNumber = $inputNumber;

        while (cache()->has('unique_number_' . $uniqueNumber)) {
            $uniqueNumber++;
        }

        cache()->forever('unique_number_' . $uniqueNumber, true);

        return $uniqueNumber;}
}
