<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index($anime) {
        $links = \App\Link::where('episode_id', 'like', $anime)->where('type', 'watch')->get();
        // $links['episode_id'];
        return view('link', compact('links', 'anime'));
    }

    public function store(Request $works, $episode) {
        $all_links = \App\Link::where('episode_id', 'like', $episode)->where('type', 'watch')->get('id');
        if (count($all_links) > 0) {
            // All stored links
            $ids = [];
            foreach ($all_links as $link) {
                array_push($ids, $link['id']);
            }
            // return $ids[1];

            // Links that works
            $woks_ids = array();
            foreach ($works->except('_token') as $key => $value) {
                array_push($woks_ids, $key);
            }
            // return $woks_ids[0];
            
            // Update links
            foreach ($ids as $id) {
                if (!in_array($id, $woks_ids)) {
                    \App\Link::where('id', $id)->update(['working' => false]);
                }
            }
        }

        $anime = explode('_', $episode)[0];
        $ep = explode('_', $episode)[1];
        $ep_id = \App\Episode::where('episode_id', $episode)->get('id')[0]['id'];
        $next_ep_id = \App\Episode::where('id', $ep_id+1)->get('episode_id')[0]['episode_id'];

        return redirect('/links/'.$next_ep_id);
    }
}
