<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Owner; //Eloquent
use Illuminate\Support\Facades\DB; //クエリビルダー
use Carbon\Carbon;


class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
	$this->middleware('auth:admin');
	//routesでもミドルウェアに認証をかけているようにコントローラー側にもつける。
     }


    public function index()
    {

       $date_now=Carbon::now();
       //現在時刻を表示
       $date_parse=Carbon::parse(now());
       //現在時刻を表示
       $date_parse2=Carbon::parse(now());
       //年のみ表示
       echo $date_now."<br>";
       echo $date_parse."<br>";
       echo $date_parse2->year."<br>";



        $e_all=Owner::all();
        //Eloquant
        $q_get=DB::table('owners')->select('name','created_at')->get();
        //クエリビルダー
       // $q_first=DB::table('owners')->select('name')->first();
         //クエリビルダー
        //$c_test=collect([
//             'name' => 'てすと'
//         ]);
        //dd($e_all,$q_get,$q_first,$c_test);
        return view('admin.owners.index',compact('e_all','q_get'));
        //compactの中身は$つけない
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
