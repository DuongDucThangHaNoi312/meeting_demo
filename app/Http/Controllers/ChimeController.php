<?php

namespace App\Http\Controllers;

use Aws\Chime\ChimeClient;
use Aws\Chime\Exception\ChimeException;
use Aws\Credentials\Credentials;
use Illuminate\Http\Request;

/**
 *
 */
class ChimeController
{
    protected $credentials;
    protected $chime;


    public function __construct() {
        $credentials = new Credentials(
            env('AWS_ACCESS_KEY_ID'),
            env('AWS_SECRET_ACCESS_KEY'),
        );

        $this->chime = new ChimeClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => $credentials,
        ]);
    }


    public function index() {
        return view('meeting');
    }

    public function createMeeting(Request $request)
    {
        $attendeeName = $request->USERNAME;
        $data = [];

        try {
            if(!$request->meetingId) {
                $response = $this->chime->createMeeting([
                    'ClientRequestToken' => uniqid(),
                    'MediaRegion' => env('AWS_DEFAULT_REGION'),
                    'StartTime' => '2021-03-01T09:00:00Z',
                    'EndTime' => '2021-03-01T10:00:00Z',
                ]);
                $meetingId = $response['Meeting']['MeetingId'];
                $data['Attendee'] = $this->createAttendee($meetingId, $attendeeName);
                $data['Meeting'] = $response['Meeting'];
            } else {
                $data['Meeting'] = $this->getDetailMeeting($request->meetingId)['Meeting'] ?? '';
                $data['Attendee'] = $this->createAttendee($request->meetingId, $attendeeName);
            }

            return $data;
        } catch (ChimeException $e) {
            return response()->json([
                'error' => 'Error create meeting'
            ], 500);
        }
    }


    protected function getDetailMeeting($meetingId){
        $meeting = $this->chime->getMeeting([
            'MeetingId' => $meetingId,
        ]);

        return $meeting;
    }


    public function createAttendee($meetingId,  $attendeeName)
    {
        try {
            $response = $this->chime->createAttendee([
                'MeetingId' => $meetingId,
                'ExternalUserId' => uniqid(),
                'Tags' => [
                    [
                        'Key' => 'Name',
                        'Value' => $attendeeName
                    ],
                ]
            ]);


            return $response['Attendee'] ?? '';
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error joining meeting'
            ], 500);
        }
    }

    public function endMeeting($meetingId)
    {
        try {
            $response = $this->chime->deleteMeeting([
                'MeetingId' => $meetingId
            ]);

            return response()->json([
                'message' => 'Meeting ended successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error ending meeting'
            ], 500);
        }
    }
}
