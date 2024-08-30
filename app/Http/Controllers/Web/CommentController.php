<?php

use Illuminate\Support\Facades\DB;
    namespace App\Http\Controllers\Web;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    use DB;
    class CommentController extends Controller
    {
        public function comment(Request $request){
            $request->validate([
                'comment'=>'required|max:255|min:5|string'
            ]);
            $id = Auth()->user()->id;
            $date = date('Y-m-d H:i:s');
            $result = DB::table('comments')->insert([
                'user_id' => $id,
                'news_id' => $request->news_id,
                'comment' => $request->comment,
                'status' => 'active',
                'created_at' => $date,
                'updated_at' => $date
            ]);
            if ($result) {
                $request->session()->flash('commentSuccess','comment posted');
            } else {
                $request->session()->flash('commentDanger','comment not posted');
            }
            
            return redirect()->back();
        }
    }