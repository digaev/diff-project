<?php

namespace App\Http\Controllers;

use App\TextDiffer;
use Illuminate\Http\Request;

class DiffController extends Controller
{
    public function diff(Request $request)
    {
        $this->validate($request, [
           'text1' => 'required',
           'text2' => 'required',
        ]);

        $differ = new TextDiffer();
        $difference = $differ->compare($request->input('text1'), $request->input('text2'));

        if ($request->ajax()) {
            return response()->json($difference);
        }

        // Do nothing...
        return redirect('/');
    }
}
