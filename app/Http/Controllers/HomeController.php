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

    public function process_spin($text)
    {
        return preg_replace_callback(
            '/\{(((?>[^\{\}]+)|(?R))*?)\}/x',
            array($this, 'replace'),
            $text
        );
    }

    public function replace($text)
    {
        $text = $this->process_spin($text[1]);
        $parts = explode('|', $text);
        return $parts[array_rand($parts)];
    }

    public function starts_with_upper($str) {
        $chr = mb_substr ($str, 0, 1, "UTF-8");
        return mb_strtolower($chr, "UTF-8") != $chr;
    }

    public function is_part_upper($str) {
        return (bool) preg_match('/[A-Z]/', $str);
    }

    public function spintax($result, $synonyms) {
        if ($synonyms != '') {
            $result =
                $result
                .'{'
                .$synonyms
                .'}';
        }
        return $result;
    }

    public function process_spintax2($text)
    {
        $spintaxCollections = SpintaxOutput::orderBy('spintax', 'ASC')->get();
        $spintaxTargetIdDict = [];
        foreach ($spintaxCollections as $sc) $spintaxTargetIdDict[$sc->target_id] = '';
        foreach ($spintaxCollections as $sc)
            $spintaxTargetIdDict[$sc->target_id] =
                $spintaxTargetIdDict[$sc->target_id] === '' ?
                    $spintaxTargetIdDict[$sc->target_id].$sc->spintax : $spintaxTargetIdDict[$sc->target_id].'|'.$sc->spintax;

        $parts = preg_split('/(?<=\s)|(?<=\w)(?=[.,:;!?()-])|(?<=[.,!()?\x{201C}])(?=[^ ])/u', $text);
        $spintaxText = '';

        foreach ($parts as $p) {
            $trimmed_p = trim($p);
            if (strlen($trimmed_p) == 1) {
                if ($this->starts_with_upper($trimmed_p)) {
                    $t = SpintaxInput::where('target', strtolower($trimmed_p))->first();
                    if ($t != null)
                        $spintax = $this->spintax($spintaxText, ucwords($spintaxTargetIdDict[$t->id], "|"));
                    else
                        $spintaxText = $spintaxText.$trimmed_p;
                }
                else
                {
                    $t = SpintaxInput::where('target', $trimmed_p)->first();
                    if ($t != null)
                        $spintaxText = $this->spintax($spintaxText, $spintaxTargetIdDict[$t->id]);
                    else
                        $spintaxText = $spintaxText.$trimmed_p;
                }
            }
            else {
                if (!$this->is_part_upper(substr($trimmed_p,1))) {
                    if ($this->starts_with_upper($trimmed_p)) {
                        $t = SpintaxInput::where('target', strtolower($trimmed_p))->first();
                        if ($t != null)
                            $spintaxText = $this->spintax($spintaxText, ucwords($spintaxTargetIdDict[$t->id], "|"));
                        else
                            $spintaxText = $spintaxText.$trimmed_p;
                    }
                    else
                    {
                        $t = SpintaxInput::where('target', $trimmed_p)->first();
                        if ($t != null)
                            $spintaxText = $this->spintax($spintaxText, $spintaxTargetIdDict[$t->id]);
                        else
                            $spintaxText = $spintaxText.$trimmed_p;
                    }
                }
                else {
                    $spintaxText = $spintaxText.$trimmed_p;
                }
            }

            if (strpos($p, ' '))
                $spintaxText = $spintaxText.' ';
        }
        return $spintaxText;
    }


    public function spin(Request $request)
    {
        $output = null;
        if ($request->spin === 'spin') {
            $output = $this->process_spin($request->spinner_input);
        }
        else if ($request->spin === 'spintax1') {
            $output = $this->process_spintax1($request->spinner_input);
        }
        else if ($request->spin === 'spintax2') {
            $output = $this->process_spintax2($request->spinner_input);
        }

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
