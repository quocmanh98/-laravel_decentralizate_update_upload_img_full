<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;


class AdminController extends Controller
{

    public function __construct()
    {
        // $this->middleware('CheckAge');
        // $this->middleware('CheckAge')->only('index','show');
        // $this->middleware('CheckAge')->except('index');
    }

    public function index()
    {
        return view('demo.admin.index');
    }

    public function show()
    {
        return view('demo.admin.show');
    }

    public function add()
    {
        return view('demo.admin.add');
    }

    public function upload()
    {
        return view('demo.form.index');
    }

    public function showUpload()
    {
        $student = Student::all();
        return view('demo.form.show', compact('student'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|max:100|min:5',
                'content' => 'required'
            ],
            [
                'required' => 'Trường :attribute không được để trống',
                'min' => 'Trường :attribute có độ dài ít nhất :min ký tự',
                'max' => 'Trường :attribute có độ dài tối đa :max ký tự'
            ],
            [
                'title' => 'tiêu đề',
                'content' => 'nội dung'
            ]
        );

        $input = $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file;

            // Lấy tên file
            $filename = $file->getClientOriginalName();
            // Lấy đuôi file
            $file->getClientOriginalExtension();
            // Lấy kích thước file
            $file->getSize();

            $file->move('public/uploads/demo', $file->getClientOriginalName());
            $thumbnail = 'public/uploads/demo/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }

        Student::create($input);
        return redirect()->route('form.show');
    }

    public function showMultiple()
    {
        $student = Student::all();
        return view('demo.multiple.show',compact('student'));
    }

    public function multipleStore(Request $request)
    {
        // var_dump($_FILES);
        // return $postData = $request->only('file');
        // $request->validate(
        //     [
        //         'file' => 'required|mimes:jpeg,png,jpg,gif,svg'
        //     ]
        // );
        $file = $request->file;
        foreach ($file as $multi_img) {
            $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(1000,1000)->save("public/uploads/demo/".$name_gen);

            $last_img = "public/uploads/demo/".$name_gen;

            Student::insert(
                [
                    'thumbnail' =>  $last_img,
                    'created_at' => Carbon::now()
                ]
            );
        }
        return redirect()->route('form.show.multiple');
    }

    public function uploadMultiple()
    {
        return view('demo.multiple.index');
    }
}
