<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\SchoolYear;
use App\Http\Requests\school_year\SchoolYearAddRequest;
use Illuminate\Support\Facades\Log;

class SchoolYearController extends Controller
{
    private $semester;
    private $schoolYear;

    public function __construct(Semester $semester, SchoolYear $schoolYear){
        $this->semester = $semester;
        $this->schoolYear = $schoolYear;
    }

    public function index(){
        $schoolYears = $this->schoolYear->orderBy('school_year')->get();
        return view('school_year.index',compact('schoolYears'));
    }

    public function create() {
        return view('school_year.create');
    }

    public function store(SchoolYearAddRequest $request) {
        try{
            $startYear = $request->start_year;
            $endYear = $startYear + 1;
            $newSchoolYear = $startYear.'-'.$endYear;
            $checkSchoolYear = $this->schoolYear->where('school_year',$newSchoolYear)->first();
            if($checkSchoolYear === null){
                $this->schoolYear->create([
                    'school_year'=>$newSchoolYear
                ]);
                return redirect()->route('school-year.index')->with('message','Tạo năm học '.$newSchoolYear.' thành công');
            }
            else{
                return redirect()->route('school-year.index')->with('message','Năm học '.$newSchoolYear.' đã tồn tại');
            }
         }
         catch(\Exception $e){
             Log::error('Message:'.$e->getMessage());
         }
    }

    public function delete ($id) {
        try{
            $this->schoolYear->find($id)->delete();
            return redirect()->route('school-year.index');
        }
        catch(\Exception $e){
            Log::error('Message:'.$e->getMessage());
        }
    }

}
