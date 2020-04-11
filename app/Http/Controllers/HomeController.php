<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\SpintaxInput;
use App\Model\SpintaxOutput;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function process($text)
    {
        return preg_replace_callback(
            '/\{(((?>[^\{\}]+)|(?R))*?)\}/x',
            array($this, 'replace'),
            $text
        );
    }

    public function replace($text)
    {
        $text = $this->process($text[1]);
        $parts = explode('|', $text);
        return $parts[array_rand($parts)];
    }

    public function spin(Request $request)
    {
        if($request->spin === 'spin') {
            $output = $this->process($request->spinner_input);
        }

        // $outputs = SpintaxOutput::orderBy('spintax', 'ASC')->get();
        // $spintaxCollections = [];
        // foreach ($outputs as $o) $spintaxCollections[$o->target_id] = '';
        // foreach ($outputs as $o)
        //     $spintaxCollections[$o->target_id] =
        //         $spintaxCollections[$o->target_id] === '' ?
        //             $spintaxCollections[$o->target_id].$o->spintax : $spintaxCollections[$o->target_id].'|'.$o->spintax;

        $data = [
            'input' => $request->spinner_input,
            'output' => $output
        ];

        return view('pages.welcome')->with($data);
    }


    public function welcome()
    {
        $input = null;
        $output = null;

        $data = [
            'input' => $input,
            'output' => $output
        ];
        return view('pages.welcome')->with($data);
    }
}
