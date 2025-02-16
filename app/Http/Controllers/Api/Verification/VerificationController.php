<?php

namespace App\Http\Controllers\Api\Verification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Services\SMSService;
use Exception;

class VerificationController extends Controller
{
    /**
     * Envia o código de verificação por SMS.
     */
    public function sendPhoneVerification()
    {
        try {
            $user = auth('api')->user();

            if (!$user->phone) {
                return response()->json([
                    'status' => false,
                    'message' => 'Usuário não possui telefone cadastrado'
                ], 400);
            }

            // Gera um código de validação de 6 dígitos
            $code = rand(100000, 999999);

            // Salva o código e o horário de expiração
            $user->phone_verification_code = $code;
            $user->phone_verification_expires_at = now()->addMinutes(10);
            $user->save();

            // Constrói a mensagem
            $message = "Bem-vindo ao Cassino TemPix! Seu codigo de verificacao: $code. Venha se divertir e boa sorte!";

            // Envia o SMS
            SMSService::send($user->phone, $message);

            return response()->json([
                'status'  => true,
                'message' => 'Codigo de verificacao enviado por SMS!'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao enviar SMS: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Envia o código de verificação por e-mail.
     */
    public function sendEmailVerification()
    {
        try {
            $user = auth('api')->user();

            if (!$user->email) {
                return response()->json([
                    'status' => false,
                    'message' => 'Usuário não possui email cadastrado'
                ], 400);
            }

            // Gera um código de validação de 6 dígitos
            $code = rand(100000, 999999);

            // Salva o código e o horário de expiração
            $user->email_verification_code = $code;
            $user->email_verification_expires_at = now()->addMinutes(10);
            $user->save();

            // Envia o e-mail utilizando o Mailable
            Mail::to($user->email)->send(new VerificationMail($user, $code));

            return response()->json([
                'status'  => true,
                'message' => 'Codigo de verificacao enviado para o e-mail!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao enviar código de verificação: ' . $e->getMessage()
            ], 500);
        }
    }

    public function confirmEmailVerification(Request $request)
    {
        $rules = [
            'code' => 'required|digits:6'
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = auth('api')->user();

        if ($user->email_verification_code != $request->code) {
            return response()->json(['status' => false, 'message' => 'Codigo incorreto.'], 400);
        }

        if (now()->greaterThan($user->email_verification_expires_at)) {
            return response()->json(['status' => false, 'message' => 'Codigo expirado.'], 400);
        }

        $user->email_verified_at = now();
        $user->email_verification_code = null;
        $user->save();

        // Retornar o usuário atualizado
        return response()->json([
            'status' => true, 
            'message' => 'Email verificado com sucesso!',
            'user' => $user->fresh()
        ]);
    }

    public function confirmPhoneVerification(Request $request)
    {
        $rules = [
            'code' => 'required|digits:6'
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = auth('api')->user();

        if ($user->phone_verification_code != $request->code) {
            return response()->json(['status' => false, 'message' => 'Codigo incorreto.'], 400);
        }

        if (now()->greaterThan($user->phone_verification_expires_at)) {
            return response()->json(['status' => false, 'message' => 'Codigo expirado.'], 400);
        }

        $user->phone_verified_at = now();
        $user->phone_verification_code = null;
        $user->save();

        // Retornar o usuário atualizado, como fizemos com o email
        return response()->json([
            'status' => true, 
            'message' => 'Telefone verificado com sucesso!',
            'user' => $user->fresh()
        ]);
    }
} 