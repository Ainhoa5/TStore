<?php
namespace App\Controllers;

// En /app/ApiClient.php

/**
 * Clase ApiClient para realizar solicitudes HTTP a una API.
 * 
 * Esta clase utiliza cURL para hacer solicitudes HTTP a una API externa
 * especificada por una URL base. Soporta el método POST, con capacidad para
 * extenderse a otros métodos HTTP según sea necesario.
 */
class ApiClient
{
    /**
     * La URL base de la API a la que se hacen las solicitudes.
     *
     * @var string
     */
    private $baseUrl;
    /**
     * Constructor de la clase ApiClient.
     *
     * Inicializa el cliente API con la URL base de la API.
     *
     * @param string $baseUrl La URL base de la API.
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Envía una solicitud HTTP a la API.
     *
     * Realiza una solicitud HTTP usando cURL basado en el método especificado,
     * el endpoint de la API y los datos a enviar. Actualmente soporta el método
     * POST, pero puede ser extendido para soportar otros métodos HTTP.
     *
     * @param string $method El método HTTP de la solicitud ('POST').
     * @param string $endpoint El endpoint de la API a la cual se hace la solicitud.
     * @param array $data Los datos que se enviarán con la solicitud.
     * 
     * @return array La respuesta de la API decodificada desde JSON.
     * @throws \Exception Si ocurre un error durante la solicitud cURL.
     */
    public function sendRequest($method, $endpoint, $data = [])
    {
        // Asegúrate de que no haya una barra adicional despues de '?op='
        $url = $this->baseUrl . ltrim($endpoint, '/');
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        // Agregar más configuraciones según sea necesario para otros métodos HTTP
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch));
        }

        curl_close($ch);
        return json_decode($response, true);
    }
}