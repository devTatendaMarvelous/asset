<?php

namespace App\Traits;

use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\Result\PngResult;
use Exception;
use Illuminate\Support\Facades\Gate;

trait Core
{

    public function errorOccurredMessage(): string
    {
        return 'An error occurred while processing your request. Please try again later.';

    }

    public function notAllowedMessage(): string
    {
        return 'You are not allowed to access this page';

    }

    /**
     * Check user permission and execute callback if authorized.
     */
    private function checkPermission($ability, callable $callback)
    {
        if (!Gate::allows($ability)) {
            abort(403, "You are not allowed to access this page");
        }

        try {
            return $callback();
        } catch (Exception $exception) {
            dd($exception->getMessage());
            toast($this->errorOccurredMessage(), 'error');
            return back();
        }
    }


    function paymentCycles(): array
    {
        $start = Carbon::createFromDate(2020, 1, 1);
        $end = Carbon::now()->subMonth();
        $cycles = [];

        while ($end->greaterThanOrEqualTo($start)) {
            $cycles[] = $end->month . $end->year;
            $end->subMonth();
        }
        return $cycles;
    }




    function generateQr($id,$serial): void
    {
        $qrCode = new QrCode("$id@$serial");
        $writer = new PngWriter();

        /** @var PngResult $result */
        $result = $writer->write($qrCode);

    $filePath = storage_path('app/public/assets/qr_' . $serial . '.png');
    if (!file_exists(dirname($filePath))) {
        mkdir(dirname($filePath), 0755, true);
    }
    file_put_contents($filePath, $result->getString());
//        return base64_encode($result->getString());


    }



    function getAssetTypes()
    {
        return ['LAPTOP',
            'TABLET',
            'SMARTPHONE',
            'SMARTWATCH',
            'E-READER',
            'HEADPHONES',
            'PORTABLE SPEAKER',
            'DIGITAL CAMERA',
            'FITNESS TRACKER',
            'EXTERNAL HARD DRIVE',
            'USB FLASH DRIVE',
            'CALCULATOR',
            'GAMING CONSOLE',
            'VR HEADSET',
            'PRINTER',
            'SCANNER',
            'GRAPHICS TABLET',
            'WEBCAM',
            'MICROPHONE',
            'PROJECTOR',
            'ROUTER',
            'MODEM',
            'BLUETOOTH ADAPTER',
            'WIRELESS MOUSE',
            'WIRELESS KEYBOARD',
            'POWER BANK',
            'CHARGING CABLE',
            'SD CARD',
            'CARD READER',
            'PORTABLE MONITOR',
            'DESKTOP COMPUTER',
            'NETWORK SWITCH',
            'NETWORK HUB',
            'SMART GLASSES',
            'DRONE',
            'ACTION CAMERA',
            '3D PRINTER',
            'SMART PEN',
            'PORTABLE DVD PLAYER',
            'PORTABLE SSD',
            'PORTABLE HDD',
            'VR CONTROLLER',
            'GAMEPAD',
            'JOYSTICK',
            'GRAPHICS CARD',
            'MOTHERBOARD',
            'CPU',
            'RAM MODULE',
            'SPEAKERPHONE',
            'SMART LIGHT',
            'SMART PLUG',];

    }
    public function systemPermissions(): array
    {
        return [

            'Access Settings',

            //Agents Permissions
            'Access Agents',
            'View Agents',
            'Edit Agents',
            'Delete Agents',
            'Add Agents',
            'Manage Agents',


        ];
    }
}
