<?php

class Weather

{
    private string $apiKey;
    private string $city;

    public function __construct(string $apiKey, string $city)
    {
        $this->apiKey = $apiKey;
        $this->city = $city;
    }

    public function getForecast(): array|null
    {
        $curl = curl_init("https://api.openweathermap.org/data/2.5/forecast?q={$this->city}&appid={$this->apiKey}&units=metric&lang=fr");
        curl_setopt_array($curl, [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 1
        ]);
        $data = curl_exec($curl);
        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE !== 200)) {
            return null;
        }
        $results = [];
        $data = json_decode($data, true);

        foreach ($data['list'] as $day) {
            $results[] = [
                'temp' => $day['main']['temp'],
                'description' => $day['weather'][0]['description'],
                'date' => new DateTime('@' . $day['dt'])
            ];
        }
        return $results;
    }
}