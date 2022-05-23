<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class NotesController extends Controller
{

    public function NotesSelectModule(Type $var = null)
    {
        $Modules = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.ModuleName', 'C.CourseName', 'M.id')
            ->get();

        $data = [

            "Page" => "Documents.SelectModule",
            "Title" => "Select course module to attach document notes to",
            "Desc" => "document notes Settings",
            "Modules" => $Modules,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),

        ];

        return view('scrn', $data);
    }

    public function AcceptNotesModuleSelection(Request $request)
    {

        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtCourseNotes', ['id' => $id]);
    }

    public function MgtCourseNotes($id)
    {
        $CourseDetails = DB::table('modules AS M')
            ->where('M.id', $id)
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.ModuleName', 'C.CourseName', 'M.id', 'C.CID', 'M.MID')
            ->first();

        $Notes = DB::table('modules AS M')
            ->where('M.id', $id)
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->join('document_notes AS D', 'D.MID', 'M.MID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->select('M.ModuleName', 'C.CourseName', 'D.*', 'I.Name')
            ->get();

        $rem = [

            "id",
            "created_at",
            "updated_at",
            "uuid",
            "CID",
            "MID",
            "IID",
            "url",

        ];

        $FormEngine = new FormEngine;

        $data = [

            "Page" => "Documents.MgtNotes",
            "Title" => "Manage  Modular Document Notes ",
            "Desc" => 'Documents Notes Settings',
            "Notes" => $Notes,
            "CourseName" => $CourseDetails->CourseName,
            "ModuleName" => $CourseDetails->ModuleName,
            "CID" => $CourseDetails->CID,
            "MID" => $CourseDetails->MID,
            "rem" => $rem,
            "Form" => $FormEngine->Form('document_notes'),

        ];

        return view('scrn', $data);

    }

    public function NewDoc(Request $request)
    {
        $request->validate([

            '*' => 'required',
            'url' => 'required|mimes:pdf,mp4|max:300048',

        ]);

        $fileName = time() . '.' . $request->url->extension();

        $request->url->move(public_path('assets/data'), $fileName);

        DB::table($request->TableName)->insert(
            $request->except([
                '_token',
                'TableName',
                'id',
                'files',
            ])
        );

        DB::table($request->TableName)->where('uuid', $request->uuid)->update([

            'url' => $fileName,
        ]);

        return redirect()->back()->with('status', 'The record was created successfully');
    }

    public function DeleteDoc($id, $TableName)
    {
        $del = DB::table($TableName)->where('id', $id)->first();

        unlink(public_path('assets/data/' . $del->url));

        DB::table($TableName)->where('id', $id)->delete();

        return redirect()->back()->with('status', 'The record was deleted successfully');
    }

    public function VideoSelectModule(Type $var = null)
    {
        $Modules = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.ModuleName', 'C.CourseName', 'M.id')
            ->get();

        $data = [

            "Page" => "Videos.SelectModule",
            "Title" => "Select course module to attach video notes to",
            "Desc" => "video notes Settings",
            "Modules" => $Modules,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),

        ];

        return view('scrn', $data);
    }

    public function AcceptVideoModuleSelection(Request $request)
    {

        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtVideNotes', ['id' => $id]);
    }

    public function MgtVideNotes($id)
    {
        $CourseDetails = DB::table('modules AS M')
            ->where('M.id', $id)
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.ModuleName', 'C.CourseName', 'M.id', 'C.CID', 'M.MID')
            ->first();

        $Notes = DB::table('modules AS M')
            ->where('M.id', $id)
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->join('video_notes AS D', 'D.MID', 'M.MID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->select('M.ModuleName', 'C.CourseName', 'D.*', 'I.Name')
            ->get();

        $rem = [

            "id",
            "created_at",
            "updated_at",
            "uuid",
            "CID",
            "MID",
            "IID",
            "url",

        ];

        $FormEngine = new FormEngine;

        $data = [

            "Page" => "Videos.MgtVideos",
            "Title" => "Manage Modular Video Notes ",
            "Desc" => 'Video Notes Settings',
            "Notes" => $Notes,
            "CourseName" => $CourseDetails->CourseName,
            "ModuleName" => $CourseDetails->ModuleName,
            "CID" => $CourseDetails->CID,
            "MID" => $CourseDetails->MID,
            "rem" => $rem,
            "Form" => $FormEngine->Form('video_notes'),

        ];

        return view('scrn', $data);

    }

}