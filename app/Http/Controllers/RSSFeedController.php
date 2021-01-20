<?php

namespace App\Http\Controllers;

use App\Models\rssfeed;
use View;
use Request;
use Redirect;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;

class RSSFeedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rssfeeds = rssfeed::all()->where('user_id', '=', Auth::user()->id);
        return View::make('rss.viewfeed')
            ->with('rssfeeds', $rssfeeds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rss.addfeed');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate posted form data
        $rules = array(
            'rss_name' => 'required',
            'rss_url' => 'required',
            'user_id' => 'required'
        );
       
        $validator = Validator::make(Request::all(), $rules);

        // process the login
        if ($validator->fails()) {
            //print_r(Request::all());
             return Redirect::to('rssfeeds/create')
                ->withErrors($validator);
        } else {
            // store
            $rssfeeds = new rssfeed;
            $rssfeeds->rss_name = Request::get('rss_name');
            $rssfeeds->rss_url = Request::get('rss_url');
            $rssfeeds->user_id = Request::get('user_id');
            $rssfeeds->save();

            // redirect
            Session::flash('message', 'Successfully created RSS Feed!');
            return Redirect::to('rssfeeds');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rssfeed  $rssfeed
     * @return \Illuminate\Http\Response
     */
    public function show(rssfeed $rssfeed)
    {
        $rssFeedContent = @file_get_contents($rssfeed->rss_url);
        $xml = simplexml_load_string($rssFeedContent, 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        if($array != FALSE) {
            return View::make('rss.showfeed')
                ->with('array', $array);
        } else {
            Session::flash('message', 'Unable to show RSS Feed!');
            return Redirect::to('rssfeeds');
        }
    }

    /**
     * Display all resources.
     *
     * @param  \App\Models\rssfeed  $rssfeed
     * @return \Illuminate\Http\Response
     */
    public function showRssFeeds()
    {
        $rssfeeds = rssfeed::all()->where('user_id', '=', Auth::user()->id);
        $rssFeedsArray = array();
        $rssOutputArray = array();

        foreach($rssfeeds as $rssfeed) {
            $rssFeedContent = @file_get_contents($rssfeed['rss_url']);
            $xml = simplexml_load_string($rssFeedContent, 'SimpleXMLElement', LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            if($array != FALSE) {
                foreach($array['channel'] as $key=>$val) {
                    if($key=='title' || $key=='description' || $key=='link') {
                        if(!empty($val)) {
                            $rssFeedsArray[$key] = $val;
                        }
                    } elseif ($key=='image') {
                        foreach($val as $subKey=>$subVal) {
                            if($subKey=='url') {
                                if(!empty($val)) {
                                    $rssFeedsArray[$key] = $val;
                                }
                            }
                        }
                    }
                }
                $rssOutputArray[$rssfeed['rss_name']] = $rssFeedsArray;
            }
        }

        return View::make('rss.showrssfeeds')
            ->with('rssOutputArray', $rssOutputArray);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rssfeed  $rssfeed
     * @return \Illuminate\Http\Response
     */
    public function edit(rssfeed $rssfeed)
    {
        return View::make('rss.editfeed')
            ->with('rssfeed', $rssfeed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rssfeed  $rssfeed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rssfeed $rssfeed)
    {
        // Validate posted form data
        $rules = array(
            'rss_name' => 'required',
            'rss_url' => 'required',
            'user_id' => 'required'
        );
       
        $validator = Validator::make(Request::all(), $rules);

        // process the login
        if ($validator->fails()) {
             return Redirect::to('rssfeeds/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $rssfeed->update(Request::all());

            // redirect
            Session::flash('message', 'Successfully updated RSS Feed!');
            return Redirect::to('rssfeeds');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rssfeed  $rssfeed
     * @return \Illuminate\Http\Response
     */
    public function destroy(rssfeed $rssfeed)
    {
        $rssfeed->delete();

        return redirect()->route('rssfeeds.index')
            ->with('success', 'Rssfeed deleted successfully');
    }
}
