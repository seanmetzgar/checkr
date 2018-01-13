<?php

namespace App\Http\Controllers;

use App\CheckrEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckrEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        if (($request->hasHeader('X-Checkr-Signature') || $request->hasHeader('X-Sean-Test'))
            && $request->hasHeader('Content-Type')
            && $request->header('Content-Type') == 'application/json') {
            //
            $dataString = $request->getContent();

            if ($dataString) {
                if ($request->hasHeader('X-Sean-Test')) {
                    $checkrSignature = hash_hmac('sha256', $dataString, env('CHECKR_API_KEY'));
                } else {
                    $checkrSignature = $request->header('X-Checkr-Signature');
                }

                $dataSignature = hash_hmac('sha256', $dataString, env('CHECKR_API_KEY'));
                $verifiedHash = hash_equals($checkrSignature, $dataSignature);

                if ($verifiedHash) {

                    $eventType = $request->input('type');
                    if (strpos($eventType, 'report.') === 0) {
                        $objectType = "report";
                    } elseif (strpos($eventType, 'candidate.') === 0) {
                        $objectType = "candidate";
                    } elseif (strpos($eventType, 'invitation.') === 0) {
                        $objectType = "invitation";
                    } else {
                        $objectType = "unknown";
                    }

                    $eventData = [];
                    $eventData['event_id'] = $request->input('id');
                    $eventData['object'] = $request->input('object');
                    $eventData['type'] = $request->input('type');
                    $eventData['data'] = $request->input('data');
                    $eventData['checkr_created_at'] = $request->input('created_at') ? Carbon::parse($request->input('created_at')) : null;
                    $eventData['checkr_object_id'] = $request->input('data.object.id');
                    $eventData['checkr_object_type'] = $objectType;

                    $event = new CheckrEvent;
                    $event->fill($eventData);
                    $event->save();

                    $responseMessage = "Event created successfully.";
                    $responseStatus = 201;

                } else {
                    $responseMessage = "Could not verify request authenticity.";
                    $responseStatus = 403;
                }
            } else {
                $responseMessage = "Request data could not be found or verified.";
                $responseStatus = 403;
            }
        } else {
            $responseMessage = "Invalid request headers.";
            $responseStatus = 403;
        }
        return response()->json(["message" => $responseMessage], $responseStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CheckrEvent  $checkrEvent
     * @return \Illuminate\Http\Response
     */
    public function show(CheckrEvent $checkrEvent)
    {

    }
}
