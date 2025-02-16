<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class SMSService
{
    /**
     * Envia o SMS utilizando os parâmetros passados.
     *
     * Nota: Esse método não gera nem altera o código de verificação;
     * o controller deve montar a mensagem completa e enviar.
     *
     * @param string $phone   Número do telefone (pode vir com ou sem prefixo)
     * @param string $message Mensagem completa a ser enviada (já com o código)
     * @return bool
     * @throws Exception
     */
    public static function send($phone, $message)
    {
        try {
            // Log inicial (para depuração)
            file_put_contents(
                storage_path('logs/sms.log'),
                date('Y-m-d H:i:s') . " - Iniciando envio de SMS via Infobip\n",
                FILE_APPEND
            );

            // Remove todos os caracteres que não são dígitos
            $phone = preg_replace('/[^0-9]/', '', $phone);
            file_put_contents(
                storage_path('logs/sms.log'),
                date('Y-m-d H:i:s') . " - Número formatado (sem prefixo): {$phone}\n",
                FILE_APPEND
            );

            // Adiciona o prefixo "55" se não estiver presente
            if (substr($phone, 0, 2) !== "55") {
                $phone = "55" . $phone;
                file_put_contents(
                    storage_path('logs/sms.log'),
                    date('Y-m-d H:i:s') . " - Prefixo adicionado: {$phone}\n",
                    FILE_APPEND
                );
            }
            
            // Remove acentuação (caso haja) e mantém exatamente a mensagem passada
            $message = iconv('UTF-8', 'ASCII//TRANSLIT', $message);
            // Trunca para 160 caracteres, se necessário
            if (strlen($message) > 160) {
                $message = substr($message, 0, 160);
            }

            // Configurações da API Infobip
            $apiKey  = 'a8f60fe88b4448f0f4e72984561784b9-97f99a18-2062-42e8-8688-60b38fd074b9';
            $baseUrl = 'https://2mglg6.api.infobip.com';
            $endpoint = '/sms/1/text/single';
            $url = $baseUrl . $endpoint;

            // Sender ID autorizado (sender alfanumérico pode ser bloqueado);
            // aqui é usado um sender numérico, por ex.: "27368"
            $sender = "TEMPIX";

            // O payload é construído com base na mensagem passada do controller
            $payload = [
                "from" => $sender,
                "to"   => $phone,
                "text" => $message
            ];

            // Codifica o payload em JSON preservando os caracteres (sem escapes desnecessários)
            $jsonPayload = json_encode($payload, JSON_UNESCAPED_UNICODE);

            // Realiza a requisição HTTP POST para o endpoint da Infobip
            $response = Http::withHeaders([
                'Authorization' => 'App ' . $apiKey,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json'
            ])->withBody($jsonPayload, 'application/json')->post($url);

            // Log da resposta da Infobip
            $responseBody = $response->body();
            file_put_contents(
                storage_path('logs/sms.log'),
                date('Y-m-d H:i:s') . " - Resposta Infobip: " . $responseBody . "\n",
                FILE_APPEND
            );

            $jsonResponse = json_decode($responseBody, true);
            $jsonMessages = $jsonResponse['messages'][0] ?? [];
            $statusName = $jsonMessages['status']['name'] ?? '';
            $statusDescription = $jsonMessages['status']['description'] ?? '';

            // Considera o SMS enviado com sucesso se:
            // - o status for "PENDING_ACCEPTED"
            // - ou se a descrição do status for "Message sent to next instance"
            if ($statusName === 'PENDING_ACCEPTED' || $statusDescription === 'Message sent to next instance') {
                return true;
            }

            throw new Exception('Erro ao enviar SMS: ' . $statusDescription);
        } catch (Exception $e) {
            file_put_contents(
                storage_path('logs/sms.log'),
                date('Y-m-d H:i:s') . " - ERRO: " . $e->getMessage() . "\n\n",
                FILE_APPEND
            );
            throw $e;
        }
    }
}