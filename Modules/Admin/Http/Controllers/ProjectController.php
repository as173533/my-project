<?php

namespace Modules\Admin\Http\Controllers;

use Datatables;
use App\Model\Project;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use URL;
use Validator;

class ProjectController extends AdminController {

    //*** JSON Request
    public function datatables() {
        $datas = Project::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('image', function(Project $data) {
                            $image = $data->image ? URL::asset('public/uploads/project/' . $data->image) : URL::asset('public/backend/no-image.png');
                            return '<img src="' . $image . '" alt="Image" height="60" width="60">';
                        })
                        ->editColumn('link', function(Project $data) {
                            return '<a href="'.$data->link . '" target="_blank">'.$data->link.'</a>';
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("admin-project-edit", $model->id) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteProject(this);" data-href="' . Route("admin-project-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['image','link', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::project.list');
    }

    //*** GET Request
    public function create() {
        $cats = Category::all();
        return view('admin::project.add', compact('cats'));
    }

    //*** POST Request
    public function store(Request $request) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'category_id' => 'required',
                    'name' => 'required',
                    'short_description' => 'required',
                    'link' => 'required',
                    'description' => 'required',
                    'status' => 'required',
                    'image' => 'required|mimes:jpeg,jpg,png,svg',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {

            //--- Validation Section Ends
            //--- Logic Section
            $data = new Project();
            $input = $request->all();
            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/project');
                $file->move($destinationPath, $name);
                $input['image'] = $name;
            }
            
            $data->fill($input)->save();
            //--- Logic Section Ends
            //--- Redirect Section        
            return redirect()->route('admin-project-index')->with('success_msg', 'Project Created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id) {
        $cats = Category::all();
        $data = Project::findOrFail($id);
        return view('admin::project.edit', compact('data', 'cats'));
    }

    //*** POST Request
    public function update(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'category_id' => 'required',
                    'name' => 'required',
                    'short_description' => 'required',
                    'link' => 'required',
                    'description' => 'required',
                    'status' => 'required',
                    'image' => 'nullable|mimes:jpeg,jpg,png,svg',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Validation Section Ends
            //--- Logic Section
            $data = Project::findOrFail($id);
            $input = $request->all();
            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/project');
                $file->move($destinationPath, $name);
                if ($data->image != null) {
                    if (file_exists(public_path('uploads/project' . $data->image))) {
                        unlink(public_path('uploads/project' . $data->image));
                    }
                }
                $input['image'] = $name;
            }
            

            $data->update($input);
            //--- Logic Section Ends
            //--- Redirect Section     
            return redirect()->route('admin-project-index')->with('success_msg', 'Project Updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = Project::findOrFail($id);
        //If Photo Doesn't Exist
        if ($model->image == null) {
            $model->delete();
            //--- Redirect Section     
            $data['status'] = 200;
            $data['msg'] = 'Data Deleted Successfully.';
            return response()->json($data);
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (isset($model->image))
            if (file_exists(public_path('uploads/project' . $model->image))) {
                unlink(public_path('uploads/project' . $model->image));
            }
        $model->delete();
        //--- Redirect Section     
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends     
    }

}
