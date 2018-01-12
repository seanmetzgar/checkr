<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CheckrCandidate as CheckrCandidate;
use Input;
use GuzzleHttp\Client;

class CheckrCandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = CheckrCandidate::all();
        return view('checkr.candidates.index')->withCandidates($candidates);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checkr.candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        dump($data);

        $guzzleClient = new Client();
        $checkrResponse = $guzzleClient->request('POST', 'https://api.checkr.com/v1/candidates', [
            'form_params' => [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'middle_name' => $data['middle_name'],
                'dob' => $data['dob'],
                'ssn' => $data['ssn'],
                'zipcode' => $data['zipcode'],
                'email' => $data['email'],
            ],
            'auth' => [env('CHECKR_API_KEY'), '']
        ]);

        print_r($checkrResponse->getStatusCode());
        echo "<br><br>";
        dump($checkrResponse->getHeader('content-type'));

        $stuff = $checkrResponse->getBody();
        echo $stuff;


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
