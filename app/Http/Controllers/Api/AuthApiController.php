<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponses;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;
use libphonenumber\PhoneNumberUtil;
use function response;

class AuthApiController extends Controller
{

    use ApiResponses;

    public function authentication(Request $request)
    {
        $input = $request->input('auth_input');
        $field = null;
        $phoneNumber = null;

        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } else {
            $phoneNumber = $input;

            try {
                $phoneNumberUtil = PhoneNumberUtil::getInstance();
                $parsedNumber = $phoneNumberUtil->parse($phoneNumber, 'IR');
                $isValidNumber = $phoneNumberUtil->isValidNumber($parsedNumber);

                if ($isValidNumber) {
                    $phoneNumberNATIONAL = $phoneNumberUtil->format($parsedNumber, PhoneNumberFormat::NATIONAL);
                    $phoneNumberType = $phoneNumberUtil->getNumberType($parsedNumber);

                    if ($phoneNumberType === PhoneNumberType::MOBILE) {
                        $field = 'mobile';
                        $phoneNumber = str_replace(' ', '', $phoneNumberNATIONAL);
                    }
                } else {
                    return new JsonResponse(['message' => 'شماره همراه وارد شده صحیح نمیباشد '], 400);

                }
            } catch (NumberParseException $e) {
                \Log::error($e->getMessage());
                return new JsonResponse(['message' => 'parsing exception...'], 500);
            }
        }


        $user = User::where($field, $input)->first();
        if (empty($user)) {
            $user = new User();
            $user->password = Hash::make(Str::random(8));

            if ($field === 'email') {
                $user->email = $input;
            } else {
                $user->mobile = $phoneNumber;
            }
            $user->save();
        }

        $otpCode = rand(111111, 999999);
        $token = Str::random(60);
        $expiresAt = Carbon::now()->addMinutes(2); // Set expiration time to 2 minutes

        Otp::create([
            'token' => $token,
            'otp_code' => $otpCode,
            'type' => $field,
            'user_id' => $user->id,
            'expires_at' => $expiresAt,
        ]);

        $currentTime = Carbon::now();
        $remainingTime = $currentTime->diffInSeconds($expiresAt);


        if ($field === 'email') {
            // Send OTP to the user's email
            // Code to send OTP via email goes here
            // Since this is an API, you can return a success response here
            return new JsonResponse(['message' => 'OTP sent to email'], 200);
        }


        $receptor = $phoneNumber;
        $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
        $template = 'digishop';
        $param1 = $otpCode;
        $ghasedak_response = GhasedakFacade::setVerifyType($type)->Verify($receptor, $template, $param1);
        $ghasedak_result = $ghasedak_response->result;

