<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    //
    // protected $section;
    // public function __construct(SectionRepository $sections)
    //    {
    //       $this->section=$sections;
    //    }
    
  

    public function index()
    {
        //return $this->section->index();
        $sections=Section::all();
        return view("dashboard.sections.index",compact("sections"));

    }

     public function show()
    {
        
    }

     public function create(Request $request)
    {
        
    }

     public function store(Request $request)
    {
         $section=$request->validate([
            'name'=>"required|string",
            'des'=>"required|string"
         ]);
         $section=Section::create($section);
       
         return redirect()->route('section.index')->with('add',"Section created suc");
        
    }

     public function edit()
    {
        
    }

     public function update(Request $request,$id)
    {
         $section=Section::find($id);
         $sections=$request->validate([
            'name'=>"required|string",
             'des'=>"required|string"
         ]);
         $section->update($sections);
         return redirect()->route('section.index')->with('update',"Section updated suc");

        
    }

     public function destroy($id)
    {
        $section=Section::find($id);
        $section->delete();
        return redirect()->route('section.index')->with('delete',"Section deleted suc");

        
    }
}