        if (isset($ghasedak_result->code) && $ghasedak_result->code === 200) {

            $response_data = [
                'success' => true,
                'message' => 'OTP Sent Successfully',
                'data' => [
                    'expires_at' => $expiresAt->format('Y-m-d H:i:s'),
                    'remaining_time' => $remainingTime,
                    'token' => $token,
                    'otp_code' => $otpCode
                ],
                'ghasedak_response' => [
                    'code' => $ghasedak_result->code,      // Accessing the property using -> (arrow) notation
                    'message' => $ghasedak_result->message
                ]
            ];

            return new JsonResponse($response_data, 200);
        } else {
            // The OTP sending process failed or encountered an error
            // Return an appropriate error response to the user
            return new JsonResponse(['message' => 'OTP sending failed. Please try again later.'], 500);
        }


    }


    public function verify(Request $request, $token)
    {

        try {
            $input = $request->only('otp_input');
            $request->validate([
                'otp_input' => 'required|min:6|max:6',
            ]);
            $otp = Otp::where('token', $token)
                ->where('otp_code', $input['otp_input'])
                ->where('used', 0)
                ->where('expires_at', '>=', Carbon::now()) // Check if OTP code has not expired
                ->first();
            if (!$otp) {
                return response()->json(['message' => 'Invalid OTP.'], 400);
            }
            $otp->used = 1;
            $otp->save();
            $user = $otp->user;
            if (!$user->activation) {
                $user->activation = true;
                $user->activation_date = Carbon::now();
            }
            if ($otp->type == 'mobile' && empty($user->mobile_verified_at)) {
                $user->mobile_verified_at = Carbon::now();
            } else {
                $user->email_verified_at = Carbon::now();
            }
            $user->save();// Generate a new API token for the user using Sanctum
            $jwt = $user->createToken('api-token')->plainTextToken;
            return new JsonResponse(['message' => 'Verification successful.', 'jwt' => $jwt, 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);

        }
    }

    public function resendOtp($token)
    {
        $otp = Otp::where('token', $token)->first();


        if (!$otp) {
            return response()->json(['message' => 'Invalid token'], 400);
        }

        // Generate a new OTP code
        $token = Str::random(60);
        $otpCode = rand(111111, 999999);
        $expiresAt = Carbon::now()->addMinutes(2);

        $user = $otp->user()->first();


        $newOtp = Otp::create([
            'token' => $token,
            'otp_code' => $otpCode,
            'type' => $otp->type,
            'user_id' => $user->id,
            'expires_at' => $expiresAt,
        ]);

        $currentTime = Carbon::now();
        $remainingTime = $currentTime->diffInSeconds($expiresAt);


        // Send the OTP code to the user again (via email or SMS)
        // Code to send OTP via email or SMS goes here

        if ($otp->type == 'mobile') {
            $receptor = $user->mobile;
            $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
            $template = 'digishop';
            $param1 = $otpCode;
            $ghasedak_response = GhasedakFacade::setVerifyType($type)->Verify($receptor, $template, $param1);
            $ghasedak_result = $ghasedak_response->result;

            if (isset($ghasedak_result->code) && $ghasedak_result->code === 200) {

                // Assuming $ghasedak_result is an object of stdClass
                $response_data = [
                    'success' => true,
                    'message' => 'OTP Sent Successfully',
                    'data' => [
                        'expires_at' => $expiresAt->format('Y-m-d H:i:s'),
                        'remaining_time' => $remainingTime,
                        'token' => $token,
                        'otp_code' => $otpCode
                    ],
                    'ghasedak_response' => [
                        'code' => $ghasedak_result->code,      // Accessing the property using -> (arrow) notation
                        'message' => $ghasedak_result->message // Accessing the property using -> (arrow) notation
                    ]
                ];


                // Return the JSON response with the response data
                return new JsonResponse($response_data, 200);
            } else {
                // The OTP sending process failed or encountered an error
                // Return an appropriate error response to the user
                return new JsonResponse(['message' => 'OTP sending failed. Please try again later.'], 500);
            }


        }

    }


    public function loginOrRegister(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // User does not exist, register
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'activation' =>true,
                'email_verified_at' => Carbon::now()
            ]);

            $token = $user->createToken('api-token')->plainTextToken;
            return $this->successResponse(data: [
                'user' => $user,
                'jwt' => $token
            ], message: 'ثبت نام شما با موفقیت انجام شد');

        }
        // User exists, attempt login
        if (!Hash::check($request->password, $user->password)) {
            return $this->errorResponse(
                message: 'کاربری با مشخصات وارد شده پیدا نشد.',
                code: 401);
            //  return response()->json(['message' => 'Invalid credentials'], 401);
        }


        // Generate JWT token
        $token = $user->createToken('api-token')->plainTextToken;

        return $this->successResponse(data: [
            'user' => $user,
            'jwt' => $token
        ], message: 'شما با موفقیت وارد شدید');
        // return response()->json(['token' => $token]);

    }


    public function logout()
    {
        try {
            // Revoke the current user's access token (logout)
            Auth::user()->currentAccessToken()->delete();

            // Perform any additional logout logic here
            // For example, you may clear session data, update user status, etc.

            // Return a response to the client indicating successful logout
            return response()->json(['message' => 'Logout successful'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during the logout process
            // For example, log the exception and return an error response
            \Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred during logout.'], 500);
        }
    }
}
